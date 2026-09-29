<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<?php
// Définitions par défaut pour éviter les warnings d'analyse statique
$total_value = $total_value ?? 0.0;
$total_products = $total_products ?? 0;
$low_stock_count = $low_stock_count ?? 0;
$monthly_movements = $monthly_movements ?? [];
?>

<h2 class="mb-4">Rapports de stock</h2>

<div class="table-responsive mb-4">
    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>Indicateur</th>
                <th>Valeur</th>
                <th>Observation</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><i class="bi bi-cash-stack"></i> Valeur totale du stock</td>
                <td><strong><?= number_format($total_value, 0, ',', ' ') ?> Ar</strong></td>
                <td>Montant total estimé du stock disponible</td>
            </tr>
            <tr>
                <td><i class="bi bi-box"></i> Nombre de produits</td>
                <td><strong><?= $total_products ?></strong></td>
                <td>Produits enregistrés dans le système</td>
            </tr>
            <tr>
                <td><i class="bi bi-exclamation-triangle"></i> Produits en stock faible</td>
                <td><strong><?= $low_stock_count ?></strong></td>
                <td>Produits à réapprovisionner rapidement</td>
            </tr>
            <tr>
                <td><i class="bi bi-arrow-repeat"></i> Mouvements du mois</td>
                <td><strong><?= count($monthly_movements) ?></strong></td>
                <td>Nombre total de mouvements enregistrés</td>
            </tr>
        </tbody>
    </table>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-boxes"></i> Rapports disponibles</h5>
                <div class="list-group mt-3">
                    <a href="/report/inventory" class="list-group-item list-group-item-action">
                        <strong>Rapport d’inventaire</strong><br>
                        <small class="text-muted">Vue complète du stock actuel</small>
                    </a>
                    <a href="/report/movements" class="list-group-item list-group-item-action">
                        <strong>Mouvements de stock</strong><br>
                        <small class="text-muted">Historique des entrées, sorties et ajustements</small>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-info-circle"></i> Informations</h5>
                <p class="mt-3 mb-2"><strong>Valeur totale du stock :</strong> <?= number_format($total_value, 0, ',', ' ') ?> Ar</p>
                <p class="mb-2"><strong>Nombre de produits :</strong> <?= $total_products ?></p>
                <p class="mb-2"><strong>Produits en stock faible :</strong> <?= $low_stock_count ?></p>
                <hr>
                <p class="text-muted mb-0">Ces données permettent une meilleure décision d’approvisionnement et de gestion d’inventaire.</p>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
