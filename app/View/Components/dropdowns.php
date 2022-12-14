<?php

namespace App\View\Components;

use Illuminate\View\Component;

class dropdowns extends Component
{
    public $text;
    public $add;
    public $id;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($text="",$add="",$id="")
    {
        $this->text = $text;
        $this->add = $add;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dropdowns');
    }
}
