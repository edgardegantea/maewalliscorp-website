<p style="margin-top:-10px;"><a href="/admin/services/create" class="btn btn-primary">+ Nuevo servicio</a></p>

<div class="card">
    <?php if (empty($items)): ?>
        <p class="empty-state">Todavía no hay servicios.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr><th>#</th><th>Icono</th><th>Título</th><th>Descripción</th><th></th></tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= (int) $item['position'] ?></td>
                        <td style="font-size:20px;"><?= esc($item['icon']) ?></td>
                        <td><?= esc($item['title']) ?></td>
                        <td style="max-width:420px;"><?= esc($item['description']) ?></td>
                        <td class="row-actions">
                            <a href="/admin/services/<?= (int) $item['id'] ?>/edit">Editar</a>
                            <form method="post" action="/admin/services/<?= (int) $item['id'] ?>/delete" onsubmit="return confirm('¿Eliminar este servicio?');" style="display:inline;">
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
