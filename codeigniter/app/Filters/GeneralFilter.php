<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\Config\Services;

class GeneralFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = Services::session();
        
        // Check if the user is not logged in
        if (!$session->get('isLoggedIn')) {
            // Prepare a response object to return a message
            $response = Services::response();
            $response->setStatusCode(200); // You can set this to 401 if it's an unauthorized access
            $session->setFlashdata('error', 'Not Logged in.');
            return redirect()->to('/');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after the controller method is executed
    }
}