<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name',
        'email','date_birth','cpf',
        'contact','user_id','city','street',
        'neighborhood','number','state',
        'cep',];
}
