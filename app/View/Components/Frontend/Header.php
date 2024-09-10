<?php

namespace App\View\Components\Frontend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    public $user;
    public $route_name;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->user = auth()->user();
        $this->route_name = request()->route() !== null ? request()->route()->getName() : 'unknown';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.header');
    }
}
