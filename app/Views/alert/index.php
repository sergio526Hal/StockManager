<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <i class="bi bi-exclamation-circle"></i> Alertes Actives
    </div>
    <div class="card-body">
        <?php if (empty($alerts)): ?>
            <p class="text-muted">Aucune alerte active. Bien géré !</p>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Produit</th>
                            <th>Catégorie</th>
                            <th>Message</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($alerts as $alert): ?>
                            <tr>
                                <td><?= date('d/m/Y H:i', strtotime($alert['created_at'])) ?></td>
                                <td>
                                    <?php if ($alert['type'] === 'low_stock'): ?>
                                        <span class="badge" style="background-color: #fde7e5; color: #8a2c2a;">Stock Faible</span>
                                    <?php elseif ($alert['type'] === 'overstock'): ?>
                                        <span class="badge" style="background-color: #fff7e6; color: #8a5e00;">Surstock</span>
                                    <?php else: ?>
                                        <span class="badge" style="background-color: #f0f0f0; color: #666;">Expiré</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= $alert['name'] ?></td>
                                <td><?= $alert['category_name'] ?? 'N/A' ?></td>
                                <td><?= $alert['message'] ?></td>
                                <td>
                                    <a href="/alert/resolve/<?= $alert['id'] ?>" class="btn btn-sm btn-success">
                                        <i class="bi bi-check-circle"></i> Résoudre
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
