<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<?php
// Définitions par défaut pour éviter les warnings d'analyse statique
$product = $product ?? ['id' => 0, 'name' => '', 'sku' => ''];
$type = $type ?? '';
?>

<div class="mb-3">
    <a href="/stock" class="btn btn-primary">
        <i class="bi bi-box-arrow-in-left"></i> Retour aux Stocks
    </a>
</div>

<div class="card">
    <div class="card-header">
        <i class="bi bi-arrow-repeat"></i> Mouvement de Stock - <?= $product['name'] ?>
    </div>
    <div class="card-body">
        <form method="POST" action="/stock/movement">
            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Produit</label>
                        <input type="text" class="form-control" value="<?= $product['name'] ?> (<?= $product['sku'] ?>)" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="type">Type de Mouvement</label>
                        <select id="type" name="type" class="form-select" required>
                            <option value="in" <?= $type === 'in' ? 'selected' : '' ?>>Entrée (In)</option>
                            <option value="out" <?= $type === 'out' ? 'selected' : '' ?>>Sortie (Out)</option>
                            <option value="adjustment">Ajustement</option>
                            <option value="return">Retour</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="quantity">Quantité</label>
                        <input type="number" id="quantity" name="quantity" class="form-control" required placeholder="0">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="reference">Référence (Bon, Facture, etc.)</label>
                        <input type="text" id="reference" name="reference" class="form-control" placeholder="Ex: BON-001">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="notes">Notes</label>
                <textarea id="notes" name="notes" class="form-control" rows="2" placeholder="Notes ou observations"></textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Enregistrer le Mouvement
                </button>
                <a href="/stock" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
