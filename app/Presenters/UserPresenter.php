<?php namespace App\Presenters;

use App\Models\TanzContact;
// -- https://github.com/laracasts/Presenter
use Laracasts\Presenter\Presenter;

use Carbon\Carbon;

class UserPresenter extends Presenter {

//    public function rolesList()
//    {
//        return implode(', ', $this->entity->roles()->orderBy('name')->lists('name')->toArray());
//    }

    public function fullName()
    {
        return implode(', ', [$this -> family_name, $this -> given_name]);
    }

    public function fuzzyLastLogin()
    {
    	return $this->last_login_at->diffForHumans();
    }

}