<?php

namespace App\Http\Controllers;

use App\Authorizable;
use App\Http\Requests\CreateDatabase_typeRequest;
use App\Http\Requests\UpdateDatabase_typeRequest;
use App\Repositories\Database_typeRepository;
use DB;
use Flash;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class Database_typeController extends AppBaseController
{
    use Authorizable;

    /** @var Database_typeRepository */
    private $databaseTypeRepository;

    public function __construct(Database_typeRepository $databaseTypeRepo)
    {
        $this->databaseTypeRepository = $databaseTypeRepo;
    }

    /**
     * Display a listing of the Database_type.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->databaseTypeRepository->pushCriteria(new RequestCriteria($request));
        $databaseTypes = $this->databaseTypeRepository->all();

        return view('database_types.index')
            ->with('databaseTypes', $databaseTypes);
    }

    /**
     * Show the form for creating a new Database_type.
     *
     * @return Response
     */
    public function create()
    {
        return view('database_types.create')
        ->with('show_is_active', false)
        ->with('this_is_edit', false);
    }

    /**
     * Store a newly created Database_type in storage.
     *
     * @param  CreateDatabase_typeRequest  $request
     * @return Response
     */
    public function store(CreateDatabase_typeRequest $request)
    {
        $input = $request->all();

        $databaseType = $this->databaseTypeRepository->create($input);

        Flash::success('Database Type saved successfully.');

        return redirect(route('databaseTypes.index'));
    }

    /**
     * Display the specified Database_type.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $databaseType = $this->databaseTypeRepository->findWithoutFail($id);

        if (empty($databaseType)) {
            Flash::error('Database Type not found');

            return redirect(route('databaseTypes.index'));
        }

        return view('database_types.show')->with('databaseType', $databaseType);
    }

    /**
     * Show the form for editing the specified Database_type.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $databaseType = $this->databaseTypeRepository->findWithoutFail($id);

        if (empty($databaseType)) {
            Flash::error('Database Type not found');

            return redirect(route('databaseTypes.index'));
        }

        $rec_arr['record'] = DB::table('database_types')->where('id', $id)->get()->first();

        return view('database_types.edit')
        ->with('databaseType', $databaseType)
        ->with($rec_arr)
        ->with('show_is_active', true)
        ->with('this_is_edit', true);
    }

    /**
     * Update the specified Database_type in storage.
     *
     * @param  int  $id
     * @param  UpdateDatabase_typeRequest  $request
     * @return Response
     */
    public function update($id, UpdateDatabase_typeRequest $request)
    {
        $databaseType = $this->databaseTypeRepository->findWithoutFail($id);

        if (empty($databaseType)) {
            Flash::error('Database Type not found');

            return redirect(route('databaseTypes.index'));
        }

        $databaseType = $this->databaseTypeRepository->update($request->all(), $id);

        Flash::success('Database Type updated successfully.');

        return redirect(route('databaseTypes.index'));
    }

    /**
     * Remove the specified Database_type from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $databaseType = $this->databaseTypeRepository->findWithoutFail($id);

        if (empty($databaseType)) {
            Flash::error('Database Type not found');

            return redirect(route('databaseTypes.index'));
        }

        $this->databaseTypeRepository->delete($id);

        Flash::success('Database Type deleted successfully.');

        return redirect(route('databaseTypes.index'));
    }
}
