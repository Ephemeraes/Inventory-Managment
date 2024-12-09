<?php namespace App\Controllers;

use CodeIgniter\Controller;

class OperationController extends BaseController
{
    public function __construct()
    {
        helper('url'); 
        $this->session = session();
    }

    public function operation()
    {
        //https://codeigniter.org/user_guide/libraries/pagination.html
        $perPage = 10; 
        $model = new \App\Models\OperationModel();
        $currentPage = $this->request->getVar('page') ?? 1;
        $offset = ($currentPage - 1) * $perPage;

        // Search
        $search = $this->request->getGet('search');
        if (!empty($search)) {
            // If there are no seperated queries, rows and records will be different. This is 
            // because that query will run twice.
            $query_all = $model->searchHistory($search);
            $query_part = $model->searchHistory($search);
        } else {
            $query_all = $model->getCombinedHistory();
            $query_part = $model->getCombinedHistory();
        }
        $records = $query_all->offset($offset)
                            ->get()
                            ->getResultArray();

        // Page
        $records = array_slice($records, $offset, $perPage);
        $pager = service('pager');
        $rows = count($query_part->get()->getResultArray()); 
        $pagerLink = $pager -> makeLinks($currentPage, $perPage, $rows);
        // data
        $data = [
            'name' => 'Operation Management',
            'records' => $records,
            'message' => $this->session->getFlashdata(),
            'pagerLink' => $pager
        ];
        return view('operation', $data);
    }

    public function adduser()
    {
        $data['name'] = 'Operation Management';
        $accountModel = new \App\Models\AccountModel();
        $employeeModel = new \App\Models\EmployeeModel();
        if ($this->request->getMethod() === 'POST') {
            $data = $this->request->getPost();
            $accountData = [
                'id' => $data['id'],
                'password' => $data['password']
            ];
            $employeeData = [
                'id' => $data['id'],
                'name' => $data['name'],
                'role' =>$data['role']
            ];
            try {
                if ($accountModel->insert($accountData)) {
                    // Though succssfully inserted, $employeeModel -> insert($employeeData); always returns 0. 
                    // It should not be used in if statement.
                    $employeeModel->insert($employeeData);
                    $this->session->setFlashdata('success', 'User added successfully.');
                    return redirect()->to('/operation');
                } else {
                    $this->session->setFlashdata('error', 'Failed to add user. Please try again.');
                    return redirect()->to('/operation/adduser');
                }
            } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
                if ($e->getCode() == 1062) {
                    $this->session->setFlashdata('error', 'Duplicate ID. User already exists.');
                } 
                return redirect()->to('/operation/adduser');
            }
        }
        return view('adduser', $data);
    }

    public function approveRecord()
    {
        $itemModel = new \App\Models\ItemModel();
        $operationModel = new \App\Models\OperationModel();
        $data = $this->request->getPost();

        $result = $operationModel->updateApproval($data['record_id'], $data['approve']);

        if ($data['approve'] === 'no') {
            if ($data['stock_change'] != 0) {
                $itemModel->updateStockNumber($data['specification'], -$data['stock_change']);
            }

            if($data['new_position'] != null) {
                $placeData = [
                    'specification' => $data['specification'], 
                    'place' => $data['old_position']
                ];
                $itemModel->update($placeData);
            }
        }
        if ($result) {
            $this->session->setFlashdata('success', 'Update successfully.');
        } else {
            $this->session->setFlashdata('error', 'Failed to update approval');
        }
    }
}