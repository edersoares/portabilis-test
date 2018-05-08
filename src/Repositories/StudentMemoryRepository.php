<?php

namespace App\Repositories;

use App\Model\StudentModel;
use App\Repositories\Contract\StudentRepository;
use Illuminate\Database\Eloquent\Collection;

class StudentMemoryRepository implements StudentRepository
{
    /**
     * Cache collection.
     *
     * @var Collection
     */
    protected $cache;

    /**
     * Eloquent repository.
     *
     * @var StudentRepository
     */
    protected $repository;

    /**
     * StudentMemoryRepository constructor.
     *
     * @param StudentRepository $repository
     */
    public function __construct(StudentRepository $repository)
    {
        $this->clear();
        $this->repository = $repository;
    }

    /**
     * Clear the cache.
     *
     * @return void
     */
    private function clear()
    {
        $this->cache = new Collection();
    }

    /**
     * @inheritdoc
     */
    public function findByCpf($cpf, $ignoreId = null)
    {
        return $this->repository->findByCpf($cpf, $ignoreId);
    }

    /**
     * @inheritdoc
     */
    public function all()
    {
        if ($this->cache->isEmpty()) {
            $this->cache = $this->repository->all();
        }

        return $this->cache;
    }

    /**
     * @inheritdoc
     */
    public function find($id)
    {
        $student = $this->cache->first(function ($student) use ($id) {
            return $student->id == $id;
        });

        if (empty($student)) {
            $student = $this->repository->find($id);
        }

        return $student;
    }

    /**
     * @inheritdoc
     */
    public function store(StudentModel $student)
    {
        $this->repository->store($student);

        $this->clear();

        return $student;
    }

    /**
     * @inheritdoc
     */
    public function remove(StudentModel $student)
    {
        $this->repository->remove($student);

        $this->clear();

        return $student;
    }
}