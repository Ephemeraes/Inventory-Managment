<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table            = 'Item';
    protected $primaryKey       = 'specification';
    protected $allowedFields    = ['specification', 'type', 'place', 'stock_number'];
    protected $returnType       = 'array';

    public function updateStockNumber($specification, $stock_change)
    {
        $item = $this->find($specification);
        if ($item) {
            $new_stock_number = $item['stock_number'] + $stock_change;
            $this->update($specification, ['stock_number' => $new_stock_number]);
            return true;
        }
        return false; 
    }
}
