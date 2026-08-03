<?php $isEdit = ! empty($item); ?>
<div class="card" style="max-width:560px;">
    <form method="post" action="<?= $isEdit ? '/admin/portfolio/' . (int) $item['id'] . '/update' : '/admin/portfolio' ?>">
        <?= csrf_field() ?>

        <div class="field">
            <label for="category">Categoría</label>
            <input type="text" id="category" name="category" value="<?= esc($item['category'] ?? '') ?>" required>
        </div>

        <div class="field">
            <label for="title">Título</label>
            <input type="text" id="title" name="title" value="<?= esc($item['title'] ?? '') ?>" required>
        </div>

        <div class="field">
            <label for="description">Descripción</label>
            <textarea id="description" name="description" rows="4" required><?= esc($item['description'] ?? '') ?></textarea>
        </div>

        <div class="field">
            <label for="position">Orden</label>
            <input type="number" id="position" name="position" value="<?= esc($item['position'] ?? 0) ?>">
        </div>

        <button type="submit" class="btn btn-primary"><?= $isEdit ? 'Guardar cambios' : 'Crear proyecto' ?></button>
        <a href="/admin/portfolio" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
