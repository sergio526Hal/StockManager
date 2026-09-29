<?php

namespace App\Models;

use CodeIgniter\Model;

class StockMovementModel extends Model
{
    protected $table = 'stock_movements';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['product_id', 'user_id', 'type', 'quantity', 'reference', 'notes', 'created_at'];
    protected $useTimestamps = false;
    protected $validationRules = [
        'product_id' => 'required|integer',
        'user_id' => 'required|integer',
        'type' => 'required|in_list[in,out,adjustment,return]',
        'quantity' => 'required|integer',
    ];

    public function getMovementsHistory($productId = null, $limit = 50)
    {
        $query = $this->select('stock_movements.*, products.sku, products.name, users.full_name')
            ->join('products', 'products.id = stock_movements.product_id', 'left')
            ->join('users', 'users.id = stock_movements.user_id', 'left');

        if ($productId) {
            $query->where('stock_movements.product_id', (int) $productId);
        }

        return $query->orderBy('stock_movements.created_at', 'DESC')
            ->limit((int) max(1, $limit))
            ->findAll();
    }

    public function recordMovement($productId, $userId, $type, $quantity, $reference = null, $notes = null)
    {
        $productId = (int) $productId;
        $userId = (int) $userId;
        $type = in_array($type, ['in', 'out', 'adjustment', 'return'], true) ? $type : 'adjustment';
        $quantity = (int) $quantity;

        if ($productId <= 0 || $userId <= 0 || $quantity <= 0) {
            return false;
        }

        return $this->insert([
            'product_id' => $productId,
            'user_id' => $userId,
            'type' => $type,
            'quantity' => $quantity,
            'reference' => trim((string) ($reference ?? '')) ?: null,
            'notes' => trim((string) ($notes ?? '')) ?: null,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
