<p style="color:#5a6376;margin-top:-10px;">Hola, <?= esc($adminName ?? '') ?>.</p>

<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:16px;">
    <div class="card">
        <span class="pill">Contacto</span>
        <h3 style="margin:10px 0 0;font-size:28px;"><?= (int) $messagesCount ?></h3>
        <p style="color:#5a6376;font-size:13.5px;margin:4px 0 0;">Mensajes recibidos</p>
    </div>
    <div class="card">
        <span class="pill">Servicios</span>
        <h3 style="margin:10px 0 0;font-size:28px;"><?= (int) $servicesCount ?></h3>
        <p style="color:#5a6376;font-size:13.5px;margin:4px 0 0;">Publicados</p>
    </div>
    <div class="card">
        <span class="pill">Portafolio</span>
        <h3 style="margin:10px 0 0;font-size:28px;"><?= (int) $portfolioCount ?></h3>
        <p style="color:#5a6376;font-size:13.5px;margin:4px 0 0;">Proyectos</p>
    </div>
    <div class="card">
        <span class="pill">Equipo</span>
        <h3 style="margin:10px 0 0;font-size:28px;"><?= (int) $partnersCount ?></h3>
        <p style="color:#5a6376;font-size:13.5px;margin:4px 0 0;">Socios</p>
    </div>
    <div class="card">
        <span class="pill">Soporte</span>
        <h3 style="margin:10px 0 0;font-size:28px;"><?= (int) $openTicketsCount ?></h3>
        <p style="color:#5a6376;font-size:13.5px;margin:4px 0 0;">Tickets abiertos</p>
    </div>
</div>
