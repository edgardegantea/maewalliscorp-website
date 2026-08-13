<p style="margin-top:-10px;"><a href="/admin/faqs/create" class="btn btn-primary">+ Nueva pregunta</a></p>

<div class="card">
    <?php if (empty($items)): ?>
        <p class="empty-state">Todavía no hay preguntas.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr><th>#</th><th>Pregunta</th><th>Respuesta</th><th></th></tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= (int) $item['position'] ?></td>
                        <td><?= esc($item['question']) ?></td>
                        <td style="max-width:420px;"><?= esc($item['answer']) ?></td>
                        <td class="row-actions">
                            <a href="/admin/faqs/<?= (int) $item['id'] ?>/edit">Editar</a>
                            <form method="post" action="/admin/faqs/<?= (int) $item['id'] ?>/delete" onsubmit="return confirm('¿Eliminar esta pregunta?');" style="display:inline;">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn btn-danger" style="padding:4px 9px;font-size:12.5px;">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
