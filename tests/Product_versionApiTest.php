<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Product_versionApiTest extends TestCase
{
    use MakeProduct_versionTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateProduct_version()
    {
        $productVersion = $this->fakeProduct_versionData();
        $this->json('POST', '/api/v1/productVersions', $productVersion);

        $this->assertApiResponse($productVersion);
    }

    /**
     * @test
     */
    public function testReadProduct_version()
    {
        $productVersion = $this->makeProduct_version();
        $this->json('GET', '/api/v1/productVersions/'.$productVersion->id);

        $this->assertApiResponse($productVersion->toArray());
    }

    /**
     * @test
     */
    public function testUpdateProduct_version()
    {
        $productVersion = $this->makeProduct_version();
        $editedProduct_version = $this->fakeProduct_versionData();

        $this->json('PUT', '/api/v1/productVersions/'.$productVersion->id, $editedProduct_version);

        $this->assertApiResponse($editedProduct_version);
    }

    /**
     * @test
     */
    public function testDeleteProduct_version()
    {
        $productVersion = $this->makeProduct_version();
        $this->json('DELETE', '/api/v1/productVersions/'.$productVersion->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/productVersions/'.$productVersion->id);

        $this->assertResponseStatus(404);
    }
}
