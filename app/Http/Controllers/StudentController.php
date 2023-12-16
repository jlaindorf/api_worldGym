<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends Controller
{
    public function store(Request $request){
        try{

            $data = $request->all();

            $request->validate([

                'name' => 'string|required|max:255',
                'email'=> 'email|required|unique:students,email|max:255',
                'date_birth' => '|required|date_format:Y-m-d',
                'cpf' => 'required|string|max:14|unique:users,cpf|',
                'contact' => 'required|string|max:10',
                'cep' => 'string',
                'street' => 'string',
                'neighborhood' => 'string',
                'city' => 'string',
                'number' => 'string'
            ]);
            $userId = Auth::id();

            $data['user_id'] = $userId;

            $student = Student::create($data);

            return $student;



        }catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
