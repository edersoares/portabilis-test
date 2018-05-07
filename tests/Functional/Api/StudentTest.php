<?php

namespace Tests\Functional\Api;

use App\Model\StudentModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tests\Functional\BaseTestCase;
use Tests\Functional\RefreshDatabase;

class StudentTest extends BaseTestCase
{
    use RefreshDatabase, DecodeJson;

    /**
     * GET /api/students
     *
     * @return void
     *
     * @throws \Exception
     */
    public function testGetStudents()
    {
        $response = $this->runApp('GET', '/api/students');

        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * POST /api/students
     *
     * @return void
     *
     * @throws \Exception
     */
    public function testPostStudent()
    {
        $student = [
            'name' => 'Eder Soares',
            'cpf' => '012.345.678-90',
            'rg' => '1234567890',
            'phone' => '11 2233-4455',
            'birthday' => '2018-01-01'
        ];

        $response = $this->runApp('POST', '/api/students', $student);

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertArraySubset($student, $this->decodeJsonResponse($response));
    }

    /**
     * GET /api/students/{id}
     *
     * @return void
     *
     * @throws \Exception
     */
    public function testGetStudent()
    {
        $student = StudentModel::create([
            'name' => 'Eder Soares',
            'cpf' => '012.345.678-90',
            'rg' => '1234567890',
            'phone' => '11 2233-4455',
            'birthday' => '2018-01-01'
        ]);

        $response = $this->runApp('GET', '/api/students/' . $student->id);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArraySubset($student->toArray(), $this->decodeJsonResponse($response));
    }

    /**
     * PATCH /api/students/{id}
     *
     * @return void
     *
     * @throws \Exception
     */
    public function testPatchStudent()
    {
        $student = StudentModel::create([
            'name' => 'Eder Soares',
            'cpf' => '012.345.678-90',
            'rg' => '1234567890',
            'phone' => '11 2233-4455',
            'birthday' => '2018-01-01'
        ]);

        $newData = [
            'id' => $student->id,
            'name' => 'Eder',
            'cpf' => '999.888.777-000',
            'rg' => '1122334455',
            'phone' => '12 3456-8900',
            'birthday' => '2019-01-01'
        ];

        $response = $this->runApp('PATCH', '/api/students/' . $student->id, $newData);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArraySubset($newData, $this->decodeJsonResponse($response));
    }

    /**
     * DELETE /api/students/{id}
     *
     * @return void
     *
     * @throws \Exception
     */
    public function testDeleteStudent()
    {
        $this->expectException(ModelNotFoundException::class);

        $student = StudentModel::create([
            'name' => 'Eder Soares',
            'cpf' => '012.345.678-90',
            'rg' => '1234567890',
            'phone' => '11 2233-4455',
            'birthday' => '2018-01-01'
        ]);

        $response = $this->runApp('DELETE', '/api/students/' . $student->id);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArraySubset($student->toArray(), $this->decodeJsonResponse($response));

        StudentModel::findOrFail($student->id);
    }
}