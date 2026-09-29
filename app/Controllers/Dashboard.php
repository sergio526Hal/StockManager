<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\StockModel;
use App\Models\StockMovementModel;
use App\Models\AlertModel;

class Dashboard extends BaseController
{
    protected $productModel;
    protected $stockModel;
    protected $movementModel;
    protected $alertModel;

    public function __construct()
    {
        if (!session()->get('user_id')) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Not authenticated');
        }
        $this->productModel = new ProductModel();
        $this->stockModel = new StockModel();
        $this->movementModel = new StockMovementModel();
        $this->alertModel = new AlertModel();
    }

    public function index()
    {
        $data = [
            'total_products' => $this->productModel->countAll(),
            'low_stock_products' => $this->getLowStockProducts(),
            'recent_movements' => $this->movementModel->getMovementsHistory(null, 10),
            'active_alerts' => $this->alertModel->getActiveAlerts(),
            'user_name' => session()->get('full_name'),
        ];

        return view('dashboard/index', $data);
    }

    private function getLowStockProducts()
    {
        $stocks = $this->stockModel->getAllStockWithProducts();
        $low = [];
        foreach ($stocks as $stock) {
            if ($stock['quantity'] <= $stock['minimum_stock']) {
                $low[] = $stock;
            }
        }
        return array_slice($low, 0, 5);
    }
}
