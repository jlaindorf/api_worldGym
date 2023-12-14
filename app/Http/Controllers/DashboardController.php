<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request){

      $registered_students =   Student::where('user_id',$request->user()->id)->count();

      return $registered_students;
    }
}
