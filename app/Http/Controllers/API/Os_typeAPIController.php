<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateOs_typeAPIRequest;
use App\Http\Requests\API\UpdateOs_typeAPIRequest;
use App\Models\Os_type;
use App\Repositories\Os_typeRepository;
use Illuminate\Http\Request;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class Os_typeController
 */
class Os_typeAPIController extends AppBaseController
{
    /** @var Os_typeRepository */
    private $osTypeRepository;

    public function __construct(Os_typeRepository $osTypeRepo)
    {
        $this->osTypeRepository = $osTypeRepo;
    }

    /**
     * @param  Request  $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/osTypes",
     *      summary="Get a listing of the Os_types.",
     *      tags={"Os_type"},
     *      description="Get all Os_types",
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
     *                  @SWG\Items(ref="#/definitions/Os_type")
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
        $this->osTypeRepository->pushCriteria(new RequestCriteria($request));
        $this->osTypeRepository->pushCriteria(new LimitOffsetCriteria($request));
        // $osTypes = $this->osTypeRepository->all();
        $osTypes = Os_type::select('id', 'os_family', 'os_short_name', 'os_long_name', 'os_patchset')->get();

        return $this->sendResponse($osTypes->toArray(), 'Os Types retrieved successfully');
    }

    /**
     * @param  CreateOs_typeAPIRequest  $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/osTypes",
     *      summary="Store a newly created Os_type in storage",
     *      tags={"Os_type"},
     *      description="Store Os_type",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Os_type that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Os_type")
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
     *                  ref="#/definitions/Os_type"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateOs_typeAPIRequest $request)
    {
        $input = $request->all();

        // dd($input);

        if (empty($input['os_family'])) {
            return $this->sendError('OS Family cannot be blank');
        } elseif (empty($input['os_short_name'])) {
            return $this->sendError('OS Short Name cannot be blank');
        } elseif (empty($input['os_long_name'])) {
            return $this->sendError('OS Long Name cannot be blank');
        }

        $osTypes = $this->osTypeRepository->create($input);

        return $this->sendResponse($osTypes->toArray(), 'Os Type saved successfully');
    }

    /**
     * @param  int  $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/osTypes/{id}",
     *      summary="Display the specified Os_type",
     *      tags={"Os_type"},
     *      description="Get Os_type",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Os_type",
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
     *                  ref="#/definitions/Os_type"
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
        /** @var Os_type $osType */
        $osType = $this->osTypeRepository->findWithoutFail($id);

        if (empty($osType)) {
            return $this->sendError('Os Type not found');
        } else {
            $osType = Os_type::select('id', 'os_family', 'os_short_name', 'os_long_name', 'os_patchset')->where('id', $id)->get();
        }

        return $this->sendResponse($osType->toArray(), 'Os Type retrieved successfully');
    }

    /**
     * @param  int  $id
     * @param  UpdateOs_typeAPIRequest  $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/osTypes/{id}",
     *      summary="Update the specified Os_type in storage",
     *      tags={"Os_type"},
     *      description="Update Os_type",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Os_type",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Os_type that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Os_type")
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
     *                  ref="#/definitions/Os_type"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateOs_typeAPIRequest $request)
    {
        $input = $request->all();

        /** @var Os_type $osType */
        $osType = $this->osTypeRepository->findWithoutFail($id);

        if (empty($osType)) {
            return $this->sendError('Os Type not found');
        }

        if (isset($input['os_family'])) {
            if ((empty($input['os_family'])) || (is_null($input['os_family']))) {
                return $this->sendError('OS Family cannot be blank or null');
            }
        }

        if (isset($input['os_short_name'])) {
            if ((empty($input['os_short_name'])) || (is_null($input['os_short_name']))) {
                return $this->sendError('OS Short Name cannot be blank or null');
            }
        }

        if (isset($input['os_long_name'])) {
            if ((empty($input['os_long_name'])) || (is_null($input['os_long_name']))) {
                return $this->sendError('OS Long Name cannot be blank or null');
            }
        }

        $osType = $this->osTypeRepository->update($input, $id);

        return $this->sendResponse($osType->toArray(), 'Os_type updated successfully');
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
        /** @var Os_type $osType */
        // $osType = $this->osTypeRepository->findWithoutFail($id);

        // if (empty($osType)) {
        //     return $this->sendError('Os Type not found');
        // }

        // $osType->delete();

        // return $this->sendResponse($id, 'Os Type deleted successfully');
        return $this->sendError('Deletion not supported through API');
    }
}
