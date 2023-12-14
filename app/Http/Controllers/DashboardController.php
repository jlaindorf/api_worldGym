<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Plan;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request){

      $registered_students =   Student::where('user_id',$request->user()->id)->count();

      $registered_exercises = Exercise::where('user_id',$request->user()->id)->count();
      $user = $request->user();  // Obtém o usuário autenticado
      $planId = $user->plan_id;
      $planName = $planId ? Plan::find($planId)->description : null;


      return [$registered_students, $registered_exercises, $planName];
  }


    }

