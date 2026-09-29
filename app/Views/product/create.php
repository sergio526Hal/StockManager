<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<?php
// Définitions par défaut pour éviter les warnings d'analyse statique
$categories = $categories ?? [];
?>

<div class="card">
    <div class="card-header">
        <i class="bi bi-plus-circle"></i> Créer un Nouveau Produit
    </div>
    <div class="card-body">
        <form method="POST" action="/product/store">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="category_id">Catégorie</label>
                        <select id="category_id" name="category_id" class="form-select" required>
                            <option value="">-- Sélectionner une catégorie --</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sku">SKU</label>
                        <input type="text" id="sku" name="sku" class="form-control" required placeholder="Ex: PROD-001">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="name">Nom du Produit</label>
                <input type="text" id="name" name="name" class="form-control" required placeholder="Entrez le nom du produit">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control" rows="3" placeholder="Description du produit"></textarea>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="unit_price">Prix Unitaire (Ar)</label>
                        <input type="number" id="unit_price" name="unit_price" class="form-control" step="0.1" required placeholder="0.0">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="unit">Unité</label>
                        <input type="text" id="unit" name="unit" class="form-control" value="pcs" required placeholder="Ex: pcs, kg, L">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="minimum_stock">Stock Minimum</label>
                        <input type="number" id="minimum_stock" name="minimum_stock" class="form-control" required placeholder="0">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="initial_quantity">Quantité Initiale</label>
                        <input type="number" id="initial_quantity" name="initial_quantity" class="form-control" placeholder="0">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Créer le Produit
                </button>
                <a href="/product" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
