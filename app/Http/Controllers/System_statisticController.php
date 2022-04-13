<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSystem_statisticRequest;
use App\Http\Requests\UpdateSystem_statisticRequest;
use App\Repositories\System_statisticRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Response;
use DB;

class System_statisticController extends AppBaseController
{
    /** @var  System_statisticRepository */
    private $systemStatisticRepository;

    public function __construct(System_statisticRepository $systemStatisticRepo)
    {
        $this->systemStatisticRepository = $systemStatisticRepo;
    }

    public function index(Request $request)
    {
        // $systemStatistics = $this->systemStatisticRepository->all();
        $systemStatistics = $this->systemStatisticRepository->all();
        $releaseNumbers = DB::table('release_numbers')->get();
        $releaseData = DB::table('z_release_data')->get();
        $actionData = DB::table('z_action_data')->get();
        $timePeriod = DB::table('z_tp_data')->get();
        // $systemStatistics = DB::table('system_statistics')->orderBy('created_at', 'desc')->get();

        return view('system_statistics.index')
            ->with('releaseNumbers', $releaseNumbers)
            ->with('releaseData', $releaseData)
            ->with('actionData', $actionData)
            ->with('timePeriod', $timePeriod)
            ->with('systemStatistics', $systemStatistics);
    }

    public function details(Request $request)
    {
        // $systemStatistics = $this->systemStatisticRepository->all();
        // $systemStatistics = $this->systemStatisticRepository->all();
        $releaseNumbers = DB::table('release_numbers')->get();
        $releaseData = DB::table('z_release_data')->get();
        // $systemStatistics = DB::table('system_statistics')->orderBy('created_at', 'desc')->get();

        return view('system_statistics.details')
            ->with('releaseNumbers', $releaseNumbers)
            ->with('releaseData', $releaseData);
            // ->with('systemStatistics', $systemStatistics);
    }

    public function create()
    {
        return redirect(route('systemStatistics.index'));
    }

    public function store(CreateSystem_statisticRequest $request)
    {
        return redirect(route('systemStatistics.index'));
    }

    public function show($id)
    {
        return redirect(route('systemStatistics.index'));
    }

    public function edit($id)
    {
        return redirect(route('systemStatistics.index'));
    }

    public function update($id, UpdateSystem_statisticRequest $request)
    {
        return redirect(route('systemStatistics.index'));
    }

    public function destroy($id)
    {
        return redirect(route('systemStatistics.index'));
    }
}
