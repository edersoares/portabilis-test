<?php
/**
 * Created by PhpStorm.
 * User: evertonmuniz
 * Date: 29/03/18
 * Time: 10:15
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class StudentModel extends Model
{
    protected $table = 'students';

    protected $fillable = [
        'name', 'cpf', 'rg', 'phone', 'birthday'
    ];

}