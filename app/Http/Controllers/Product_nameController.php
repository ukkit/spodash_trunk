<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\Http\Requests\CreateProduct_nameRequest;
use App\Http\Requests\UpdateProduct_nameRequest;
use App\Repositories\Product_nameRepository;
use DB;
use Flash;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class Product_nameController extends AppBaseController
{
    use Authorizable;

    /** @var Product_nameRepository */
    private $productNameRepository;

    public function __construct(Product_nameRepository $productNameRepo)
    {
        $this->productNameRepository = $productNameRepo;
    }

    /**
     * Display a listing of the Product_name.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->productNameRepository->pushCriteria(new RequestCriteria($request));
        $productNames = $this->productNameRepository->all();

        return view('product_names.index')
            ->with('productNames', $productNames);
    }

    /**
     * Show the form for creating a new Product_name.
     *
     * @return Response
     */
    public function create()
    {
        return view('product_names.create')
        ->with('show_is_active', false)
        ->with('this_is_edit', false);
    }

    /**
     * Store a newly created Product_name in storage.
     *
     * @param  CreateProduct_nameRequest  $request
     * @return Response
     */
    public function store(CreateProduct_nameRequest $request)
    {
        $input = $request->all();

        $productName = $this->productNameRepository->create($input);

        Flash::success('Product Name saved successfully.');

        return redirect(route('productNames.index'));
    }

    /**
     * Display the specified Product_name.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $productName = $this->productNameRepository->findWithoutFail($id);

        if (empty($productName)) {
            Flash::error('Product Name not found');

            return redirect(route('productNames.index'));
        }

        return view('product_names.show')->with('productName', $productName);
    }

    /**
     * Show the form for editing the specified Product_name.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $productName = $this->productNameRepository->findWithoutFail($id);

        if (empty($productName)) {
            Flash::error('Product Name not found');

            return redirect(route('productNames.index'));
        }

        $rec_arr['record'] = DB::table('product_names')->where('id', $id)->get()->first();

        return view('product_names.edit')
        ->with('productName', $productName)
        ->with('show_is_active', true)
        ->with('this_is_edit', true)
        ->with($rec_arr);
    }

    /**
     * Update the specified Product_name in storage.
     *
     * @param  int  $id
     * @param  UpdateProduct_nameRequest  $request
     * @return Response
     */
    public function update($id, UpdateProduct_nameRequest $request)
    {
        $productName = $this->productNameRepository->findWithoutFail($id);

        if (empty($productName)) {
            Flash::error('Product Name not found');

            return redirect(route('productNames.index'));
        }

        $productName = $this->productNameRepository->update($request->all(), $id);

        Flash::success('Product Name updated successfully.');

        return redirect(route('productNames.index'));
    }

    /**
     * Remove the specified Product_name from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $productName = $this->productNameRepository->findWithoutFail($id);

        if (empty($productName)) {
            Flash::error('Product Name not found');

            return redirect(route('productNames.index'));
        }

        $this->productNameRepository->delete($id);

        Flash::success('Product Name deleted successfully.');

        return redirect(route('productNames.index'));
    }
}
