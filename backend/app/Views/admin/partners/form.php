<?php
$isEdit = ! empty($item);
$linesOf = static fn ($arr) => implode("\n", is_array($arr) ? $arr : []);
$linksLines = '';
if (! empty($item['links'])) {
    $linksLines = implode("\n", array_map(
        static fn ($l) => ($l['label'] ?? '') . '|' . ($l['url'] ?? ''),
        $item['links']
    ));
}
?>
<div class="card" style="max-width:720px;">
    <form method="post" action="<?= $isEdit ? '/admin/partners/' . (int) $item['id'] . '/update' : '/admin/partners' ?>">
        <?= csrf_field() ?>

        <div class="field">
            <label for="name">Nombre completo</label>
            <input type="text" id="name" name="name" value="<?= esc($item['name'] ?? '') ?>" required>
        </div>

        <div class="field">
            <label for="slug">Slug (para la URL /nosotros/slug)</label>
            <input type="text" id="slug" name="slug" value="<?= esc($item['slug'] ?? '') ?>" required pattern="[a-z0-9\-]+">
            <small>Solo minúsculas, números y guiones. Ej: juan-perez</small>
        </div>

        <div class="field">
            <label for="role">Rol / puesto</label>
            <input type="text" id="role" name="role" value="<?= esc($item['role'] ?? '') ?>" required>
        </div>

        <div class="field">
            <label for="semblanza">Semblanza</label>
            <textarea id="semblanza" name="semblanza" rows="4" required><?= esc($item['semblanza'] ?? '') ?></textarea>
        </div>

        <div class="field">
            <label for="academico">Historial académico</label>
            <textarea id="academico" name="academico" rows="5"><?= esc($linesOf($item['academico'] ?? [])) ?></textarea>
            <small>Un elemento por línea.</small>
        </div>

        <div class="field">
            <label for="profesional">Historial profesional</label>
            <textarea id="profesional" name="profesional" rows="6"><?= esc($linesOf($item['profesional'] ?? [])) ?></textarea>
            <small>Un elemento por línea.</small>
        </div>

        <div class="field">
            <label for="publicaciones">Publicaciones y proyectos (opcional)</label>
            <textarea id="publicaciones" name="publicaciones" rows="4"><?= esc($linesOf($item['publicaciones'] ?? [])) ?></textarea>
            <small>Un elemento por línea.</small>
        </div>

        <div class="field">
            <label for="links">Perfiles / enlaces (opcional)</label>
            <textarea id="links" name="links" rows="3"><?= esc($linksLines) ?></textarea>
            <small>Un enlace por línea, formato: Etiqueta|https://url</small>
        </div>

        <div class="field">
            <label><input type="checkbox" name="pending_review" value="1" <?= ! empty($item['pending_review']) ? 'checked' : '' ?>> Marcar como información pendiente de confirmar</label>
        </div>

        <div class="field">
            <label for="position">Orden</label>
            <input type="number" id="position" name="position" value="<?= esc($item['position'] ?? 0) ?>">
        </div>

        <button type="submit" class="btn btn-primary"><?= $isEdit ? 'Guardar cambios' : 'Crear socio' ?></button>
        <a href="/admin/partners" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
