<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        if (session()->get('user_id')) {
            return redirect()->to('/dashboard');
        }
        return view('auth/login');
    }

    public function authenticate()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        if (!$username || !$password) {
            return redirect()->back()->with('error', 'Veuillez remplir tous les champs');
        }

        $user = $this->userModel->authenticate($username, $password);

        if ($user) {
            session()->set([
                'user_id' => $user['id'],
                'username' => $user['username'],
                'full_name' => $user['full_name'],
                'role' => $user['role'],
            ]);
            return redirect()->to('/dashboard');
        }

        return redirect()->back()->with('error', 'Identifiants invalides');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login');
    }

    public function register()
    {
        if ($this->request->getMethod() === 'POST') {
            $data = [
                'username' => $this->request->getPost('username'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
                'full_name' => $this->request->getPost('full_name'),
                'role' => 'employee',
            ];

            if ($this->userModel->save($data)) {
                return redirect()->to('/auth/login')->with('success', 'Inscription réussie. Veuillez vous connecter.');
            } else {
                return redirect()->back()->with('error', 'Erreur lors de l\'inscription');
            }
        }
        return view('auth/register');
    }
}
