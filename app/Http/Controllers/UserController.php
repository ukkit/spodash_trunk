<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\UserRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\User;
use DB;
use App\Models\Team;
use App\Models\Role;
use App\Models\Permission;
use App\Authorizable;

class UserController extends AppBaseController
{
    use Authorizable;

    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $users = $this->userRepository->all();

        return view('users.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $this->validate($request, [
            'name' => 'bail|required|min:2',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'roles' => 'required|min:1'
        ]);

        // hash password
        $request->merge(['password' => bcrypt($request->get('password'))]);

        // Create the user
        if ( $user = User::create($request->except('roles', 'permissions')) ) {

            $this->syncPermissions($request, $user);

            flash('User has been created.');

        } else {
            flash()->error('Unable to create user.');
        }

        return redirect()->route('users.index');

        // $input = $request->all();

        // $user = $this->userRepository->create($input);

        // Flash::success('User saved successfully.');

        // return redirect(route('users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        $roles = Role::where('name','<>','superadmin')->pluck('name', 'id');
        $permissions = Permission::all('name', 'id');
        $tm_arr['teams_arr'] = DB::table('user_has_teams')->where('user_id',$id)->get();
        $team_ALL_id=DB::table('teams')->where('team_name',"ALL")->pluck('id')->first();
        $team_list['teams'] = \App\Models\Team::all()->except($team_ALL_id);
        return view('users.edit', compact('user', 'roles', 'permissions'))
        ->with($tm_arr)
        ->with($team_list)
        ->with('this_is_edit', true);
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $this->validate($request, [
            'name' => 'bail|required|min:2',
            'roles' => 'required|min:1'
        ]);

        // Get the user
        $user = User::findOrFail($id);

        // $user = $this->userRepository->find($id);
        $user->fill($request->except('roles', 'permissions', 'password'));

        // Handle the user roles
        $this->syncPermissions($request, $user);

        $user->save();



        DB::table('user_has_teams')->where('user_id',$id)->delete();
        #$teams_to_update=$request->get('teams');
        $teams_to_update=$request->get('teamName');

        if (!empty($teams_to_update) > 0)
        {

            foreach ($teams_to_update as $tu) {

             DB::table('user_has_teams')->insert(
                ['user_id' => $id, 'team_id' => $tu]
                );


            }
        }

        flash()->success('User has been updated.');

        return redirect()->route('users.index');

    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('users.index'));
    }

    private function syncPermissions(Request $request, $user)
    {
        // Get the submitted roles
        $roles = $request->get('roles', []);
        $permissions = $request->get('permissions', []);

        // Get the roles
        $roles = Role::find($roles);

        // check for current role changes
        if( ! $user->hasAllRoles( $roles ) ) {
            // reset all direct permissions for user
            $user->permissions()->sync([]);
        } else {
            // handle permissions
            $user->syncPermissions($permissions);
        }

        $user->syncRoles($roles);

        return $user;
    }

}
