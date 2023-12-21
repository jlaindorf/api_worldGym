<!DOCTYPE html>
<html lang="pt-br">

<head>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #000;
            margin: 0;
            padding: 0;
        }

        header {
            position: relative;
            background-color: rgb(225, 226, 0);
            padding: 20px;
        }

        .logo {
            font-family: sans-serif;
            text-align: left;
            width: 90%;
            color: #000;
            font-weight: bold;
        }

        main {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: rgb(225, 226, 0);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .welcome {
            height: 20%;
            width: 100%;
            background-color: rgb(225, 226, 0);
            text-align: center;
            padding: 20px;
            box-sizing: border-box;
            position: relative;
        }

        h1 {
            font-size: 42px;
            font-weight: bold;
            margin-bottom: 20px;
            position: absolute;
            top: 25%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: rgb(225, 226, 0);
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 1); /* Adicionado sombreado */
        }

        img {
            width: 100%;
            display: block;
            margin-top: 20px;
            z-index: -1;
        }

        h2,
        h3,
        p {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">WorldGym</div>
    </header>
    <main>
        <div class="welcome">
            <h1>Bem-vindo à WORLDGYM {{$name}}!</h1>
            <img src="https://img.freepik.com/fotos-gratis/halteres-no-chao-de-uma-academia-ai-generative_123827-23743.jpg"
                alt="academia vazia">
            <h2>Agora você faz parte da nossa rede e tem acesso a todos os benefícios do seu plano {{$planName}}</h2>
            <h3>Esperamos que faça bom uso e aproveite ao máximo nossa academia!</h3>
            <p>Lembre-se que seu limite de cadastro de alunos é {{$userLimit > 0 ? $userLimit: 'ILIMITADO'}}!</p>
        </div>
    </main>
</body>

</html>
