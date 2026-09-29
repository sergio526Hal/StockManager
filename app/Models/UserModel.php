<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['username', 'email', 'password', 'full_name', 'role', 'status'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[255]|is_unique[users.username]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[6]',
        'full_name' => 'required|min_length[3]|max_length[255]',
        'role' => 'required|in_list[admin,manager,employee]',
    ];

    public function authenticate($username, $password)
    {
        $user = $this->where('username', $username)->orWhere('email', $username)->first();
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return null;
    }
}
