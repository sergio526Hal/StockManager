<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <i class="bi bi-box"></i> Rapport d'Inventaire Complet
    </div>
    <div class="card-body">
        <?php if (empty($stocks)): ?>
            <p class="text-muted">Aucun stock trouvé.</p>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>SKU</th>
                            <th>Produit</th>
                            <th>Catégorie</th>
                            <th>Quantité</th>
                            <th>Prix Unit.</th>
                            <th>Valeur</th>
                            <th>Min</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $totalValue = 0;
                            foreach ($stocks as $stock):
                                $value = $stock['quantity'] * $stock['unit_price'];
                                $totalValue += $value;
                        ?>
                            <tr>
                                <td><span class="badge badge-status-inactive"><?= $stock['sku'] ?></span></td>
                                <td><?= $stock['name'] ?></td>
                                <td><?= $stock['category_name'] ?? 'N/A' ?></td>
                                <td><?= $stock['quantity'] ?></td>
                                <td><?= number_format($stock['unit_price'], 0, ',', ' ') ?> Ar</td>
                                <td><strong><?= number_format($value, 0, ',', ' ') ?> Ar</strong></td>
                                <td><?= $stock['minimum_stock'] ?></td>
                                <td>
                                    <?php if ($stock['quantity'] <= $stock['minimum_stock']): ?>
                                        <span class="badge" style="background-color: #fde7e5; color: #8a2c2a;">⚠ Faible</span>
                                    <?php else: ?>
                                        <span class="badge badge-status-active">✓ OK</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr style="font-weight: bold; background-color: #f8f9fa;">
                            <td colspan="5">TOTAL</td>
                            <td><?= number_format($totalValue, 0, ',', ' ') ?> Ar</td>
                            <td colspan="2"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
