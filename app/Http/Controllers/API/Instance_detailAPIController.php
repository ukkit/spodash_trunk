<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateInstance_detailAPIRequest;
use App\Http\Requests\API\UpdateInstance_detailAPIRequest;
use App\Models\Instance_detail;
use App\Repositories\Instance_detailRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use DB;
use App\Models\Server_detail;
use App\Models\Product_name;
use App\Models\Product_version;
use App\Models\Database_detail;

/**
 * Class Instance_detailController
 * @package App\Http\Controllers\API
 */

class Instance_detailAPIController extends AppBaseController
{
    /** @var  Instance_detailRepository */
    private $instanceDetailRepository;

    public function __construct(Instance_detailRepository $instanceDetailRepo)
    {
        $this->instanceDetailRepository = $instanceDetailRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/instanceDetails",
     *      summary="Get a listing of the Instance_details.",
     *      tags={"Instance_detail"},
     *      description="Get all Instance_details",
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
     *                  @SWG\Items(ref="#/definitions/Instance_detail")
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
        $this->instanceDetailRepository->pushCriteria(new RequestCriteria($request));
        $this->instanceDetailRepository->pushCriteria(new LimitOffsetCriteria($request));
        // $instanceDetails = $this->instanceDetailRepository->all();

        $instanceDetails = Instance_detail::select('id','server_details_id','product_names_id','product_versions_id','database_details_id','instance_name','instance_tomcat_port','instance_login','instance_pwd','instance_install_path','instance_shared_dir','jenkins_url')->get();

        return $this->sendResponse($instanceDetails->toArray(), 'Instance Details retrieved successfully');
    }

    /**
     * @param CreateInstance_detailAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/instanceDetails",
     *      summary="Store a newly created Instance_detail in storage",
     *      tags={"Instance_detail"},
     *      description="Store Instance_detail",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Instance_detail that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Instance_detail")
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
     *                  ref="#/definitions/Instance_detail"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateInstance_detailAPIRequest $request)
    {
        $input = $request->all();

        if (empty($input['server_details_id'])) {
            return $this->sendError('Server Details ID cannot be blank');
        } elseif (empty($input['product_names_id'])) {
            return $this->sendError('Product Name ID cannot be blank');
        } elseif (empty($input['product_versions_id'])) {
            return $this->sendError('Product Version ID cannot be blank');
        } elseif (empty($input['database_details_id'])) {
            return $this->sendError('Database Detail ID cannot be blank');
        } elseif (empty($input['instance_name'])) {
            return $this->sendError('Instance Name cannot be blank');
        } elseif (empty($input['instance_tomcat_port'])) {
            return $this->sendError('Tomcat Port cannot be blank');
        } elseif (empty($input['instance_login'])) {
            return $this->sendError('Instance Login ID cannot be blank');
        } elseif (empty($input['instance_pwd'])) {
            return $this->sendError('Instance Password cannot be blank');
        } elseif (empty($input['instance_install_path'])) {
            return $this->sendError('Installation Path cannot be blank');
        } elseif (empty($input['instance_shared_dir'])) {
            return $this->sendError('Shared directory path cannot be blank');
        }

        $serverDetail = Server_detail::where('id',$input['server_details_id'])->value('server_name');
        $productName = Product_name::where('id',$input['product_names_id'])->value('product_short_name');
        $productVersion = Product_version::where('id',$input['product_versions_id'])->value('pv_id');
        $dbDetail = Database_detail::where('id',$input['database_details_id'])->value('db_sid');

        if (empty($serverDetail)) {
            return $this->sendError('Server Detail ID '.$input['server_details_id'].' does not exist');
        } elseif (empty($productName)) {
            return $this->sendError('Product Name ID '.$input['product_names_id'].' does not exist');
        } elseif (empty($productVersion)) {
            return $this->sendError('Product Version ID '.$input['product_versions_id'].' does not exist');
        } elseif (empty($dbDetail)) {
            return $this->sendError('Database Detail ID '.$input['database_details_id'].' does not exist');
        }

        $instanceDetails = $this->instanceDetailRepository->create($input);

        return $this->sendResponse($instanceDetails->toArray(), 'Instance Detail saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/instanceDetails/{id}",
     *      summary="Display the specified Instance_detail",
     *      tags={"Instance_detail"},
     *      description="Get Instance_detail",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Instance_detail",
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
     *                  ref="#/definitions/Instance_detail"
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
        /** @var Instance_detail $instanceDetail */
        $instanceDetail = $this->instanceDetailRepository->findWithoutFail($id);

