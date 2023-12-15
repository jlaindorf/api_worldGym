<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ExerciseController extends Controller
{
    public function store(Request $request)
    {
        try {

            $data = $request->all();

            $request->validate([
                'description' => 'required|string|max:255',
            ]);

            $userId = Auth::id();

            $existingExercise = Exercise::where('user_id', $userId)
                ->where('description', $data['description'])
                ->first();

            if ($existingExercise) {
                return response()->json(['error' => 'Exercício já cadastrado para o usuário.'], Response::HTTP_CONFLICT);
            }
            $data['user_id'] = $userId;

            $exercise = Exercise::create($data);

            return $exercise;
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function index(Request $request){
        try {
                $userId = $request->user()->id;

                $data = Exercise::where('user_id', $userId)->orderby('description','ASC')->get();
          return  $data;

        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function destroy($id){

         $exercise = Exercise::find($id);
         if(!$exercise) return $this->error('Dado Não encontrado', Response::HTTP_NOT_FOUND);

         $userId = auth()->id();
        if ($exercise->user_id !== $userId) {
            return $this->response('Exercício cadastrado por outro usuário', Response::HTTP_FORBIDDEN);
        }

         $exercise->delete();


        return $this->response('', Response::HTTP_NO_CONTENT);



    }
    }

