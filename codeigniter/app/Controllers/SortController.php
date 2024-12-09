<?php namespace App\Controllers;

use CodeIgniter\Controller;

class SortController extends BaseController
{
    public function __construct()
    {
        helper('url'); 
        $this->session = session();
    }

    public function sort()
    {
        $data['name'] = 'Sort Data';
        $data['stockHistory'] = [];
        return view('sort', $data);
    }

    public function sortResult() {
        $numberModel = new \App\Models\NumberModel();
        $itemModel = new \App\Models\ItemModel();
        $data = $this->request->getPost();

        // Invalid Time
        if ($data['startTime'] > $data['endTime']) {
            session()->setFlashData('error', 'End time is earlier than the start time.');
            return redirect()->to('/sort');
        }

        if (!empty($data['specification'])){
            $item = $itemModel->where('specification', $data['specification'])->first();
            if ($item) {
                $stockNumber = $item['stock_number'];
            } else {
                // Invalid item
                session()->setFlashData('error', 'Invalid specification.');
                return redirect()->to('/sort');
            }

            // Only valid record will be sorted
            $itemRecord = $numberModel->where('specification', $data['specification'])
                                    ->where('time >=', $data['startTime'])
                                    ->whereIn('approve', ['awaiting', 'yes'])
                                    ->orderBy('time', 'DESC')
                                    ->findAll();
            if ($itemRecord) {
                $stockHistory = [];
                foreach ($itemRecord as $record) {
                    $stockHistory[] = [
                        'time' => $record['time'],
                        'stock' => $stockNumber
                    ];
                    $stockNumber -= $record['stock_change'];
                }

                //https://chat.openai.com/share/936c64d3-0a86-4df3-b02a-71544f801398
                usort($stockHistory, function($a, $b) {
                    return $a['time'] <=> $b['time'];
                });

                // Input is date, but the record is datetime. E.g. 5.12 will be always less than 5.12 10:00:00;
                // Therefore, switch the date to datetime
                $stockHistory = array_filter($stockHistory, function($record) use ($data) {
                        $endTime = new \DateTime($data['endTime']);
                        $endTime->setTime(23, 59, 59)->format('Y-m-d H:i:s');;
                    return $record['time'] <= $endTime;
                });
            } else {
                session()->setFlashData('error', 'No valid specification in the record.');
                return redirect()->to('/sort');
            } 
        }
        $data['name'] = 'Sort Data';
        $data['stockHistory'] = $stockHistory;
        return view('sort', $data);
    }
}