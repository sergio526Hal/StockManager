<?php
namespace App\Controllers;
use App\Models\UserModel;
class Login extends BaseController
{
    public function index()
    {
        return view('login');
    }
    public function auth()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $model = new UserModel();
        $user = $model
            ->where('username', $username)
            ->where('password', $password)
            ->first();
        if($user)
        {
            session() -> set([
                "id"=>$user['id'],
                'username' => $user['username'],
                'logged_in' => true
            ]);
            return redirect() -> to('/dashboard');
        }
        else
        {
            return redirect() -> back() -> with('error','Nom ou mot de passe incorrect');
        }
    }
    public function dashboard()
    {
        if(!session()->get('logged_in'))
        {
            return redirect()->to("/");
        }
        return view('dashboard');
       
    }
     public function logout()
    {
        session()->destroy();
        return redirect() -> to("/");
    }
}