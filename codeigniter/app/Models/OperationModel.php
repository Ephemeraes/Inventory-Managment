<?php

namespace App\Models;

use CodeIgniter\Model;

class OperationModel extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->db = \Config\Database::connect(); 
    }

    public function getCombinedHistory()
    {
        $db = \Config\Database::connect();
        $subQuery1 = $db->table('Stock_change_history')
                ->select('record_id, Stock_change_history.id, specification, time, stock_change, NULL AS old_position, NULL AS new_position, approve, name')
                ->join('Employee', 'Employee.id = Stock_change_history.id')
                ->orderBy('time', 'ASC');

        $subQuery2 = $db->table('Place_change_history')
                ->select('record_id, Place_change_history.id, specification, time, NULL AS stock_change, old_position, new_position, approve, name')
                ->join('Employee', 'Employee.id = Place_change_history.id')
                ->orderBy('time', 'ASC');
        $query = $subQuery1->unionAll($subQuery2);
        return $query;
    }

    public function searchHistory($search)
    {
        $db = \Config\Database::connect();
        $subQuery1 = $db->table('Stock_change_history')
                ->select('record_id, Stock_change_history.id, specification, time, stock_change, NULL AS old_position, NULL AS new_position, approve, name')
                ->join('Employee', 'Employee.id = Stock_change_history.id');

        $subQuery2 = $db->table('Place_change_history')
                ->select('record_id, Place_change_history.id, specification, time, NULL AS stock_change, old_position, new_position, approve, name')
                ->join('Employee', 'Employee.id = Place_change_history.id');
        
        $subQuery1->like('specification', $search)
                    ->orLike('time', $search)
                    ->orLike('approve', $search)
                    ->orLike('name', $search);
            
        $subQuery2->like('specification', $search)
                    ->orLike('time', $search)
                    ->orLike('approve', $search)
                    ->orLike('name', $search);
        $query = $subQuery1->unionAll($subQuery2);
        return $query;
    }

    public function updateApproval($recordId, $decision)
    {
        $db = \Config\Database::connect();
        
        $data = ['approve' => $decision];
        $prefix = substr($recordId, 0, 1);
        $tableName = '';
        switch ($prefix) {
            case 'N':
                $tableName = 'Stock_change_history';
                break;
            case 'P':
                $tableName = 'Place_change_history';
                break;
            default:
                return false;
        }
        $builder = $db->table($tableName); 
        $builder->where('record_id', $recordId); 
        $result = $builder->update($data);
    
        return $result;
    }

}