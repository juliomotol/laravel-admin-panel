<?php

namespace JulioMotol\AdminPanel\Views;

use Illuminate\View\Component;

class AdminPanel extends Component
{
    public function __construct(
        public readonly string $app_logo
    ) {
    }

    public function render()
    {
        return view('admin-panel::main');
    }
}
