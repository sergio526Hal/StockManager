<?php

namespace App\Controllers;

use App\Models\StockModel;
use App\Models\StockMovementModel;
use App\Models\AlertModel;
use App\Models\ProductModel;

class Report extends BaseController
{
    protected $stockModel;
    protected $movementModel;
    protected $alertModel;
    protected $productModel;

    public function __construct()
    {
        if (!session()->get('user_id')) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Not authenticated');
        }
        $this->stockModel = new StockModel();
        $this->movementModel = new StockMovementModel();
        $this->alertModel = new AlertModel();
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        $data = [
            'total_value' => $this->calculateTotalInventoryValue(),
            'total_products' => $this->productModel->countAll(),
            'low_stock_count' => $this->getLowStockCount(),
            'monthly_movements' => $this->getMonthlyMovements(),
        ];
        return view('report/index', $data);
    }

    public function inventory()
    {
        $data = [
            'stocks' => $this->stockModel->getAllStockWithProducts(),
        ];
        return view('report/inventory', $data);
    }

    public function movements()
    {
        $startDate = $this->request->getGet('start_date');
        $endDate = $this->request->getGet('end_date');

        $query = $this->movementModel->select('stock_movements.*, products.sku, products.name, users.full_name')
            ->join('products', 'products.id = stock_movements.product_id', 'left')
            ->join('users', 'users.id = stock_movements.user_id', 'left');

        if ($startDate) {
            $query->where('DATE(stock_movements.created_at) >=', $startDate);
        }
        if ($endDate) {
            $query->where('DATE(stock_movements.created_at) <=', $endDate);
        }

        $data = [
            'movements' => $query->orderBy('stock_movements.created_at', 'DESC')->findAll(),
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];
        return view('report/movements', $data);
    }

    private function calculateTotalInventoryValue()
    {
        $stocks = $this->stockModel->getAllStockWithProducts();
        $total = 0;
        foreach ($stocks as $stock) {
            $total += $stock['quantity'] * $stock['unit_price'];
        }
        return $total;
    }

    private function getLowStockCount()
    {
        $stocks = $this->stockModel->getAllStockWithProducts();
        $count = 0;
        foreach ($stocks as $stock) {
            if ($stock['quantity'] <= $stock['minimum_stock']) {
                $count++;
            }
        }
        return $count;
    }

    private function getMonthlyMovements()
    {
        return $this->movementModel->select('MONTH(created_at) as month, COUNT(*) as count, type')
            ->where('YEAR(created_at)', date('Y'))
            ->groupBy('MONTH(created_at), type')
            ->findAll();
    }
}
