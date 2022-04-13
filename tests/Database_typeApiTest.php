<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Database_typeApiTest extends TestCase
{
    use MakeDatabase_typeTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateDatabase_type()
    {
        $databaseType = $this->fakeDatabase_typeData();
        $this->json('POST', '/api/v1/databaseTypes', $databaseType);

        $this->assertApiResponse($databaseType);
    }

    /**
     * @test
     */
    public function testReadDatabase_type()
    {
        $databaseType = $this->makeDatabase_type();
        $this->json('GET', '/api/v1/databaseTypes/'.$databaseType->id);

        $this->assertApiResponse($databaseType->toArray());
    }

    /**
     * @test
     */
    public function testUpdateDatabase_type()
    {
        $databaseType = $this->makeDatabase_type();
        $editedDatabase_type = $this->fakeDatabase_typeData();

        $this->json('PUT', '/api/v1/databaseTypes/'.$databaseType->id, $editedDatabase_type);

        $this->assertApiResponse($editedDatabase_type);
    }

    /**
     * @test
     */
    public function testDeleteDatabase_type()
    {
        $databaseType = $this->makeDatabase_type();
        $this->json('DELETE', '/api/v1/databaseTypes/'.$databaseType->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/databaseTypes/'.$databaseType->id);

        $this->assertResponseStatus(404);
    }
}
