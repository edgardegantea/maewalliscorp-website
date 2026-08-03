<p style="margin-top:-10px;"><a href="/admin/partners/create" class="btn btn-primary">+ Nuevo socio</a></p>

<div class="card">
    <?php if (empty($items)): ?>
        <p class="empty-state">Todavía no hay socios.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr><th>#</th><th>Nombre</th><th>Rol</th><th>Slug</th><th></th></tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><?= (int) $item['position'] ?></td>
                        <td><?= esc($item['name']) ?></td>
                        <td><?= esc($item['role']) ?></td>
                        <td><code><?= esc($item['slug']) ?></code></td>
                        <td class="row-actions">
                            <a href="/nosotros/<?= esc($item['slug'], 'url') ?>" target="_blank">Ver</a>
                            <a href="/admin/partners/<?= (int) $item['id'] ?>/edit">Editar</a>
                            <form method="post" action="/admin/partners/<?= (int) $item['id'] ?>/delete" onsubmit="return confirm('¿Eliminar este socio?');" style="display:inline;">
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
