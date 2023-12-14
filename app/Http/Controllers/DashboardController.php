<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Plan;
use App\Models\Student;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{


    public function index(Request $request)
    {
        try {
            $registeredStudents =   Student::where('user_id', $request->user()->id)->count();

            $registeredExercises = Exercise::where('user_id', $request->user()->id)->count();
            $user = $request->user();
            $planId = $user->plan_id;
            $planName = Plan::find($planId)->description;
            $planLimit = Plan::find($planId)->limit;

            $remainingStudents = ($planName === 'OURO') ? 'ILIMITADO' : ($planLimit - $registeredStudents);



            return [
                'registered_students' => $registeredStudents,
                'registered_exercises' => $registeredExercises,
                'current_user_plan' => $planName,
                'remaining_students' => $remainingStudents,
            ];
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
