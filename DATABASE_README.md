# Instruções para Configuração do Banco de Dados

Este documento contém as instruções para configurar o banco de dados MariaDB/MySQL para o site Omnia Brasil.

## Requisitos

- MariaDB ou MySQL instalado
- Acesso de administrador ao banco de dados

## Passos para Configuração

1. Crie um banco de dados chamado `omnia_db`:
   ```sql
   CREATE DATABASE omnia_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

2. Importe o arquivo SQL de estrutura e dados iniciais:
   ```bash
   mysql -u root -p omnia_db < app/config/database.sql
   ```
   
   Ou você pode executar o conteúdo do arquivo `app/config/database.sql` diretamente no seu cliente MySQL/MariaDB.

3. Configure as credenciais de acesso ao banco no arquivo `app/models/Database.php`:
   ```php
   private $host = 'localhost';     // Endereço do servidor de banco de dados
   private $username = 'root';      // Nome de usuário do banco de dados
   private $password = '';          // Senha do banco de dados
   private $database = 'omnia_db';  // Nome do banco de dados
   ```

## Estrutura do Banco de Dados

O banco de dados contém as seguintes tabelas:

1. `users` - Usuários administrativos
2. `settings` - Configurações do site
3. `pages` - Páginas do site
4. `content_sections` - Seções de conteúdo das páginas
5. `banners` - Banners do site
6. `product_categories` - Categorias de produtos
7. `products` - Produtos
8. `resumes` - Currículos recebidos
9. `quotes` - Cotações de culturas
10. `weather` - Previsão do tempo

## Dados Iniciais

O script de criação do banco de dados já inclui dados iniciais para todas as tabelas, incluindo:

- Um usuário administrativo (admin/admin123)
- Configurações básicas do site
- Páginas principais com conteúdo inicial
- Categorias de produtos e produtos de exemplo
- Cotações e previsão do tempo de exemplo

## Manutenção

Para atualizar as cotações e previsão do tempo automaticamente, você pode configurar uma tarefa cron para executar o script `app/scripts/atualizar_cotacoes.php` periodicamente.

## Acesso ao Painel Administrativo

Após a configuração do banco de dados, você pode acessar o painel administrativo em:

- URL: /admin
- Usuário: admin
- Senha: admin123
