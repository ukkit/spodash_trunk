<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateDatabase_detailRequest;
use App\Http\Requests\UpdateDatabase_detailRequest;
use App\Repositories\Database_detailRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use DB;
use App\Models\Server_detail;
use App\Models\Database_type;
use App\Models\Ambari_detail;
use App\Authorizable;

class Database_detailController extends AppBaseController
{
    use Authorizable;
    /** @var  Database_detailRepository */
    private $databaseDetailRepository;

    public function __construct(Database_detailRepository $databaseDetailRepo)
    {
        $this->databaseDetailRepository = $databaseDetailRepo;
    }

    /**
     * Display a listing of the Database_detail.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->databaseDetailRepository->pushCriteria(new RequestCriteria($request));
        // $databaseDetails = $this->databaseDetailRepository->all();
        $databaseDetails = $this->databaseDetailRepository->orderBy('updated_at', 'desc')->all();

        return view('database_details.index')
            ->with('databaseDetails', $databaseDetails);
    }

    /**
     * Show the form for creating a new Database_detail.
     *
     * @return Response
     */
    public function create()
    {
        // $sd_arr['server_detail'] = Server_detail::All();
        // Below will list only DB Servers in Add Database Details page
        $sd_arr['server_detail'] = DB::table('server_details')
                                    ->join('server_uses', 'server_details.server_uses_id', 'server_uses.id')
                                    ->where('server_uses.use_short_name', 'DB')
                                    ->select('server_details.*')
                                    ->get();
        $dt_arr['database_type'] = Database_type::All();
        $ad_arr['ambari_detail'] = Ambari_detail::All();

        return view('database_details.create')
        ->with($sd_arr)
        ->with($dt_arr)
        ->with($ad_arr)
        ->with('show_is_active', false)
        ->with('this_is_edit', false);
    }

    /**
     * Store a newly created Database_detail in storage.
     *
     * @param CreateDatabase_detailRequest $request
     *
     * @return Response
     */
    public function store(CreateDatabase_detailRequest $request)
    {
        $input = $request->all();

        //  CODE START - auto generate GEN_DBD_ID
        $value = DB::table('server_details')->select('server_ip')->where('id', $input['server_details_id'])->get()->first();
        $stripped_ip = str_replace(".","",$value->server_ip);
        $lower_dbsid = strtolower($input['db_sid']);
        $stripped_dbsid = str_replace("_","",$lower_dbsid);
        $stripped_dbsid = str_replace("-","",$stripped_dbsid);
        $lower_dbuser = strtolower($input['db_user']);
        $stripped_dbuser = str_replace("_","",$lower_dbuser);
        $stripped_dbuser = str_replace("-","",$stripped_dbuser);

        $dbd_id = $stripped_ip."_".$stripped_dbsid."_".$stripped_dbuser;

        $input['gen_dbd_id'] = $dbd_id;
        // CODE END - auto generate GEN_DBD_ID

        $databaseDetail = $this->databaseDetailRepository->create($input);

        Flash::success('Database Detail saved successfully.');

        return redirect(route('databaseDetails.index'));
    }

    /**
     * Display the specified Database_detail.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        // $databaseDetail = $this->databaseDetailRepository->findWithoutFail($id);

        // if (empty($databaseDetail)) {
        //     Flash::error('Database Detail not found');

        //     return redirect(route('databaseDetails.index'));
        // }

        // return view('database_details.show')->with('databaseDetail', $databaseDetail);
        return redirect(route('databaseDetails.index'));


    }

    /**
     * Show the form for editing the specified Database_detail.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $databaseDetail = $this->databaseDetailRepository->findWithoutFail($id);

        if (empty($databaseDetail)) {
            Flash::error('Database Detail not found');

            return redirect(route('databaseDetails.index'));
        }

        $sd_arr['server_detail'] = Server_detail::All();
        $dt_arr['database_type'] = Database_type::All();
        $ad_arr['ambari_detail'] = Ambari_detail::All();

        $rec_arr['record'] = DB::table('database_details')->where('id', $id)->get()->first();

        return view('database_details.edit')
        ->with('databaseDetail', $databaseDetail)
        ->with($sd_arr)
        ->with($dt_arr)
        ->with($rec_arr)
        ->with($ad_arr)
        ->with('show_is_active', true)
        ->with('this_is_edit', true);
    }

    /**
     * Update the specified Database_detail in storage.
     *
     * @param  int              $id
     * @param UpdateDatabase_detailRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDatabase_detailRequest $request)
    {
        $databaseDetail = $this->databaseDetailRepository->findWithoutFail($id);

        if (empty($databaseDetail)) {
            Flash::error('Database Detail not found');

            return redirect(route('databaseDetails.index'));
        }

        // CODE START - auto generate GEN_DBD_ID
        $value = DB::table('server_details')->select('server_ip')->where('id', $databaseDetail['server_details_id'])->get()->first();
        $stripped_ip = str_replace(".","",$value->server_ip);
        $lower_dbsid = strtolower($request['db_sid']);
        $stripped_dbsid = str_replace("_","",$lower_dbsid);
        $stripped_dbsid = str_replace("-","",$stripped_dbsid);
        $lower_dbuser = strtolower($request['db_user']);
        $stripped_dbuser = str_replace("_","",$lower_dbuser);
        $stripped_dbuser = str_replace("-","",$stripped_dbuser);

        $dbd_id = $stripped_ip."_".$stripped_dbsid."_".$stripped_dbuser;

        $request['gen_dbd_id'] = $dbd_id;
        // CODE END - auto generate GEN_DBD_ID

        $databaseDetail = $this->databaseDetailRepository->update($request->all(), $id);

        Flash::success('Database Detail updated successfully.');

        return redirect(route('databaseDetails.index'));
    }

    /**
     * Remove the specified Database_detail from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $databaseDetail = $this->databaseDetailRepository->findWithoutFail($id);

        if (empty($databaseDetail)) {
            Flash::error('Database Detail not found');

            return redirect(route('databaseDetails.index'));
        }

        $this->databaseDetailRepository->delete($id);

        Flash::success('Database Detail deleted successfully.');

        return redirect(route('databaseDetails.index'));
    }
}
