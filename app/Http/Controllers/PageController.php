<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    function pb(Request $request)
    {
        $version = $_GET['version'];
        $level = 76654;


        return view(
            'pb',
            [
                'version' => $version,
                'level' => $level,
            ]
        );
    }
}
