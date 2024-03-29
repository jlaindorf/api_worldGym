<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends Controller
{
    public function store(Request $request)
    {
        try {

            $data = $request->all();

            $request->validate([

                'name' => 'string|required|max:255',
                'email' => 'email|required|unique:students,email|max:255',
                'date_birth' => '|required|date_format:Y-m-d',
                'cpf' => 'required|string|size:14|unique:students,cpf|regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/',
                'contact' => 'required|string|max:20',
                'cep' => 'string',
                'state' => 'string',
                'street' => 'string',
                'neighborhood' => 'string',
                'city' => 'string',
                'number' => 'string'
            ]);
            $userId = Auth::id();

            $data['user_id'] = $userId;

            $student = Student::create($data);

            return $student;
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
    public function index(Request $request)
    {
        try {

            $filters = $request->query();
            $students = Student::where('user_id', $request->user()->id)
                ->select(
                    'students.id as student_id',
                    'students.name as student_name',
                    'students.email as student_email',
                    'students.cpf as student_cpf',
                    'students.date_birth as student_date_birth',
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





            return   $students->orderby('name', 'ASC')->get();
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
    public function destroy($id)
    {

        $student = Student::find($id);
        if (!$student) return $this->error('Dado Não encontrado', Response::HTTP_NOT_FOUND);

        $userId = auth()->id();
        if ($student->user_id !== $userId) {
            return $this->response('Aluno cadastrado por outro usuário', Response::HTTP_FORBIDDEN);
        }

        $student->delete();


        return $this->response('', Response::HTTP_NO_CONTENT);
    }

    public function update($id, Request $request)
    {

        try {
            $data = $request->all();
            $request->validate([

                'name' => 'string|max:255',
                'email' => [
                    'email',
                    Rule::unique('students', 'email')->ignore($id),
                    'max:255',
                ],
                'date_birth' => '|date_format:Y-m-d',
                'cpf' => [
                    'string',
                    'size:14',
                    'regex:/^\d{3}\.\d{3}\.\d{3}-\d{2}$/',
                    Rule::unique('students', 'cpf')->ignore($id),
                ],
                'contact' => 'string|max:20',
                'cep' => 'string',
                'state' => 'string',
                'street' => 'string',
                'neighborhood' => 'string',
                'city' => 'string',
                'number' => 'string'
            ]);


            $student = Student::find($id);
            if (!$student) return $this->error('Aluno não encontrado', Response::HTTP_NOT_FOUND);
            $userId = auth()->id();
            if ($student->user_id !== $userId) {
                return $this->response('Aluno cadastrado por outro usuário', Response::HTTP_FORBIDDEN);
            }


            $student->update(array_filter($data));

            return $this->response('Aluno atualizado com sucesso !', Response::HTTP_OK);
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }


    public function show($id)
    {
        try {
            $student = Student::find($id);
            if (!$student) return $this->error('Aluno não encontrado', Response::HTTP_NOT_FOUND);
            return [
                'id' => $student->id,
                'name' => $student->name,
                'email' => $student->email,
                'date_birth' => $student->date_birth,
                'cpf' => $student->cpf,
                'contact' => $student->contact,
                'address' => [
                    'cep' => $student->cep,
                    'street' => $student->street,
                    'state' => $student->state,
                    'neighborhood' => $student->neighborhood,
                    'city' => $student->city,
                    'number' => $student->number,
                ]

            ];
        } catch (\Exception $exception) {
            return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }
}
