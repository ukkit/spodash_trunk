<?php

use App\Models\Os_type;
use App\Repositories\Os_typeRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Os_typeRepositoryTest extends TestCase
{
    use MakeOs_typeTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var Os_typeRepository
     */
    protected $osTypeRepo;

    public function setUp()
    {
        parent::setUp();
        $this->osTypeRepo = App::make(Os_typeRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateOs_type()
    {
        $osType = $this->fakeOs_typeData();
        $createdOs_type = $this->osTypeRepo->create($osType);
        $createdOs_type = $createdOs_type->toArray();
        $this->assertArrayHasKey('id', $createdOs_type);
        $this->assertNotNull($createdOs_type['id'], 'Created Os_type must have id specified');
        $this->assertNotNull(Os_type::find($createdOs_type['id']), 'Os_type with given id must be in DB');
        $this->assertModelData($osType, $createdOs_type);
    }

    /**
     * @test read
     */
    public function testReadOs_type()
    {
        $osType = $this->makeOs_type();
        $dbOs_type = $this->osTypeRepo->find($osType->id);
        $dbOs_type = $dbOs_type->toArray();
        $this->assertModelData($osType->toArray(), $dbOs_type);
    }

    /**
     * @test update
     */
    public function testUpdateOs_type()
    {
        $osType = $this->makeOs_type();
        $fakeOs_type = $this->fakeOs_typeData();
        $updatedOs_type = $this->osTypeRepo->update($fakeOs_type, $osType->id);
        $this->assertModelData($fakeOs_type, $updatedOs_type->toArray());
        $dbOs_type = $this->osTypeRepo->find($osType->id);
        $this->assertModelData($fakeOs_type, $dbOs_type->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteOs_type()
    {
        $osType = $this->makeOs_type();
        $resp = $this->osTypeRepo->delete($osType->id);
        $this->assertTrue($resp);
        $this->assertNull(Os_type::find($osType->id), 'Os_type should not exist in DB');
    }
}
