<?php 
namespace App\Controllers;
use App\Models\QuantiteProduitModel;
class QuantiteProduitController extends BaseController{
    protected QuantiteProduitModel $quantiteProduitModel;
    public function __construct(){
        $this->quantiteProduitModel = new QuantiteProduitModel();
    }
    public function create(){
        $data = [
            'idProduit' => $this->request->getPost('idProduit'),
            'quantite' => $this->request->getPost('quantite')
        ];
        $this->quantiteProduitModel->insert($data);
        return redirect()->to('/quantites');
    }
    public function update($id){
        $data = [
            'idProduit' => $this->request->getPost('idProduit'),
            'quantite' => $this->request->getPost('quantite')
        ];
        $this->quantiteProduitModel->update($id, $data);
        return redirect()->to('/quantites');
    }
    public function delete($id){
        $this->quantiteProduitModel->delete($id);
        return redirect()->to('/quantites');
    }
    public function find($id){
        $quantite = $this->quantiteProduitModel->find($id);
        return view('quantite_view', ['quantite' => $quantite]);
    }
    public function findAll(){
        $quantites = $this->quantiteProduitModel->findAll();
        return view('quantites_view', ['quantites' => $quantites]);
    }
}