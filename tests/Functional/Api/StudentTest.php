<?php

namespace Tests\Functional\Api;

use Tests\Functional\BaseTestCase;

class StudentTest extends BaseTestCase
{
    /**
     * Test that the index route returns a rendered response containing the text 'SlimFramework' but not a greeting
     */
    public function testGetIndex()
    {
        $response = $this->runApp('GET', '/api/students');

        $this->assertEquals(200, $response->getStatusCode());
    }
}