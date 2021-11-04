<?php

namespace App\View\Components;

use Illuminate\View\Component;

class HomeworkViewer extends Component
{
    /**
     * @var array
     */
    public $d;

    /**
     * @var boolean
     */
    public $disabled;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($d, $disabled = false)
    {
        $this->d = $d;
        $this->disabled = $disabled;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.homework-viewer');
    }
}
