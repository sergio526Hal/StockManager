<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="mb-3">
    <a href="/stock/history" class="btn btn-info text-white">
        <i class="bi bi-clock-history"></i> Historique des Mouvements
    </a>
</div>

<div class="card">
    <div class="card-header">
        <i class="bi bi-boxes"></i> Gestion des Stocks
    </div>
    <div class="card-body">
        <?php if (empty($stocks)): ?>
            <p class="text-muted">Aucun stock trouvé. Créez d'abord des produits.</p>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>code</th>
                            <th>Produit</th>
                            <th>Catégorie</th>
                            <th>Quantité</th>
                            <th>Réservé</th>
                            <th>Disponible</th>
                            <th>Min</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($stocks as $stock): ?>
                            <tr>
                                <td><span class="badge badge-status-inactive"><?= $stock['sku'] ?></span></td>
                                <td><?= $stock['name'] ?></td>
                                <td><?= $stock['category_name'] ?? 'N/A' ?></td>
                                <td><strong><?= $stock['quantity'] ?></strong></td>
                                <td><?= $stock['reserved_quantity'] ?></td>
                                <td><?= $stock['quantity'] - $stock['reserved_quantity'] ?></td>
                                <td><?= $stock['minimum_stock'] ?></td>
                                <td>
                                    <?php 
                                        $available = $stock['quantity'] - $stock['reserved_quantity'];
                                        if ($stock['quantity'] <= $stock['minimum_stock']): 
                                    ?>
                                        <span class="badge" style="background-color: #fde7e5; color: #8a2c2a;">Faible</span>
                                    <?php elseif ($available > 0): ?>
                                        <span class="badge badge-status-active">OK</span>
                                    <?php else: ?>
                                        <span class="badge" style="background-color: #f0f0f0; color: #666;">Rupture</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="/stock/in/<?= $stock['product_id'] ?>" class="btn btn-sm btn-success">
                                        <i class="bi bi-plus-circle"></i> Entrée
                                    </a>
                                    <a href="/stock/out/<?= $stock['product_id'] ?>" class="btn btn-sm btn-danger">
                                        <i class="bi bi-dash-circle"></i> Sortie
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
