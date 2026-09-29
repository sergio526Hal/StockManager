<?php

namespace App\Controllers;

use App\Models\AlertModel;

class Alert extends BaseController
{
    protected $alertModel;

    public function __construct()
    {
        if (!session()->get('user_id')) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Not authenticated');
        }
        $this->alertModel = new AlertModel();
    }

    public function index()
    {
        $data = [
            'alerts' => $this->alertModel->getActiveAlerts(),
        ];
        return view('alert/index', $data);
    }

    public function resolve($id)
    {
        if ($this->alertModel->resolveAlert($id)) {
            return redirect()->to('/alert')->with('success', 'Alerte résolue');
        }
        return redirect()->back()->with('error', 'Erreur lors de la résolution');
    }
}
