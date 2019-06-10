<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Requests\CreateUserRequest;

use App\Models\PermissionGroup;
use App\Models\NullModel;

class UsersPermissionsGroupsController extends Controller
{

    /**
     * List specified resource from storage.
     *
     * @return View
     */
    public function index()
    {
        $models = PermissionGroup::orderBy('code', 'asc') -> filter()
                    -> paginate(session() -> get('itemsPerIndexPage', $this -> paginate_size));

        return view('users.permissions-groups.index', compact('models'));
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return View
     */
    public function trash()
    {
        $models = PermissionGroup::orderBy('code', 'asc')
            -> onlyTrashed()
            -> filter()
            -> paginate(session()->get('itemsPerIndexPage', $this -> paginate_size));

        return view('users.permissions-groups.index', compact('models'));
    }

    /**
     * Edit the specified resource from storage.
     *
     * @param  PermissionGroup  $model
     * @return Response
     */
    public function edit(PermissionGroup $model)
    {
        return view('users.permissions-groups.edit', compact('model'));
    }

    /**
     * -- UPDATE the specified resource
     *
     * @param  Request  $request
     * @param  PermissionGroup  $model
     * @return Response
     */
    public function update(Request $request, PermissionGroup $model)
    {
        if ($model -> fill($request->input()) -> save()) {
            return redirect()->route('users-permissions-groups-index');
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

        return view('users.permissions-groups.create', compact('model'));
    }

    /**
     * -- STORE the specified resource
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $model = PermissionGroup::create($request->input());

        if ($model -> hasErrors()) {
            return redirect()->back()->withInput()->withErrors($model->getErrors());
        }

        return redirect()->route('users-permissions-groups-index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  PermissionGroup  $model
     * @return Response
     */
    public function delete(PermissionGroup $model)
    {
        if ($model -> delete()) {
            session()->flash('model-delete-confirmation', trans('users.model.delete-confirmation'));
        }

        return redirect()->back();
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  PermissionGroup  $model
     * @return Response
     */
    public function restore(PermissionGroup $model)
    {
        if ($model -> restore()) {
            session()->flash('model-restore-confirmation', trans('users.model.restore-confirmation'));
        }

        return redirect()->route('users-permissions-groups-trash');
    }

    /**
     * Show the specified resource from storage.
     *
     * @param  PermissionGroup  $model
     * @return Response
     */
    public function show(PermissionGroup $model)
    {
        return view('users.permissions-groups.show', compact('model'));
    }
}
