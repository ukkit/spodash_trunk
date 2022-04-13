<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIntellicus_detailRequest;
use App\Http\Requests\UpdateIntellicus_detailRequest;
use App\Repositories\Intellicus_detailRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use App\Models\Server_detail;
use App\Models\Database_detail;
use App\Models\Intellicus_version;
use Response;
use DB;

class Intellicus_detailController extends AppBaseController
{
    /** @var  Intellicus_detailRepository */
    private $intellicusDetailRepository;

    public function __construct(Intellicus_detailRepository $intellicusDetailRepo)
    {
        $this->intellicusDetailRepository = $intellicusDetailRepo;
    }

    /**
     * Display a listing of the Intellicus_detail.
     *
     * @param Request $request
     *
     * @return Response|Factory|RedirectResponse|Redirector|View
     */
    public function index(Request $request)
    {
        $intellicusDetails = $this->intellicusDetailRepository->all();

        return view('intellicus_details.index')
            ->with('intellicusDetails', $intellicusDetails);
    }

    /**
     * Show the form for creating a new Intellicus_detail.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|Response
     */
    public function create()
    {
        $sd_arr['server_detail'] = DB::table('server_details')->whereNull('deleted_at')->get();
        $iv_arr['intellicus_version'] = DB::table('intellicus_versions')->whereNull('deleted_at')->get();
        // $dd_arr['db_detail'] = DB::table('database_details')->where('repository_type', 'Intellicus')->whereNull('deleted_at')->get();
        $dd_arr['db_detail'] = DB::table('database_details')
                                ->join('server_details', 'server_details.id', 'database_details.server_details_id')
                                ->where('database_details.repository_type', 'Intellicus')
                                ->whereNull('database_details.deleted_at')
                                ->select('database_details.id', 'server_details.server_name', 'server_details.server_ip', 'database_details.db_user', 'database_details.db_sid')
                                ->get();

        return view('intellicus_details.create')
        ->with($sd_arr)
        ->with($iv_arr)
        ->with($dd_arr)
        ->with('show_is_active', false)
        ->with('this_is_edit', false);
    }

    /**
     * Store a newly created Intellicus_detail in storage.
     *
     * @param CreateIntellicus_detailRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|Response
     */
    public function store(CreateIntellicus_detailRequest $request)
    {
        $input = $request->all();

        $intellicusDetail = $this->intellicusDetailRepository->create($input);

        Flash::success('Intellicus Detail saved successfully.');

        return redirect(route('intellicusDetails.index'));
    }

    /**
     * Display the specified Intellicus_detail.
     *
     * @param int $id
     *
     * @return Factory|RedirectResponse|Redirector|View|Response
     */
    public function show($id)
    {
        $intellicusDetail = $this->intellicusDetailRepository->find($id);

        if (empty($intellicusDetail)) {
            Flash::error('Intellicus Detail not found');

            return redirect(route('intellicusDetails.index'));
        }

        return view('intellicus_details.show')->with('intellicusDetail', $intellicusDetail);
    }

    /**
     * Show the form for editing the specified Intellicus_detail.
     *
     * @param int $id
     *
     * @return Factory|RedirectResponse|Redirector|View|Response
     */
    public function edit($id)
    {
        $intellicusDetail = $this->intellicusDetailRepository->find($id);

        $sd_arr['server_detail'] = Server_detail::All();
        $iv_arr['intellicus_version'] = Intellicus_version::All();
        $rec_arr['record'] = DB::table('intellicus_details')->where('id', $id)->get()->first();
        // $dd_arr['db_detail'] = DB::table('database_details')->where('is_intellicus_repository', 'Y')->whereNull('deleted_at')->get();
        $dd_arr['db_detail'] = DB::table('database_details')
                                ->join('server_details', 'server_details.id', 'database_details.server_details_id')
                                ->where('database_details.repository_type', 'Intellicus')
                                ->whereNull('database_details.deleted_at')
                                ->select('database_details.id', 'server_details.server_name', 'server_details.server_ip', 'database_details.db_user', 'database_details.db_sid')
                                ->get();

        if (empty($intellicusDetail)) {
            Flash::error('Intellicus Detail not found');

            return redirect(route('intellicusDetails.index'));
        }

        return view('intellicus_details.edit')
        ->with($sd_arr)
        ->with($iv_arr)
        ->with($rec_arr)
        ->with($dd_arr)
        ->with('show_is_active', true)
        ->with('this_is_edit', true)
        ->with('intellicusDetail', $intellicusDetail);
    }

    /**
     * Update the specified Intellicus_detail in storage.
     *
     * @param int $id
     * @param UpdateIntellicus_detailRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|Response
     */
    public function update($id, UpdateIntellicus_detailRequest $request)
    {
        $intellicusDetail = $this->intellicusDetailRepository->find($id);

        if (empty($intellicusDetail)) {
            Flash::error('Intellicus Detail not found');

            return redirect(route('intellicusDetails.index'));
        }

        $intellicusDetail = $this->intellicusDetailRepository->update($request->all(), $id);

        Flash::success('Intellicus Detail updated successfully.');

        return redirect(route('intellicusDetails.index'));
    }

    /**
     * Remove the specified Intellicus_detail from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|Response
     */
    public function destroy($id)
    {
        $intellicusDetail = $this->intellicusDetailRepository->find($id);

        if (empty($intellicusDetail)) {
            Flash::error('Intellicus Detail not found');

            return redirect(route('intellicusDetails.index'));
        }

        $this->intellicusDetailRepository->delete($id);

        Flash::success('Intellicus Detail deleted successfully.');

        return redirect(route('intellicusDetails.index'));
    }
}
