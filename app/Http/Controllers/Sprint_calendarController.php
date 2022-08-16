<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSprint_calendarRequest;
use App\Http\Requests\UpdateSprint_calendarRequest;
use App\Repositories\Sprint_calendarRepository;
use Flash;
use Illuminate\Http\Request;
use Response;

class Sprint_calendarController extends AppBaseController
{
    /** @var Sprint_calendarRepository */
    private $sprintCalendarRepository;

    public function __construct(Sprint_calendarRepository $sprintCalendarRepo)
    {
        $this->sprintCalendarRepository = $sprintCalendarRepo;
    }

    /**
     * Display a listing of the Sprint_calendar.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $sprintCalendars = $this->sprintCalendarRepository->all();

        return view('sprint_calendars.index')
            ->with('sprintCalendars', $sprintCalendars);
    }

    /**
     * Show the form for creating a new Sprint_calendar.
     *
     * @return Response
     */
    public function create()
    {
        return view('sprint_calendars.create');
    }

    /**
     * Store a newly created Sprint_calendar in storage.
     *
     * @param  CreateSprint_calendarRequest  $request
     * @return Response
     */
    public function store(CreateSprint_calendarRequest $request)
    {
        $input = $request->all();

        $sprintCalendar = $this->sprintCalendarRepository->create($input);

        Flash::success('Sprint Calendar saved successfully.');

        return redirect(route('sprintCalendars.index'));
    }

    /**
     * Display the specified Sprint_calendar.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $sprintCalendar = $this->sprintCalendarRepository->find($id);

        if (empty($sprintCalendar)) {
            Flash::error('Sprint Calendar not found');

            return redirect(route('sprintCalendars.index'));
        }

        return view('sprint_calendars.show')->with('sprintCalendar', $sprintCalendar);
    }

    /**
     * Show the form for editing the specified Sprint_calendar.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $sprintCalendar = $this->sprintCalendarRepository->find($id);

        if (empty($sprintCalendar)) {
            Flash::error('Sprint Calendar not found');

            return redirect(route('sprintCalendars.index'));
        }

        return view('sprint_calendars.edit')->with('sprintCalendar', $sprintCalendar);
    }

    /**
     * Update the specified Sprint_calendar in storage.
     *
     * @param  int  $id
     * @param  UpdateSprint_calendarRequest  $request
     * @return Response
     */
    public function update($id, UpdateSprint_calendarRequest $request)
    {
        $sprintCalendar = $this->sprintCalendarRepository->find($id);

        if (empty($sprintCalendar)) {
            Flash::error('Sprint Calendar not found');

            return redirect(route('sprintCalendars.index'));
        }

        $sprintCalendar = $this->sprintCalendarRepository->update($request->all(), $id);

        Flash::success('Sprint Calendar updated successfully.');

        return redirect(route('sprintCalendars.index'));
    }

    /**
     * Remove the specified Sprint_calendar from storage.
     *
     * @param  int  $id
     * @return Response
     *
     * @throws \Exception
     */
    public function destroy($id)
    {
        // $sprintCalendar = $this->sprintCalendarRepository->find($id);

        // if (empty($sprintCalendar)) {
        //     Flash::error('Sprint Calendar not found');

        //     return redirect(route('sprintCalendars.index'));
        // }

        // $this->sprintCalendarRepository->delete($id);

        // Flash::success('Sprint Calendar deleted successfully.');

        Flash::success('Deletion not supported.');

        return redirect(route('sprintCalendars.index'));
    }
}
