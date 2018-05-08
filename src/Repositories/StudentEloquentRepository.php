<?php

namespace App\Repositories;

use App\Model\StudentModel;
use App\Repositories\Contract\StudentRepository;

class StudentEloquentRepository implements StudentRepository
{
    /**
     * @inheritdoc
     */
    public function findByCpf($cpf, $ignoreId = null)
    {
        $query = StudentModel::query()->where('cpf', $cpf);

        if ($ignoreId) {
            $query->where('id', '<>', $ignoreId);
        }

        return $query->first();
    }

    /**
     * @inheritdoc
     */
    public function all()
    {
        return StudentModel::all();
    }

    /**
     * @inheritdoc
     */
    public function find($id)
    {
        return StudentModel::find($id);
    }

    /**
     * @inheritdoc
     *
     * @throws \Throwable
     */
    public function store(StudentModel $student)
    {
        $student->saveOrFail();

        return $student;
    }

    /**
     * @inheritdoc
     *
     * @throws \Exception
     */
    public function remove(StudentModel $student)
    {
        $student->delete();

        return $student;
    }
}