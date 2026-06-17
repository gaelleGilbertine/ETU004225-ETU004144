<?php

namespace App\Controllers;

use App\Models\AchatDetailModel;
use CodeIgniter\Controller;

use App\Models\ProduitModel;


class AchatDetailController extends BaseController
{
    
    public function index()
    {
        $produitModel = new ProduitModel();
        $produits = $produitModel->findAll();


        return view('/achat/achat_detail_view', ['produits' => $produits]);
    }

   
    public function show($id)
    {
        $model = new AchatDetailModel();
        $detail = $model->find($id);

        if (!$detail) {
            return $this->response->setJSON([
                'message' => 'Détail non trouvé'
            ]);
        }

        return $this->response->setJSON($detail);
    }

 
    public function create()
    {
        $model = new AchatDetailModel();
        $data = $this->request->getPost();
            $session = session();
        $model->insert([
            'idAchat' => $session->get('achat_id'), // ou une autre méthode pour obtenir l'ID de l'achat en cours
            'idProduit' => $data['idProduit'],
            'quantite' => $data['quantite']
        ]);

        return $this->response->setJSON([
            'message' => 'Détail ajouté avec succès'
        ]);
    }

    public function update($id)
    {
        $model = new AchatDetailModel();
        $data = $this->request->getPost();

        $updateData = [
            'idAchat' => $data['idAchat'],
            'idProduit' => $data['idProduit'],
            'quantite' => $data['quantite']
        ];

        $model->update($id, $updateData);

        return $this->response->setJSON([
            'message' => 'Détail mis à jour'
        ]);
    }

 
    public function delete($id)
    {
        $model = new AchatDetailModel();
        $model->delete($id);

        return $this->response->setJSON([
            'message' => 'Détail supprimé'
        ]);
    }
}