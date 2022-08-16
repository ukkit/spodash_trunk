<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\API\CreateProduct_versionAPIRequest;
use App\Http\Requests\API\UpdateProduct_versionAPIRequest;
use App\Models\Product_version;
use App\Repositories\Product_versionRepository;
use Illuminate\Http\Request;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class Product_versionController
 */
class Product_versionAPIController extends AppBaseController
{
    /** @var Product_versionRepository */
    private $productVersionRepository;

    public function __construct(Product_versionRepository $productVersionRepo)
    {
        $this->productVersionRepository = $productVersionRepo;
    }

    /**
     * @param  Request  $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/productVersions",
     *      summary="Get a listing of the Product_versions.",
     *      tags={"Product_version"},
     *      description="Get all Product_versions",
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
     *                  @SWG\Items(ref="#/definitions/Product_version")
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
        $this->productVersionRepository->pushCriteria(new RequestCriteria($request));
        $this->productVersionRepository->pushCriteria(new LimitOffsetCriteria($request));
        // $productVersions = $this->productVersionRepository->all();
        $productVersions = Product_version::select('id', 'product_ver_number', 'product_build_numer', 'pv_id')->get();

        return $this->sendResponse($productVersions->toArray(), 'Product Versions retrieved successfully');
    }

    /**
     * @param  CreateProduct_versionAPIRequest  $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/productVersions",
     *      summary="Store a newly created Product_version in storage",
     *      tags={"Product_version"},
     *      description="Store Product_version",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Product_version that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Product_version")
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
     *                  ref="#/definitions/Product_version"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateProduct_versionAPIRequest $request)
    {
        $input = $request->all();

        // $input = $request->all();
        if (empty($input['product_ver_number'])) {
            return $this->sendError('1. Product Version number cannot be blank');
        } elseif (empty($input['product_build_numer'])) {
            return $this->sendError('2. Product Build number cannot be blank');
        }

        $strip_pvn = preg_replace('/[^0-9]/', '', $input['product_ver_number']);
        $strip_pbn = preg_replace('/[^0-9]/', '', $input['product_build_numer']);
        $pv_id = $strip_pvn.$strip_pbn;

        $input['pv_id'] = $pv_id;

        $productVersions = $this->productVersionRepository->create($input);

        return $this->sendResponse($productVersions->toArray(), 'Product Version saved successfully');
    }

    /**
     * @param  int  $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/productVersions/{id}",
     *      summary="Display the specified Product_version",
     *      tags={"Product_version"},
     *      description="Get Product_version",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Product_version",
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
     *                  ref="#/definitions/Product_version"
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
        /** @var Product_version $productVersion */
        $productVersion = $this->productVersionRepository->findWithoutFail($id);

        if (empty($productVersion)) {
            return $this->sendError('Product Version not found');
        } else {
            $productVersion = Product_version::select('id', 'product_ver_number', 'product_build_numer', 'pv_id')->where('id', $id)->get();
        }

        return $this->sendResponse($productVersion->toArray(), 'Product Version retrieved successfully');
    }

    /**
     * @param  int  $id
     * @param  UpdateProduct_versionAPIRequest  $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/productVersions/{id}",
     *      summary="Update the specified Product_version in storage",
     *      tags={"Product_version"},
     *      description="Update Product_version",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Product_version",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Product_version that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Product_version")
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
     *                  ref="#/definitions/Product_version"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateProduct_versionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Product_version $productVersion */
        $productVersion = $this->productVersionRepository->findWithoutFail($id);

        if (empty($productVersion)) {
            return $this->sendError('Product Version not found');
        }

        if (isset($input['product_ver_number'])) {
            if (empty($input['product_ver_number'])) {
                return $this->sendError('Product Version number cannot be blank');
            } else {
                $strip_pvn = preg_replace('/[^0-9]/', '', $input['product_ver_number']);
            }
        } else {
            $strip_pvn = preg_replace('/[^0-9]/', '', $productVersion['product_ver_number']);
        }

        if (isset($input['product_build_numer'])) {
            if (empty($input['product_build_numer'])) {
                return $this->sendError('Product Build number cannot be blank');
            } else {
                $strip_pbn = preg_replace('/[^0-9]/', '', $input['product_build_numer']);
            }
        } else {
            $strip_pbn = preg_replace('/[^0-9]/', '', $productVersion['product_build_numer']);
        }

        // if (empty($productVersion['product_ver_number'])) {
        //     return $this->sendError('Product Version number cannot be blank');
        // } elseif (empty($productVersion['product_build_numer'])) {
        //     return $this->sendError('Product Build number cannot be blank');
        // }

        // $strip_pvn = preg_replace("/[^0-9]/","",$productVersion['product_ver_number']);
        // $strip_pbn = preg_replace("/[^0-9]/","",$productVersion['product_build_numer']);
        $pv_id = $strip_pvn.$strip_pbn;
        $input['pv_id'] = $pv_id;

        $productVersion = $this->productVersionRepository->update($input, $id);

        return $this->sendResponse($productVersion->toArray(), 'Product_version updated successfully');
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
        /** @var Product_version $productVersion */
        // $productVersion = $this->productVersionRepository->findWithoutFail($id);

        // if (empty($productVersion)) {
        //     return $this->sendError('Product Version not found');
        // }

        // $productVersion->delete();

        // return $this->sendResponse($id, 'Product Version deleted successfully');
        return $this->sendError('Deletion not supported through API');
    }
}
