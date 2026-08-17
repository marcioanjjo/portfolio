<?php
$statusAtual = $statusAtual ?? 'pendente';
?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
    <h1>⚙️ Painel Administrativo</h1>
    <div style="display: flex; gap: 0.5rem;">
        <a href="/" target="_blank" class="btn" style="background: #475569;">🌐 Ver Site</a>
        <a href="/admin/logout" class="btn" style="background: #ef4444;">Sair</a>
    </div>
</div>

<!-- Abas de Filtro -->
<div style="display: flex; gap: 0.5rem; margin-bottom: 1.5rem; border-bottom: 1px solid #cbd5e1; padding-bottom: 0.5rem;">
    <a href="/admin/dashboard?status=pendente"
        class="btn"
        style="background: <?= $statusAtual === 'pendente' ? '#0284c7' : '#94a3b8' ?>; padding: 0.4rem 1rem;">
        📥 Pendentes
        <span style="background: rgba(0,0,0,0.25); color: #fff; padding: 0.1rem 0.45rem; border-radius: 999px; font-size: 0.75rem; font-weight: bold;">
            <?= $contadores['pendente'] ?? 0 ?>
        </span>
    </a>
    <a href="/admin/dashboard?status=concluido"
        class="btn"
        style="background: <?= $statusAtual === 'concluido' ? '#16a34a' : '#94a3b8' ?>; padding: 0.4rem 1rem;">
        ✅ Concluídos
        <span style="background: rgba(0,0,0,0.25); color: #fff; padding: 0.1rem 0.45rem; border-radius: 999px; font-size: 0.75rem; font-weight: bold;">
            <?= $contadores['concluido'] ?? 0 ?>
        </span>
    </a>
    <a href="/admin/dashboard?status=arquivado"
        class="btn"
        style="background: <?= $statusAtual === 'arquivado' ? '#475569' : '#94a3b8' ?>; padding: 0.4rem 1rem;">
        🗄️ Arquivados
        <span style="background: rgba(0,0,0,0.25); color: #fff; padding: 0.1rem 0.45rem; border-radius: 999px; font-size: 0.75rem; font-weight: bold;">
            <?= $contadores['arquivado'] ?? 0 ?>
        </span>
    </a>
</div>

<h2>Solicitações: <?= ucfirst(htmlspecialchars($statusAtual)) ?>s</h2>

<?php if (empty($contatos)): ?>
    <p style="color: #64748b; margin-top: 1rem;">Nenhum orçamento encontrado nesta categoria.</p>
<?php else: ?>
    <div style="display: flex; flex-direction: column; gap: 1rem; margin-top: 1rem;">
        <?php foreach ($contatos as $c): ?>
            <div class="card" style="border-left: 5px solid <?= $statusAtual === 'concluido' ? '#16a34a' : ($statusAtual === 'arquivado' ? '#64748b' : '#0284c7') ?>;">
                <div style="display: flex; justify-content: space-between; color: #64748b; font-size: 0.9rem;">
                    <span>Data: <?= date('d/m/Y H:i', strtotime($c['criado_em'])) ?></span>
                    <span><strong>WhatsApp:</strong> <?= htmlspecialchars($c['whatsapp']) ?></span>
                </div>

                <h3 style="margin: 0.5rem 0; color: #0f172a;"><?= htmlspecialchars($c['nome']) ?> (<?= htmlspecialchars($c['email']) ?>)</h3>

                <p style="background: #f8fafc; padding: 1rem; border-radius: 6px; color: #334155; font-style: italic;">
                    "<?= nl2br(htmlspecialchars($c['mensagem'])) ?>"
                </p>

                <!-- Ações do Orçamento -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1rem; flex-wrap: wrap; gap: 0.5rem;">
                    <a href="https://wa.me/55<?= preg_replace('/[^0-9]/', '', $c['whatsapp']) ?>" target="_blank" class="btn" style="background: #16a34a; font-size: 0.85rem;">
                        <i class="fab fa-whatsapp"></i> Chamar no WhatsApp
                    </a>

                    <div style="display: flex; gap: 0.4rem;">
                        <?php if ($statusAtual !== 'concluido'): ?>
                            <form action="/admin/contato/status" method="POST" style="display: inline;">
                                <input type="hidden" name="csrf_token" value="<?= \App\Helpers\Csrf::generate(); ?>">
                                <input type="hidden" name="id" value="<?= $c['id'] ?>">
                                <input type="hidden" name="status" value="concluido">
                                <input type="hidden" name="redirect_status" value="<?= $statusAtual ?>">
                                <button type="submit" class="btn" style="background: #16a34a; font-size: 0.85rem; border: none; cursor: pointer;">
                                    ✓ Marcar Concluído
                                </button>
                            </form>
                        <?php endif; ?>

                        <?php if ($statusAtual !== 'arquivado'): ?>
                            <form action="/admin/contato/status" method="POST" style="display: inline;">
                                <input type="hidden" name="csrf_token" value="<?= \App\Helpers\Csrf::generate(); ?>">
                                <input type="hidden" name="id" value="<?= $c['id'] ?>">
                                <input type="hidden" name="status" value="arquivado">
                                <input type="hidden" name="redirect_status" value="<?= $statusAtual ?>">
                                <button type="submit" class="btn" style="background: #475569; font-size: 0.85rem; border: none; cursor: pointer;">
                                    🗄️ Arquivar
                                </button>
                            </form>
                        <?php endif; ?>

                        <?php if ($statusAtual !== 'pendente'): ?>
                            <form action="/admin/contato/status" method="POST" style="display: inline;">
                                <input type="hidden" name="csrf_token" value="<?= \App\Helpers\Csrf::generate(); ?>">
                                <input type="hidden" name="id" value="<?= $c['id'] ?>">
                                <input type="hidden" name="status" value="pendente">
                                <input type="hidden" name="redirect_status" value="<?= $statusAtual ?>">
                                <button type="submit" class="btn" style="background: #0284c7; font-size: 0.85rem; border: none; cursor: pointer;">
                                    ↩ Reabrir (Pendente)
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>