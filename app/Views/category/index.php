<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="mb-3">
    <a href="/category/create" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Nouvelle Catégorie
    </a>
</div>

<div class="card">
    <div class="card-header">
        <i class="bi bi-folder"></i> Catégories
    </div>
    <div class="card-body">
        <?php if (empty($categories)): ?>
            <p class="text-muted">Aucune catégorie. <a href="/category/create">Créer une catégorie</a></p>
        <?php else: ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $cat): ?>
                        <tr>
                            <td><?= $cat['name'] ?></td>
                            <td><?= $cat['description'] ?? '-' ?></td>
                            <td>
                                <?php if ($cat['status'] === 'active'): ?>
                                    <span class="badge badge-status-active">Active</span>
                                <?php else: ?>
                                    <span class="badge badge-status-inactive">Inactive</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="/category/edit/<?= $cat['id'] ?>" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="/category/delete/<?= $cat['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>
