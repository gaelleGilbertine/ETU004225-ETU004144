<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'User';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'username',
        'mdp'
    ];

    protected $useAutoIncrement = true;
    protected $returnType = 'array'; // ou 'object'

    protected $useTimestamps = false;
}