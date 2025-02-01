<?php

namespace App\Core\Http\Controllers;

class SpaController
{
    public function __invoke()
    {
        return view('app');
    }
}
