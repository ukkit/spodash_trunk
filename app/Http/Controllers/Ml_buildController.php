<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateMl_buildRequest;
use App\Http\Requests\UpdateMl_buildRequest;
use App\Repositories\Ml_buildRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Ml_build;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Response;

class Ml_buildController extends AppBaseController
{
    /** @var  Ml_buildRepository */
    private $mlBuildRepository;

    public function __construct(Ml_buildRepository $mlBuildRepo)
    {
        $this->mlBuildRepository = $mlBuildRepo;
    }

    /**
     * Display a listing of the Ml_build.
     *
     * @param Request $request
     *
     * @return Response|Factory|RedirectResponse|Redirector|View
     */
    public function index(Request $request)
    {
        $mlBuilds = $this->mlBuildRepository->all();

        return view('ml_builds.index')
            ->with('mlBuilds', $mlBuilds);
    }

    /**
     * Show the form for creating a new Ml_build.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|Response
     */
    public function create()
    {
        return view('ml_builds.create')->with('this_is_edit', false);
    }

    /**
     * Store a newly created Ml_build in storage.
     *
     * @param CreateMl_buildRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|Response
     */
    public function store(CreateMl_buildRequest $request)
    {
        $input = $request->all();

        $strip_pvn = preg_replace("/[^0-9]/", "", $input['ml_version']);
        $strip_pbn = preg_replace("/[^0-9]/", "", $input['ml_build']);
        $old_pvid = $strip_pvn . $strip_pbn;
        $pv_id = $strip_pvn . "_" . $strip_pbn;

        $input['pv_id'] = $pv_id;

        $mlBuild = $this->mlBuildRepository->create($input);

        Flash::success('ML Build details saved successfully.');

        return redirect(route('mlBuilds.index'));
    }

    /**
     * Display the specified Ml_build.
     *
     * @param int $id
     *
     * @return Factory|RedirectResponse|Redirector|View|Response
     */
    public function show($id)
    {
        $mlBuild = $this->mlBuildRepository->find($id);

        if (empty($mlBuild)) {
            Flash::error('Ml Build not found');

            return redirect(route('mlBuilds.index'));
        }

        return view('ml_builds.show')->with('mlBuild', $mlBuild);
    }

    /**
     * Show the form for editing the specified Ml_build.
     *
     * @param int $id
     *
     * @return Factory|RedirectResponse|Redirector|View|Response
     */
    public function edit($id)
    {
        $mlBuild = $this->mlBuildRepository->find($id);

        if (empty($mlBuild)) {
            Flash::error('Ml Build not found');

            return redirect(route('mlBuilds.index'));
        }

        $rec_arr['record'] = Ml_build::where('id', $id)->get()->first();

        return view('ml_builds.edit')
            ->with('mlBuild', $mlBuild)
            ->with($rec_arr)
            ->with('this_is_edit', true);
    }

    /**
     * Update the specified Ml_build in storage.
     *
     * @param int $id
     * @param UpdateMl_buildRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|Response
     */
    public function update($id, UpdateMl_buildRequest $request)
    {
        $mlBuild = $this->mlBuildRepository->find($id);

        if (empty($mlBuild)) {
            Flash::error('Ml Build not found');

            return redirect(route('mlBuilds.index'));
        }

        $mlBuild = $this->mlBuildRepository->update($request->all(), $id);

        Flash::success('Ml Build updated successfully.');

        return redirect(route('mlBuilds.index'));
    }

    /**
     * Remove the specified Ml_build from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|Response
     */
    public function destroy($id)
    {
        // $productVersion = $this->productVersionRepository->findWithoutFail($id);

        // if (empty($productVersion)) {
        //     Flash::error('Product Version not found');

        //     return redirect(route('productVersions.index'));
        // }

        // $this->productVersionRepository->delete($id);

        Flash::warning('Deletion not supported.');

        return redirect(route('productVersions.index'));
    }
}
