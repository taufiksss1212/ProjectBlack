<?php

namespace App\Controllers\Landing;

use App\Controllers\BaseController;

class Katalog extends BaseController
{
    public function katalog()
    {
        return view('Landing/katalog');
    }
}
