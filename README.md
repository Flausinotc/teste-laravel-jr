<<<<<<< HEAD
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
=======
# Projeto - Cadastro de Produtos via API do Mercado Livre

Este é um projeto de exemplo desenvolvido em Laravel, que permite o cadastro de produtos diretamente no Mercado Livre utilizando a API oficial. O projeto inclui um formulário para o cadastro de produtos, integração com a API do Mercado Livre, e o armazenamento de produtos em um banco de dados MySQL.

## Tecnologias Utilizadas

- PHP 8.x
- Laravel 8.x
- MySQL
- GuzzleHTTP para requisições HTTP
- Bootstrap (para front-end simples)

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
git clone "URL_DO_REPOSITORIO"
cd "NOME_DA_PASTA"
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
MERCADO_LIVRE_REDIRECT_URI=https://seu-endereco.ngrok.io/auth/mercado-livre/callback
Observação: No campo MERCADO_LIVRE_REDIRECT_URI, substitua https://seu-endereco.ngrok.io pelo seu URL gerado pelo ngrok (por exemplo, https://abc123.ngrok.io).

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

Passo 7: Usando o ngrok para URL HTTPS
O Mercado Livre exige que o redirect_uri utilize um URL HTTPS. Para gerar um URL com HTTPS, use o ngrok. Inicie o servidor Laravel e depois execute o seguinte comando no terminal:

bash
Copy
ngrok http 8000
O ngrok fornecerá um URL HTTPS, como https://seu-endereco.ngrok.io. Atualize esse URL no seu arquivo .env para o Mercado Livre reconhecer a URL correta durante o processo de autenticação.

Passo 8: Autenticação no Mercado Livre
Acesse https://localhost:8000/auth/mercado-livre para realizar a autenticação com o Mercado Livre. Após a autenticação, o token será salvo na sessão e você será redirecionado para a página de cadastro de produtos.

Passo 9: Cadastrando Produtos
Após a autenticação, você pode cadastrar produtos via formulário, que será enviado diretamente para a API do Mercado Livre e armazenado no banco de dados local.

Funcionalidades Implementadas
Cadastro de produtos no Mercado Livre via API.
Armazenamento de produtos no banco de dados MySQL.
Autenticação OAuth2 com o Mercado Livre.
Upload de imagens junto com o cadastro do produto.
Bônus (Opcional)
Validação de dados no formulário.
Interface simples com CSS básico.
SQL para criação do banco de dados junto ao arquivo.
>>>>>>> 4dd66fee168e6cc6a129498b5fdf5db502cc0395
