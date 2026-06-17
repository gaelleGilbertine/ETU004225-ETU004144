<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CaisseModel;
use App\Models\ProduitModel;
use App\Models\PrixModel;
use App\Models\QuantiteProduitModel;
use App\Models\AchatModel;
use App\Models\AchatDetailModel;

/**
 * CaisseAppController
 *
 * Sert :
 *  - GET  /caisse            → la SPA (vue HTML)
 *  - POST /api/login         → authentification
 *  - POST /api/logout        → déconnexion
 *  - GET  /api/caisses       → liste des caisses
 *  - GET  /api/produits      → produits + prix courant + stock
 *  - POST /api/achat/creer   → crée un achat + ses détails + décrémente le stock
 */
class CaisseAppController extends BaseController
{
    /* ----------------------------------------------------------------
       Vue principale
    ----------------------------------------------------------------*/
    public function index(): string
    {
        return view('caisse/index');
    }

    /* ----------------------------------------------------------------
       POST /api/login
    ----------------------------------------------------------------*/
    public function login()
    {
        $body = $this->request->getJSON(true);
        $username = trim($body['username'] ?? '');
        $mdp      = $body['mdp'] ?? '';

        if (!$username || !$mdp) {
            return $this->response->setJSON(['success' => false, 'message' => 'Champs manquants'])->setStatusCode(400);
        }

        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        if ($user && password_verify($mdp, $user['mdp'])) {
            session()->set([
                'user_id'    => $user['id'],
                'username'   => $user['username'],
                'isLoggedIn' => true,
            ]);
            return $this->response->setJSON([
                'success' => true,
                'user'    => ['id' => $user['id'], 'username' => $user['username']],
            ]);
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Identifiants incorrects'])->setStatusCode(401);
    }

    /* ----------------------------------------------------------------
       POST /api/logout
    ----------------------------------------------------------------*/
    public function logout()
    {
        session()->destroy();
        return $this->response->setJSON(['success' => true]);
    }

    /* ----------------------------------------------------------------
       GET /api/caisses
    ----------------------------------------------------------------*/
    public function getCaisses()
    {
        $model   = new CaisseModel();
        $caisses = $model->findAll();
        return $this->response->setJSON(['caisses' => $caisses]);
    }

    /* ----------------------------------------------------------------
       GET /api/produits
       Retourne designation + prix courant (dernier enregistré) + stock
    ----------------------------------------------------------------*/
    public function getProduits()
    {
        $db = \Config\Database::connect();

        // Jointure : produit → dernier prix → stock
        $rows = $db->query("
            SELECT
                p.id,
                p.designation,
                COALESCE(pp.prixUnitaire, 0.00) AS prixUnitaire,
                COALESCE(q.quantite, 0)         AS quantite
            FROM Produit p
            LEFT JOIN (
                SELECT idProduit, prixUnitaire
                FROM PrixProduit
                WHERE id IN (
                    SELECT MAX(id) FROM PrixProduit GROUP BY idProduit
                )
            ) pp ON pp.idProduit = p.id
            LEFT JOIN (
                SELECT idProduit, quantite
                FROM QuantiteProduit
                WHERE id IN (
                    SELECT MAX(id) FROM QuantiteProduit GROUP BY idProduit
                )
            ) q ON q.idProduit = p.id
            ORDER BY p.designation
        ")->getResultArray();

        // Cast types
        foreach ($rows as &$r) {
            $r['id']          = (int)   $r['id'];
            $r['prixUnitaire']= (float) $r['prixUnitaire'];
            $r['quantite']    = (int)   $r['quantite'];
        }

        return $this->response->setJSON(['produits' => $rows]);
    }

    /* ----------------------------------------------------------------
       POST /api/achat/creer
       Body JSON : { idUser, idCaisse, lignes: [{idProduit, quantite}] }
    ----------------------------------------------------------------*/
    public function creerAchat()
    {
        $body     = $this->request->getJSON(true);
        $idUser   = (int) ($body['idUser']   ?? 0);
        $idCaisse = (int) ($body['idCaisse'] ?? 0);
        $lignes   = $body['lignes'] ?? [];

        if (!$idUser || !$idCaisse || empty($lignes)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Données manquantes'])->setStatusCode(400);
        }

        $db              = \Config\Database::connect();
        $achatModel      = new AchatModel();
        $detailModel     = new AchatDetailModel();
        $qteModel        = new QuantiteProduitModel();

        $db->transStart();

        // 1. Créer l'achat
        $idAchat = $achatModel->insert([
            'idUser'   => $idUser,
            'idCaisse' => $idCaisse,
            'date'     => date('Y-m-d H:i:s'),
        ], true);

        // 2. Insérer chaque ligne + décrémenter le stock
        foreach ($lignes as $ligne) {
            $idProduit = (int) $ligne['idProduit'];
            $quantite  = (int) $ligne['quantite'];

            $detailModel->insert([
                'idAchat'   => $idAchat,
                'idProduit' => $idProduit,
                'quantite'  => $quantite,
            ]);

            // Récupère la dernière ligne de stock pour ce produit
            $stockRow = $qteModel->where('idProduit', $idProduit)
                                 ->orderBy('id', 'DESC')
                                 ->first();

            $ancienStock = $stockRow ? (int) $stockRow['quantite'] : 0;
            $nouveauStock = max(0, $ancienStock - $quantite);

            // Insère un nouvel enregistrement de stock (historique)
            $qteModel->insert([
                'idProduit' => $idProduit,
                'quantite'  => $nouveauStock,
            ]);
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            return $this->response->setJSON(['success' => false, 'message' => 'Erreur lors de la transaction'])->setStatusCode(500);
        }

        return $this->response->setJSON(['success' => true, 'idAchat' => $idAchat]);
    }
}
