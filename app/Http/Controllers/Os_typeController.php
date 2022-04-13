<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOs_typeRequest;
use App\Http\Requests\UpdateOs_typeRequest;
use App\Repositories\Os_typeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use DB;
use App\Authorizable;

class Os_typeController extends AppBaseController
{
    use Authorizable;
    /** @var  Os_typeRepository */
    private $osTypeRepository;

    public function __construct(Os_typeRepository $osTypeRepo)
    {
        $this->osTypeRepository = $osTypeRepo;
    }

    /**
     * Display a listing of the Os_type.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->osTypeRepository->pushCriteria(new RequestCriteria($request));
        $osTypes = $this->osTypeRepository->all();

        return view('os_types.index')
            ->with('osTypes', $osTypes);
    }

    /**
     * Show the form for creating a new Os_type.
     *
     * @return Response
     */
    public function create()
    {
        return view('os_types.create')
        ->with('show_is_active', false)
        ->with('this_is_edit', false);
    }

    /**
     * Store a newly created Os_type in storage.
     *
     * @param CreateOs_typeRequest $request
     *
     * @return Response
     */
    public function store(CreateOs_typeRequest $request)
    {
        $input = $request->all();

        $osType = $this->osTypeRepository->create($input);

        Flash::success('Os Type saved successfully.');

        return redirect(route('osTypes.index'));
    }

    /**
     * Display the specified Os_type.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $osType = $this->osTypeRepository->findWithoutFail($id);

        if (empty($osType)) {
            Flash::error('Os Type not found');

            return redirect(route('osTypes.index'));
        }

        return view('os_types.show')->with('osType', $osType);
    }

    /**
     * Show the form for editing the specified Os_type.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $osType = $this->osTypeRepository->findWithoutFail($id);

        if (empty($osType)) {
            Flash::error('Os Type not found');

            return redirect(route('osTypes.index'));
        }

        $rec_arr['record'] = DB::table('os_types')->where('id', $id)->get()->first();

        return view('os_types.edit')
        ->with('osType', $osType)
        ->with($rec_arr)
        ->with('show_is_active', true)
        ->with('this_is_edit', true);
    }

    /**
     * Update the specified Os_type in storage.
     *
     * @param  int              $id
     * @param UpdateOs_typeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOs_typeRequest $request)
    {
        $osType = $this->osTypeRepository->findWithoutFail($id);

        if (empty($osType)) {
            Flash::error('Os Type not found');

            return redirect(route('osTypes.index'));
        }

        $osType = $this->osTypeRepository->update($request->all(), $id);

        Flash::success('Os Type updated successfully.');

        return redirect(route('osTypes.index'));
    }

    /**
     * Remove the specified Os_type from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        // $osType = $this->osTypeRepository->findWithoutFail($id);

        // if (empty($osType)) {
        //     Flash::error('Os Type not found');

        //     return redirect(route('osTypes.index'));
        // }

        // $this->osTypeRepository->delete($id);

        Flash::success('Deletion not supported.');

        return redirect(route('osTypes.index'));
    }
}
