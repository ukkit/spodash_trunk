<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Database_detailApiTest extends TestCase
{
    use MakeDatabase_detailTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateDatabase_detail()
    {
        $databaseDetail = $this->fakeDatabase_detailData();
        $this->json('POST', '/api/v1/databaseDetails', $databaseDetail);

        $this->assertApiResponse($databaseDetail);
    }

    /**
     * @test
     */
    public function testReadDatabase_detail()
    {
        $databaseDetail = $this->makeDatabase_detail();
        $this->json('GET', '/api/v1/databaseDetails/'.$databaseDetail->id);

        $this->assertApiResponse($databaseDetail->toArray());
    }

    /**
     * @test
     */
    public function testUpdateDatabase_detail()
    {
        $databaseDetail = $this->makeDatabase_detail();
        $editedDatabase_detail = $this->fakeDatabase_detailData();

        $this->json('PUT', '/api/v1/databaseDetails/'.$databaseDetail->id, $editedDatabase_detail);

        $this->assertApiResponse($editedDatabase_detail);
    }

    /**
     * @test
     */
    public function testDeleteDatabase_detail()
    {
        $databaseDetail = $this->makeDatabase_detail();
        $this->json('DELETE', '/api/v1/databaseDetails/'.$databaseDetail->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/databaseDetails/'.$databaseDetail->id);

        $this->assertResponseStatus(404);
    }
}
