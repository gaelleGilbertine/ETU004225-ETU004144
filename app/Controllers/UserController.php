<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class UserController extends BaseController
{
    
    public function index()
    {
        $model = new UserModel();
        $data['users'] = $model->findAll();

        return $this->response->setJSON($data);
    }

  
    public function show($id)
    {
        $model = new UserModel();
        $user = $model->find($id);

        if (!$user) {
            return $this->response->setJSON(['message' => 'User non trouvé']);
        }

        return $this->response->setJSON($user);
    }

   
    public function create()
    {
        $model = new UserModel();
        $data = $this->request->getPost();

        $model->insert([
            'username' => $data['username'],
            'mdp' => password_hash($data['mdp'], PASSWORD_DEFAULT)
        ]);

        return $this->response->setJSON(['message' => 'Utilisateur créé']);
    }

   
    public function update($id)
    {
        $model = new UserModel();
        $data = $this->request->getPost();

        $updateData = [
            'username' => $data['username']
        ];

        if (!empty($data['mdp'])) {
            $updateData['mdp'] = password_hash($data['mdp'], PASSWORD_DEFAULT);
        }

        $model->update($id, $updateData);

        return $this->response->setJSON(['message' => 'Utilisateur mis à jour']);
    }

   
    public function delete($id)
    {
        $model = new UserModel();
        $model->delete($id);

        return $this->response->setJSON(['message' => 'Utilisateur supprimé']);
    }

  
    public function login()
    {
        $model = new UserModel();
        $data = $this->request->getPost();

        $user = $model->where('username', $data['username'])->first();

        if ($user && password_verify($data['mdp'], $user['mdp'])) {

            session()->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'isLoggedIn' => true
            ]);

            return $this->response->setJSON([
                'message' => 'Connexion réussie'
            ]);
        }

        return $this->response->setJSON([
            'message' => 'Identifiants incorrects'
        ]);
    }

  
    public function logout()
    {
        session()->destroy();

        return $this->response->setJSON([
            'message' => 'Déconnexion réussie'
        ]);
    }
}