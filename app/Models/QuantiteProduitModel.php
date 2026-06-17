<?php 
namespace App\Models;
use CodeIgniter\Model;
class QuantiteProduitModel extends Model{
    protected $table = 'QuantiteProduit';
    protected $primaryKey = 'id';
    protected $allowedFields = ['idProduit','quantite'];
}


?>