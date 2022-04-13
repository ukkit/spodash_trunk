<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProduct_versionRequest;
use App\Http\Requests\UpdateProduct_versionRequest;
use App\Repositories\Product_versionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use DB;
use App\Authorizable;

class Product_versionController extends AppBaseController
{
    use Authorizable;
    /** @var  Product_versionRepository */
    private $productVersionRepository;

    public function __construct(Product_versionRepository $productVersionRepo)
    {
        $this->productVersionRepository = $productVersionRepo;
    }

    /**
     * Display a listing of the Product_version.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->productVersionRepository->pushCriteria(new RequestCriteria($request));
        // $productVersions = $this->productVersionRepository->paginate(15);
        $productVersions = $this->productVersionRepository->all();

        return view('product_versions.index')
            ->with('productVersions', $productVersions);
    }

    /**
     * Show the form for creating a new Product_version.
     *
     * @return Response
     */
    public function create()
    {
        return view('product_versions.create')->with('this_is_edit', false);
    }

    /**
     * Store a newly created Product_version in storage.
     *
     * @param CreateProduct_versionRequest $request
     *
     * @return Response
     */
    public function store(CreateProduct_versionRequest $request)
    {
        $input = $request->all();

        $strip_pvn = preg_replace("/[^0-9]/","",$input['product_ver_number']);
        $strip_pbn = preg_replace("/[^0-9]/","",$input['product_build_numer']);
        $pv_id = $strip_pvn.$strip_pbn;

        // Generating pv_id by merging numbers of product_Ver_number and product_build_number
        $input['pv_id'] = $pv_id;

        // dd($pv_id);

        $productVersion = $this->productVersionRepository->create($input);

        Flash::success('Product Version saved successfully.');

        return redirect(route('productVersions.index'));
    }

    /**
     * Display the specified Product_version.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $productVersion = $this->productVersionRepository->findWithoutFail($id);

        if (empty($productVersion)) {
            Flash::error('Product Version not found');

            return redirect(route('productVersions.index'));
        }

        return view('product_versions.show')->with('productVersion', $productVersion);
    }

    /**
     * Show the form for editing the specified Product_version.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $productVersion = $this->productVersionRepository->findWithoutFail($id);

        if (empty($productVersion)) {
            Flash::error('Product Version not found');

            return redirect(route('productVersions.index'));
        }

        $rec_arr['record'] = DB::table('product_versions')->where('id', $id)->get()->first();

        return view('product_versions.edit')
        ->with('productVersion', $productVersion)
        ->with($rec_arr)
        ->with('this_is_edit', true);
    }

    /**
     * Update the specified Product_version in storage.
     *
     * @param  int              $id
     * @param UpdateProduct_versionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProduct_versionRequest $request)
    {
        $productVersion = $this->productVersionRepository->findWithoutFail($id);

        if (empty($productVersion)) {
            Flash::error('Product Version not found');

            return redirect(route('productVersions.index'));
        }

        $productVersion = $this->productVersionRepository->update($request->all(), $id);

        Flash::success('Product Version updated successfully.');

        return redirect(route('productVersions.index'));
    }

    /**
     * Remove the specified Product_version from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        // $productVersion = $this->productVersionRepository->findWithoutFail($id);

        // if (empty($productVersion)) {
        //     Flash::error('Product Version not found');

        //     return redirect(route('productVersions.index'));
        // }

        // $this->productVersionRepository->delete($id);

        Flash::warning('Deletion not supported.');

        return redirect(route('productVersions.index'));
    }
}
