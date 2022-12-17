<?php

namespace App\Models;

use CodeIgniter\Model;

class Modelfnb extends Model
{
    protected $table = 'fnb';
    protected $primaryKey = 'id';
    protected $allowedFields = [
    'id','namafnb','hargafnb','jumlahfnb','jenisfnb'
    ];
    }
