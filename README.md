<img src="https://github.com/jlaindorf/files/blob/main/halteres-no-chao-de-uma-academia-ai-generative.jpg" width="600" alt="Logo">


# API WORLDGYM

A WorldGym, uma empresa altamente respeitada no ramo de academias, expressou satisfação em relação ao protótipo do projeto front-end desenvolvido no módulo 1. Diante desse êxito, a empresa agora manifestou o interesse em dar continuidade ao projeto, solicitando a criação do back-end da aplicação, disponibilizando de uma API REST completa para que os usuários tenham controle dos seus treinos e alunos .

## Tecnologias Utilizadas
Utilizei para a criação do projeto a linguagem PHP , utilizando o framework Laravel com banco de dados Postgresql e Dbeaver para conexao com o banco de dados . 
<div>
<img src="https://github.com/jlaindorf/files/blob/main/download.png" width="60" alt="laravel">
<img src="https://github.com/jlaindorf/files/blob/main/docker.png" width="60" alt="docker">
<img src="https://github.com/jlaindorf/files/blob/main/dbeaver.jpg" width="60" alt="dbeaver">
</div>

## Ferramentas e plugins 

COMPOSER| DOM PDF | BLADE | DOCKER | MAILTRAP

## Relacionamento do Bancos De Dados

<img src="https://github.com/jlaindorf/files/blob/main/api_academia%20-%20public.png" width="800" alt="relacionamentos db">


## Como executar o projeto 
* Clonar para sua maquina. 
* Abrir terminal 
  * Composer install (para baixar as dependências)
* no arquivo .ENV configurar seu banco de dados
* Abrir Terminal
  * php artisan serve
## Rotas da Aplicação 
| Método | Rota             | Controlador/Método  | Middleware |
|--------|------------------|---------------------|------------|
| POST   | /users           | UserController@store | -          |
| POST   | /login           | AuthController@store | -          |

| Método | Rota                             | Controlador/Método              | Middleware                   |
|--------|----------------------------------|---------------------------------|------------------------------|
| GET    | /dashboard                       | DashboardController@index       | auth:sanctum                 |
| POST   | /exercises                       | ExerciseController@store        | auth:sanctum                 |
| GET    | /exercises                       | ExerciseController@index        | auth:sanctum                 |
| DELETE | /exercises/{id}                  | ExerciseController@destroy      | auth:sanctum                 |
| GET    | /students/export                 | WorkoutController@showWorkout   | auth:sanctum                 |
| POST   | /students                        | StudentController@store         | auth:sanctum, CheckStudentLimit |
| GET    | /students                        | StudentController@index         | auth:sanctum                 |
| DELETE | /students/{id}                   | StudentController@destroy       | auth:sanctum                 |
| PUT    | /students/{id}                   | StudentController@update        | auth:sanctum                 |
| GET    | /students/{id}                   | StudentController@show          | auth:sanctum                 |
| POST   | /workouts                        | WorkoutController@store         | auth:sanctum                 |
| GET    | /students/{id}/workouts          | WorkoutController@index         | auth:sanctum                 |

## Tratamento de exeções e responses utilizados
| HTTP Status Code | Descrição                                         | Mensagem de Erro                               |
|-------------------|---------------------------------------------------|-----------------------------------------------|
| 400               | Bad Request - Requisição com dados inválidos      | { "error": "Dados da requisição inválidos" }  |
| 401               | Unauthorized - Login inválido                     | { "error": "Credenciais de login inválidas" }|
| 409               | Conflict - Exercício já cadastrado para o usuário  | { "error": "Exercício já cadastrado" }        |
| 403               | Forbidden - ID do exercício não pertence ao usuário| { "error": "Acesso proibido ao exercício" }   |
| 404               | Not Found - ID do exercício não encontrado        | { "error": "Exercício não encontrado" }       |
| 204               | No Content - Sucesso sem conteúdo                 | Sucesso nos deletes                           |
| 201               | Created - Requisição criou com sucesso            | Cadastros                                     |
| 200               | OK - Requisição bem-sucedida                      | Pesquisas e listagens                         |


# Api em Funcionamento:

* Cadastro de usuário 

<img src="https://github.com/jlaindorf/files/blob/main/cadastro%20de%20usuario.png" width="600" alt="cadastro-usuario">

* Email de confirmação de novo usuário 

<img src="https://github.com/jlaindorf/files/blob/main/template-email-usuario.png" width="600" alt="email-usuario">

* Cadastro de aluno 

<img src="https://github.com/jlaindorf/files/blob/main/cadastro-aluno.png" width="600" alt="cadastro-aluno">

* Cadastro de exercício 

<img src="https://github.com/jlaindorf/files/blob/main/cadastro-exercicio.png" width="600" alt="cadastro-exercicio">

* Dashboard 

<img src="https://github.com/jlaindorf/files/blob/main/dashboard.png" width="600" alt="dashboard">

* Cadastro de treino

<img src="https://github.com/jlaindorf/files/blob/main/cadastro-treino.png" width="600" alt="cadastro-treino">

* Listagem de treino

<img src="https://github.com/jlaindorf/files/blob/main/listagem-treino.png" width="600" alt="listagem-treino">

* Consulta de um aluno

<img src="https://github.com/jlaindorf/files/blob/main/consulta-aluno.png" width="600" alt="consulta-um-aluno">

* Ficha de treino do aluno 

<img src="https://github.com/jlaindorf/files/blob/main/ficha%20de%20treino.png" width="600" alt="ficha-treino">

## Melhorias que poderiam ser efetuadas no projeto

- Middlewares para os acessos de treinos, alunos e exercícios
- Criar uma rota para os exerícios já executados 
- Opção para apagar treino e usuário

 

<img src = "https://avatars.githubusercontent.com/u/125938958?v=4" width="100" src="perfil-github">

✨Julio L. Laindorf✨


[<img src="https://github.githubassets.com/assets/GitHub-Mark-ea2971cee799.png" alt="GitHub" width="50">](https://github.com/jlaindorf)
[<img src="https://static-00.iconduck.com/assets.00/linkedin-icon-2048x2048-ya5g47j2.png" alt="linkedin" width="50">](https://www.linkedin.com/in/laindorfjulio/)



