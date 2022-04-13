<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDba_detailRequest;
use App\Http\Requests\UpdateDba_detailRequest;
use App\Repositories\Dba_detailRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Response;
use App\Models\Server_detail;
use DB;
use Log;
use Auth;

class Dba_detailController extends AppBaseController
{
    /** @var  Dba_detailRepository */
    private $dbaDetailRepository;

    public function __construct(Dba_detailRepository $dbaDetailRepo)
    {
        $this->dbaDetailRepository = $dbaDetailRepo;
    }

    /**
     * Display a listing of the Dba_detail.
     *
     * @param Request $request
     *
     * @return Response|Factory|RedirectResponse|Redirector|View
     */
    public function index(Request $request)
    {
        $dbaDetails = $this->dbaDetailRepository->all();

        return view('dba_details.index')
            ->with('dbaDetails', $dbaDetails);
    }

    /**
     * Show the form for creating a new Dba_detail.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|Response
     */
    public function create()
    {
        $sd_arr['server_detail'] = DB::table('server_details')
                                    ->join('server_uses', 'server_details.server_uses_id', 'server_uses.id')
                                    ->where('server_uses.use_short_name', 'DB')
                                    ->whereNull('server_details.deleted_at')
                                    ->select('server_details.*')
                                    ->get();

        return view('dba_details.create')
        ->with($sd_arr)
        ->with('show_is_active', false)
        ->with('this_is_edit', false);
    }

    /**
     * Store a newly created Dba_detail in storage.
     *
     * @param CreateDba_detailRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|Response
     */
    public function store(CreateDba_detailRequest $request)
    {
        $input = $request->all();

        $dbaDetail = $this->dbaDetailRepository->create($input);

        Flash::success('Dba Detail saved successfully.');

        return redirect(route('dbaDetails.index'));
    }

    /**
     * Display the specified Dba_detail.
     *
     * @param int $id
     *
     * @return Factory|RedirectResponse|Redirector|View|Response
     */
    public function show($id)
    {
        $dbaDetail = $this->dbaDetailRepository->find($id);

        if (empty($dbaDetail)) {
            Flash::error('Dba Detail not found');

            return redirect(route('dbaDetails.index'));
        }

        return view('dba_details.show')->with('dbaDetail', $dbaDetail);
    }

    /**
     * Show the form for editing the specified Dba_detail.
     *
     * @param int $id
     *
     * @return Factory|RedirectResponse|Redirector|View|Response
     */
    public function edit($id)
    {
        $dbaDetail = $this->dbaDetailRepository->find($id);

        if (empty($dbaDetail)) {
            Flash::error('Dba Detail not found');

            return redirect(route('dbaDetails.index'));
        }

        $sd_arr['server_detail'] = Server_detail::All();

        $rec_arr['record'] = DB::table('dba_details')->where('id', $id)->get()->first();


        return view('dba_details.edit')
        ->with($sd_arr)
        ->with($rec_arr)
        ->with('dbaDetail', $dbaDetail)
        ->with('show_is_active', true)
        ->with('this_is_edit', true);
    }

    /**
     * Update the specified Dba_detail in storage.
     *
     * @param int $id
     * @param UpdateDba_detailRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|Response
     */
    public function update($id, UpdateDba_detailRequest $request)
    {
        $dbaDetail = $this->dbaDetailRepository->find($id);

        if (empty($dbaDetail)) {
            Flash::error('Dba Detail not found');

            return redirect(route('dbaDetails.index'));
        }

        $dbaDetail = $this->dbaDetailRepository->update($request->all(), $id);

        Flash::success('Dba Detail updated successfully.');

        return redirect(route('dbaDetails.index'));
    }

    /**
     * Remove the specified Dba_detail from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|Response
     */
    public function destroy($id)
    {
        $dbaDetail = $this->dbaDetailRepository->find($id);
        $user_details = Auth::user();

        if (empty($dbaDetail)) {
            Flash::error('Dba Detail not found');

            return redirect(route('dbaDetails.index'));
        }

        $this->dbaDetailRepository->delete($id);
        Log::alert("Record for ID ".$id." deleted by ".$user_details->name);
        Flash::success('Dba Detail deleted successfully.');

        return redirect(route('dbaDetails.index'));
    }
}
