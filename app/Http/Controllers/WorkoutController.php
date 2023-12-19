<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WorkoutController extends Controller
{
    public function store(Request $request){
        try{
           $data = $request->all();
            $request->validate([
               'student_id' => 'integer',
               'exercise_id' => 'integer',
               'repetitions' => 'integer|required',
               'weight' => 'float|required',
               'break_time' => 'integer|required',
               'day' => 'required|in:SEGUNDA,TERÇA,QUARTA,QUINTA,SEXTA,SÁBADO,DOMINGO',
               'observations' => 'string|required',
               'time' => 'integer|required'
            ]);

          $workout = Workout::create($data);

          return $workout;


        }catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
