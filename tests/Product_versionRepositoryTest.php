<?php

use App\Models\Product_version;
use App\Repositories\Product_versionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Product_versionRepositoryTest extends TestCase
{
    use MakeProduct_versionTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var Product_versionRepository
     */
    protected $productVersionRepo;

    public function setUp()
    {
        parent::setUp();
        $this->productVersionRepo = App::make(Product_versionRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateProduct_version()
    {
        $productVersion = $this->fakeProduct_versionData();
        $createdProduct_version = $this->productVersionRepo->create($productVersion);
        $createdProduct_version = $createdProduct_version->toArray();
        $this->assertArrayHasKey('id', $createdProduct_version);
        $this->assertNotNull($createdProduct_version['id'], 'Created Product_version must have id specified');
        $this->assertNotNull(Product_version::find($createdProduct_version['id']), 'Product_version with given id must be in DB');
        $this->assertModelData($productVersion, $createdProduct_version);
    }

    /**
     * @test read
     */
    public function testReadProduct_version()
    {
        $productVersion = $this->makeProduct_version();
        $dbProduct_version = $this->productVersionRepo->find($productVersion->id);
        $dbProduct_version = $dbProduct_version->toArray();
        $this->assertModelData($productVersion->toArray(), $dbProduct_version);
    }

    /**
     * @test update
     */
    public function testUpdateProduct_version()
    {
        $productVersion = $this->makeProduct_version();
        $fakeProduct_version = $this->fakeProduct_versionData();
        $updatedProduct_version = $this->productVersionRepo->update($fakeProduct_version, $productVersion->id);
        $this->assertModelData($fakeProduct_version, $updatedProduct_version->toArray());
        $dbProduct_version = $this->productVersionRepo->find($productVersion->id);
        $this->assertModelData($fakeProduct_version, $dbProduct_version->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteProduct_version()
    {
        $productVersion = $this->makeProduct_version();
        $resp = $this->productVersionRepo->delete($productVersion->id);
        $this->assertTrue($resp);
        $this->assertNull(Product_version::find($productVersion->id), 'Product_version should not exist in DB');
    }
}
