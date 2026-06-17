<?php

namespace App\Controllers;

use App\Models\AchatModel;
use App\Models\CaisseModel;
class AchatController extends BaseController
{
    
    public function index(){
        $caissesModel = new CaisseModel();
        $caisses = $caissesModel->findAll();
        return view('/achat/achat_view', ['caisses' => $caisses]);
    }

  
    public function show($id)
    {
        $model = new AchatModel();
        $achat = $model->find($id);

        if (!$achat) {
            return $this->response->setJSON([
                'message' => 'Achat non trouvé'
            ]);
        }

        return $this->response->setJSON($achat);
    }

  
    public function create()
    {
        $model = new AchatModel();
        $data = $this->request->getPost();
        $session = session();
      
        $model->insert([
            'idUser' => $data['idUser'],
            // 'idCaisse' => $data['idCaisse'],
            'idCaisse' => $data['idCaisse'] ?? null, // ou gérer autrement
            'date' => date('Y-m-d H:i:s') // ou laisser SQLite gérer
        ]);
        $data['idCaisse'] = $session->get('caisse_id'); // ou une autre méthode pour obtenir l'ID de l'utilisateur connecté
        
        return redirect()->to('/achatDetail');
    }

  
    public function update($id)
    {
        $model = new AchatModel();
        $data = $this->request->getPost();

        $updateData = [
            'idUser' => $data['idUser'],
            'idCaisse' => $data['idCaisse'],
            'nomClient' => $data['nomClient']
        ];

        // optionnel : mise à jour date
        if (!empty($data['date'])) {
            $updateData['date'] = $data['date'];
        }

        $model->update($id, $updateData);

        return $this->response->setJSON([
            'message' => 'Achat mis à jour'
        ]);
    }

    
    public function delete($id)
    {
        $model = new AchatModel();
        $model->delete($id);

        return $this->response->setJSON([
            'message' => 'Achat supprimé'
        ]);
    }
}