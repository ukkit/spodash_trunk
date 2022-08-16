<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateAction_historyRequest;
use App\Http\Requests\UpdateAction_historyRequest;
use App\Repositories\Action_historyRepository;
use DB;
use Flash;
use Illuminate\Http\Request;

class Action_historyController extends AppBaseController
{
    /** @var Action_historyRepository */
    private $actionHistoryRepository;

    public function __construct(Action_historyRepository $actionHistoryRepo)
    {
        $this->actionHistoryRepository = $actionHistoryRepo;
    }

    public function index(Request $request)
    {
        // $actionHistories = $this->actionHistoryRepository->all();
        $actionHistories = $this->actionHistoryRepository->orderBy('start_time', 'desc')->all();

        return view('action_histories.index')
            ->with('actionHistories', $actionHistories);
    }

    public function create()
    {
        return view('action_histories.create');
    }

    public function store(CreateAction_historyRequest $request)
    {
        $input = $request->all();

        $actionHistory = $this->actionHistoryRepository->create($input);

        Flash::success('Action History saved successfully.');

        return redirect(route('actionHistories.index'));
    }

    public function show($id)
    {
        $actionHistory = $this->actionHistoryRepository->find($id);

        if (empty($actionHistory)) {
            Flash::error('Action History not found');

            return redirect(route('actionHistories.index'));
        }

        return view('action_histories.show')->with('actionHistory', $actionHistory);
    }

    public function edit($id)
    {
        $actionHistory = $this->actionHistoryRepository->find($id);

        if (empty($actionHistory)) {
            Flash::error('Action History not found');

            return redirect(route('actionHistories.index'));
        }

        return view('action_histories.edit')->with('actionHistory', $actionHistory);
    }

    public function update($id, UpdateAction_historyRequest $request)
    {
        $actionHistory = $this->actionHistoryRepository->find($id);

        if (empty($actionHistory)) {
            Flash::error('Action History not found');

            return redirect(route('actionHistories.index'));
        }

        $actionHistory = $this->actionHistoryRepository->update($request->all(), $id);

        Flash::success('Action History updated successfully.');

        return redirect(route('actionHistories.index'));
    }

    public function destroy($id)
    {
        $actionHistory = $this->actionHistoryRepository->find($id);
        if (empty($actionHistory)) {
            Flash::error('Action History not found');

            return redirect(route('actionHistories.index'));
        }
        $this->actionHistoryRepository->delete($id);

        return redirect(route('actionHistories.index'));
    }

    public function stats(Request $request)
    {
        \Artisan::call('command:prodversionstorelnums');
        $actionHistories = $this->actionHistoryRepository->whereNull('deleted_at')->orderBy('start_time', 'desc')->get();
        $rn_arr['version_numbers'] = DB::table('release_numbers')->whereNull('deleted_at')->distinct()->get();

        return view('action_histories.stats')
            ->with($rn_arr)
            ->with('actionHistories', $actionHistories);
    }
}
