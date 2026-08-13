<?php if (! $ticket): ?>
    <p class="empty-state">Ticket no encontrado.</p>
<?php else: ?>
    <div class="card" style="max-width:680px;">
        <p style="margin-top:0;color:#8890a0;font-size:13px;">
            Folio <code><?= esc($ticket['folio']) ?></code> · Creado <?= esc($ticket['created_at']) ?>
            · Origen: <?= esc($ticket['source']) ?>
        </p>

        <h3 style="margin:0 0 4px;font-size:18px;"><?= esc($ticket['subject']) ?></h3>
        <p style="color:#5a6376;font-size:14px;margin-bottom:20px;">
            <?= esc($ticket['name']) ?> — <?= esc($ticket['email']) ?>
        </p>

        <div class="field">
            <label>Descripción</label>
            <p style="white-space:pre-wrap;font-size:14.5px;color:#1c2230;background:#f3f5f9;border-radius:8px;padding:12px 14px;margin:0;"><?= esc($ticket['description']) ?></p>
        </div>

        <form method="post" action="/admin/tickets/<?= (int) $ticket['id'] ?>/update" style="margin-top:20px;">
            <?= csrf_field() ?>

            <div class="field">
                <label for="status">Estado</label>
                <select id="status" name="status" style="width:100%;padding:9px 12px;border:1px solid #dde2ec;border-radius:8px;font-size:14px;">
                    <option value="abierto" <?= $ticket['status'] === 'abierto' ? 'selected' : '' ?>>Abierto</option>
                    <option value="en_progreso" <?= $ticket['status'] === 'en_progreso' ? 'selected' : '' ?>>En progreso</option>
                    <option value="cerrado" <?= $ticket['status'] === 'cerrado' ? 'selected' : '' ?>>Cerrado</option>
                </select>
            </div>

            <div class="field">
                <label for="partner_id">Asignado a</label>
                <select id="partner_id" name="partner_id" style="width:100%;padding:9px 12px;border:1px solid #dde2ec;border-radius:8px;font-size:14px;">
                    <option value="">Sin asignar</option>
                    <?php foreach ($partners as $partner): ?>
                        <option value="<?= (int) $partner['id'] ?>" <?= (int) ($ticket['partner_id'] ?? 0) === (int) $partner['id'] ? 'selected' : '' ?>>
                            <?= esc($partner['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="field">
                <label for="admin_notes">Notas internas</label>
                <textarea id="admin_notes" name="admin_notes" rows="4"><?= esc($ticket['admin_notes'] ?? '') ?></textarea>
                <small>No visibles para el cliente; solo para seguimiento interno.</small>
            </div>

            <button type="submit" class="btn btn-primary">Guardar cambios</button>
            <a href="/admin/tickets" class="btn btn-secondary">Volver</a>
        </form>
    </div>
<?php endif; ?>
