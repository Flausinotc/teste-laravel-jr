# Projeto - Cadastro de Produtos via API do Mercado Livre

Este é um projeto de exemplo desenvolvido em **Laravel**, que permite o cadastro de produtos diretamente no Mercado Livre utilizando a API oficial. O projeto inclui um formulário para o cadastro de produtos, integração com a API do Mercado Livre, e o armazenamento de produtos em um banco de dados MySQL.

## Tecnologias Utilizadas

- **PHP 8.x**
- **Laravel 8.x**
- **MySQL**
- **GuzzleHTTP** para requisições HTTP
- **Bootstrap** (para front-end simples)

## Pré-requisitos

Antes de rodar o projeto, certifique-se de ter as seguintes ferramentas instaladas:

- PHP 8.x ou superior
- Composer
- MySQL
- Git

## Configuração do Projeto

### Passo 1: Clonando o Repositório

Clone o repositório para a sua máquina local:

```bash
git clone https://github.com/seu-usuario/nome-do-repositorio.git
cd nome-do-repositorio
Passo 2: Instalando as Dependências
Instale as dependências do Laravel utilizando o Composer:

bash
Copy
composer install
Passo 3: Configurando o Banco de Dados
Crie um banco de dados MySQL e configure as credenciais no arquivo .env. Exemplo:

plaintext
Copy
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha
Passo 4: Configurando as Credenciais do Mercado Livre
Crie uma aplicação no Mercado Livre Developer.
No painel da sua aplicação, obtenha o client_id, client_secret e redirect_uri.
No arquivo .env, adicione as variáveis:
plaintext
Copy
MERCADO_LIVRE_CLIENT_ID=seu_client_id
MERCADO_LIVRE_CLIENT_SECRET=seu_client_secret
MERCADO_LIVRE_REDIRECT_URI=http://localhost:8000/auth/mercado-livre/callback
Passo 5: Rodando as Migrações
Execute as migrações para criar as tabelas no banco de dados:

bash
Copy
php artisan migrate
Passo 6: Rodando o Projeto
Agora você pode rodar o servidor do Laravel:

bash
Copy
php artisan serve
Isso iniciará o servidor local em http://localhost:8000. Abra este endereço no navegador.

Passo 7: Autenticação no Mercado Livre
Acesse http://localhost:8000/auth/mercado-livre para realizar a autenticação com o Mercado Livre.
Após a autenticação, o token será salvo na sessão e você será redirecionado para a página de cadastro de produtos.
Passo 8: Cadastrando Produtos
Após a autenticação, você pode cadastrar produtos via formulário, que será enviado diretamente para a API do Mercado Livre e armazenado no banco de dados local.

Funcionalidades Implementadas
Cadastro de produtos no Mercado Livre via API.
Armazenamento de produtos no banco de dados MySQL.
Autenticação OAuth2 com o Mercado Livre.
Upload de imagens junto com o cadastro do produto.

Bônus (Opcional)
Validação de dados no formulário.
Interface simples com CSS básico.
SQL para criação do BD junto ao arquivo.
