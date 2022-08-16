<?php

use App\Models\Database_type;
use App\Repositories\Database_typeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Database_typeRepositoryTest extends TestCase
{
    use MakeDatabase_typeTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var Database_typeRepository
     */
    protected $databaseTypeRepo;

    protected function setUp(): void
    {
        parent::setUp();
        $this->databaseTypeRepo = App::make(Database_typeRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateDatabase_type()
    {
        $databaseType = $this->fakeDatabase_typeData();
        $createdDatabase_type = $this->databaseTypeRepo->create($databaseType);
        $createdDatabase_type = $createdDatabase_type->toArray();
        $this->assertArrayHasKey('id', $createdDatabase_type);
        $this->assertNotNull($createdDatabase_type['id'], 'Created Database_type must have id specified');
        $this->assertNotNull(Database_type::find($createdDatabase_type['id']), 'Database_type with given id must be in DB');
        $this->assertModelData($databaseType, $createdDatabase_type);
    }

    /**
     * @test read
     */
    public function testReadDatabase_type()
    {
        $databaseType = $this->makeDatabase_type();
        $dbDatabase_type = $this->databaseTypeRepo->find($databaseType->id);
        $dbDatabase_type = $dbDatabase_type->toArray();
        $this->assertModelData($databaseType->toArray(), $dbDatabase_type);
    }

    /**
     * @test update
     */
    public function testUpdateDatabase_type()
    {
        $databaseType = $this->makeDatabase_type();
        $fakeDatabase_type = $this->fakeDatabase_typeData();
        $updatedDatabase_type = $this->databaseTypeRepo->update($fakeDatabase_type, $databaseType->id);
        $this->assertModelData($fakeDatabase_type, $updatedDatabase_type->toArray());
        $dbDatabase_type = $this->databaseTypeRepo->find($databaseType->id);
        $this->assertModelData($fakeDatabase_type, $dbDatabase_type->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteDatabase_type()
    {
        $databaseType = $this->makeDatabase_type();
        $resp = $this->databaseTypeRepo->delete($databaseType->id);
        $this->assertTrue($resp);
        $this->assertNull(Database_type::find($databaseType->id), 'Database_type should not exist in DB');
    }
}
