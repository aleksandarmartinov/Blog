<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class IndexController extends BaseController {

    public function index()
    {
        echo $this->blade->make('index', ['posts' => []])->render();
    }

}