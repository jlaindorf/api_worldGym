<html>

<style>

    .logo{
        text-align: left;
        width: 90%;
        color:blue;
    }
    body {
        font-family: sans-serif;
    }

    .name {
        width: 80%;
        margin: 0 auto;
        text-align: center;
    }

    .day {
        font-size: 14px;
        color: rgba(245, 245, 245);
        background-color: black;
    }

    .list {
        font-size: 12px;
        padding-top: 10px;
    }
    img {
            width: 80px;
            position: absolute;
            top: 0;
            right: 0;
            margin-right: 68%;
            z-index: -1;
        }
</style>

<head>
    <img  src="https://i.pinimg.com/originals/42/9d/63/429d631659a11a9eb666b103d811470a.jpg" alt="barra de peso" width="100">
    <h1 class="logo">WorldGym</h1>
</head>

<body>



    <h2 class="name">Treinos da semana <br>{{ $name }}</h2>

    @foreach ($workouts as $day => $dayWorkouts)
        <h2 class="day" style="border: 1px solid black;">{{ $day }}</h2>
        @if (empty($dayWorkouts))
            <p class="list">Nenhum treino para este dia.</p>
        @else
        <ul >
                @foreach ($dayWorkouts as $workout)
                    <li class="list" >
                        <strong>Exercício:</strong> {{ $workout['exercise']['description'] }}
                        | <strong>Peso:</strong> {{ $workout['weight'] }} kg
                        | <strong>Tempo:</strong> {{ $workout['time'] }} minutos
                        | <strong>Repetições:</strong> {{ $workout['repetitions'] }}
                        | <strong>Tempo de Descanso:</strong> {{ $workout['break_time'] }} segundos
                        | <strong>Observações:</strong> {{ $workout['observations'] }}
                    </li>
                @endforeach
            </ul>
        @endif
    @endforeach
</body>

</html>
