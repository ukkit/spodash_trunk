<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePai_buildRequest;
use App\Http\Requests\UpdatePai_buildRequest;
use App\Repositories\Pai_buildRepository;
use Flash;
use Illuminate\Http\Request;

class Pai_buildController extends AppBaseController
{
    /** @var Pai_buildRepository */
    private $paiBuildRepository;

    public function __construct(Pai_buildRepository $paiBuildRepo)
    {
        $this->paiBuildRepository = $paiBuildRepo;
    }

    public function index(Request $request)
    {
        $paiBuilds = $this->paiBuildRepository->all();

        return view('pai_builds.index')
            ->with('paiBuilds', $paiBuilds);
    }

    public function create()
    {
        return view('pai_builds.create');
    }

    public function store(CreatePai_buildRequest $request)
    {
        $input = $request->all();

        $strip_pvn = preg_replace('/[^0-9]/', '', $input['pai_version']);
        $strip_pbn = preg_replace('/[^0-9]/', '', $input['pai_build']);
        $old_pvid = $strip_pvn.$strip_pbn;
        $pv_id = $strip_pvn.'_'.$strip_pbn;

        // Generating pv_id by merging numbers of pai_version and pai_build
        $input['pv_id'] = $pv_id;
        $input['old_pvid'] = $old_pvid;

        $paiBuild = $this->paiBuildRepository->create($input);

        Flash::success('Pai Build saved successfully.');

        return redirect(route('paiBuilds.index'));
    }

    public function show($id)
    {
        $paiBuild = $this->paiBuildRepository->find($id);

        if (empty($paiBuild)) {
            Flash::error('Pai Build not found');

            return redirect(route('paiBuilds.index'));
        }

        return view('pai_builds.show')->with('paiBuild', $paiBuild);
    }

    public function edit($id)
    {
        $paiBuild = $this->paiBuildRepository->find($id);

        if (empty($paiBuild)) {
            Flash::error('Pai Build not found');

            return redirect(route('paiBuilds.index'));
        }

        return view('pai_builds.edit')->with('paiBuild', $paiBuild);
    }

    public function update($id, UpdatePai_buildRequest $request)
    {
        $paiBuild = $this->paiBuildRepository->find($id);

        if (empty($paiBuild)) {
            Flash::error('Pai Build not found');

            return redirect(route('paiBuilds.index'));
        }

        $paiBuild = $this->paiBuildRepository->update($request->all(), $id);

        Flash::success('Pai Build updated successfully.');

        return redirect(route('paiBuilds.index'));
    }

    public function destroy($id)
    {
        $paiBuild = $this->paiBuildRepository->find($id);

        if (empty($paiBuild)) {
            Flash::error('Pai Build not found');

            return redirect(route('paiBuilds.index'));
        }

        // $this->paiBuildRepository->delete($id);

        Flash::success('Pai Build deleted successfully.');

        return redirect(route('paiBuilds.index'));
    }
}
