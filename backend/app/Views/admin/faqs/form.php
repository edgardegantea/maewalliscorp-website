<?php $isEdit = ! empty($item); ?>
<div class="card" style="max-width:560px;">
    <form method="post" action="<?= $isEdit ? '/admin/faqs/' . (int) $item['id'] . '/update' : '/admin/faqs' ?>">
        <?= csrf_field() ?>

        <div class="field">
            <label for="question">Pregunta</label>
            <input type="text" id="question" name="question" value="<?= esc($item['question'] ?? '') ?>" required>
        </div>

        <div class="field">
            <label for="answer">Respuesta</label>
            <textarea id="answer" name="answer" rows="5" required><?= esc($item['answer'] ?? '') ?></textarea>
        </div>

        <div class="field">
            <label for="position">Orden</label>
            <input type="number" id="position" name="position" value="<?= esc($item['position'] ?? 0) ?>">
        </div>

        <button type="submit" class="btn btn-primary"><?= $isEdit ? 'Guardar cambios' : 'Crear pregunta' ?></button>
        <a href="/admin/faqs" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