        if (empty($instanceDetail)) {
            return $this->sendError('Instance Detail not found');
        } else {
            $instanceDetail = Instance_detail::select('id','server_details_id','product_names_id','product_versions_id','database_details_id','instance_name','instance_tomcat_port','instance_login','instance_pwd','jenkins_url','instance_install_path','instance_shared_dir','instance_is_auto_upgraded','instance_is_active','instance_show_on_site','show_jenkins_build','instance_owner','instance_note')->where('id',$id)->get();
        }

        return $this->sendResponse($instanceDetail->toArray(), 'Instance Detail retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateInstance_detailAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/instanceDetails/{id}",
     *      summary="Update the specified Instance_detail in storage",
     *      tags={"Instance_detail"},
     *      description="Update Instance_detail",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Instance_detail",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Instance_detail that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Instance_detail")
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
     *                  ref="#/definitions/Instance_detail"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateInstance_detailAPIRequest $request)
    {
        $input = $request->all();


        /** @var Instance_detail $instanceDetail */
        // $instanceDetail = $this->instanceDetailRepository->findWithoutFail($id);
        $instanceDetail = Instance_detail::select('id','server_details_id','product_names_id','product_versions_id','database_details_id','instance_name','instance_tomcat_port','instance_login','instance_pwd','jenkins_url','instance_install_path','instance_shared_dir','instance_is_auto_upgraded','instance_is_active','instance_show_on_site','show_jenkins_build','instance_owner','instance_note')->where('id',$id)->get();

        if (empty($instanceDetail)) {
            return $this->sendError('Instance Detail not found');
        }

        if (isset($input['server_details_id'])) {
            if ((empty($input['server_details_id'])) || (is_null($input['server_details_id'])))  {
                return $this->sendError('Server Details ID cannot be blank or null');
            } else {
                $serverDetail = Server_detail::where('id',$input['server_details_id'])->value('server_name');
                if (empty($serverDetail)) {
                    return $this->sendError('Server Detail ID '.$input['server_details_id'].' does not exist');
                }
            }
        }

        if (isset($input['product_names_id'])) {
            if (empty($input['product_names_id'])) {
                return $this->sendError('Product Name ID cannot be blank');
            } else {
                $productName = Product_name::where('id',$input['product_names_id'])->value('product_short_name');
                if (empty($productName)) {
                    return $this->sendError('Product Name ID '.$input['product_names_id'].' does not exist');
                }
            }
        }

        if (isset($input['product_versions_id'])) {
            if (empty($input['product_versions_id'])) {
                return $this->sendError('Product Version ID cannot be blank');
            } else {
                $productVersion = Product_version::where('id',$input['product_versions_id'])->value('pv_id');
                if (empty($productVersion)) {
                    return $this->sendError('Product Version ID '.$input['product_versions_id'].' does not exist');
                }
            }
        }

        if (isset($input['database_details_id'])) {
            if (empty($input['database_details_id'])) {
                return $this->sendError('Database Detail ID cannot be blank');
            } else {
                $dbDetail = Database_detail::where('id',$input['database_details_id'])->value('db_sid');
                if (empty($dbDetail)) {
                    return $this->sendError('Database Detail ID '.$input['database_details_id'].' does not exist');
                }
            }
        }

        $instanceDetail = $this->instanceDetailRepository->update($input, $id);

        return $this->sendResponse($instanceDetail->toArray(), 'Instance_detail updated successfully');
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
