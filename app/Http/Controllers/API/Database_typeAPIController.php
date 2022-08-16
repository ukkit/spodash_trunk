<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateDatabase_typeAPIRequest;
use App\Http\Requests\API\UpdateDatabase_typeAPIRequest;
use App\Models\Database_type;
use App\Repositories\Database_typeRepository;
use Illuminate\Http\Request;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class Database_typeController
 */
class Database_typeAPIController extends AppBaseController
{
    /** @var Database_typeRepository */
    private $databaseTypeRepository;

    public function __construct(Database_typeRepository $databaseTypeRepo)
    {
        $this->databaseTypeRepository = $databaseTypeRepo;
    }

    /**
     * @param  Request  $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/databaseTypes",
     *      summary="Get a listing of the Database_types.",
     *      tags={"Database_type"},
     *      description="Get all Database_types",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Database_type")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->databaseTypeRepository->pushCriteria(new RequestCriteria($request));
        $this->databaseTypeRepository->pushCriteria(new LimitOffsetCriteria($request));
        // $databaseTypes = $this->databaseTypeRepository->all();
        $databaseTypes = Database_type::select('id', 'db_short_name', 'db_long_name', 'db_patchset')->get();

        return $this->sendResponse($databaseTypes->toArray(), 'Database Types retrieved successfully');
    }

    /**
     * @param  CreateDatabase_typeAPIRequest  $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/databaseTypes",
     *      summary="Store a newly created Database_type in storage",
     *      tags={"Database_type"},
     *      description="Store Database_type",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Database_type that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Database_type")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Database_type"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateDatabase_typeAPIRequest $request)
    {
        $input = $request->all();

        if (empty($input['db_short_name'])) {
            return $this->sendError('DB Short Name cannot be blank');
        } elseif (empty($input['db_long_name'])) {
            return $this->sendError('DB Long Name cannot be blank');
        }

        $databaseTypes = $this->databaseTypeRepository->create($input);

        return $this->sendResponse($databaseTypes->toArray(), 'Database Type saved successfully');
    }

    /**
     * @param  int  $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/databaseTypes/{id}",
     *      summary="Display the specified Database_type",
     *      tags={"Database_type"},
     *      description="Get Database_type",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Database_type",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Database_type"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Database_type $databaseType */
        $databaseType = $this->databaseTypeRepository->findWithoutFail($id);

        if (empty($databaseType)) {
            return $this->sendError('Database Type not found');
        } else {
            $databaseType = Database_type::select('id', 'db_short_name', 'db_long_name', 'db_patchset')->where('id', $id)->get();
        }

        return $this->sendResponse($databaseType->toArray(), 'Database Type retrieved successfully');
    }

    /**
     * @param  int  $id
     * @param  UpdateDatabase_typeAPIRequest  $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/databaseTypes/{id}",
     *      summary="Update the specified Database_type in storage",
     *      tags={"Database_type"},
     *      description="Update Database_type",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Database_type",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Database_type that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Database_type")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Database_type"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateDatabase_typeAPIRequest $request)
    {
        $input = $request->all();

        /** @var Database_type $databaseType */
        // $databaseType = $this->databaseTypeRepository->findWithoutFail($id);
        $databaseType = Database_type::select('id', 'db_short_name', 'db_long_name', 'db_patchset')->where('id', $id)->get();

        if (empty($databaseType)) {
            return $this->sendError('Database Type not found');
        } elseif (empty($input['db_short_name'])) {
            return $this->sendError('DB Short Name cannot be blank');
        } elseif (empty($input['db_long_name'])) {
            return $this->sendError('DB Long Name cannot be blank');
        }

        $databaseType = $this->databaseTypeRepository->update($input, $id);

        return $this->sendResponse($databaseType->toArray(), 'Database_type updated successfully');
    }

    /**
     * @param  int  $id
     * @return Response
     *
     * @SWG\Delete(
     *      summary="Deletion not supported through API"
     * )
     */
    public function destroy($id)
    {
        /** @var Database_type $databaseType */
        // $databaseType = $this->databaseTypeRepository->findWithoutFail($id);

        // if (empty($databaseType)) {
        //     return $this->sendError('Database Type not found');
        // }

        // $databaseType->delete();

        return $this->sendError('Deletion not supported through API');
    }
}
