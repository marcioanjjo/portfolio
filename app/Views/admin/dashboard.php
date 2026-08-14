<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h1>⚙️ Painel Administrativo</h1>
    <a href="/admin/logout" class="btn" style="background: #ef4444;">Sair da Conta</a>
</div>

<h2>📨 Solicitações de Orçamentos Recebidas</h2>

<?php if (empty($contatos)): ?>
    <p>Nenhuma solicitação recebida até o momento.</p>
<?php else: ?>
    <div style="display: flex; flex-direction: column; gap: 1rem; margin-top: 1rem;">
        <?php foreach ($contatos as $c): ?>
            <div class="card" style="border-left: 5px solid #0284c7;">
                <div style="display: flex; justify-content: space-between; color: #64748b; font-size: 0.9rem;">
                    <span>Data: <?= date('d/m/Y H:i', strtotime($c['criado_em'])) ?></span>
                    <span><strong>WhatsApp:</strong> <?= htmlspecialchars($c['whatsapp']) ?></span>
                </div>
                <h3 style="margin: 0.5rem 0; color: #0f172a;"><?= htmlspecialchars($c['nome']) ?> (<?= htmlspecialchars($c['email']) ?>)</h3>
                <p style="background: #f8fafc; padding: 1rem; border-radius: 6px; color: #334155; font-style: italic;">
                    "<?= nl2br(htmlspecialchars($c['mensagem'])) ?>"
                </p>
                <a href="https://wa.me/55<?= preg_replace('/[^0-9]/', '', $c['whatsapp']) ?>" target="_blank" class="btn" style="background: #16a34a; font-size: 0.85rem;">
                    <i class="fab fa-whatsapp"></i> Responder no WhatsApp
                </a>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>