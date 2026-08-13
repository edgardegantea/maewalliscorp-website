<div class="card" style="max-width:720px;">
    <form method="post" action="/admin/legal/<?= esc($key, 'url') ?>">
        <?= csrf_field() ?>

        <div class="field">
            <label for="title">Título</label>
            <input type="text" id="title" name="title" value="<?= esc($page['title'] ?? '') ?>" required>
        </div>

        <div class="field">
            <label for="content">Contenido</label>
            <textarea id="content" name="content" rows="20" required><?= esc($page['content'] ?? '') ?></textarea>
            <small>
                Una línea en blanco separa párrafos. Una línea que empiece con <code>## </code> se
                muestra como subtítulo. Para enlaces usa <code>[texto](/ruta)</code>.
            </small>
        </div>

        <button type="submit" class="btn btn-primary">Guardar cambios</button>
    </form>
</div>
