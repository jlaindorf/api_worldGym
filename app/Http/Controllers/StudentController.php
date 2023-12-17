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
    public function index(Request $request){
        try {

            $filters = $request->query();
            $students =Student::where('user_id', $request->user()->id)
            ->select(
                'students.id as student_id',
                'students.name as student_name',
                'students.email as student_email',
                'students.cpf as student_cpf',
                'students.contact as student_contact',
                'students.cep as student_cep',
                'students.street as student_street',
                'students.state as student_state',
                'students.neighborhood as student_neighborhood ',
                'students.city as student_city',
                'students.number as student_number',

            );
            if ($request->has('name') && !empty($filters['name'])) {
                $students->where('name', 'ilike', '%' . $filters['name'] . '%');
            }
            if ($request->has('cpf') && !empty($filters['cpf'])) {
                $students->where('cpf', 'ilike', '%' . $filters['cpf'] . '%');
            }
            if ($request->has('email') && !empty($filters['email'])) {
                $students->where('email', 'ilike', '%' . $filters['email'] . '%');
            }





            return   $students->orderby('name','ASC')->get();

        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
