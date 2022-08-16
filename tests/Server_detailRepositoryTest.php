<?php

use App\Models\Server_detail;
use App\Repositories\Server_detailRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Server_detailRepositoryTest extends TestCase
{
    use MakeServer_detailTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var Server_detailRepository
     */
    protected $serverDetailRepo;

    protected function setUp(): void
    {
        parent::setUp();
        $this->serverDetailRepo = App::make(Server_detailRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateServer_detail()
    {
        $serverDetail = $this->fakeServer_detailData();
        $createdServer_detail = $this->serverDetailRepo->create($serverDetail);
        $createdServer_detail = $createdServer_detail->toArray();
        $this->assertArrayHasKey('id', $createdServer_detail);
        $this->assertNotNull($createdServer_detail['id'], 'Created Server_detail must have id specified');
        $this->assertNotNull(Server_detail::find($createdServer_detail['id']), 'Server_detail with given id must be in DB');
        $this->assertModelData($serverDetail, $createdServer_detail);
    }

    /**
     * @test read
     */
    public function testReadServer_detail()
    {
        $serverDetail = $this->makeServer_detail();
        $dbServer_detail = $this->serverDetailRepo->find($serverDetail->id);
        $dbServer_detail = $dbServer_detail->toArray();
        $this->assertModelData($serverDetail->toArray(), $dbServer_detail);
    }

    /**
     * @test update
     */
    public function testUpdateServer_detail()
    {
        $serverDetail = $this->makeServer_detail();
        $fakeServer_detail = $this->fakeServer_detailData();
        $updatedServer_detail = $this->serverDetailRepo->update($fakeServer_detail, $serverDetail->id);
        $this->assertModelData($fakeServer_detail, $updatedServer_detail->toArray());
        $dbServer_detail = $this->serverDetailRepo->find($serverDetail->id);
        $this->assertModelData($fakeServer_detail, $dbServer_detail->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteServer_detail()
    {
        $serverDetail = $this->makeServer_detail();
        $resp = $this->serverDetailRepo->delete($serverDetail->id);
        $this->assertTrue($resp);
        $this->assertNull(Server_detail::find($serverDetail->id), 'Server_detail should not exist in DB');
    }
}
