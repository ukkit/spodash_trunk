<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePai_detailRequest;
use App\Http\Requests\UpdatePai_detailRequest;
use App\Models\Ambari_detail;
use App\Models\Server_detail;
use App\Repositories\Pai_detailRepository;
use DB;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Log;
use Response;

class Pai_detailController extends AppBaseController
{
    /** @var Pai_detailRepository */
    private $paiDetailRepository;

    public function __construct(Pai_detailRepository $paiDetailRepo)
    {
        $this->paiDetailRepository = $paiDetailRepo;
    }

    /**
     * Display a listing of the Pai_detail.
     *
     * @param  Request  $request
     * @return Response|Factory|RedirectResponse|Redirector|View
     */
    public function index(Request $request)
    {
        Log::debug('inside Pai_detailController.index');
        $paiDetails = $this->paiDetailRepository->all();

        return view('pai_details.index')
            ->with('paiDetails', $paiDetails);
    }

    /**
     * Show the form for creating a new Pai_detail.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|Response
     */
    public function create()
    {
        Log::debug('inside Pai_detailController.create');
        // $sd_arr['server_detail'] = DB::table('server_details')->whereNull('deleted_at')->get();
        // $ad_arr['ambari_detail'] = DB::table('ambari_details')->whereNull('deleted_at')->get();
        $sd_arr['server_detail'] = Server_detail::All();
        $ad_arr['ambari_detail'] = Ambari_detail::All();

        Log::debug('Pai_detailController.create server_detail record count '.count($sd_arr));
        Log::debug('Pai_detailController.create ambari_detail record count '.count($ad_arr));
        // Log::debug('inside Pai_detailController.store');

        return view('pai_details.create')
        ->with($sd_arr)
        ->with($ad_arr)
        ->with('this_is_edit', false);
    }

    /**
     * Store a newly created Pai_detail in storage.
     *
     * @param  CreatePai_detailRequest  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|Response
     */
    public function store(CreatePai_detailRequest $request)
    {
        Log::debug('inside Pai_detailController.store');
        $input = $request->all();

        $paiDetail = $this->paiDetailRepository->create($input);

        Flash::success('Pai Detail saved successfully.');

        return redirect(route('paiDetails.index'));
    }

    /**
     * Display the specified Pai_detail.
     *
     * @param  int  $id
     * @return Factory|RedirectResponse|Redirector|View|Response
     */
    public function show($id)
    {
        Log::debug('inside Pai_detailController.show');
        $paiDetail = $this->paiDetailRepository->find($id);

        if (empty($paiDetail)) {
            Flash::error('Pai Detail not found');

            return redirect(route('paiDetails.index'));
        }

        return view('pai_details.show')->with('paiDetail', $paiDetail);
    }

    /**
     * Show the form for editing the specified Pai_detail.
     *
     * @param  int  $id
     * @return Factory|RedirectResponse|Redirector|View|Response
     */
    public function edit($id)
    {
        Log::debug('inside Pai_detailController.edit for ID '.$id);

        $paiDetail = $this->paiDetailRepository->find($id);

        if (empty($paiDetail)) {
            Flash::error('Pai Detail not found');

            return redirect(route('paiDetails.index'));
        }
        // $sd_arr['server_detail'] = DB::table('server_details')->whereNull('deleted_at')->get();
        // $ad_arr['ambari_detail'] = DB::table('ambari_details')->whereNull('deleted_at')->get();
        $sd_arr['server_detail'] = Server_detail::All();
        $ad_arr['ambari_detail'] = Ambari_detail::All();
        $rec_arr['record'] = DB::table('pai_details')->where('id', $id)->get()->first();

        Log::debug('Pai_detailController.edit server_detail record count '.count($sd_arr));
        Log::debug('Pai_detailController.edit ambari_detail record count '.count($ad_arr));

        return view('pai_details.edit')
        ->with($sd_arr)
        ->with($ad_arr)
        ->with($rec_arr)
        ->with('this_is_edit', true)
        ->with('paiDetail', $paiDetail);
    }

    /**
     * Update the specified Pai_detail in storage.
     *
     * @param  int  $id
     * @param  UpdatePai_detailRequest  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|Response
     */
    public function update($id, UpdatePai_detailRequest $request)
    {
        Log::debug('inside Pai_detailController.update');

        $paiDetail = $this->paiDetailRepository->find($id);

        if (empty($paiDetail)) {
            Flash::error('Pai Detail not found');

            return redirect(route('paiDetails.index'));
        }

        $paiDetail = $this->paiDetailRepository->update($request->all(), $id);

        Flash::success('Pai Detail updated successfully.');

        return redirect(route('paiDetails.index'));
    }

    /**
     * Remove the specified Pai_detail from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|Response
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        $paiDetail = $this->paiDetailRepository->find($id);

        if (empty($paiDetail)) {
            Flash::error('Pai Detail not found');

            return redirect(route('paiDetails.index'));
        }

        $this->paiDetailRepository->delete($id);

        Flash::success('Pai Detail deleted successfully.');

        return redirect(route('paiDetails.index'));
    }
}
