<?php

namespace App\Models;

use CodeIgniter\Model;

class AlertModel extends Model
{
    protected $table = 'alerts';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['product_id', 'type', 'message', 'status', 'created_at', 'resolved_at'];
    protected $useTimestamps = false;
    protected $validationRules = [
        'product_id' => 'required|integer',
        'type' => 'required|in_list[low_stock,overstock,expired]',
        'message' => 'required|min_length[5]',
    ];

    public function getActiveAlerts()
    {
        return $this->select('alerts.*, products.sku, products.name, categories.name as category_name')
            ->join('products', 'products.id = alerts.product_id', 'left')
            ->join('categories', 'categories.id = products.category_id', 'left')
            ->where('alerts.status', 'active')
            ->orderBy('alerts.created_at', 'DESC')
            ->findAll();
    }

    public function createAlert($productId, $type, $message)
    {
        $existing = $this->where('product_id', $productId)
            ->where('type', $type)
            ->where('status', 'active')
            ->first();

        if (!$existing) {
            return $this->insert([
                'product_id' => $productId,
                'type' => $type,
                'message' => $message,
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
        return false;
    }

    public function resolveAlert($alertId)
    {
        return $this->update($alertId, [
            'status' => 'resolved',
            'resolved_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
