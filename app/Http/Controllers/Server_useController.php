<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateServer_useRequest;
use App\Http\Requests\UpdateServer_useRequest;
use App\Repositories\Server_useRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Authorizable;

class Server_useController extends AppBaseController
{
    use Authorizable;

    /** @var  Server_useRepository */
    private $serverUseRepository;

    public function __construct(Server_useRepository $serverUseRepo)
    {
        $this->serverUseRepository = $serverUseRepo;
    }

    /**
     * Display a listing of the Server_use.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->serverUseRepository->pushCriteria(new RequestCriteria($request));
        $serverUses = $this->serverUseRepository->all();

        return view('server_uses.index')
            ->with('serverUses', $serverUses);
    }

    /**
     * Show the form for creating a new Server_use.
     *
     * @return Response
     */
    public function create()
    {
        return view('server_uses.create');
    }

    /**
     * Store a newly created Server_use in storage.
     *
     * @param CreateServer_useRequest $request
     *
     * @return Response
     */
    public function store(CreateServer_useRequest $request)
    {
        $input = $request->all();

        $serverUse = $this->serverUseRepository->create($input);

        Flash::success('Server Use saved successfully.');

        return redirect(route('serverUses.index'));
    }

    /**
     * Display the specified Server_use.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $serverUse = $this->serverUseRepository->findWithoutFail($id);

        if (empty($serverUse)) {
            Flash::error('Server Use not found');

            return redirect(route('serverUses.index'));
        }

        return view('server_uses.show')->with('serverUse', $serverUse);
    }

    /**
     * Show the form for editing the specified Server_use.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $serverUse = $this->serverUseRepository->findWithoutFail($id);

        if (empty($serverUse)) {
            Flash::error('Server Use not found');

            return redirect(route('serverUses.index'));
        }

        return view('server_uses.edit')->with('serverUse', $serverUse);
    }

    /**
     * Update the specified Server_use in storage.
     *
     * @param  int              $id
     * @param UpdateServer_useRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateServer_useRequest $request)
    {
        $serverUse = $this->serverUseRepository->findWithoutFail($id);

        if (empty($serverUse)) {
            Flash::error('Server Use not found');

            return redirect(route('serverUses.index'));
        }

        $serverUse = $this->serverUseRepository->update($request->all(), $id);

        Flash::success('Server Use updated successfully.');

        return redirect(route('serverUses.index'));
    }

    /**
     * Remove the specified Server_use from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $serverUse = $this->serverUseRepository->findWithoutFail($id);

        if (empty($serverUse)) {
            Flash::error('Server Use not found');

            return redirect(route('serverUses.index'));
        }

        $this->serverUseRepository->delete($id);

        Flash::success('Server Use deleted successfully.');

        return redirect(route('serverUses.index'));
    }
}
