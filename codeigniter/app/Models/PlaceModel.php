<?php

namespace App\Models;

use CodeIgniter\Model;

class PlaceModel extends Model
{
    protected $table            = 'Place_change_history';
    protected $primaryKey       = 'record_id';
    protected $returnType       = 'array';
    protected $useTimestamps = false;
    protected $allowedFields    = ['record_id', 'id', 'specification', 'old_position', 'new_position', 'time', 'approve'];
}
