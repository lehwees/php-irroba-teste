## Descrição

Este projeto é um sistema de agendamento médico desenvolvido em **Laravel 12**, que permite aos médicos gerenciar seus pacientes e consultas por meio de uma API RESTful autenticada com **Laravel Passport**. A aplicação também conta com interface web usando **Blade Templates**.

---

## Funcionalidades principais

- **Autenticação segura** via OAuth2 com Laravel Passport.
- Cadastro e login de médicos.
- Gerenciamento completo (CRUD) de pacientes vinculados ao médico.
- Gerenciamento completo (CRUD) de agendamentos médicos.
- API RESTful para operações com pacientes e agendamentos.
- Interface web com Blade para interação simples e rápida.
- Suporte a ambiente local via XAMPP.
- Banco de dados MySQL para armazenamento dos dados.

---

## Considerações sobre ambiente e versões

Devido a limitações e incompatibilidades da máquina utilizada para o desenvolvimento, **não foi possível utilizar Docker nem Laravel 8**. Por esse motivo, o projeto foi desenvolvido utilizando:

- **Laravel 12**
- Execução local via XAMPP
- PHP 8.3
- Composer 2.8.9

Essa escolha garante maior compatibilidade com o ambiente disponível e mantém a aplicação atualizada com versões recentes e estáveis.

---

## Tecnologias usadas

- **PHP 8.3**
- **Laravel 12**
- **Composer 2.8.9**
- MySQL
- Laravel Passport (OAuth2)
- Blade Templates
- XAMPP (servidor local)

---

## Requisitos

Antes de começar, você precisa ter instalado em seu ambiente:

- PHP 8.3
- Composer 2.8.9
- MySQL
- XAMPP (servidor local)

---

## Instalação e configuração

### Clone o repositório

```bash
git clone <URL-do-repositório>
cd <nome-do-projeto>

2. Instale as dependências PHP via Composer 2.8.9
bash
composer install

3. Configure o arquivo .env
Copie o arquivo .env.example para .env e ajuste as configurações do banco de dados e do Passport:
bash
cp .env.example .env
Exemplo para conexão MySQL:

env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha


4. Gere a chave da aplicação
bash
php artisan key:generate

5. Execute as migrations
bash
php artisan migrate

6. Instale e configure o Passport
bash
php artisan passport:install

7. Inicialize o servidor local
Com XAMPP: Coloque o projeto dentro da pasta htdocs e acesse via navegador:
bash
http://localhost/PHP%20Irroba%20Teste/agendamento-app/public/api/

📡 Uso da API
Base URL (exemplo local):
perl

http://localhost/PHP%20Irroba%20Teste/agendamento-app/public/api/
Endpoints principais
Método	Rota	Descrição	Autenticação
POST	/register	Registrar médico	Não
POST	/login	Login do médico	Não
GET	    /pacientes	Listar pacientes do médico	Sim
POST	/pacientes	Criar paciente	Sim
PUT  	/pacientes/{id}	Atualizar paciente	Sim
DELETE	/pacientes/{id}	Deletar paciente	Sim
GET	    /agendamentos	Listar agendamentos	Sim
POST	/agendamentos	Criar agendamento	Sim
PUT	    /agendamentos/{id}	Atualizar agendamento	Sim
DELETE	/agendamentos/{id}	Deletar agendamento	Sim

Exemplo de chamada para login (usando cURL):
bash

curl --location --request POST 'http://localhost/PHP%20Irroba%20Teste/agendamento-app/public/api/login' \
--header 'Content-Type: application/json' \
--data-raw '{
    "email": "medico@exemplo.com",
    "password": "suaSenha123"
}'
💡 Considerações importantes
Toda operação que requer autenticação deve enviar o token Bearer no header Authorization.

Pacientes e agendamentos sempre estarão vinculados ao médico autenticado.

O layout da aplicação web é centralizado em resources/views/layouts/app.blade.php para fácil manutenção e consistência visual.

Para desenvolvimento local, recomendo o uso do XAMPP para evitar problemas de ambiente.

Utilize as versões especificadas (PHP 8.3, Laravel 12 e Composer 2.8.9) para garantir compatibilidade e segurança.

Contato

Letícia Machado Lopes

Email: leticia_machadolopes@hotmail.com

LinkedIn: https://www.linkedin.com/in/let%C3%ADcia-machado-16226317a/

