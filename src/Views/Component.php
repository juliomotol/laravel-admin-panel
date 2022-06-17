<?php

namespace JulioMotol\AdminPanel\Views;

use Illuminate\View\Component as BaseComponent;

class Component extends BaseComponent
{
    public function render()
    {
        return view('admin-panel::main');
    }
}
