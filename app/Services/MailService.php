<?php

namespace App\Services;


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailService
{
    /**
     * Envia uma notificação por e-mail com os dados do orçamento recebido
     */
    public static function sendBudgetNotification(array $data): bool
    {
        $email = new PHPMailer(true);
        //$email->SMTPDebug = 2;

        try {
            // Configurações do Servidor SMTP vindas do .env
            $email->isSMTP();
            $email->Host = $_SERVER['SMTP_HOST'] ?? '';
            $email->SMTPAuth = true;
            $email->Username = $_SERVER['SMTP_USER'] ?? '';
            $email->Password = $_SERVER['SMTP_PASS'] ?? '';
            $email->SMTPSecure = ($_SERVER['SMTP_SECURE'] ?? '') === 'ssl' ? PHPMailer::ENCRYPTION_SMTPS : PHPMailer::ENCRYPTION_STARTTLS;
            $email->Port = (int) ($_SERVER['SMTP_PORT'] ?? 465);
            $email->CharSet = 'UTF-8';

            // Remetente e Destinatário
            $email->setFrom($_SERVER['SMTP_USER'] ?? '', 'SQL Tecnologia - Site');
            $email->addAddress($_SERVER['MAIL_TO'] ?? ''); //Seu e-mail que recebe o aviso.
            $email->addReplyTo($data['email'], $data['nome']); //Permite Responder Direto para o cliente.


            //Conteudo do e-mail
            $email->isHTML(true);
            $email->Subject = "⚡ Novo Orçamento Recebido: {$data['nome']}";

            $email->Body = "
                <div style='font-family: Arial, sans-serif; color: #333;'>
                    <h2 style='color: #0284c7;'>🚀 Novo Orçamento Recebido</h2>
                    <p>Você recebeu uma nova mensagem através do formulário do portfólio.</p>
                    <hr>
                    <p><strong>Nome:</strong> {$data['nome']}</p>
                    <p><strong>Email:</strong> {$data['email']}</p>
                    <p><strong>WhatsApp:</strong><a href='https://wa.me/55" . preg_replace('/[^0-9]/', '', $data['whatsapp']) . "' target='_blank'>{$data['whatsapp']}</a></p>
                    <p><strong>Mensagem / Projeto:</strong></p>
                    <blockquote style='background-color: #f4f6f9; padding: 10px; border-left: 4px solid #0284c7;'>
                        " . nl2br(htmlspecialchars($data['mensagem'])) . "
                    </blockquote>
                    <hr>
                    <p><small>Mensagem gravada automaticamente na tabela 'contato' do MYSQL. </small></p>
                </div>
            ";

            $email->send();
            return true;
        } catch (Exception $e) {
            // Em ambiente local, se o SMTP falhar, podemos registrar o log
            error_log("Erro ao enviar e-mail: {$email->ErrorInfo}");
            return false;
        }
    }
}
