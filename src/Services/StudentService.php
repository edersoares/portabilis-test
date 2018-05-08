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
     * Return if there is error.
     *
     * @param array    $data
     * @param int|null $ignoreId
     *
     * @return string
     */
    public function validate(array $data, $ignoreId = null)
    {
        if (empty($data['name'])) {
            return 'O nome deve ser preenchido';
        }

        if (strlen($data['name']) < 3) {
            return 'O nome deve conter mais que 3 caracteres';
        }

        if (strlen($data['name']) > 50) {
            return 'O nome deve conter menos que 50 caracteres';
        }

        if (empty($data['cpf'])) {
            return 'O CPF deve ser preenchido';
        }

        if (strlen($data['cpf']) < 11 || strlen($data['cpf']) > 11) {
            return 'O CPF deve conter 11 caracteres';
        }

        if ($this->cpfIsAvailable($data['cpf'], $ignoreId)) {
            return 'O CPF já está cadastrado para outro estudante';
        }

        if (empty($data['rg'])) {
            return 'O RG deve ser preenchido.';
        }

        if (strlen($data['rg']) < 6) {
            return 'O RG deve conter mais que 6 caracteres';
        }

        if (strlen($data['rg']) > 14) {
            return 'O RG deve conter menos que 14 caracteres';
        }

        if (empty($data['phone'])) {
            return 'O telefone deve ser preenchido';
        }

        if (strlen($data['phone']) < 8) {
            return 'O telefone deve conter mais que 8 caracteres';
        }

        if (strlen($data['phone']) > 13) {
            return 'O telefone deve conter menos que 13 caracteres';
        }

        if (empty($data['birthday'])) {
            return 'A data de nascimento deve ser preenchida';
        }

        if (false === date_create_from_format('d/m/Y', $data['birthday'])) {
            return 'A data de nascimento precisa ser válida';
        }
    }

    public function cpfIsAvailable($cpf, $ignoreId = null)
    {
        $student = $this->repository->findByCpf($cpf);

        if ($student && $student->id != $ignoreId) {
            return true;
        }

        return false;
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