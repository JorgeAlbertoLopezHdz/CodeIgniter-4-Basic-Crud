<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class UserModel extends Model
{
    public function index()
    {
        try {
            $query  = $this->db->query('CALL getUsers()');
            return $query->getResult();
        } catch (Exception $e) {
            die(var_dump($e->getMessage()));
        }
    }
}
