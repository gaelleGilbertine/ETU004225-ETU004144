<?php

namespace App\Models;

use CodeIgniter\Model;

class AchatDetailModel extends Model
{
    protected $table = 'AchatDetail';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'idAchat',
        'idProduit',
        'quantite'
    ];

    protected $useAutoIncrement = true;
    protected $returnType = 'array'; // ou 'object'

    protected $useTimestamps = false;
}
?>