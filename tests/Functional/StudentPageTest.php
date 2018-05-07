<?php

namespace Tests\Functional;

use App\Model\StudentModel;

class StudentPageTest extends BaseTestCase
{
    use RefreshDatabase;

    public function testGetIndex()
    {
        StudentModel::create([
            'name' => 'Eder Soares',
            'cpf' => '012.345.678-90',
            'rg' => '1234567890',
            'phone' => '11 2233-4455',
            'birthday' => '2018-01-01'
        ]);

        $response = $this->runApp('GET', '/');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertContains('Eder Soares', (string) $response->getBody());
    }
}