<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSf_buildRequest;
use App\Http\Requests\UpdateSf_buildRequest;
use App\Models\Sf_build;
use App\Repositories\Sf_buildRepository;
use Flash;
use Illuminate\Http\Request;

class Sf_buildController extends AppBaseController
{
    /** @var Sf_buildRepository */
    private $sfBuildRepository;

    public function __construct(Sf_buildRepository $sfBuildRepo)
    {
        $this->sfBuildRepository = $sfBuildRepo;
    }

    public function index(Request $request)
    {
        $sfBuilds = $this->sfBuildRepository->all();

        return view('sf_builds.index')
            ->with('sfBuilds', $sfBuilds);
    }

    public function create()
    {
        return view('sf_builds.create')->with('this_is_edit', false);
    }

    public function store(CreateSf_buildRequest $request)
    {
        $input = $request->all();

        $strip_pvn = preg_replace('/[^0-9]/', '', $input['sf_pai_version']);
        $strip_pbn = preg_replace('/[^0-9]/', '', $input['sf_pai_build']);
        $old_pvid = $strip_pvn.$strip_pbn;
        $pv_id = $strip_pvn.'_'.$strip_pbn;

        // Generating pv_id by merging numbers of sf_pai_version and sf_pai_build
        $input['pv_id'] = $pv_id;
        $input['old_pvid'] = $old_pvid;

        $sfBuild = $this->sfBuildRepository->create($input);

        Flash::success('SF Build saved successfully.');

        return redirect(route('sfBuilds.index'));
    }

    public function show($id)
    {
        $sfBuild = $this->sfBuildRepository->find($id);

        if (empty($sfBuild)) {
            Flash::error('Sf Build not found');

            return redirect(route('sfBuilds.index'));
        }

        return view('sf_builds.show')->with('sfBuild', $sfBuild);
    }

    public function edit($id)
    {
        $sfBuild = $this->sfBuildRepository->find($id);

        if (empty($sfBuild)) {
            Flash::error('Sf Build not found');

            return redirect(route('sfBuilds.index'));
        }

        $rec_arr['record'] = Sf_build::where('id', $id)->get()->first();

        return view('sf_builds.edit')
            ->with('sfBuild', $sfBuild)
            ->with($rec_arr)
            ->with('this_is_edit', true);
    }

    public function update($id, UpdateSf_buildRequest $request)
    {
        $sfBuild = $this->sfBuildRepository->find($id);

        if (empty($sfBuild)) {
            Flash::error('Sf Build not found');

            return redirect(route('sfBuilds.index'));
        }

        $sfBuild = $this->sfBuildRepository->update($request->all(), $id);

        Flash::success('Sf Build updated successfully.');

        return redirect(route('sfBuilds.index'));
    }

    public function destroy($id)
    {
        $sfBuild = $this->sfBuildRepository->find($id);

        if (empty($sfBuild)) {
            Flash::error('Sf Build not found');

            return redirect(route('sfBuilds.index'));
        }

        // $this->sfBuildRepository->delete($id);

        Flash::success('Sf Build deleted successfully.');

        return redirect(route('sfBuilds.index'));
    }
}
