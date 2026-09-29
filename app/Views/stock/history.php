<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <i class="bi bi-clock-history"></i> Historique des Mouvements de Stock
    </div>
    <div class="card-body">
        <?php if (empty($movements)): ?>
            <p class="text-muted">Aucun mouvement de stock trouvé.</p>
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
                            <th>Notes</th>
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
                                $notes = $move['notes'] ?? '-';
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
                                    <?php elseif (($move['type'] ?? '') === 'adjustment'): ?>
                                        <span class="badge" style="background-color: #fff7e6; color: #8a5e00;">Ajustement</span>
                                    <?php else: ?>
                                        <span class="badge" style="background-color: #e6f3ff; color: #003d7a;">Retour</span>
                                    <?php endif; ?>
                                </td>
                                <td><strong><?= esc($move['quantity'] ?? 0) ?></strong></td>
                                <td><?= esc($fullName) ?></td>
                                <td><?= esc($reference) ?></td>
                                <td><small><?= esc($notes) ?></small></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
