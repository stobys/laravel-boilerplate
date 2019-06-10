<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use App\Models\NullModel;

use Debugbar;
use Session;

class SettingsController extends Controller {

    /**
     * List specified resource from storage.
     *
     * @return View
     */
    public function sidebar()
    {
        if ( request()->has('itemsPerPage') ) {
            session()->put('itemsPerIndexPage', request()->input('itemsPerPage') );
        }

        settings()->set('allow-users-password-change-by-admin', request()->has('allow-users-password-change-by-admin') );
     
        
        $this->ajax_result['itemsPerPage'] = request()->input('itemsPerPage');

        return response()->json( $this->ajax_result );
    }

}
