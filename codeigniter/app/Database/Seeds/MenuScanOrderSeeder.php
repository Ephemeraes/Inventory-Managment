<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MenuScanOrderSeeder extends Seeder
{
    public function run()
    {
        $item_data = [
            [
                'specification' => 'Screw A',
                'place' => 'Warehouse 1',
                'type' => 'screw',
                'stock_number' => 100,
            ],
            [
                'specification' => 'Pipe B',
                'place' => 'Warehouse 2',
                'type' => 'pipe',
                'stock_number' => 50,
            ],
            [
                'specification' => 'Iron Core C',
                'place' => 'Warehouse 1',
                'type' => 'iron core',
                'stock_number' => 75,
            ],
            [
                'specification' => 'Copper Wire D',
                'place' => 'Warehouse 3',
                'type' => 'copper wire',
                'stock_number' => 200,
            ],
        ];
        foreach ($item_data as $item) {
            $this->db->table('Item')->insert($item);
        }

        $account_data = [
                [
                    'password' => 'test3',
                ], 
                [
                    'password' => 'test2',
                ],
                [
                    'password' => 'test1',
                ],
        ];
        $accountIds = [];
        foreach ($account_data as $account) {
            $this->db->table('Account')->insert($account);
            $accountIds[] = $this->db->insertID();
        }

        $place_data =[
            [
                'id' => 1,
                'specification' => 'A1',
                'type' => 'pipe',
                'new_position' => "A10",
            ]
        ];
        $this->db->table('Place_change_history')->insertBatch($place_data);

        $stock_data = [
            [
                'id' => 1,
                'specification' => 'A1',
                'type' => 'pipe',
                'stock_change' => 10,
            ]
        ];
        $this->db->table('Stock_change_history')->insertBatch($stock_data);
    }
}
