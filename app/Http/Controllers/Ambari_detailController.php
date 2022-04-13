<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAmbari_detailRequest;
use App\Http\Requests\UpdateAmbari_detailRequest;
use App\Repositories\Ambari_detailRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Response;

class Ambari_detailController extends AppBaseController
{
    /** @var  Ambari_detailRepository */
    private $ambariDetailRepository;

    public function __construct(Ambari_detailRepository $ambariDetailRepo)
    {
        $this->ambariDetailRepository = $ambariDetailRepo;
    }

    /**
     * Display a listing of the Ambari_detail.
     *
     * @param Request $request
     *
     * @return Response|Factory|RedirectResponse|Redirector|View
     */
    public function index(Request $request)
    {
        $ambariDetails = $this->ambariDetailRepository->all();

        return view('ambari_details.index')
            ->with('ambariDetails', $ambariDetails);
    }

    /**
     * Show the form for creating a new Ambari_detail.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|Response
     */
    public function create()
    {
        return view('ambari_details.create');
    }

    /**
     * Store a newly created Ambari_detail in storage.
     *
     * @param CreateAmbari_detailRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|Response
     */
    public function store(CreateAmbari_detailRequest $request)
    {
        $input = $request->all();

        $ambariDetail = $this->ambariDetailRepository->create($input);

        Flash::success('Ambari Detail saved successfully.');

        return redirect(route('ambariDetails.index'));
    }

    /**
     * Display the specified Ambari_detail.
     *
     * @param int $id
     *
     * @return Factory|RedirectResponse|Redirector|View|Response
     */
    public function show($id)
    {
        $ambariDetail = $this->ambariDetailRepository->find($id);

        if (empty($ambariDetail)) {
            Flash::error('Ambari Detail not found');

            return redirect(route('ambariDetails.index'));
        }

        return view('ambari_details.show')->with('ambariDetail', $ambariDetail);
    }

    /**
     * Show the form for editing the specified Ambari_detail.
     *
     * @param int $id
     *
     * @return Factory|RedirectResponse|Redirector|View|Response
     */
    public function edit($id)
    {
        $ambariDetail = $this->ambariDetailRepository->find($id);

        if (empty($ambariDetail)) {
            Flash::error('Ambari Detail not found');

            return redirect(route('ambariDetails.index'));
        }

        return view('ambari_details.edit')->with('ambariDetail', $ambariDetail);
    }

    /**
     * Update the specified Ambari_detail in storage.
     *
     * @param int $id
     * @param UpdateAmbari_detailRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|Response
     */
    public function update($id, UpdateAmbari_detailRequest $request)
    {
        $ambariDetail = $this->ambariDetailRepository->find($id);

        if (empty($ambariDetail)) {
            Flash::error('Ambari Detail not found');

            return redirect(route('ambariDetails.index'));
        }

        $ambariDetail = $this->ambariDetailRepository->update($request->all(), $id);

        Flash::success('Ambari Detail updated successfully.');

        return redirect(route('ambariDetails.index'));
    }

    /**
     * Remove the specified Ambari_detail from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|Response
     */
    public function destroy($id)
    {
        $ambariDetail = $this->ambariDetailRepository->find($id);

        if (empty($ambariDetail)) {
            Flash::error('Ambari Detail not found');

            return redirect(route('ambariDetails.index'));
        }

        $this->ambariDetailRepository->delete($id);

        Flash::success('Ambari Detail deleted successfully.');

        return redirect(route('ambariDetails.index'));
    }
}
