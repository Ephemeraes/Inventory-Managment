<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\Config\Services;

class ManagerFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = Services::session();

        // Check if the user is not an admin
        if ($session->get('role') != 'manager') {
            // Prepare a response object to return a message
            $response = Services::response();
            $response->setStatusCode(403); // Appropriate status code for forbidden access
            $session->setFlashdata('error', 'Access denied');
            return redirect()->to('/inventory');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after the controller method is executed
    }
}