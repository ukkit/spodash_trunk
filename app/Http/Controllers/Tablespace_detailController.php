<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTablespace_detailRequest;
use App\Http\Requests\UpdateTablespace_detailRequest;
use App\Repositories\Tablespace_detailRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Response;

class Tablespace_detailController extends AppBaseController
{
    /** @var  Tablespace_detailRepository */
    private $tablespaceDetailRepository;

    public function __construct(Tablespace_detailRepository $tablespaceDetailRepo)
    {
        $this->tablespaceDetailRepository = $tablespaceDetailRepo;
    }

    /**
     * Display a listing of the Tablespace_detail.
     *
     * @param Request $request
     *
     * @return Response|Factory|RedirectResponse|Redirector|View
     */
    public function index(Request $request)
    {
        // $tablespaceDetails = $this->tablespaceDetailRepository->all();
        $tablespaceDetails = $this->tablespaceDetailRepository->orderBy('created_at', 'desc')->all();

        return view('tablespace_details.index')
            ->with('tablespaceDetails', $tablespaceDetails);
    }

    /**
     * Show the form for creating a new Tablespace_detail.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|Response
     */
    public function create()
    {
        // return view('tablespace_details.create');
        // return redirect(route('tablespace_details.index'));
        return redirect(route('tablespaceDetails.index'));

    }

    /**
     * Store a newly created Tablespace_detail in storage.
     *
     * @param CreateTablespace_detailRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|Response
     */
    public function store(CreateTablespace_detailRequest $request)
    {
        $input = $request->all();

        $tablespaceDetail = $this->tablespaceDetailRepository->create($input);

        Flash::success('Tablespace Detail saved successfully.');

        return redirect(route('tablespaceDetails.index'));
    }

    /**
     * Display the specified Tablespace_detail.
     *
     * @param int $id
     *
     * @return Factory|RedirectResponse|Redirector|View|Response
     */
    public function show($id)
    {
        // $tablespaceDetail = $this->tablespaceDetailRepository->find($id);

        // if (empty($tablespaceDetail)) {
        //     Flash::error('Tablespace Detail not found');

        //     return redirect(route('tablespaceDetails.index'));
        // }

        // return view('tablespace_details.show')->with('tablespaceDetail', $tablespaceDetail);
        return redirect(route('tablespaceDetails.index'));
    }

    /**
     * Show the form for editing the specified Tablespace_detail.
     *
     * @param int $id
     *
     * @return Factory|RedirectResponse|Redirector|View|Response
     */
    public function edit($id)
    {
        // $tablespaceDetail = $this->tablespaceDetailRepository->find($id);

        // if (empty($tablespaceDetail)) {
        //     Flash::error('Tablespace Detail not found');

        //     return redirect(route('tablespaceDetails.index'));
        // }

        // return view('tablespace_details.edit')->with('tablespaceDetail', $tablespaceDetail);
        return redirect(route('tablespaceDetails.index'));
    }

    /**
     * Update the specified Tablespace_detail in storage.
     *
     * @param int $id
     * @param UpdateTablespace_detailRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|Response
     */
    public function update($id, UpdateTablespace_detailRequest $request)
    {
        // $tablespaceDetail = $this->tablespaceDetailRepository->find($id);

        // if (empty($tablespaceDetail)) {
        //     Flash::error('Tablespace Detail not found');

        //     return redirect(route('tablespaceDetails.index'));
        // }

        // $tablespaceDetail = $this->tablespaceDetailRepository->update($request->all(), $id);

        // Flash::success('Tablespace Detail updated successfully.');
        Flash::warning('Update disabled.');

        return redirect(route('tablespaceDetails.index'));
    }

    /**
     * Remove the specified Tablespace_detail from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|Response
     */
    public function destroy($id)
    {
        // $tablespaceDetail = $this->tablespaceDetailRepository->find($id);

        // if (empty($tablespaceDetail)) {
        //     Flash::error('Tablespace Detail not found');

        //     return redirect(route('tablespaceDetails.index'));
        // }

        // $this->tablespaceDetailRepository->delete($id);

        // Flash::success('Tablespace Detail deleted successfully.');
        Flash::success('Delete disabled');

        return redirect(route('tablespaceDetails.index'));
    }
}
