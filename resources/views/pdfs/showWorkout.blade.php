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
        color: blue;
    }

    .list {
        font-size: 12px;
    }
</style>

<head></head>

<body>

    <h1 class="logo">WorldGym</h1>
    <h2 class="name">Treinos da semana <br>{{ $name }}</h2>

    @foreach ($workouts as $day => $dayWorkouts)
        <h2 class="day">{{ $day }}</h2>
        @if (empty($dayWorkouts))
            <p class="list">Nenhum treino para este dia.</p>
        @else
            <ul>
                @foreach ($dayWorkouts as $workout)
                    <li class="list">
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
