<?php

namespace App\Controllers;

use App\Models\StockModel;
use App\Models\ProductModel;
use App\Models\StockMovementModel;
use App\Models\AlertModel;

class Stock extends BaseController
{
    protected $stockModel;
    protected $productModel;
    protected $movementModel;
    protected $alertModel;

    public function __construct()
    {
        if (!session()->get('user_id')) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Not authenticated');
        }
        $this->stockModel = new StockModel();
        $this->productModel = new ProductModel();
        $this->movementModel = new StockMovementModel();
        $this->alertModel = new AlertModel();
    }

    public function index()
    {
        $data = [
            'stocks' => $this->stockModel->getAllStockWithProducts(),
        ];
        return view('stock/index', $data);
    }

    public function in($productId)
    {
        $product = $this->productModel->getProductById($productId);
        if (!$product) {
            return redirect()->to('/stock')->with('error', 'Produit introuvable.');
        }

        $data = [
            'product' => $product,
            'type' => 'in',
        ];
        return view('stock/movement', $data);
    }

    public function out($productId)
    {
        $product = $this->productModel->getProductById($productId);
        if (!$product) {
            return redirect()->to('/stock')->with('error', 'Produit introuvable.');
        }

        $data = [
            'product' => $product,
            'type' => 'out',
        ];
        return view('stock/movement', $data);
    }

    public function movement()
    {
        $productId = (int) $this->request->getPost('product_id');
        $type = $this->request->getPost('type');
        $quantity = (int) $this->request->getPost('quantity');
        $reference = $this->request->getPost('reference');
        $notes = $this->request->getPost('notes');

        if ($productId <= 0 || !in_array($type, ['in', 'out', 'adjustment', 'return'], true) || $quantity <= 0) {
            return redirect()->back()->with('error', 'Données du mouvement invalides.');
        }

        $product = $this->productModel->find($productId);
        if (!$product) {
            return redirect()->back()->with('error', 'Produit introuvable.');
        }

        if ($type === 'out') {
            $available = $this->stockModel->getAvailableQuantity($productId);
            if ($quantity > $available) {
                return redirect()->back()->with('error', 'La quantité sortie dépasse le stock disponible.');
            }
        }

        $result = $this->movementModel->recordMovement(
            $productId,
            session()->get('user_id'),
            $type,
            $quantity,
            $reference,
            $notes
        );

        if ($result === false) {
            return redirect()->back()->with('error', 'Impossible d’enregistrer ce mouvement de stock.');
        }

        if ($type === 'in' || $type === 'adjustment') {
            $this->stockModel->updateQuantity($productId, $quantity);
        } elseif ($type === 'out' || $type === 'return') {
            $this->stockModel->updateQuantity($productId, $type === 'out' ? -$quantity : $quantity);
        }

        $this->checkStockAlerts($productId);

        return redirect()->to('/stock')->with('success', 'Mouvement de stock enregistré');
    }

    private function checkStockAlerts($productId)
    {
        $product = $this->productModel->find($productId);
        $stock = $this->stockModel->getStockByProduct($productId);

        if ($stock && $product) {
            if ($stock['quantity'] <= $product['minimum_stock']) {
                $this->alertModel->createAlert(
                    $productId,
                    'low_stock',
                    'Stock faible pour ' . $product['name'] . ': ' . $stock['quantity'] . ' unités'
                );
            }
        }
    }

    public function history($productId = null)
    {
        $productId = $productId !== null ? (int) $productId : null;

        $data = [
            'productId' => $productId,
            'movements' => $this->movementModel->getMovementsHistory($productId, 100),
        ];

        return view('stock/history', $data);
    }
}
