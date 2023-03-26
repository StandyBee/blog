<?php

namespace App\Http\Controllers\Admin\Main;


class AdminIndexController extends BaseController
{
    public function index()
    {
        return view('admin.main.index');
    }
}
