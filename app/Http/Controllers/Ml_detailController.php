<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMl_detailRequest;
use App\Http\Requests\UpdateMl_detailRequest;
use App\Repositories\Ml_detailRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Response;
use DB;
use Auth;
use Mail;
use Log;
use App\Models\Database_detail;
use App\Models\Server_detail;
use App\Models\Instance_detail;
use App\Models\Intellicus_detail;

class Ml_detailController extends AppBaseController
{
    /** @var  Ml_detailRepository */
    private $mlDetailRepository;

    public function __construct(Ml_detailRepository $mlDetailRepo)
    {
        $this->mlDetailRepository = $mlDetailRepo;
    }

    public function index(Request $request)
    {
        $mlDetails = $this->mlDetailRepository->all();
        return view('ml_details.index')->with('mlDetails', $mlDetails);
    }

    public function create()
    {
        Log::debug("inside Ml_detailController.create");
        $sd_arr['server_detail'] = Server_detail::where('server_details.server_is_active', 'Y')
                                    ->whereNull('server_details.deleted_at')->get();
        $pai_arr['pai_detail'] = Database_detail::where('repository_type','PAI')
                                    ->where('db_is_active','Y')
                                    ->whereNull('deleted_at')->get();
        $id_arr['intellicus_detail'] = Intellicus_detail::whereNull('deleted_at')->get();

        return view('ml_details.create')
        ->with($sd_arr)
        ->with($id_arr)
        ->with($pai_arr)
        ->with('this_is_edit', false)
        ->with('show_is_active', false);
    }

    public function store(CreateMl_detailRequest $request)
    {
        Log::debug("inside Ml_detailController.store");
        $input = $request->all();

        $mlDetail = $this->mlDetailRepository->create($input);
        Flash::success('Ml Detail saved successfully.');
        return redirect(route('mlDetails.index'));
    }

    public function show($id)
    {
        return redirect(route('mlDetails.index'));
    }

    public function edit($id)
    {
        Log::debug("inside Ml_detailController.edit");
        $mlDetail = $this->mlDetailRepository->find($id);

        $sd_arr['server_detail'] = Server_detail::where('server_details.server_is_active', 'Y')
                                    ->whereNull('server_details.deleted_at')->get();
        $pai_arr['pai_detail'] = Database_detail::where('repository_type','PAI')
                                    ->where('db_is_active','Y')
                                    ->whereNull('deleted_at')->get();
        $id_arr['intellicus_detail'] = Intellicus_detail::whereNull('deleted_at')->get();
        $rec_arr['record'] = DB::table('ml_details')->where('id', $id)->get()->first();

        if (empty($mlDetail)) {
            Flash::error('Ml Detail not found');

            return redirect(route('mlDetails.index'));
        }

        return view('ml_details.edit')
        ->with($sd_arr)
        ->with($pai_arr)
        ->with($id_arr)
        ->with($rec_arr)
        ->with('this_is_edit', true)
        ->with('show_is_active', true)
        ->with('mlDetail', $mlDetail);
    }


    public function update($id, UpdateMl_detailRequest $request)
    {
        $mlDetail = $this->mlDetailRepository->find($id);

        if (empty($mlDetail)) {
            Flash::error('Ml Detail not found');
            return redirect(route('mlDetails.index'));
        }

        $mlDetail = $this->mlDetailRepository->update($request->all(), $id);
        Flash::success('Ml Detail updated successfully.');
        return redirect(route('mlDetails.index'));
    }

    public function destroy($id)
    {
        return redirect(route('mlDetails.index'));
    }
}
