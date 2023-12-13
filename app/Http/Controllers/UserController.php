<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
   public function store(Request $request){
    try {

        $data = $request->all();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'cpf' => 'required|string|max:14|unique:users,cpf|',
            'plan_id' => 'required',
            'password' => 'required|string|min:8|max:32',
            'date_birth' => '|required|date-format:Y-m-d',
        ]);


        $user = User::create($data);

        return $user;
    } catch (\Exception $exception) {
        return $this->error($exception->getMessage(), Response::HTTP_BAD_REQUEST);
    }
}
   }
