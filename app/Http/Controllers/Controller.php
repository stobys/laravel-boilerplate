<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Flash;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $paginate_size = 10;

    protected $ajax_result = [
        'errno'     => 0,
        'errmsg'    => '',
        'html'      => '',
        'growl'     => [
            'error'     => [],
            'warning'   => [],
            'success'   => [],
            'notice'    => []
        ]
    ];

    public function __construct()
    {
        // $this -> middleware('auth', ['except' => ['showLoginForm', 'login']]);


        // Flash::success('User has been updated successfully.');
        // Flash::error('Oh snap!', 'Something went wrong. Please try again for a few seconds.');

        // flash('Sorry! Please try again.')->error();



        // flash('success')->success();
        // flash('error')->error();
        //flash('warning')->info()->important()->title('jakis fajny tytul');
        // flash('overlay')->success()->overlay();
        // flash()->overlay('Modal Message', 'Modal Title');
        // flash('important')->important();
        // flash('error important')->error()->important();


        $links = session()->has('links') ? session('links') : [];
        array_unshift($links, request()->path()); // Putting it in the beginning of links array
        if (count($links) == 5) {
            array_shift($links);
        }
        session()->put('links', $links); // Saving links array to the session

        // $this -> middleware('auth', ['except' => ['showLoginForm', 'login']]);

        // Asset::addScript('initAfterAjax();', 'ready');

        // if ( File::exists( public_path('assets/js/app-'. controllerName() .'.js') ) )
        // {
        //     // Asset::add('assets/js/app-'. controllerName() .'.js', 'footer');
        // }
    }
}
