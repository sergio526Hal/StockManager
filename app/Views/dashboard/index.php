<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<?php
// Définitions par défaut pour éviter les warnings d'analyse statique
$total_products = $total_products ?? 0;
$low_stock_products = $low_stock_products ?? [];
$active_alerts = $active_alerts ?? [];
$recent_movements = $recent_movements ?? [];
?>

<h1 class="mb-4">Tableau de bord</h1>

<div class="table-responsive mb-4">
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Indicateur</th>
                <th>Valeur</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><i class="bi bi-box"></i> Total Produits</td>
                <td><?= $total_products ?></td>
                <td>Nombre total de produits en catalogue</td>
            </tr>
            <tr>
                <td><i class="bi bi-exclamation-triangle"></i> Stock Faible</td>
                <td><?= count($low_stock_products) ?></td>
                <td>Produits avec stock en dessous du minimum</td>
            </tr>
            <tr>
                <td><i class="bi bi-bell"></i> Alertes Actives</td>
                <td><?= count($active_alerts) ?></td>
                <td>Alertes non résolues</td>
            </tr>
            <tr>
                <td><i class="bi bi-arrow-repeat"></i> Mouvements</td>
                <td><?= count($recent_movements) ?></td>
                <td>Mouvements de stock récents</td>
            </tr>
        </tbody>
    </table>
</div>

<div class="table-responsive mb-4">
    <table class="table table-hover table-bordered">
        <thead class="table-light">
            <tr>
                <th colspan="4">Produits avec Stock Faible</th>
            </tr>
            <tr>
                <th>Code</th>
                <th>Produit</th>
                <th>Stock</th>
                <th>Min</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($low_stock_products)): ?>
                <tr>
                    <td colspan="4" class="text-center text-muted">Aucun produit avec stock faible</td>
                </tr>
            <?php else: ?>
                <?php foreach ($low_stock_products as $product): ?>
                    <tr>
                        <td><?= $product['sku'] ?></td>
                        <td><?= $product['name'] ?></td>
                        <td><?= $product['quantity'] ?></td>
                        <td><?= $product['minimum_stock'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="table-responsive mb-4">
    <table class="table table-hover table-bordered">
        <thead class="table-light">
            <tr>
                <th colspan="3">Alertes Actives</th>
            </tr>
            <tr>
                <th>Type</th>
                <th>Message</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($active_alerts)): ?>
                <tr>
                    <td colspan="3" class="text-center text-muted">Aucune alerte active</td>
                </tr>
            <?php else: ?>
                <?php foreach ($active_alerts as $alert): ?>
                    <tr>
                        <td><?= $alert['type'] ?></td>
                        <td><?= $alert['message'] ?></td>
                        <td><?= $alert['status'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="table-responsive mb-4">
    <table class="table table-hover table-bordered">
        <thead class="table-light">
            <tr>
                <th>Date</th>
                <th>Produit</th>
                <th>Type</th>
                <th>Quantité</th>
                <th>Utilisateur</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($recent_movements)): ?>
                <tr>
                    <td colspan="5" class="text-center text-muted">Aucun mouvement récent</td>
                </tr>
            <?php else: ?>
                <?php foreach ($recent_movements as $movement): ?>
                    <tr>
                        <td><?= date('d/m/Y H:i', strtotime($movement['created_at'])) ?></td>
                        <td><?= $movement['name'] ?> (<?= $movement['sku'] ?>)</td>
                        <td><?= $movement['type'] ?></td>
                        <td><?= $movement['quantity'] ?></td>
                        <td><?= $movement['full_name'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="d-flex flex-wrap gap-2">
    <a href="/product" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Ajouter Produit</a>
    <a href="/stock" class="btn btn-info text-white"><i class="bi bi-boxes"></i> Gérer Stocks</a>
    <a href="/report" class="btn btn-warning text-white"><i class="bi bi-graph-up"></i> Voir Rapports</a>
</div>

<?= $this->endSection() ?>
