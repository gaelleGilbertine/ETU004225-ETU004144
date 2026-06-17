<?php 
namespace App\Controllers;
use App\Models\ProduitModel;
use App\Models\QuantiteProduitModel;

class ProduitController extends BaseController{
    protected ProduitModel $produitModel;
  

    public function __construct(){
        $this->produitModel = new ProduitModel();
    }

    public function create(){
        $data = [
            'designation' => $this->request->getPost('designation')
        ];
        $this->produitModel->insert($data);
        return redirect()->to('/produits');
   }
   public function update($id){
    $data = [
        'designation' => $this->request->getPost('designation')
    ];
    $this->produitModel->update($id, $data);
    return redirect()->to('/produits');
   }
    public function delete($id){
        $this->produitModel->delete($id);
        return redirect()->to('/produits');
    }
    public function find($id){
        $produit = $this->produitModel->find($id);
        if($produit){
            return view('produit_view', ['produit' => $produit]);
        }else{
            return redirect()->to('/produits');
        }
    }
    public function findAll(){
        $produits = $this->produitModel->findAll();
        return view('produits_view', ['produits' => $produits]);
    }
    
}
?>