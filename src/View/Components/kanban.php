<?php

namespace MrShaneBarron\Kanban\View\Components;

use Illuminate\View\Component;

class Kanban extends Component
{
    public function __construct()
    {
        //
    }

    public function render()
    {
        return view('sb-kanban::components.kanban');
    }
}
