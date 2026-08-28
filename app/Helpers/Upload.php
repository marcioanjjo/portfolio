<?php

namespace App\Helpers;

class Upload
{
    /**
     * Faz o upload de uma imagem e retorna o caminho relativo para salvar no banco.
     */
    public static function image(array $file, string $subPasta = 'projetos'): ?string
    {
        // 1. Validação básica de envio
        if (empty($file['name']) || !isset($file['error']) || $file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        // 2. Validação da extensão
        $extensao = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $extensoesValidas = ['jpg', 'jpeg', 'png', 'webp', 'svg'];
        if (!in_array($extensao, $extensoesValidas, true)) {
            return null;
        }

        // 3. Resolução dinâmica do caminho físico absoluto
        // Se existir a pasta /public_html (HostGator), usa ela; senão, usa DOCUMENT_ROOT ou fallback relativo
        $basePublica = !empty($_SERVER['DOCUMENT_ROOT'])
            ? rtrim($_SERVER['DOCUMENT_ROOT'], '/')
            : dirname(__DIR__, 2) . '/public';

        $caminhoRelativoWeb = '/assets/img/' . trim($subPasta, '/') . '/';
        $diretorioDestino = $basePublica . $caminhoRelativoWeb;

        // 4. Criação recursiva da pasta de destino com permissões corretas
        if (!is_dir($diretorioDestino)) {
            mkdir($diretorioDestino, 0755, true);
        }

        // 5. Nome único, seguro e sem pontos extras
        $nomeArquivo = 'img_' . bin2hex(random_bytes(12)) . '.' . $extensao;
        $caminhoFisicoCompleto = $diretorioDestino . $nomeArquivo;

        // 6. Move o arquivo temporário para o destino final
        if (move_uploaded_file($file['tmp_name'], $caminhoFisicoCompleto)) {
            chmod($caminhoFisicoCompleto, 0644);
            // Retorna o caminho exato que vai para a tag <img src="..."> no HTML
            return $caminhoRelativoWeb . $nomeArquivo;
        }

        return null;
    }
}
