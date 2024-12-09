<?php

namespace App\Controllers;

use CodeIgniter\CLI\CLI;
use CodeIgniter\Config\Services;
use CodeIgniter\Controller;

class Migrate extends Controller
{
    public function index()
    {
        $migrate = Services::migrations();

        try {
            $migrate->latest();
            CLI::write('Migrations completed successfully.', 'green');
        } catch (\Exception $e) {
            CLI::write('Migration failed: ' . $e->getMessage(), 'red');
        }
    }
}