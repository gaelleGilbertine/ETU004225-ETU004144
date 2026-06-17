<?php 
namespace App\Models;
use CodeIgniter\Model;
class ProduitModel extends Model{
    protected $table = 'Produit';
    protected $primaryKey = 'id';
    protected $allowedFields = ['designation'];

    
}

?>