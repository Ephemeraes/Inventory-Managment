<?php

namespace App\Models;

use CodeIgniter\Model;

class NumberModel extends Model
{
    protected $table            = 'Stock_change_history';
    protected $primaryKey       = 'record_id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['record_id', 'id', 'specification', 'stock_change', 'time', 'approve'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;
    protected $useTimestamps = false;
}
