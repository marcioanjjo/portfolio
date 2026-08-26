<?php

namespace App\Helpers;


class Upload
{
    /**
     * Faz o upload de uma imagem e retorna o caminho relativo para o banco.
     */
    public static function image(array $file, string $subPasta = 'projetos'): ?string
    {
        if (empty($file['name']) || $file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $diretorioDestino = __DIR__ . '/../../public/assets/img/' . trim($subPasta, '/') . '/';

        //Garante que o diretorio exista
        if (!is_dir($diretorioDestino)) {
            mkdir($diretorioDestino, 0755, true);
        }

        $extensao = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $extensoesValida = ['jpg', 'jpeg', 'png', 'webp', 'svg'];
        if (!in_array($extensao, $extensoesValida, true)) {
            return null;
        }

        $nomeArquivo = uniqid('img_', true) . '.' . $extensao;
        $caminhoCompleto = $diretorioDestino . $nomeArquivo;

        if (move_uploaded_file($file['tmp_name'], $caminhoCompleto)) {
            chmod($caminhoCompleto, 0666);
            return '/assets/img/' . trim($subPasta, '/') . '/' . $nomeArquivo;
        }
        return null;
    }
}
