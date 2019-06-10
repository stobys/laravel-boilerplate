<?php namespace App\Presenters;

// -- https://github.com/laracasts/Presenter
use Laracasts\Presenter\Presenter;

class AuthPermissionPresenter extends Presenter {

    public function title()
    {
        return trans('permissions.'. $this -> name);
    }

}