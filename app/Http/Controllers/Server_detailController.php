<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateServer_detailRequest;
use App\Http\Requests\UpdateServer_detailRequest;
use App\Repositories\Server_detailRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\Os_type;
use App\Models\Database_type;
use App\Models\Server_use;
use DB;

class Server_detailController extends AppBaseController
{
    /** @var  Server_detailRepository */
    private $serverDetailRepository;

    public function __construct(Server_detailRepository $serverDetailRepo)
    {
        $this->serverDetailRepository = $serverDetailRepo;
    }

    /**
     * Display a listing of the Server_detail.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->serverDetailRepository->pushCriteria(new RequestCriteria($request));
        // $serverDetails = $this->serverDetailRepository->paginate(15);
        $serverDetails = $this->serverDetailRepository->all();

        $ot_arr['os_types'] = Os_type::all();
        $db_arr['database_types'] = Database_type::all();
        $su_arr['server_uses'] = Server_use::all();

        return view('server_details.index')
            ->with('serverDetails', $serverDetails)
            ->with($ot_arr)
            ->with($db_arr)
            ->with($su_arr);
    }

    /**
     * Show the form for creating a new Server_detail.
     *
     * @return Response
     */
    public function create()
    {
        $ot_arr['os_types'] = Os_type::where('os_is_active','Y')->get();
        $db_arr['database_types'] = Database_type::where('db_is_active','Y')->get();
        $su_arr['server_uses'] = Server_use::all();


        return view('server_details.create')
        ->with($ot_arr)
        ->with($db_arr)
        ->with($su_arr)
        ->with('this_is_edit', false)
        ->with('show_is_active', false);
    }

    /**
     * Store a newly created Server_detail in storage.
     *
     * @param CreateServer_detailRequest $request
     *
     * @return Response
     */
    public function store(CreateServer_detailRequest $request)
    {
        $input = $request->all();

        // CODE START - Auto Generate GEN_SD_ID
        $stripped_ip = str_replace(".","",$input['server_ip']);
        $lower_servername = strtolower($input['server_name']);
        $stripped_servername = str_replace("_","",$lower_servername);
        $stripped_servername = str_replace("-","",$stripped_servername);
        $stripped_servername = str_replace(".","",$stripped_servername);
        $gen_sd_id = $stripped_servername."_".$stripped_ip;

        $input['gen_sd_id'] = $gen_sd_id;
        // CODE END - Auto Generate GEN_SD_ID

        $serverDetail = $this->serverDetailRepository->create($input);

        Flash::success('Server Detail saved successfully.');

        return redirect(route('serverDetails.index'));
    }

    /**
     * Display the specified Server_detail.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $serverDetail = $this->serverDetailRepository->findWithoutFail($id);

        if (empty($serverDetail)) {
            Flash::error('Server Detail not found');

            return redirect(route('serverDetails.index'));
        }

        $os_type = Os_type::all();

        return view('server_details.show')
        ->with('serverDetail', $serverDetail)
        ->with('os_type', $os_type);
    }

    /**
     * Show the form for editing the specified Server_detail.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $serverDetail = $this->serverDetailRepository->findWithoutFail($id);

        if (empty($serverDetail)) {
            Flash::error('Server Detail not found');

            return redirect(route('serverDetails.index'));
        }

        $ot_arr['os_types'] = Os_type::all();
        $db_arr['database_types'] = Database_type::all();
        $su_arr['server_uses'] = Server_use::all();

        $rec_arr['record'] = DB::table('server_details')->where('id', $id)->get()->first();

        return view('server_details.edit')
        ->with('serverDetail', $serverDetail)
        ->with($ot_arr)
        ->with($db_arr)
        ->with($su_arr)
        ->with($rec_arr)
        ->with('show_is_active', true)
        ->with('this_is_edit', true);
    }

    /**
     * Update the specified Server_detail in storage.
     *
     * @param  int              $id
     * @param UpdateServer_detailRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateServer_detailRequest $request)
    {
        $serverDetail = $this->serverDetailRepository->findWithoutFail($id);

        if (empty($serverDetail)) {
            Flash::error('Server Detail not found');

            return redirect(route('serverDetails.index'));
        }

        // CODE START - Auto Generate GEN_SD_ID
        $value = DB::table('server_details')->where('id', $id)->get()->first();
        if ($request['server_ip'] == null) {
            $stripped_ip = str_replace(".","",$value->server_ip);
        } else {
            $stripped_ip = str_replace(".","",$request['server_ip']);
        }
        if ($request['server_name'] == null) {
            $lower_servername = strtolower($value->server_name);
        } else {
            $lower_servername = strtolower($request['server_name']);
        }

        $stripped_servername = str_replace("_","",$lower_servername);
        $stripped_servername = str_replace("-","",$stripped_servername);
        $stripped_servername = str_replace(".","",$stripped_servername);
        $gen_sd_id = $stripped_servername."_".$stripped_ip;

        $request['gen_sd_id'] = $gen_sd_id;
        // CODE END - Auto Generate GEN_SD_ID

        $serverDetail = $this->serverDetailRepository->update($request->all(), $id);

        Flash::success('Server Detail updated successfully.');

        return redirect(route('serverDetails.index'));
    }

    /**
     * Remove the specified Server_detail from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $serverDetail = $this->serverDetailRepository->findWithoutFail($id);

        if (empty($serverDetail)) {
            Flash::error('Server Detail not found');

            return redirect(route('serverDetails.index'));
        }

        $this->serverDetailRepository->delete($id);

        Flash::success('Server Detail deleted successfully.');

        return redirect(route('serverDetails.index'));
    }
}
