<?php

namespace App\Models;

use CodeIgniter\Model;

class AchatModel extends Model
{
    protected $table = 'Achat';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'idUser',
        'idCaisse',
        'nomClient',
        'date'
    ];

    protected $useAutoIncrement = true;
    protected $returnType = 'array'; // ou 'object'

    protected $useTimestamps = false;
}