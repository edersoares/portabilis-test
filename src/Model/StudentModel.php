<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StudentModel extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'students';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'cpf', 'rg', 'phone', 'birthday'
    ];
}