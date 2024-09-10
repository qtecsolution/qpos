<?php

namespace App\View\Components\Frontend;

use Closure;
use App\Models\Page;
use App\Models\Product;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Footer extends Component
{
    public $featured_products;
    public $pages;

    /**
     * Create a new component instance.
     */
    public function __construct(Product $product, Page $page)
    {
        $this->featured_products = $product->with(['category'])
            ->where('is_monthly_featured', 1)
            ->where('status', 1)
            ->latest()
            ->limit(3)
            ->get();


        $this->pages = Page::where('status', 1)
            ->orderBy('title', 'asc')
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.frontend.footer');
    }
}
