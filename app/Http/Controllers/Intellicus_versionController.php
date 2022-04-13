<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateIntellicus_versionRequest;
use App\Http\Requests\UpdateIntellicus_versionRequest;
use App\Repositories\Intellicus_versionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Response;
use DB;

class Intellicus_versionController extends AppBaseController
{
    /** @var  Intellicus_versionRepository */
    private $intellicusVersionRepository;

    public function __construct(Intellicus_versionRepository $intellicusVersionRepo)
    {
        $this->intellicusVersionRepository = $intellicusVersionRepo;
    }

    /**
     * Display a listing of the Intellicus_version.
     *
     * @param Request $request
     *
     * @return Response|Factory|RedirectResponse|Redirector|View
     */
    public function index(Request $request)
    {
        $intellicusVersions = $this->intellicusVersionRepository->all();

        return view('intellicus_versions.index')
            ->with('intellicusVersions', $intellicusVersions);
    }

    /**
     * Show the form for creating a new Intellicus_version.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|Response
     */
    public function create()
    {
        return view('intellicus_versions.create')
        ->with('show_is_active', false)
        ->with('this_is_edit', false);
    }

    /**
     * Store a newly created Intellicus_version in storage.
     *
     * @param CreateIntellicus_versionRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|Response
     */
    public function store(CreateIntellicus_versionRequest $request)
    {
        $input = $request->all();

        $intellicusVersion = $this->intellicusVersionRepository->create($input);

        Flash::success('Intellicus Version saved successfully.');

        return redirect(route('intellicusVersions.index'));
    }

    /**
     * Display the specified Intellicus_version.
     *
     * @param int $id
     *
     * @return Factory|RedirectResponse|Redirector|View|Response
     */
    public function show($id)
    {
        $intellicusVersion = $this->intellicusVersionRepository->find($id);

        if (empty($intellicusVersion)) {
            Flash::error('Intellicus Version not found');

            return redirect(route('intellicusVersions.index'));
        }

        return view('intellicus_versions.show')->with('intellicusVersion', $intellicusVersion);
    }

    /**
     * Show the form for editing the specified Intellicus_version.
     *
     * @param int $id
     *
     * @return Factory|RedirectResponse|Redirector|View|Response
     */
    public function edit($id)
    {
        $intellicusVersion = $this->intellicusVersionRepository->find($id);

        $rec_arr['record'] = DB::table('intellicus_versions')->where('id', $id)->get()->first();

        if (empty($intellicusVersion)) {
            Flash::error('Intellicus Version not found');

            return redirect(route('intellicusVersions.index'));
        }

        return view('intellicus_versions.edit')
        ->with($rec_arr)
        ->with('show_is_active', true)
        ->with('this_is_edit', true)
        ->with('intellicusVersion', $intellicusVersion);
    }

    /**
     * Update the specified Intellicus_version in storage.
     *
     * @param int $id
     * @param UpdateIntellicus_versionRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|Response
     */
    public function update($id, UpdateIntellicus_versionRequest $request)
    {
        $intellicusVersion = $this->intellicusVersionRepository->find($id);

        if (empty($intellicusVersion)) {
            Flash::error('Intellicus Version not found');

            return redirect(route('intellicusVersions.index'));
        }

        $intellicusVersion = $this->intellicusVersionRepository->update($request->all(), $id);

        Flash::success('Intellicus Version updated successfully.');

        return redirect(route('intellicusVersions.index'));
    }

    /**
     * Remove the specified Intellicus_version from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|Response
     */
    public function destroy($id)
    {
        $intellicusVersion = $this->intellicusVersionRepository->find($id);

        if (empty($intellicusVersion)) {
            Flash::error('Intellicus Version not found');

            return redirect(route('intellicusVersions.index'));
        }

        $this->intellicusVersionRepository->delete($id);

        Flash::success('Intellicus Version deleted successfully.');

        return redirect(route('intellicusVersions.index'));
    }
}
