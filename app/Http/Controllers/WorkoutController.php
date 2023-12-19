<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WorkoutController extends Controller
{
    public function store(Request $request)
    {
        try {

            $data = $request->all();

            $request->validate([
                'student_id' => 'integer',
                'exercise_id' => 'integer',
                'repetitions' => 'integer|required',
                'weight' => 'numeric|required',
                'break_time' => 'integer|required',
                'day' => 'required|in:SEGUNDA,TERÇA,QUARTA,QUINTA,SEXTA,SÁBADO,DOMINGO',
                'observations' => 'string|required',
                'time' => 'integer|required'
            ]);

            $sameWorkout = Workout::where([
                'student_id' => $data['student_id'],
                'exercise_id' => $data['exercise_id'],
                'day' => $data['day']
            ])->first();
            if ($sameWorkout) {
                return $this->response('Treino já existente para o aluno', Response::HTTP_CONFLICT);
            }
            $workout = Workout::create($data);

            return $workout;
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
