<p style="margin-top:-10px;"><a href="/admin/process/create" class="btn btn-primary">+ Nuevo paso</a></p>

<div class="card">
    <?php if (empty($items)): ?>
        <p class="empty-state">Todavía no hay pasos.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr><th>#</th><th>Título</th><th>Descripción</th><th></th></tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= (int) $item['position'] ?></td>
                        <td><?= esc($item['title']) ?></td>
                        <td style="max-width:420px;"><?= esc($item['description']) ?></td>
                        <td class="row-actions">
                            <a href="/admin/process/<?= (int) $item['id'] ?>/edit">Editar</a>
                            <form method="post" action="/admin/process/<?= (int) $item['id'] ?>/delete" onsubmit="return confirm('¿Eliminar este paso?');" style="display:inline;">
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
