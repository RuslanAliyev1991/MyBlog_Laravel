<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Header extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     * 
     */
    public function __construct($headerTitle, $headerInfo,$headerImage=null, $postBy = null)
    {
        $this->headerTitle = $headerTitle;
        $this->headerInfo = $headerInfo;
        $this->headerImage=$headerImage;
        $this->postBy = $postBy;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.header', ['headerInfo' => $this->headerInfo, 'headerTitle' => $this->headerTitle,'headerImage'=>$this->headerImage, 'postBy' => $this->postBy ?? null]);
    }
}