<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Workout;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
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
                'observations' => 'text',
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

    public function index($id)
    {
        try {
            $student = Student::find($id);

            $workouts = Workout::where('student_id', $student->id)
                ->orderBy('created_at', 'ASC')
                ->with(['exercise' => function ($query) {
                    $query->select('id', 'description');
                }])->get();

            $workoutsByDay = [];

            $weekDays = ['SEGUNDA', 'TERÇA', 'QUARTA', 'QUINTA', 'SEXTA', 'SÁBADO', 'DOMINGO'];

            foreach ($weekDays as $day) {
                $workoutsByDay[$day] = $workouts->where('day', $day)->isEmpty() ? [] : $workouts->where('day', $day)->all();
            }

            return [
                'student_id' => $student->id,
                'student_name' => $student->name,
                'workouts' => $workoutsByDay,
            ];
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function showWorkout(Request $request)
    {
        $studentId = $request->input('id');
        $student = Student::find($studentId);

        if (!$student) return $this->error('Aluno Não encontrado', Response::HTTP_NOT_FOUND);

        $workouts = Workout::where('student_id', $student->id)
            ->orderBy('created_at', 'ASC')
            ->with(['exercise' => function ($query) {
                $query->select('id', 'description');
            }])->get();

        $workoutsByDay = [];

        $weekDays = ['SEGUNDA', 'TERÇA', 'QUARTA', 'QUINTA', 'SEXTA', 'SÁBADO', 'DOMINGO'];

        foreach ($weekDays as $day) {
            $workoutsByDay[$day] = $workouts->where('day', $day)->isEmpty() ? [] : $workouts->where('day', $day)->all();
        }

        $pdf =  Pdf::loadView('pdfs.showWorkout', [

            'name' => $student->name,
            'workouts' => $workoutsByDay

        ]);


        return $pdf->stream('showWorkout');
    }
}
