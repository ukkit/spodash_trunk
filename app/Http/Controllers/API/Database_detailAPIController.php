<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateDatabase_detailAPIRequest;
use App\Http\Requests\API\UpdateDatabase_detailAPIRequest;
use App\Models\Database_detail;
use App\Repositories\Database_detailRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Server_detail;
use App\Models\Database_type;
use DB;

/**
 * Class Database_detailController
 * @package App\Http\Controllers\API
 */

class Database_detailAPIController extends AppBaseController
{
    /** @var  Database_detailRepository */
    private $databaseDetailRepository;

    public function __construct(Database_detailRepository $databaseDetailRepo)
    {
        $this->databaseDetailRepository = $databaseDetailRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/databaseDetails",
     *      summary="Get a listing of the Database_details.",
     *      tags={"Database_detail"},
     *      description="Get all Database_details",
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
     *                  @SWG\Items(ref="#/definitions/Database_detail")
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
        $this->databaseDetailRepository->pushCriteria(new RequestCriteria($request));
        $this->databaseDetailRepository->pushCriteria(new LimitOffsetCriteria($request));
        // $databaseDetails = $this->databaseDetailRepository->all();

        $databaseDetails = Database_detail::select('id','server_details_id','database_types_id','db_sid','db_user','db_pass','db_port','db_notes','db_is_active','is_dba')->get();

        return $this->sendResponse($databaseDetails->toArray(), 'Database Details retrieved successfully');
    }

    /**
     * @param CreateDatabase_detailAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/databaseDetails",
     *      summary="Store a newly created Database_detail in storage",
     *      tags={"Database_detail"},
     *      description="Store Database_detail",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Database_detail that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Database_detail")
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
     *                  ref="#/definitions/Database_detail"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateDatabase_detailAPIRequest $request)
    {
        $input = $request->all();


        if (empty($input['server_details_id'])) {
            return $this->sendError('Server Detail ID cannot be blank');
        } elseif (empty($input['database_types_id'])) {
            return $this->sendError('Database Type ID cannot be blank');
        } elseif (empty($input['db_sid'])) {
            return $this->sendError('Database SID cannot be blank');
        } elseif (empty($input['db_user'])) {
            return $this->sendError('Database User Name cannot be blank');
        } elseif (empty($input['db_pass'])) {
            return $this->sendError('Database Password cannot be blank');
        } elseif (empty($input['db_port'])) {
            return $this->sendError('Database Port Number cannot be blank');
        }

        $serverName = Server_detail::where('id',$input['server_details_id'])->value('server_name');
        $dbType = Database_type::where('id',$input['database_types_id'])->value('db_short_name');

        if (empty($serverName)) {
            return $this->sendError('Server Detail ID '.$input['server_details_id'].' does not exist');
        }elseif (empty($dbType)) {
            return $this->sendError('Database Type ID '.$input['database_types_id'].' does not exist');
        }

        $databaseDetails = $this->databaseDetailRepository->create($input);

        return $this->sendResponse($databaseDetails->toArray(), 'Database Detail saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/databaseDetails/{id}",
     *      summary="Display the specified Database_detail",
     *      tags={"Database_detail"},
     *      description="Get Database_detail",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Database_detail",
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
     *                  ref="#/definitions/Database_detail"
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
        /** @var Database_detail $databaseDetail */
        $databaseDetail = $this->databaseDetailRepository->findWithoutFail($id);

        if (empty($databaseDetail)) {
            return $this->sendError('Database Detail not found');
        } else {
            $databaseDetail= Database_detail::select('id','server_details_id','database_types_id','db_sid','db_user','db_pass','db_port','db_notes','db_is_active','is_dba')->where('id',$id)->get();
        }

        return $this->sendResponse($databaseDetail->toArray(), 'Database Detail retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateDatabase_detailAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/databaseDetails/{id}",
     *      summary="Update the specified Database_detail in storage",
     *      tags={"Database_detail"},
     *      description="Update Database_detail",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Database_detail",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Database_detail that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Database_detail")
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
     *                  ref="#/definitions/Database_detail"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateDatabase_detailAPIRequest $request)
    {
        $input = $request->all();
        // dd(array_keys($input));

        if (isset($input['database_types_id'])) {
            if (empty($input['database_types_id'])) {
                return $this->sendError('Database Type ID cannot be blank');
            } else {
                $dbType = Database_type::where('id',$input['database_types_id'])->value('db_short_name');
                if (empty($dbType)) {
                    return $this->sendError('Database Type ID '.$input['database_types_id'].' does not exist');
                }
            }
        }

        if (isset($input['server_details_id'])) {
            if (empty($input['server_details_id'])) {
                return $this->sendError('Server Details ID cannot be blank');
            } else {
                $serverName = Server_detail::where('id',$input['server_details_id'])->value('server_name');
                if (empty($serverName)) {
                    return $this->sendError('Server Detail ID '.$input['server_details_id'].' does not exist');
                }
            }
        }

        /** @var Database_detail $databaseDetail */
        // $databaseDetail = $this->databaseDetailRepository->findWithoutFail($id);
        $databaseDetail= Database_detail::select('id','server_details_id','database_types_id','db_sid','db_user','db_pass','db_port','db_notes','db_is_active','is_dba')->where('id',$id)->get();

        $databaseDetail = $this->databaseDetailRepository->update($input, $id);

        return $this->sendResponse($databaseDetail->toArray(), 'Database_detail updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      summary="Deletion not supported through API"
     * )
     */
    public function destroy($id)
    {
        /** @var Database_detail $databaseDetail */
        // $databaseDetail = $this->databaseDetailRepository->findWithoutFail($id);

        // if (empty($databaseDetail)) {
        //     return $this->sendError('Database Detail not found');
        // }

        // $databaseDetail->delete();

        return $this->sendError('Deletion not supported through API');
    }
}
