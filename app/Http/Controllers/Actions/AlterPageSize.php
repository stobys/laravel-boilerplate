<?php

namespace App\Http\Controllers\Actions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlterPageSize extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $itemsPerPage = $request->input('items-per-page') ?: 10;
        session()->put('itemsPerIndexPage', $itemsPerPage);

        return redirect()->back();
    }
}
