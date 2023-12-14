<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExerciseController extends Controller
{
    public function store(Request $request){
        try {

            $data = $request->all();

            $request->validate([
                'description' => 'required|string|max:255',
                'user_id' => 'required',
            ]);
            $existingExercise = Exercise::where('user_id', $data['user_id'])
                ->where('description', $data['description'])
                ->first();

                if($existingExercise){
                    return response()->json(['error' => 'Exercício já cadastrado para o usuário.'], Response::HTTP_CONFLICT);
                }

            $exercise = Exercise::create($data);

            return $exercise;
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
       }


