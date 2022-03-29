<?php

namespace App\Controllers;

use Jenssegers\Blade\Blade;

class BaseController {

    public $blade;

    public function __construct()
    {
        $this->blade = new Blade('src/views', 'src/cache');
    }

}