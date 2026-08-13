<?php
$statusLabels = ['abierto' => 'Abierto', 'en_progreso' => 'En progreso', 'cerrado' => 'Cerrado'];
$statusColors = ['abierto' => '#c0392b', 'en_progreso' => '#b8860b', 'cerrado' => '#1e7e34'];
?>
<div style="margin-top:-10px;margin-bottom:16px;display:flex;gap:8px;">
    <a href="/admin/tickets" class="btn <?= empty($activeStatus) ? 'btn-primary' : 'btn-secondary' ?>" style="padding:7px 14px;font-size:13px;">Todos</a>
    <?php foreach ($statusLabels as $key => $label): ?>
        <a href="/admin/tickets?status=<?= esc($key, 'url') ?>" class="btn <?= $activeStatus === $key ? 'btn-primary' : 'btn-secondary' ?>" style="padding:7px 14px;font-size:13px;"><?= esc($label) ?></a>
    <?php endforeach; ?>
</div>

<div class="card">
    <?php if (empty($items)): ?>
        <p class="empty-state">No hay tickets<?= $activeStatus ? ' con este estado' : '' ?>.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr><th>Folio</th><th>Asunto</th><th>Contacto</th><th>Estado</th><th>Asignado</th><th>Fecha</th><th></th></tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><code><?= esc($item['folio']) ?></code></td>
                        <td><?= esc($item['subject']) ?></td>
                        <td><?= esc($item['name']) ?><br><span style="color:#8890a0;font-size:12.5px;"><?= esc($item['email']) ?></span></td>
                        <td><span style="color:<?= $statusColors[$item['status']] ?? '#666' ?>;font-weight:600;"><?= esc($statusLabels[$item['status']] ?? $item['status']) ?></span></td>
                        <td><?= esc($item['partner_id'] ? ($partnersByIdx[$item['partner_id']] ?? '—') : '—') ?></td>
                        <td><?= esc($item['created_at']) ?></td>
                        <td class="row-actions"><a href="/admin/tickets/<?= (int) $item['id'] ?>">Ver</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
