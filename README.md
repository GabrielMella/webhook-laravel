# Webhook Payment Processor

Este projeto consiste em dois aplicativos Laravel, **webhook-server** e **webhook-client**, desenvolvidos para simular o fluxo de um sistema de webhook para processar pedidos de pagamento. O objetivo é explorar e demonstrar o uso de webhooks, eventos e listeners no Laravel.

## 🚀 Funcionalidades

- **Recebimento de pedidos de pagamento:** O webhook-server recebe uma requisição de pagamento simulado e registra o pedido no banco de dados.
- **Disparo de eventos e listeners:** Um evento é acionado para indicar o novo pedido, que é processado por um listener.
- **Chamada de webhook para o cliente:** O listener despacha um webhook (`WebhookCall`) para o webhook-client com os dados do pedido.
- **Resposta e confirmação de pagamento:** O webhook-client recebe a response e envia um e-mail de confirmação ao cliente.

## 🔧 Tecnologias Utilizadas

- **Laravel** — Framework PHP para desenvolvimento rápido e confiável.
- **Eventos e Listeners do Laravel** — Mecanismo para acionar e responder a eventos assíncronos.
- **Spatie Webhook Server** — Biblioteca para gerenciar chamadas de webhook.
- **Spatie Webhook Client** — Biblioteca para gerenciar chamadas de webhook.
- **Mailable do Laravel** — Envio de e-mails transacionais através do MailTrap.

## 🛠️ Instalação

1. Clone o repositório:

   ```bash
   git clone https://github.com/GabrielMella/webhook-laravel.git
   ```

2. **Webhook Server**

   Entre no diretório `webhook-server` e execute os seguintes comandos:

   ```bash
   cd webhook-laravel/webhook-server
   composer install
   php artisan migrate
   php artisan queue:listen
   php artisan serve --port=8082
   ```

3. **Webhook Client**

   Em uma nova janela do terminal, entre no diretório `webhook-client` e execute:

   ```bash
   cd webhook-laravel/webhook-client
   composer install
   php artisan queue:work
   php artisan serve --port=8081
   ```

## 📄 Endpoints

- **webhook-server**
  - `POST /api/payment` - Simula um pedido de pagamento e dispara o fluxo de webhook.

- **webhook-client**
  - `POST /api/paystack/webhook` - Endpoint para receber e processar o webhook enviado pelo webhook-server.

## 🔍 Fluxo do Sistema

1. **Requisição de Pagamento:** O webhook-server recebe um pedido de pagamento via `POST /api/payment`.
2. **Gravação e Disparo de Evento:** O pedido é registrado no banco de dados, e um evento é disparado.
3. **Listener e Webhook:** O listener captura o evento e despacha a chamada do WebHookCall para a URL cadastrada.
4. **Confirmação de Pagamento:** O webhook-client recebe a response e envia um e-mail de confirmação ao cliente.

## 📧 Configuração de Email

O webhook-client usa MailTrap para envio de e-mails. Configure as credenciais de MailTrap no `.env` do webhook-client para testar o envio de emails transacionais.

## 🤝 Contribuições

Este projeto é aberto para contribuições! Sinta-se à vontade para abrir uma issue ou enviar um pull request.
