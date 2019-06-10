<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\NullModel;

use App\Models\Role;

use App\Http\Requests\UserFormRequest;
use Mail;

// use App\Http\Requests\UserStoreRequest;
// use App\Http\Requests\UserChangePasswordRequest;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Mail::send('auth.login', ['key' => 'value'], function ($message) {
            $message
                -> to('s.tobys@gmail.com', 'John Smith')
                -> subject('Welcome!');
        });

        // Mail::to($request->user())->send(new OrderShipped($order));

        $models = User::orderBy('last_name', 'asc') -> withoutRoot() -> filter() -> paginate(session()->get('itemsPerIndexPage', $this -> paginate_size));

        return view('users.index', compact('models'));
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return View
     */
    public function trash()
    {
        $models = User::orderBy('last_name', 'asc')
                        -> onlyTrashed()
                        -> withoutRoot()
                        -> filter()
                        -> paginate(session()->get('itemsPerIndexPage', $this -> paginate_size));

        return view('users.index', compact('models'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new NullModel;
        $roles = Role::orderBy('name', 'asc')->pluck('name', 'id');

        return view('users.create', compact('model', 'permissionsGroups', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFormRequest $request)
    {
        $model = User::create($request->input());

        if ($model -> hasErrors()) {
            return redirect()->back()->withInput()->withErrors($model->getErrors());
        }

        $roles = $request->input('roles') ?: [];
        $model -> roles() -> sync($roles);

        return redirect()->route('users-index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function show(User $model)
    {
        return view('users.show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function edit(User $model)
    {
        $roles = Role::orderBy('name', 'asc')->pluck('name', 'id');

        return view('users.edit', compact('model', 'permissionsGroups', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function update(UserFormRequest $request, User $model)
    {
        if ($model -> fill($request->input()) -> save()) {
            $model -> roles() -> sync(array_wrap($request->input('roles_ids')));

            return redirect() -> route('users-index');
        }

        return redirect() -> back() -> withInput() -> withErrors($model->getErrors());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $User
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $model)
    {
        if ($model -> delete()) {
            session()->flash('element-delete-confirmation', 'element usuniety');
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Plant  $model
     * @return Response
     */
    public function delete(User $model)
    {
        if ($model -> delete()) {
            session()->flash('element-delete-confirmation', 'element usuniety');
        }

        return redirect()->back();
    }

    /**
     * Bulk remove the specified resource from storage.
     *
     * @return Response
     */
    public function deleteBulk(Request $request)
    {
        $ids = $request->input('selected_rows');
        $ids = array_keys(empty($ids) ? [] : $ids);

        $result = null;
        if (!empty($ids)) {
            $result = User::whereIn('id', $ids)->delete();

            if ($result) {
                session()->flash('element-delete-confirmation', 'Usuniętych elementów: '. $result);
            }
        }

        return redirect()->back();
    }

    /**
     * Restore the specified resource.
     *
     * @param  Plant  $model
     * @return Response
     */
    public function restore(User $model)
    {
        if ($model -> restore()) {
            session()->flash('element-restore-confirmation', 'element przywrocony');
        }

        return redirect()->route('users-trash');
    }

    /**
     * Bulk restore the specified resource.
     *
     * @return Response
     */
    public function restoreBulk(Request $request)
    {
        $ids = $request->input('selected_rows');
        $ids = array_keys(empty($ids) ? [] : $ids);

        $result = null;
        if (!empty($ids)) {
            $result = User::whereIn('id', $ids)->restore();

            if ($result) {
                session()->flash('element-restore-confirmation', 'Przywróconych elementów: '. $result);
            }
        }

        return redirect()->back();
    }

    /**
     * Show users profile page
     *
     * @param  User  $model
     * @return Response
     */
    public function profile(User $model = null)
    {
        if (is_null($model)) {
            $user = auth()->user();
        }

        return view('users.profile', compact('model'));
    }

    /**
     * Show users change pass page / Changes user's pass
     *
     * @param  User  $model
     * @return Response
     */
    public function changePassword(UserChangePasswordRequest $request, User $model)
    {
        $selfPasswordChange = false;

        // -- jezeli brak usera, user zmiania swoje haslo
        if (! $model -> loaded()) {
            $selfPasswordChange = true;
            $model = auth()->user();
        }
        // -- jezeli jest user, user zmiania cude haslo (lub swoje, ale przez zdefiniowanie usera w linku)
        else {
            // -- jezeli wylaczona zmiana hasla dla innych userow
            if (! settings('allow-users-password-change-by-admin', false)) {
                Flash::error(trans('users.flash.users-password-changes-not-allowed'));
                // return redirect() -> back();
                return redirect()->route('users-index');
            }
        }

        if (request()->isMethod('PATCH')) {
            $post = request()->all();

            if ($selfPasswordChange) {
                if (! $model -> verifyPassword($post['old_password'])) {
                    $validator = Validator::make([], []);
                    $validator -> errors() -> add('old_password', 'Old Password is incorrect!');

                    Flash::success(trans('users.flash.old-password-does-not-match'));
                    return redirect() -> back() -> withErrors($validator->errors());
                }
            }

            $model -> setPassword($post['new_password']);
            Flash::success(trans('users.flash.password-successfuly-changed'));
            return redirect()->route('users-index');
        } else {
            return view('users.password', compact('model', 'selfPasswordChange'));
        }
    }
}
