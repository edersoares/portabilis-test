<?php

namespace App\Services;

use App\Model\StudentModel;
use App\Repositories\Contract\StudentRepository;

class StudentService
{
    /**
     * Repository.
     *
     * @var StudentRepository
     */
    protected $repository;

    /**
     * StudentService constructor.
     *
     * @param StudentRepository $repository
     */
    public function __construct(StudentRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Return all students.
     *
     * @return array
     */
    public function all()
    {
        return $this->repository->all()->toArray();
    }

    /**
     * Find student with ID.
     *
     * @param int $id
     *
     * @return array
     */
    public function find($id)
    {
        return $this->repository->find($id)->toArray();
    }

    /**
     * Create and return a student.
     *
     * @param array $data
     *
     * @return array
     */
    public function create(array $data)
    {
        $student = new StudentModel($data);

        $this->repository->store($student);

        return $student->toArray();
    }

    /**
     * Update student with ID.
     *
     * @param int   $id
     * @param array $data
     *
     * @return array
     */
    public function update($id, array $data)
    {
        $student = $this->repository->find($id);

        $student->fill($data);

        $this->repository->store($student);

        return $student->toArray();
    }

    /**
     * Delete student with ID.
     *
     * @param int $id
     *
     * @return array
     */
    public function delete($id)
    {
        $student = $this->repository->find($id);

        $this->repository->remove($student);

        return $student->toArray();
    }
}