<?php namespace App\Controllers;

use CodeIgniter\Controller;

class InventoryController extends BaseController
{
    public function __construct()
    {
        helper('url'); 
        $this->session = session();
    }

    public function inventory($specification = null)
    {
        $model = new \App\Models\ItemModel();
        $perPage = 10; 
        $currentPage = $this->request->getVar('page') ?? 1;
        $offset = ($currentPage - 1) * $perPage;
        $search = $this->request->getGet('search');

        if (!empty($search)) {
            $conditions = [];

            foreach ($model->allowedFields as $field) {
                $conditions[] = "$field LIKE '%$search%'";
            }
            $whereClause = implode(' OR ', $conditions);
            $items = $model->where($whereClause)->orderBy('specification', 'ASC');

        } else {
            $items = $model->orderBy('specification', 'ASC'); 
        }
        $items = $items->offset($offset)
                            ->limit($perPage)
                            ->get()
                            ->getResultArray();
        $pager = service('pager');
        $rows = count($items); 
        $pagerData = $pager->makeLinks($currentPage, $perPage, $rows);

        $data = [
            'name' => 'Inventory Management',
            'items' => $items,
            'message' => $this->session->getFlashdata(),
            'pager' => $pagerData
        ];
        return view('inventory', $data);
    }

    public function addedit($specification = null)
    {
        $model = new \App\Models\ItemModel();
        if ($this->request->getMethod() === 'POST') {
            $data = $this->request->getPost();
            $data['stock_number'] = 0;
            try {
                if ($specification === null) {
                    // $model->insert($data); always returns 0. Check whether specification exists to 
                    // validate the operation.
                    $model->insert($data);
                    $inserted = $model->where('specification', $data['specification'])->first();
                    if ($inserted) {
                        $this->session->setFlashdata('success', 'Item added successfully.');
                        return redirect()->to('/inventory');
                    } else {
                        $this->session->setFlashdata('error', 'Failed to add item. Please try again.');
                    }
                } else {
                    if ($model->update($specification, $data)) {
                        $this->session->setFlashdata('success', 'Item updated successfully.');
                        return redirect()->to('/inventory');
                    } else {
                        $this->session->setFlashdata('error', 'Failed to update item. Please try again.');
                    }
                }
            } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
                if ($e->getCode() == 1062) {
                    $this->session->setFlashdata('error', 'Duplicate Item. Item already exists.');
                } 
            }
        }
        $data['item'] = ($specification === null) ? null : $model->find($specification);
        $data['name'] = 'Inventory Management';
        return view('addedit', $data);
    }

    public function delete($specification)
    {
        $model = new \App\Models\ItemModel();

        if ($model->delete($specification)) {
            $this->session->setFlashdata('success', 'Item deleted successfully.');
        } else {
            $this->session->setFlashdata('error', 'Failed to delete Item. Please try again.');
        }

        return redirect()->to('/inventory');
    }

    public function update()
    {
        $itemModel = new \App\Models\ItemModel();
        $placeModel = new \App\Models\PlaceModel();
        $numberModel = new \App\Models\NumberModel();

        $id = session()->get('id');
        $specifications = $this->request->getPost('specifications');
        $places = $this->request->getPost('place');
        $stock_numbers = $this->request->getPost('stock_number');
        $stock_changes = $this->request->getPost('stock_chnage');
        $time = date('Y-m-d H:i:s');

        foreach ($specifications as $index => $specification) {
            $place = $places[$index];
            $stock_number = $stock_numbers[$index];
            $stock_change = $stock_changes[$index];
            $item = $itemModel->where('specification', $specification)->get()->getRowArray();
            if ($stock_change != 0) {
                $numberData = [
                    'id' => $id,
                    'specification' => $specification,
                    'time' => $time,
                    'stock_change' => $stock_change
                ];
                $numberModel->insert($numberData);
                $data = [
                    'place' => $place
                ];
                $itemModel->updateStockNumber($specification, $stock_change);
                $this->session->setFlashdata('success', 'Item updated successfully.');
            }
            if ($place != $item['place']) {
                $placeData = [
                    'id' => $id,
                    'specification' => $specification,
                    'time' => $time,
                    'old_position' => $item['place'],
                    'new_position' => $place
                ];
                $placeModel->insert($placeData);

                $data = [
                    'place' => $place
                ];
                $itemModel->update($specification, $data);
                $this->session->setFlashdata('success', 'Item updated successfully.');
            }
        }
        return redirect()->to('/inventory');
    }
}