<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<?php
// Définitions par défaut pour éviter les warnings d'analyse statique
$product = $product ?? [
    'id' => 0,
    'sku' => '',
    'name' => '',
    'description' => '',
    'unit_price' => 0,
    'unit' => 'pcs',
    'minimum_stock' => 0,
    'category_id' => null,
    'status' => 'inactive',
];
$categories = $categories ?? [];
$stock = $stock ?? ['quantity' => 0, 'reserved_quantity' => 0];
?>

<div class="card">
    <div class="card-header">
        <i class="bi bi-pencil"></i> Éditer le Produit: <?= $product['name'] ?>
    </div>
    <div class="card-body">
        <form method="POST" action="/product/update/<?= $product['id'] ?>">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="category_id">Catégorie</label>
                        <select id="category_id" name="category_id" class="form-select" required>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>" <?= $product['category_id'] == $cat['id'] ? 'selected' : '' ?>>
                                    <?= $cat['name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sku">SKU</label>
                        <input type="text" id="sku" name="sku" class="form-control" value="<?= $product['sku'] ?>" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="name">Nom du Produit</label>
                <input type="text" id="name" name="name" class="form-control" value="<?= $product['name'] ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control" rows="3"><?= $product['description'] ?></textarea>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="unit_price">Prix Unitaire (Ar)</label>
                        <input type="number" id="unit_price" name="unit_price" class="form-control" step="0.1" value="<?= $product['unit_price'] ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="unit">Unité</label>
                        <input type="text" id="unit" name="unit" class="form-control" value="<?= $product['unit'] ?>" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="minimum_stock">Stock Minimum</label>
                        <input type="number" id="minimum_stock" name="minimum_stock" class="form-control" value="<?= $product['minimum_stock'] ?>" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Stock Actuel</label>
                        <input type="text" class="form-control" value="<?= $stock['quantity'] ?? 0 ?>" disabled>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Mettre à Jour
                </button>
                <a href="/product" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
