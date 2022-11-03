<?php

namespace App\View\Components;

use Illuminate\View\Component;

class sideItem extends Component
{
    public $text;
    public $route;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($text="",$route=null)
    {
        $this->text = $text;
        $this->route = $route;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.side-item');
    }
}
