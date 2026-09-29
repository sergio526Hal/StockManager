<?php

namespace App\Models;

use CodeIgniter\Model;

class StockModel extends Model
{
    protected $table = 'stock';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['product_id', 'warehouse_location', 'quantity', 'reserved_quantity', 'last_checked_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getStockByProduct($productId)
    {
        return $this->where('product_id', $productId)->first();
    }

    public function getAvailableQuantity($productId)
    {
        $stock = $this->getStockByProduct($productId);
        if ($stock) {
            return $stock['quantity'] - $stock['reserved_quantity'];
        }
        return 0;
    }

    public function updateQuantity($productId, $quantity)
    {
        $stock = $this->getStockByProduct($productId);
        if ($stock) {
            return $this->update($stock['id'], ['quantity' => $stock['quantity'] + $quantity]);
        }
        return $this->insert(['product_id' => $productId, 'quantity' => $quantity]);
    }

    public function getAllStockWithProducts()
    {
        return $this->select('stock.*, products.sku, products.name, products.unit_price, products.minimum_stock, categories.name as category_name')
            ->join('products', 'products.id = stock.product_id', 'left')
            ->join('categories', 'categories.id = products.category_id', 'left')
            ->findAll();
    }
}
