<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Requests\CreateUserRequest;

use App\Models\PermissionGroup;
use App\Models\Role;
use App\Models\NullModel;

class UsersRolesController extends Controller
{

    /**
     * List specified resource from storage.
     *
     * @return View
     */
    public function index()
    {
        $models = Role::orderBy('name', 'asc') -> filter()
                    -> paginate(session() -> get('itemsPerIndexPage', $this -> paginate_size));

        return view('users.roles.index', compact('models'));
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return View
     */
    public function trash()
    {
        $models = Role::orderBy('name', 'asc')
            -> onlyTrashed()
            -> filter()
            -> paginate(session()->get('itemsPerIndexPage', $this -> paginate_size));

        return view('users.roles.index', compact('models'));
    }

    /**
     * Edit the specified resource from storage.
     *
     * @param  Role  $model
     * @return Response
     */
    public function edit(Role $model)
    {
        $permissionsGroups = PermissionGroup::orderBy('position')->with('permissions')->get();

        return view('users.roles.edit', compact('model', 'permissionsGroups'));
    }

    /**
     * -- UPDATE the specified resource
     *
     * @param  Request  $request
     * @param  Role  $model
     * @return Response
     */
    public function update(Request $request, Role $model)
    {
        if ($model -> fill($request->input()) -> save()) {
            $model -> permissions() -> sync($request->input('permissions'));
            return redirect()->route('users-roles-index');
        }

        return redirect()->back()->withInput()->withErrors($model->getErrors());
    }

    /**
     * Create the specified resource from storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create(Request $request)
    {
        $model = new NullModel;
        $permissionsGroups = PermissionGroup::orderBy('position')->with('permissions')->get();

        return view('users.roles.create', compact('model', 'permissionsGroups'));
    }

    /**
     * -- STORE the specified resource
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $model = Role::create($request->input());

        if ($model -> hasErrors()) {
            return redirect()->back()->withInput()->withErrors($model->getErrors());
        }

        $model -> permissions() -> sync($request->input('permissions'));

        return redirect()->route('users-roles-index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Role  $model
     * @return Response
     */
    public function delete(Role $model)
    {
        if ($model -> delete()) {
            session()->flash('model-delete-confirmation', trans('users.model.delete-confirmation'));
        }

        return redirect()->back();
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  Role  $model
     * @return Response
     */
    public function restore(Role $model)
    {
        if ($model -> restore()) {
            session()->flash('model-restore-confirmation', trans('users.model.restore-confirmation'));
        }

        return redirect()->route('users-roles-trash');
    }

    /**
     * Show the specified resource from storage.
     *
     * @param  Role  $model
     * @return Response
     */
    public function show(Role $model)
    {
        return view('users.roles.show', compact('model'));
    }
}
