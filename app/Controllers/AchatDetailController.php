<?php

namespace App\Controllers;

use App\Models\AchatDetailModel;
use CodeIgniter\Controller;

class AchatDetailController extends Controller
{
    
    public function index()
    {
        $model = new AchatDetailModel();
        $data['details'] = $model->findAll();

        return $this->response->setJSON($data);
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

        $model->insert([
            'idAchat' => $data['idAchat'],
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