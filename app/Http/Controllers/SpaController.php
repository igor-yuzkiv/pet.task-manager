<?php

namespace App\Http\Controllers;

class SpaController
{
    public function __invoke()
    {
        return view('app');
    }
}
