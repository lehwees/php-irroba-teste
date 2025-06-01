<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Agendamento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background: #4CAF50;
            color: white;
            padding: 1rem;
            text-align: center;
        }
        main {
            padding: 2rem;
            text-align: center;
        }
        .btn {
            display: inline-block;
            padding: 1rem 2rem;
            margin: 1rem;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #45a049;
        }
        footer {
            background: #ddd;
            text-align: center;
            padding: 1rem;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

<header>
    <h1>Sistema de Agendamento</h1>
</header>

<main>
    <h2>Bem-vindo!</h2>
    <p>Escolha uma opção abaixo:</p>

    <a href="#" class="btn">Agendar Consulta</a>
    <a href="#" class="btn">Ver Consultas</a>
</main>

<footer>
    &copy; {{ date('Y') }} - Projeto Laravel
</footer>

</body>
</html>
