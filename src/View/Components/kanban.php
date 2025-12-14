<?php

namespace MrShaneBarron\kanban\View\Components;

use Illuminate\View\Component;

class kanban extends Component
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
