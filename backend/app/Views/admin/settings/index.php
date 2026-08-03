<div class="card" style="max-width:640px;">
    <form method="post" action="/admin/settings">
        <?= csrf_field() ?>

        <?php foreach ($fields as $key => $label): ?>
            <div class="field">
                <label for="<?= esc($key) ?>"><?= esc($label) ?></label>
                <?php if (str_contains($key, 'description') || str_contains($key, 'text')): ?>
                    <textarea id="<?= esc($key) ?>" name="<?= esc($key) ?>" rows="4"><?= esc($current[$key] ?? '') ?></textarea>
                <?php else: ?>
                    <input type="text" id="<?= esc($key) ?>" name="<?= esc($key) ?>" value="<?= esc($current[$key] ?? '') ?>">
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

        <button type="submit" class="btn btn-primary">Guardar cambios</button>
    </form>
</div>
