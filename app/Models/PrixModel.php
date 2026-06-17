<?php 
namespace App\Models;
use CodeIgniter\Model;
class PrixProduitModel extends Model{
    protected $table = 'PrixProduit';
    protected $primaryKey = 'id';
    protected $allowedFields = ['idProduit','prixUnitaire'];
}
