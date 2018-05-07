<?php

namespace App\Repositories\Contract;

use App\Model\StudentModel;
use Illuminate\Database\Eloquent\Collection;

interface StudentRepository
{
    /**
     * Return all students.
     *
     * @return Collection
     */
    public function all();

    /**
     * Return student with ID.
     *
     * @param int $id
     *
     * @return StudentModel
     */
    public function find($id);

    /**
     * Store student.
     *
     * @param StudentModel $student
     *
     * @return StudentModel
     */
    public function store(StudentModel $student);

    /**
     * Remove student.
     *
     * @param StudentModel $student
     *
     * @return StudentModel
     */
    public function remove(StudentModel $student);
}