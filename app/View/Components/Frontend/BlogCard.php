<?php

namespace App\View\Components\Frontend;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BlogCard extends Component
{
    public $blog;
    /**
     * Create a new component instance.
     */
    public function __construct($blog)
    {
        $this->blog = $blog;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.blog-card');
    }
}
