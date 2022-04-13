<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Os_typeApiTest extends TestCase
{
    use MakeOs_typeTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateOs_type()
    {
        $osType = $this->fakeOs_typeData();
        $this->json('POST', '/api/v1/osTypes', $osType);

        $this->assertApiResponse($osType);
    }

    /**
     * @test
     */
    public function testReadOs_type()
    {
        $osType = $this->makeOs_type();
        $this->json('GET', '/api/v1/osTypes/'.$osType->id);

        $this->assertApiResponse($osType->toArray());
    }

    /**
     * @test
     */
    public function testUpdateOs_type()
    {
        $osType = $this->makeOs_type();
        $editedOs_type = $this->fakeOs_typeData();

        $this->json('PUT', '/api/v1/osTypes/'.$osType->id, $editedOs_type);

        $this->assertApiResponse($editedOs_type);
    }

    /**
     * @test
     */
    public function testDeleteOs_type()
    {
        $osType = $this->makeOs_type();
        $this->json('DELETE', '/api/v1/osTypes/'.$osType->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/osTypes/'.$osType->id);

        $this->assertResponseStatus(404);
    }
}
