<?php

namespace App\Http\Middleware;

use App\Models\Plan;
use App\Models\Student;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\HttpResponses;

class CheckStudentLimit
{
    use HttpResponses;

    public function handle(Request $request, Closure $next): Response
    {
        $userId = $request->user()->id;

        $user = User::find($userId);
        $plan = Plan::find($user->plan_id);


        if ($plan->limit === null) {
            return $next($request);
        }

        $count = Student::where('user_id', $userId)->count();

        if ($count >= $plan->limit) {
            return $this->error("Limite de alunos cadastrados atingido ($count de {$plan->limit})", Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }

}
