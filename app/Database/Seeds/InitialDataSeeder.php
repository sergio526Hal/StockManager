<?php

namespace App\Database\Seeds;

use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\StockModel;
use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class InitialDataSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        $userModel = new UserModel();
        
        $adminData = [
            'username' => 'admin',
            'email' => 'admin@stockmanager.com',
            'password' => password_hash('admin123', PASSWORD_BCRYPT),
            'full_name' => 'Administrateur',
            'role' => 'admin',
            'status' => 'active',
        ];
        
        $userModel->insert($adminData);

        // Create sample categories
        $categoryModel = new CategoryModel();
        
        $categories = [
            ['name' => 'Électronique', 'description' => 'Articles électroniques et équipements'],
            ['name' => 'Informatique', 'description' => 'Ordinateurs, accessoires IT'],
            ['name' => 'Fournitures de Bureau', 'description' => 'Papier, stylos, etc.'],
            ['name' => 'Mobilier', 'description' => 'Meubles de bureau et industriels'],
            ['name' => 'Matériaux Bruts', 'description' => 'Matériaux et matières premières'],
        ];
        
        foreach ($categories as $cat) {
            $categoryModel->insert($cat);
        }

        // Create sample products
        $productModel = new ProductModel();
        
        $products = [
            [
                'category_id' => 1,
                'sku' => 'PROD-001',
                'name' => 'Moniteur LED 27"',
                'description' => 'Moniteur LED haute définition 27 pouces',
                'unit_price' => 250.00,
                'unit' => 'pcs',
                'minimum_stock' => 5,
                'status' => 'active',
            ],
            [
                'category_id' => 1,
                'sku' => 'PROD-002',
                'name' => 'Clavier Mécanique',
                'description' => 'Clavier gaming mécanique RGB',
                'unit_price' => 120.00,
                'unit' => 'pcs',
                'minimum_stock' => 10,
                'status' => 'active',
            ],
            [
                'category_id' => 2,
                'sku' => 'PROD-003',
                'name' => 'Souris Wireless',
                'description' => 'Souris sans fil ergonomique',
                'unit_price' => 35.00,
                'unit' => 'pcs',
                'minimum_stock' => 15,
                'status' => 'active',
            ],
            [
                'category_id' => 3,
                'sku' => 'PROD-004',
                'name' => 'Papier A4 500 feuilles',
                'description' => 'Ramette de papier 80g blanc',
                'unit_price' => 5.50,
                'unit' => 'ramette',
                'minimum_stock' => 20,
                'status' => 'active',
            ],
            [
                'category_id' => 3,
                'sku' => 'PROD-005',
                'name' => 'Stylos Bille Bleu (Boîte)',
                'description' => 'Boîte de 50 stylos bleus',
                'unit_price' => 8.00,
                'unit' => 'boîte',
                'minimum_stock' => 10,
                'status' => 'active',
            ],
            [
                'category_id' => 4,
                'sku' => 'PROD-006',
                'name' => 'Bureau Ergonomique',
                'description' => 'Bureau réglable en hauteur',
                'unit_price' => 450.00,
                'unit' => 'pcs',
                'minimum_stock' => 2,
                'status' => 'active',
            ],
        ];
        
        foreach ($products as $product) {
            $productModel->insert($product);
        }

        // Create sample stock
        $stockModel = new StockModel();
        
        $stocks = [
            ['product_id' => 1, 'quantity' => 25, 'warehouse_location' => 'A-1-1'],
            ['product_id' => 2, 'quantity' => 8, 'warehouse_location' => 'A-1-2'],
            ['product_id' => 3, 'quantity' => 40, 'warehouse_location' => 'A-2-1'],
            ['product_id' => 4, 'quantity' => 60, 'warehouse_location' => 'B-1-1'],
            ['product_id' => 5, 'quantity' => 15, 'warehouse_location' => 'B-1-2'],
            ['product_id' => 6, 'quantity' => 5, 'warehouse_location' => 'C-1-1'],
        ];
        
        foreach ($stocks as $stock) {
            $stockModel->insert($stock);
        }

        echo "Initial data seeded successfully!";
    }
}
