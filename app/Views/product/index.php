<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="mb-3">
    <a href="/product/create" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Ajouter Produit
    </a>
    <a href="/category" class="btn btn-secondary">
        <i class="bi bi-folder"></i> Gérer Catégories
    </a>
</div>

<div class="card">
    <div class="card-header">
        <i class="bi bi-box"></i> Liste des Produits
    </div>
    <div class="card-body">
        <?php if (empty($products)): ?>
            <p class="text-muted">Aucun produit trouvé. <a href="/product/create">Créer un produit</a></p>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>SKU</th>
                            <th>Nom</th>
                            <th>Catégorie</th>
                            <th>Prix Unitaire</th>
                            <th>Unité</th>
                            <th>Stock Min</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><span class="badge badge-status-inactive"><?= $product['sku'] ?></span></td>
                                <td><?= $product['name'] ?></td>
                                <td><?= $product['category_name'] ?? 'N/A' ?></td>
                                <td><?= number_format($product['unit_price'], 0, ',', ' ') ?> Ar</td>
                                <td><?= $product['unit'] ?></td>
                                <td><?= $product['minimum_stock'] ?></td>
                                <td>
                                    <a href="/product/detail/<?= $product['id'] ?>" class="btn btn-sm btn-info text-white">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="/product/edit/<?= $product['id'] ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="/product/delete/<?= $product['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr?')">
                                        <i class="bi bi-trash"></i>
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
