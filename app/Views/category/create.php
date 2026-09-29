<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <i class="bi bi-plus-circle"></i> Créer une Catégorie
    </div>
    <div class="card-body">
        <form method="POST" action="/category/store">
            <div class="form-group">
                <label for="name">Nom de la Catégorie</label>
                <input type="text" id="name" name="name" class="form-control" required placeholder="Ex: Électronique">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control" rows="3" placeholder="Description de la catégorie"></textarea>
            </div>

            <input type="hidden" name="status" value="active">

            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Créer
                </button>
                <a href="/category" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
