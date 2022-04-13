<?php

use App\Models\Instance_detail;
use App\Repositories\Instance_detailRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Instance_detailRepositoryTest extends TestCase
{
    use MakeInstance_detailTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var Instance_detailRepository
     */
    protected $instanceDetailRepo;

    public function setUp()
    {
        parent::setUp();
        $this->instanceDetailRepo = App::make(Instance_detailRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateInstance_detail()
    {
        $instanceDetail = $this->fakeInstance_detailData();
        $createdInstance_detail = $this->instanceDetailRepo->create($instanceDetail);
        $createdInstance_detail = $createdInstance_detail->toArray();
        $this->assertArrayHasKey('id', $createdInstance_detail);
        $this->assertNotNull($createdInstance_detail['id'], 'Created Instance_detail must have id specified');
        $this->assertNotNull(Instance_detail::find($createdInstance_detail['id']), 'Instance_detail with given id must be in DB');
        $this->assertModelData($instanceDetail, $createdInstance_detail);
    }

    /**
     * @test read
     */
    public function testReadInstance_detail()
    {
        $instanceDetail = $this->makeInstance_detail();
        $dbInstance_detail = $this->instanceDetailRepo->find($instanceDetail->id);
        $dbInstance_detail = $dbInstance_detail->toArray();
        $this->assertModelData($instanceDetail->toArray(), $dbInstance_detail);
    }

    /**
     * @test update
     */
    public function testUpdateInstance_detail()
    {
        $instanceDetail = $this->makeInstance_detail();
        $fakeInstance_detail = $this->fakeInstance_detailData();
        $updatedInstance_detail = $this->instanceDetailRepo->update($fakeInstance_detail, $instanceDetail->id);
        $this->assertModelData($fakeInstance_detail, $updatedInstance_detail->toArray());
        $dbInstance_detail = $this->instanceDetailRepo->find($instanceDetail->id);
        $this->assertModelData($fakeInstance_detail, $dbInstance_detail->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteInstance_detail()
    {
        $instanceDetail = $this->makeInstance_detail();
        $resp = $this->instanceDetailRepo->delete($instanceDetail->id);
        $this->assertTrue($resp);
        $this->assertNull(Instance_detail::find($instanceDetail->id), 'Instance_detail should not exist in DB');
    }
}
