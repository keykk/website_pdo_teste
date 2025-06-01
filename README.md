# Estrutura do Projeto

O projeto segue o padrão de arquitetura MVC (Model-View-Controller) com orientação a objetos, organizado da seguinte forma:

project/
├── app/
│   ├── controllers/      # Controladores das páginas
│   ├── models/           # Modelos para acesso a dados
│   ├── views/            # Views/templates das páginas
|   |   ├── admin/            # Arquivos do painel administrativo
│   ├── components/       # Componentes reutilizáveis
│   ├── config/           # Arquivos de configuração
│   ├── public/           # Arquivos públicos (CSS, JS, imagens)
│   └── scripts/          # Scripts de utilidade
└── index.php             # Ponto de entrada da aplicação


## Instruções de Instalação

1. Clone ou extraia os arquivos do projeto para o diretório do servidor web
2. Configure o banco de dados no arquivo `app/config/database.php`
3. Importe o arquivo SQL de estrutura do banco de dados (fornecido separadamente)
4. Certifique-se de que as permissões de escrita estejam habilitadas para os diretórios:
   - `app/public/uploads/`
   - `app/public/images/`
5. Acesse o site através do navegador

## Acesso ao Painel Administrativo

- **URL:** `/admin`
- **Usuário:** `admin`
- **Senha:** `admin123`

## Alteração de Estilos

Os estilos personalizados estão localizados em:

- `app/public/css/style.css` (Site público)
- `app/public/css/admin.css` (Painel administrativo)

## Adição de Novas Funcionalidades

Para adicionar novas funcionalidades, siga o padrão MVC implementado, criando os controladores, modelos e views necessários.

