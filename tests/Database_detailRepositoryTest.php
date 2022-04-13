<?php

use App\Models\Database_detail;
use App\Repositories\Database_detailRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Database_detailRepositoryTest extends TestCase
{
    use MakeDatabase_detailTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var Database_detailRepository
     */
    protected $databaseDetailRepo;

    public function setUp()
    {
        parent::setUp();
        $this->databaseDetailRepo = App::make(Database_detailRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateDatabase_detail()
    {
        $databaseDetail = $this->fakeDatabase_detailData();
        $createdDatabase_detail = $this->databaseDetailRepo->create($databaseDetail);
        $createdDatabase_detail = $createdDatabase_detail->toArray();
        $this->assertArrayHasKey('id', $createdDatabase_detail);
        $this->assertNotNull($createdDatabase_detail['id'], 'Created Database_detail must have id specified');
        $this->assertNotNull(Database_detail::find($createdDatabase_detail['id']), 'Database_detail with given id must be in DB');
        $this->assertModelData($databaseDetail, $createdDatabase_detail);
    }

    /**
     * @test read
     */
    public function testReadDatabase_detail()
    {
        $databaseDetail = $this->makeDatabase_detail();
        $dbDatabase_detail = $this->databaseDetailRepo->find($databaseDetail->id);
        $dbDatabase_detail = $dbDatabase_detail->toArray();
        $this->assertModelData($databaseDetail->toArray(), $dbDatabase_detail);
    }

    /**
     * @test update
     */
    public function testUpdateDatabase_detail()
    {
        $databaseDetail = $this->makeDatabase_detail();
        $fakeDatabase_detail = $this->fakeDatabase_detailData();
        $updatedDatabase_detail = $this->databaseDetailRepo->update($fakeDatabase_detail, $databaseDetail->id);
        $this->assertModelData($fakeDatabase_detail, $updatedDatabase_detail->toArray());
        $dbDatabase_detail = $this->databaseDetailRepo->find($databaseDetail->id);
        $this->assertModelData($fakeDatabase_detail, $dbDatabase_detail->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteDatabase_detail()
    {
        $databaseDetail = $this->makeDatabase_detail();
        $resp = $this->databaseDetailRepo->delete($databaseDetail->id);
        $this->assertTrue($resp);
        $this->assertNull(Database_detail::find($databaseDetail->id), 'Database_detail should not exist in DB');
    }
}
