<?php
namespace App\Controllers;
use App\Models\CaisseModel;
class CaisseController extends BaseController{
    protected CaisseModel $caisseModel;
    public function __construct(){
        $this->caisseModel = new CaisseModel();
    }
    public function create(){
        $data = [
            'nomDeCaisse' => $this->request->getPost('nomDeCaisse')
        ];
        $this->caisseModel->insert($data);
        return redirect()->to('/caisses');
    }
    public function update($id){
        $data = [
            'nomDeCaisse' => $this->request->getPost('nomDeCaisse')
        ];
        $this->caisseModel->update($id, $data);
        return redirect()->to('/caisses');
    }
    public function delete($id){
        $this->caisseModel->delete($id);
        return redirect()->to('/caisses');
    }
    public function find($id){
        $caisse = $this->caisseModel->find($id);
        return view('caisse_view', ['caisse' => $caisse]);
    }
    public function findAll(){
        $caisses = $this->caisseModel->findAll();
        return view('caisses_view', ['caisses' => $caisses]);
    }
}

?>