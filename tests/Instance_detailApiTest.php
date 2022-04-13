<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Instance_detailApiTest extends TestCase
{
    use MakeInstance_detailTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateInstance_detail()
    {
        $instanceDetail = $this->fakeInstance_detailData();
        $this->json('POST', '/api/v1/instanceDetails', $instanceDetail);

        $this->assertApiResponse($instanceDetail);
    }

    /**
     * @test
     */
    public function testReadInstance_detail()
    {
        $instanceDetail = $this->makeInstance_detail();
        $this->json('GET', '/api/v1/instanceDetails/'.$instanceDetail->id);

        $this->assertApiResponse($instanceDetail->toArray());
    }

    /**
     * @test
     */
    public function testUpdateInstance_detail()
    {
        $instanceDetail = $this->makeInstance_detail();
        $editedInstance_detail = $this->fakeInstance_detailData();

        $this->json('PUT', '/api/v1/instanceDetails/'.$instanceDetail->id, $editedInstance_detail);

        $this->assertApiResponse($editedInstance_detail);
    }

    /**
     * @test
     */
    public function testDeleteInstance_detail()
    {
        $instanceDetail = $this->makeInstance_detail();
        $this->json('DELETE', '/api/v1/instanceDetails/'.$instanceDetail->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/instanceDetails/'.$instanceDetail->id);

        $this->assertResponseStatus(404);
    }
}
