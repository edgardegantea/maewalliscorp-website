<div class="card">
    <?php if (empty($messages)): ?>
        <p class="empty-state">Todavía no hay mensajes de contacto.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Mensaje</th>
                    <th>IP</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($messages as $message): ?>
                    <tr>
                        <td><?= esc($message['created_at']) ?></td>
                        <td><?= esc($message['name']) ?></td>
                        <td><?= esc($message['email']) ?></td>
                        <td style="max-width:360px;white-space:pre-wrap;"><?= esc($message['message']) ?></td>
                        <td><?= esc($message['ip_address']) ?></td>
                        <td class="row-actions">
                            <form method="post" action="/admin/messages/<?= (int) $message['id'] ?>/delete" onsubmit="return confirm('¿Eliminar este mensaje?');" style="display:inline;">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn btn-danger" style="padding:5px 10px;font-size:12.5px;">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
