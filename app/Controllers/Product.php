<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Models\StockModel;

class Product extends BaseController
{
    protected $productModel;
    protected $categoryModel;
    protected $stockModel;

    public function __construct()
    {
        if (!session()->get('user_id')) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Not authenticated');
        }
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
        $this->stockModel = new StockModel();
    }

    public function index()
    {
        $data = [
            'products' => $this->productModel->getProductsWithCategory(),
        ];
        return view('product/index', $data);
    }

    public function create()
    {
        $data = [
            'categories' => $this->categoryModel->getActiveCategories(),
        ];
        return view('product/create', $data);
    }

    public function store()
    {
        $data = [
            'category_id' => $this->request->getPost('category_id'),
            'sku' => $this->request->getPost('sku'),
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'unit_price' => $this->request->getPost('unit_price'),
            'unit' => $this->request->getPost('unit'),
            'minimum_stock' => $this->request->getPost('minimum_stock'),
        ];

        if ($this->productModel->save($data)) {
            $productId = $this->productModel->getInsertID();
            $quantity = $this->request->getPost('initial_quantity');
            if ($quantity) {
                $this->stockModel->insert([
                    'product_id' => $productId,
                    'quantity' => $quantity,
                ]);
            }
            return redirect()->to('/product')->with('success', 'Produit créé avec succès');
        }

        return redirect()->back()->with('error', 'Erreur lors de la création du produit');
    }

    public function edit($id)
    {
        $data = [
            'product' => $this->productModel->getProductById($id),
            'categories' => $this->categoryModel->getActiveCategories(),
            'stock' => $this->stockModel->getStockByProduct($id),
        ];
        return view('product/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'category_id' => $this->request->getPost('category_id'),
            'sku' => $this->request->getPost('sku'),
            'name' => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'unit_price' => $this->request->getPost('unit_price'),
            'unit' => $this->request->getPost('unit'),
            'minimum_stock' => $this->request->getPost('minimum_stock'),
        ];

        if ($this->productModel->update($id, $data)) {
            return redirect()->to('/product')->with('success', 'Produit mis à jour avec succès');
        }

        return redirect()->back()->with('error', 'Erreur lors de la mise à jour');
    }

    public function delete($id)
    {
        if ($this->productModel->delete($id)) {
            return redirect()->to('/product')->with('success', 'Produit supprimé avec succès');
        }

        return redirect()->back()->with('error', 'Erreur lors de la suppression');
    }

    public function detail($id)
    {
        $data = [
            'product' => $this->productModel->getProductById($id),
            'stock' => $this->stockModel->getStockByProduct($id),
        ];
        return view('product/detail', $data);
    }
}
