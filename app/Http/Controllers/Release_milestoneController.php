<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRelease_milestoneRequest;
use App\Http\Requests\UpdateRelease_milestoneRequest;
use App\Repositories\Release_milestoneRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use DB;
use Auth;


class Release_milestoneController extends AppBaseController
{
    /** @var  Release_milestoneRepository */
    private $releaseMilestoneRepository;

    public function __construct(Release_milestoneRepository $releaseMilestoneRepo)
    {
        $this->releaseMilestoneRepository = $releaseMilestoneRepo;
    }

    /**
     * Display a listing of the Release_milestone.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $releaseMilestones = $this->releaseMilestoneRepository->all();

        return view('release_milestones.index')
            ->with('releaseMilestones', $releaseMilestones);
    }

    /**
     * Show the form for creating a new Release_milestone.
     *
     * @return Response
     */
    public function create()
    {

        $rel_arr['release_number'] = DB::table('release_numbers')
                ->whereNull('release_numbers.released_date')
                ->whereNotIn('release_numbers.id', function($query) {
                    $query->select('release_milestones.release_numbers_id')->from('release_milestones');
                })
                ->get();

        return view('release_milestones.create')
            ->with('this_is_edit', false)
            ->with('show_is_active', false)
            ->with($rel_arr);
    }

    /**
     * Store a newly created Release_milestone in storage.
     *
     * @param CreateRelease_milestoneRequest $request
     *
     * @return Response
     */
    public function store(CreateRelease_milestoneRequest $request)
    {
        $input = $request->all();

        $releaseMilestone = $this->releaseMilestoneRepository->create($input);

        Flash::success('Release Milestone saved successfully.');

        return redirect(route('releaseMilestones.index'));
    }

    /**
     * Display the specified Release_milestone.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $releaseMilestone = $this->releaseMilestoneRepository->find($id);

        if (empty($releaseMilestone)) {
            Flash::error('Release Milestone not found');

            return redirect(route('releaseMilestones.index'));
        }

        return view('release_milestones.show')->with('releaseMilestone', $releaseMilestone);
    }

    /**
     * Show the form for editing the specified Release_milestone.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $releaseMilestone = $this->releaseMilestoneRepository->find($id);

        $rel_arr['release_number'] = DB::table('release_numbers')
                ->whereNull('release_numbers.released_date')
                ->whereNotIn('release_numbers.id', function($query) {
                    $query->select('release_milestones.release_numbers_id')->from('release_milestones');
                })
                ->get();

        // $rel_arr['release_number'] = DB::seleactRaw

        if (empty($releaseMilestone)) {
            Flash::error('Release Milestone not found');

            return redirect(route('releaseMilestones.index'));
        }

        return view('release_milestones.edit')
        ->with('show_is_active', true)
        ->with('this_is_edit', true)
        ->with($rel_arr)
        ->with('releaseMilestone', $releaseMilestone);
    }

    /**
     * Update the specified Release_milestone in storage.
     *
     * @param int $id
     * @param UpdateRelease_milestoneRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRelease_milestoneRequest $request)
    {
        $releaseMilestone = $this->releaseMilestoneRepository->find($id);

        if (empty($releaseMilestone)) {
            Flash::error('Release Milestone not found');

            return redirect(route('releaseMilestones.index'));
        }

        $releaseMilestone = $this->releaseMilestoneRepository->update($request->all(), $id);

        Flash::success('Release Milestone updated successfully.');

        return redirect(route('releaseMilestones.index'));
    }

    /**
     * Remove the specified Release_milestone from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $releaseMilestone = $this->releaseMilestoneRepository->find($id);

        if (empty($releaseMilestone)) {
            Flash::error('Release Milestone not found');

            return redirect(route('releaseMilestones.index'));
        }

        $this->releaseMilestoneRepository->delete($id);

        Flash::success('Release Milestone deleted successfully.');

        return redirect(route('releaseMilestones.index'));
    }


}
