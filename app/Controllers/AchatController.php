<?php

namespace App\Controllers;

use App\Models\AchatModel;
use CodeIgniter\Controller;

class AchatController extends BaseController
{
    
    public function index()
    {
        $model = new AchatModel();
        $data['achats'] = $model->findAll();

        return $this->response->setJSON($data);
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

        $model->insert([
            'idUser' => $data['idUser'],
            'idCaisse' => $data['idCaisse'],
            'nomClient' => $data['nomClient'],
            'date' => date('Y-m-d H:i:s') // ou laisser SQLite gérer
        ]);

        return $this->response->setJSON([
            'message' => 'Achat créé avec succès'
        ]);
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