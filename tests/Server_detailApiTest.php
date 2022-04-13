<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Server_detailApiTest extends TestCase
{
    use MakeServer_detailTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateServer_detail()
    {
        $serverDetail = $this->fakeServer_detailData();
        $this->json('POST', '/api/v1/serverDetails', $serverDetail);

        $this->assertApiResponse($serverDetail);
    }

    /**
     * @test
     */
    public function testReadServer_detail()
    {
        $serverDetail = $this->makeServer_detail();
        $this->json('GET', '/api/v1/serverDetails/'.$serverDetail->id);

        $this->assertApiResponse($serverDetail->toArray());
    }

    /**
     * @test
     */
    public function testUpdateServer_detail()
    {
        $serverDetail = $this->makeServer_detail();
        $editedServer_detail = $this->fakeServer_detailData();

        $this->json('PUT', '/api/v1/serverDetails/'.$serverDetail->id, $editedServer_detail);

        $this->assertApiResponse($editedServer_detail);
    }

    /**
     * @test
     */
    public function testDeleteServer_detail()
    {
        $serverDetail = $this->makeServer_detail();
        $this->json('DELETE', '/api/v1/serverDetails/'.$serverDetail->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/serverDetails/'.$serverDetail->id);

        $this->assertResponseStatus(404);
    }
}
