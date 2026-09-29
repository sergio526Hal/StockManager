<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['category_id', 'sku', 'name', 'description', 'unit_price', 'unit', 'minimum_stock', 'status'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $validationRules = [
        'category_id' => 'required|integer',
        'sku' => 'required|min_length[3]|max_length[100]|is_unique[products.sku]',
        'name' => 'required|min_length[3]|max_length[255]',
        'unit_price' => 'required|numeric',
        'minimum_stock' => 'required|integer',
    ];

    public function getProductsWithCategory()
    {
        return $this->select('products.*, categories.name as category_name')
            ->join('categories', 'categories.id = products.category_id', 'left')
            ->where('products.status', 'active')
            ->findAll();
    }

    public function getProductById($id)
    {
        return $this->select('products.*, categories.name as category_name')
            ->join('categories', 'categories.id = products.category_id', 'left')
            ->where('products.id', $id)
            ->first();
    }
}
