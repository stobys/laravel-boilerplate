<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Requests\CreateUserRequest;

use App\Models\PermissionGroup;
use App\Models\Permission;
use App\Models\NullModel;

class UsersPermissionsController extends Controller
{

    /**
     * List specified resource from storage.
     *
     * @return View
     */
    public function index()
    {
        $models = Permission::orderBy('name', 'asc') -> filter()
                    -> paginate(session() -> get('itemsPerIndexPage', $this -> paginate_size));

        return view('users.permissions.index', compact('models'));
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return View
     */
    public function trash()
    {
        $models = Permission::orderBy('name', 'asc')
            -> onlyTrashed()
            -> filter()
            -> paginate(session()->get('itemsPerIndexPage', $this -> paginate_size));

        return view('users.permissions.index', compact('models'));
    }

    /**
     * Edit the specified resource from storage.
     *
     * @param  Permission  $model
     * @return Response
     */
    public function edit(Permission $model)
    {
        $permissionsGroups = PermissionGroup::orderBy('position')->pluck('code', 'id')->prepend('---', 0);

        return view('users.permissions.edit', compact('model', 'permissionsGroups'));
    }

    /**
     * -- UPDATE the specified resource
     *
     * @param  Request  $request
     * @param  Permission  $model
     * @return Response
     */
    public function update(Request $request, Permission $model)
    {
        $data = $request->input();
        if (!$request -> has('group_id') || empty($request -> get('group_id'))) {
            $data['group_id'] = null;
        }

        if ($model -> fill($data) -> save()) {
            return redirect()->route('users-permissions-index');
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
        $permissionsGroups = PermissionGroup::orderBy('position')->pluck('code', 'id')->prepend('---', 0);

        return view('users.permissions.create', compact('model', 'permissionsGroups'));
    }

    /**
     * -- STORE the specified resource
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->input();

        if (!$request -> has('group_id') || empty($request -> get('group_id'))) {
            $data['group_id'] = null;
        }

        $model = Permission::create($data);

        if ($model -> hasErrors()) {
            return redirect()->back()->withInput()->withErrors($model->getErrors());
        }

        return redirect()->route('users-permissions-index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Permission  $model
     * @return Response
     */
    public function delete(Permission $model)
    {
        if ($model -> delete()) {
            session()->flash('model-delete-confirmation', trans('users.model.delete-confirmation'));
        }

        return redirect()->back();
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  Permission  $model
     * @return Response
     */
    public function restore(Permission $model)
    {
        if ($model -> restore()) {
            session()->flash('model-restore-confirmation', trans('users.model.restore-confirmation'));
        }

        return redirect()->route('users-permissions-trash');
    }

    /**
     * Show the specified resource from storage.
     *
     * @param  Permission  $model
     * @return Response
     */
    public function show(Permission $model)
    {
        return view('users.permissions.show', compact('model'));
    }
}
