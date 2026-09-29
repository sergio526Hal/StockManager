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
    'status' => 'inactive',
    'category_name' => 'N/A',
];
$stock = $stock ?? ['quantity' => 0, 'reserved_quantity' => 0];
?>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-box"></i> Détails du Produit
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">SKU</h6>
                        <p><span class="badge badge-status-inactive"><?= $product['sku'] ?></span></p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Catégorie</h6>
                        <p><?= $product['category_name'] ?? 'N/A' ?></p>
                    </div>
                </div>

                <div class="mb-3">
                    <h6 class="text-muted">Nom</h6>
                    <p><strong><?= $product['name'] ?></strong></p>
                </div>

                <div class="mb-3">
                    <h6 class="text-muted">Description</h6>
                    <p><?= $product['description'] ?? 'N/A' ?></p>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <h6 class="text-muted">Prix Unitaire</h6>
                        <p><strong><?= number_format($product['unit_price'], 0, ',', ' ') ?> Ar</strong></p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Unité</h6>
                        <p><?= $product['unit'] ?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-muted">Stock Minimum</h6>
                        <p><?= $product['minimum_stock'] ?></p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-muted">Statut</h6>
                        <p>
                            <?php if ($product['status'] === 'active'): ?>
                                <span class="badge badge-status-active">Actif</span>
                            <?php else: ?>
                                <span class="badge badge-status-inactive">Inactif</span>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>

                <hr>

                <a href="/product/edit/<?= $product['id'] ?>" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Éditer
                </a>
                <a href="/product" class="btn btn-secondary">Retour</a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <i class="bi bi-boxes"></i> Stock Actuel
            </div>
            <div class="card-body">
                <div class="stat-box" style="box-shadow: none; border-top: 4px solid #3498db;">
                    <h6>QUANTITÉ</h6>
                    <h3><?= $stock['quantity'] ?? 0 ?></h3>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="stat-box" style="box-shadow: none; border-top: 4px solid #27ae60; text-align: left;">
                            <small class="text-muted">Disponible</small>
                            <p class="mb-0" style="font-size: 18px; font-weight: bold;">
                                <?= ($stock['quantity'] ?? 0) - ($stock['reserved_quantity'] ?? 0) ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-box" style="box-shadow: none; border-top: 4px solid #e74c3c; text-align: left;">
                            <small class="text-muted">Réservé</small>
                            <p class="mb-0" style="font-size: 18px; font-weight: bold;">
                                <?= $stock['reserved_quantity'] ?? 0 ?>
                            </p>
                        </div>
                    </div>
                </div>

                <?php if ($stock && $stock['quantity'] <= $product['minimum_stock']): ?>
                    <div class="alert alert-warning mt-3">
                        <i class="bi bi-exclamation-triangle"></i> Stock faible! Réapprovisionnement recommandé.
                    </div>
                <?php endif; ?>

                <div class="d-grid gap-2 mt-3">
                    <a href="/stock/in/<?= $product['id'] ?>" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i> Entrée
                    </a>
                    <a href="/stock/out/<?= $product['id'] ?>" class="btn btn-danger">
                        <i class="bi bi-dash-circle"></i> Sortie
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
