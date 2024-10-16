@php
$route = request()->route()->getName();
@endphp
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ auth()->user()->pro_pic }}" class="img-circle elevation-2" style="width: 2.5rem; height: 2.5rem;"
                alt="User Image">
        </div>
        <div class="info">
            <a href="{{ route('backend.admin.profile') }}" class="d-block">
                {{ auth()->user()->name }}
            </a>
        </div>
    </div>


    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('backend.admin.dashboard') }}"
                    class="nav-link {{ $route === 'backend.admin.dashboard' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('backend.admin.cart.index') }}"
                    class="nav-link {{ $route === 'backend.admin.cart.index' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-cart-plus"></i>
                    <p>
                        POS
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link {{ request()->routeIs(['backend.admin.orders.index', 'backend.admin.orders.create', 'backend.admin.orders.edit']) ? 'menu-open' : '' }}">
                    <i class="fas fa-chevron-circle-up nav-icon"></i>
                    <p>
                        People
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('backend.admin.customers.index')}}"
                            class="nav-link {{ request()->routeIs(['backend.admin.customers.index']) ? 'active' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Customer</p>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('backend.admin.suppliers.index')}}"
                            class="nav-link {{ request()->routeIs(['backend.admin.suppliers.index']) ? 'active' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Supplier</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item {{ request()->routeIs(['backend.admin.products.index', 'backend.admin.products.create', 'backend.admin.products.edit', 'backend.admin.brands.index', 'backend.admin.brands.create', 'backend.admin.brands.edit', 'backend.admin.categories.index', 'backend.admin.categories.create', 'backend.admin.categories.edit']) ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ request()->routeIs(['backend.admin.products.index', 'backend.admin.products.create', 'backend.admin.products.edit', 'backend.admin.brands.index', 'backend.admin.brands.create', 'backend.admin.brands.edit', 'backend.admin.categories.index', 'backend.admin.categories.create', 'backend.admin.categories.edit']) ? 'active' : '' }}">

                    <i class="fas fa-box nav-icon"></i>
                    <p>
                        Product
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('backend.admin.products.index')}}"
                            class="nav-link {{ request()->routeIs(['backend.admin.products.index', 'backend.admin.products.edit']) ? 'active' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Product List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('backend.admin.products.create')}}"
                            class="nav-link {{ request()->routeIs(['backend.admin.products.create']) ? 'active' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Product Create</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('backend.admin.brands.index')}}"
                            class="nav-link {{ request()->routeIs(['backend.admin.brands.index', 'backend.admin.brands.create', 'backend.admin.brands.edit']) ? 'active' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Brand</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('backend.admin.categories.index')}}"
                            class="nav-link {{ request()->routeIs([ 'backend.admin.categories.index', 'backend.admin.categories.create', 'backend.admin.categories.edit']) ? 'active' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Category</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link {{ request()->routeIs(['backend.admin.orders.index', 'backend.admin.orders.create', 'backend.admin.orders.edit']) ? 'menu-open' : '' }}">
                    <i class="fas fa-chevron-circle-up nav-icon"></i>
                    <p>
                        Sale
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('backend.admin.orders.index')}}"
                            class="nav-link {{ request()->routeIs(['backend.admin.orders.index']) ? 'active' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Sale List</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="#" class="nav-link {{ request()->routeIs(['backend.admin.purchase.index', 'backend.admin.purchase.create', 'backend.admin.purchase.edit']) ? 'menu-open' : '' }}">
                    <i class="fas fa-chevron-circle-up nav-icon"></i>
                    <p>
                        Purchase
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('backend.admin.purchase.index')}}"
                            class="nav-link {{ request()->routeIs(['backend.admin.purchase.index']) ? 'active' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Purchase List</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link {{ request()->routeIs(['backend.admin.sale.report','backend.admin.sale.summery']) ? 'menu-open' : '' }}">
                    <i class="fas fa-chart-bar nav-icon"></i>
                    <p>
                        Reports
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('backend.admin.sale.summery')}}"
                            class="nav-link {{ request()->routeIs(['backend.admin.sale.summery']) ? 'active' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Summery</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('backend.admin.sale.report')}}"
                            class="nav-link {{ request()->routeIs(['backend.admin.sale.report']) ? 'active' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Sale</p>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- settings --}}
            <li class="nav-header">SETTINGS</li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fas fa-cog nav-icon"></i>
                    <p>
                        Website Settings
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('backend.admin.settings.website.general') }}?active-tab=website-info"
                            class="nav-link {{ $route === 'backend.admin.settings.website.general' ? 'active' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>General Settings</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link d-flex justify-content-between align-items-center">
                            <span>
                                <i class="fas fa-chevron-circle-right nav-icon"></i>
                                Roles & Permissions
                            </span>
                            <span class="d-flex justify-content-between align-items-center">
                                <i class="fas fa-angle-left right"></i>
                            </span>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('backend.admin.roles') }}"
                                    class="nav-link {{ $route === 'backend.admin.roles' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Roles</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('backend.admin.permissions') }}"
                                    class="nav-link {{ $route === 'backend.admin.permissions' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Permissions</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('backend.admin.users') }}"
                            class="nav-link {{ $route === 'backend.admin.users' ? 'active' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>User Management</p>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>

<script>
    // Get all elements with the nav-treeview class
    const treeviewElements = document.querySelectorAll('.nav-treeview');

    // Iterate over each treeview element
    treeviewElements.forEach(treeviewElement => {
        // Check if it has the nav-link and active classes
        const navLinkElements = treeviewElement.querySelectorAll('.nav-link.active');

        // If there are nav-link elements with the active class, log the treeview element
        if (navLinkElements.length > 0) {
            // Add the menu-open class to the parent nav-item
            const parentNavItem = treeviewElement.closest('.nav-item');
            if (parentNavItem) {
                parentNavItem.classList.add('menu-open');
            }

            // Add the active class to the immediate child nav-link
            const childNavLink = parentNavItem.querySelector('.nav-link');
            if (childNavLink) {
                childNavLink.classList.add('active');
            }
        }
    });
</script>