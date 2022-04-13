<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateServer_detailAPIRequest;
use App\Http\Requests\API\UpdateServer_detailAPIRequest;
use App\Models\Server_detail;
use App\Repositories\Server_detailRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use DB;
use App\Models\Os_type;
use App\Models\Server_use;
use App\Models\Database_type;

/**
 * Class Server_detailController
 * @package App\Http\Controllers\API
 */

class Server_detailAPIController extends AppBaseController
{
    /** @var  Server_detailRepository */
    private $serverDetailRepository;

    public function __construct(Server_detailRepository $serverDetailRepo)
    {
        $this->serverDetailRepository = $serverDetailRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/serverDetails",
     *      summary="Get a listing of the Server_details.",
     *      tags={"Server_detail"},
     *      description="Get all Server_details",
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
     *                  @SWG\Items(ref="#/definitions/Server_detail")
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
        $this->serverDetailRepository->pushCriteria(new RequestCriteria($request));
        $this->serverDetailRepository->pushCriteria(new LimitOffsetCriteria($request));

        // $serverDetails = $this->serverDetailRepository->all();

        $serverDetails = Server_detail::select('id','os_types_id','database_types_id','server_uses_id','server_name','server_ip','server_class','server_ram_gb','server_hdd_gb','server_cpu_cores', 'server_user','server_password','admin_user','admin_password','server_owner','server_location','server_note')->get();

        // if(empty($serverDetails)) {
        //     return $this->sendError('Server Detail not found');
        // }

        return $this->sendResponse($serverDetails->toArray(), 'Server Details retrieved successfully');
    }

    /**
     * @param CreateServer_detailAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/serverDetails",
     *      summary="Store a newly created Server_detail in storage",
     *      tags={"Server_detail"},
     *      description="Store Server_detail",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Server_detail that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Server_detail")
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
     *                  ref="#/definitions/Server_detail"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateServer_detailAPIRequest $request)
    {
        $input = $request->all();

        // dd($$input['os_types_id']);

        if (empty($input['os_types_id'])) {
            return $this->sendError('OS Type ID cannot be blank');
        } elseif (empty($input['database_types_id'])) {
            return $this->sendError('Database Type ID cannot be blank');
        } elseif (empty($input['server_uses_id'])) {
            return $this->sendError('Server Use ID cannot be blank');
        } elseif (empty($input['server_name'])) {
            return $this->sendError('Server Name cannot be blank');
        } elseif (empty($input['server_ip'])) {
            return $this->sendError('Server IP Address cannot be blank');
        } elseif (empty($input['server_class'])) {
            return $this->sendError('Server Class cannot be blank');
        } elseif (empty($input['server_ram_gb'])) {
            return $this->sendError('Server RAM cannot be blank');
        } elseif (empty($input['server_hdd_gb'])) {
            return $this->sendError('Server HDD cannot be blank');
        } elseif (empty($input['server_cpu_cores'])) {
            return $this->sendError('Server CPU Cores cannot be blank');
        } elseif (empty($input['server_user'])) {
            return $this->sendError('Server Users cannot be blank');
        } elseif (empty($input['server_password'])) {
            return $this->sendError('Server Password cannot be blank');
        } elseif (empty($input['admin_user'])) {
            return $this->sendError('Admin Users cannot be blank');
        } elseif (empty($input['admin_password'])) {
            return $this->sendError('Admin Password cannot be blank');
        }

        $osType = Os_type::where('id',$input['os_types_id'])->value('os_short_name');
        $dbType = Database_type::where('id',$input['database_types_id'])->value('db_short_name');
        $serverUse = Server_use::where('id',$input['server_uses_id'])->value('use_short_name');

        if (empty($osType)) {
            return $this->sendError('OS Type ID '.$input['os_types_id'].' does not exist');
        } elseif (empty($dbType)) {
            return $this->sendError('Database Type ID '.$input['database_types_id'].' does not exist');
        } elseif (empty($serverUse)) {
            return $this->sendError('Server Use ID '.$input['server_uses_id'].' does not exist');
        }

        $serverDetails = $this->serverDetailRepository->create($input);

        return $this->sendResponse($serverDetails->toArray(), 'Server Detail saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/serverDetails/{id}",
     *      summary="Display the specified Server_detail",
     *      tags={"Server_detail"},
     *      description="Get Server_detail",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Server_detail",
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
     *                  ref="#/definitions/Server_detail"
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
        /** @var Server_detail $serverDetail */
        $serverDetail = $this->serverDetailRepository->findWithoutFail($id);

        if (empty($serverDetail)) {
            return $this->sendError('Server Detail not found');
        } else {
            $serverDetail = Server_detail::select('id','os_types_id','database_types_id','server_uses_id','server_name','server_ip','server_class','server_ram_gb','server_hdd_gb','server_cpu_cores','server_user','server_password','admin_user','admin_password','server_owner','server_location','server_note')->where('id',$id)->get();
        }

        return $this->sendResponse($serverDetail->toArray(), 'Server Detail retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateServer_detailAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/serverDetails/{id}",
     *      summary="Update the specified Server_detail in storage",
     *      tags={"Server_detail"},
     *      description="Update Server_detail",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Server_detail",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Server_detail that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Server_detail")
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
     *                  ref="#/definitions/Server_detail"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateServer_detailAPIRequest $request)
    {
        $input = $request->all();

        if (isset($input['os_types_id'])) {
            if (empty($input['os_types_id'])) {
                return $this->sendError('OS Type ID cannot be blank');
            } else {
                $osType = Os_type::where('id',$input['os_types_id'])->value('os_short_name');
                if (empty($osType)) {
                    return $this->sendError('OS Type ID '.$input['os_types_id'].' does not exist');
                }
            }
        }

        if (isset($input['dbType'])) {
            if (empty($input['dbType'])) {
                return $this->sendError('Database Type ID cannot be blank');
            } else {
                $dbType = Database_type::where('id',$input['database_types_id'])->value('db_short_name');
                if (empty($dbType)) {
                    return $this->sendError('Database Type ID '.$input['database_types_id'].' does not exist');
                }
            }
        }

        if (isset($input['server_uses_id'])) {
            if (empty($input['server_uses_id'])) {
                return $this->sendError('Server Use ID cannot be blank');
            } else {
                $serverUse = Server_use::where('id',$input['server_uses_id'])->value('use_short_name');
                if (empty($serverUse)) {
                    return $this->sendError('Server Use ID '.$input['server_uses_id'].' does not exist');
                }
            }
        }

        /** @var Server_detail $serverDetail */
        // $serverDetail = $this->serverDetailRepository->findWithoutFail($id);
        $serverDetail = Server_detail::select('id','os_types_id','database_types_id','server_uses_id','server_name','server_ip','server_class','server_ram_gb','server_hdd_gb','server_cpu_cores','server_user','server_password','admin_user','admin_password','server_owner','server_location','server_note')->where('id',$id)->get();

        if (empty($serverDetail)) {
            return $this->sendError('Server Detail not found');
        }

        $serverDetail = $this->serverDetailRepository->update($input, $id);

        return $this->sendResponse($serverDetail->toArray(), 'Server_detail updated successfully');
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

        return $this->sendError('Deletion not supported through API');
    }
}
