<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<?php
// Définitions par défaut pour éviter les warnings d'analyse statique
$start_date = $start_date ?? '';
$end_date = $end_date ?? '';
?>

<div class="card mb-3">
    <div class="card-body">
        <form method="GET" class="row g-3">
            <div class="col-md-5">
                <label for="start_date" class="form-label">Date Début</label>
                <input type="date" id="start_date" name="start_date" class="form-control" value="<?= $start_date ?>">
            </div>
            <div class="col-md-5">
                <label for="end_date" class="form-label">Date Fin</label>
                <input type="date" id="end_date" name="end_date" class="form-control" value="<?= $end_date ?>">
            </div>
            <div class="col-md-2">
                <label>&nbsp;</label>
                <button type="submit" class="btn btn-primary w-100">Filtrer</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <i class="bi bi-arrow-repeat"></i> Mouvements de Stock
    </div>
    <div class="card-body">
        <?php if (empty($movements)): ?>
            <p class="text-muted">Aucun mouvement trouvé pour cette période.</p>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>SKU</th>
                            <th>Produit</th>
                            <th>Type</th>
                            <th>Quantité</th>
                            <th>Utilisateur</th>
                            <th>Référence</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($movements as $move): ?>
                            <?php
                                $createdAt = !empty($move['created_at']) ? date('d/m/Y H:i', strtotime($move['created_at'])) : '-';
                                $sku = $move['sku'] ?? 'N/A';
                                $name = $move['name'] ?? 'Produit inconnu';
                                $fullName = $move['full_name'] ?? 'Utilisateur inconnu';
                                $reference = $move['reference'] ?? '-';
                            ?>
                            <tr>
                                <td><?= esc($createdAt) ?></td>
                                <td><span class="badge badge-status-inactive"><?= esc($sku) ?></span></td>
                                <td><?= esc($name) ?></td>
                                <td>
                                    <?php if (($move['type'] ?? '') === 'in'): ?>
                                        <span class="badge badge-status-active">Entrée</span>
                                    <?php elseif (($move['type'] ?? '') === 'out'): ?>
                                        <span class="badge" style="background-color: #fde7e5; color: #8a2c2a;">Sortie</span>
                                    <?php else: ?>
                                        <span class="badge" style="background-color: #fff7e6; color: #8a5e00;"><?= esc($move['type'] ?? 'inconnu') ?></span>
                                    <?php endif; ?>
                                </td>
                                <td><strong><?= esc($move['quantity'] ?? 0) ?></strong></td>
                                <td><?= esc($fullName) ?></td>
                                <td><?= esc($reference) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
