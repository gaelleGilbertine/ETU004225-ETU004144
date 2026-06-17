<?php 
namespace App\Controllers;
use App\Models\PrixProduitModel;
class PrixController extends BaseController{
    protected PrixProduitModel $prixProduitModel;
    public function __construct(){
        $this->prixProduitModel = new PrixProduitModel();
    }
    public function create(){
        $data = [
            'idProduit' => $this->request->getPost('idProduit'),
            'prixUnitaire' => $this->request->getPost('prixUnitaire')
        ];
        $this->prixProduitModel->insert($data);
        return redirect()->to('/prix');
    }
    public function update($id){
        $data = [
            'idProduit' => $this->request->getPost('idProduit'),
            'prixUnitaire' => $this->request->getPost('prixUnitaire')
        ];
        $this->prixProduitModel->update($id, $data);
        return redirect()->to('/prix');
    }
    public function delete($id){
        $this->prixProduitModel->delete($id);
        return redirect()->to('/prix');
    }
    public function find($id){
        $prix = $this->prixProduitModel->find($id);    
        return view('prix_view', ['prix' => $prix]); 
    }
    public function findAll(){
        $prix = $this->prixProduitModel->findAll();
        return view('prix_view', ['prix' => $prix]);
    }
}

?>