<?php

namespace App\Models;

use CodeIgniter\Model;

class AccountModel extends Model
{
    protected $table            = 'Account';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $allowedFields    = ['id', 'password'];

    public function verifyUser($id, $password)
    {
        $user = $this->where('id', $id)->first();
        if ($user){
            if ($password === $user['password']) {
                return $user;
            }
        }
        return false;
    }
}
