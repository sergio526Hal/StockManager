<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<?php
// Définitions par défaut pour éviter les warnings d'analyse statique
$category = $category ?? ['id' => 0, 'name' => '', 'description' => '', 'status' => 'inactive'];
?>

<div class="card">
    <div class="card-header">
        <i class="bi bi-pencil"></i> Éditer la Catégorie: <?= $category['name'] ?>
    </div>
    <div class="card-body">
        <form method="POST" action="/category/update/<?= $category['id'] ?>">
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" id="name" name="name" class="form-control" value="<?= $category['name'] ?>" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control" rows="3"><?= $category['description'] ?></textarea>
            </div>

            <div class="form-group">
                <label for="status">Statut</label>
                <select id="status" name="status" class="form-select" required>
                    <option value="active" <?= $category['status'] === 'active' ? 'selected' : '' ?>>Active</option>
                    <option value="inactive" <?= $category['status'] === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Mettre à Jour
                </button>
                <a href="/category" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
