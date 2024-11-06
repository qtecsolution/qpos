@php
$route = request()->route()->getName();
@endphp
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->

    <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ auth()->user()->pro_pic }}" class="img-circle elevation-2" style="width: 2.5rem; height: 2.5rem;"
                alt="User Image">
        </div>
        <div class="info">
            <a href="{{ route('backend.admin.profile') }}" class="d-block">
                {{ auth()->user()->name }}
            </a>
        </div>
    </div> -->


    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @can('dashboard_view')
            <li class="nav-item">
                <a href="{{ route('backend.admin.dashboard') }}"
                    class="nav-link {{ $route === 'backend.admin.dashboard' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            @endcan
            @can('sale_create')
            <li class="nav-item">
                <a href="{{ route('backend.admin.cart.index') }}"
                    class="nav-link {{ $route === 'backend.admin.cart.index' ? 'active' : '' }}">
                    <i class="nav-icon fas fa-cart-plus"></i>
                    <p>
                        POS
                    </p>
                </a>
            </li>
            @endcan
            @if (auth()->user()->hasAnyPermission([
            //customer
            'customer_create',
            'customer_view',
            'customer_update',
            'customer_delete',
            'customer_sales',
            //supplier
            'supplier_create',
            'supplier_view',
            'supplier_update',
            'supplier_delete',
            ]))
            <li class="nav-item {{ request()->routeIs(['backend.admin.customers.index', 'backend.admin.customers.create', 'backend.admin.customers.edit','backend.admin.suppliers.index', 'backend.admin.suppliers.create', 'backend.admin.suppliers.edit']) ? 'menu-open' : '' }}">
                <a href="#" class="nav-link">
                    <i class="fas fa-user-circle nav-icon"></i>
                    <p>
                        People
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @if (auth()->user()->hasAnyPermission(['customer_create','customer_view','customer_update','customer_delete']))
                    <li class="nav-item">
                        <a href="{{route('backend.admin.customers.index')}}"
                            class="nav-link {{ request()->routeIs(['backend.admin.customers.index','backend.admin.customers.edit','backend.admin.customers.create']) ? 'active' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Customer</p>
                        </a>
                    </li>
                    @endif
                </ul>
                <ul class="nav nav-treeview">
                    @if (auth()->user()->hasAnyPermission(['supplier_create','supplier_view','supplier_update','supplier_delete']))
                    <li class="nav-item">
                        <a href="{{route('backend.admin.suppliers.index')}}"
                            class="nav-link {{ request()->routeIs(['backend.admin.suppliers.index','backend.admin.suppliers.edit','backend.admin.suppliers.create']) ? 'active' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Supplier</p>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            @if (auth()->user()->hasAnyPermission([
            'product_create',
            'product_view',
            'product_update',
            'product_delete',
            'product_import',
            'product_purchase',
            ]))
            <li class="nav-item {{ request()->routeIs(['backend.admin.products.index', 'backend.admin.products.create', 'backend.admin.products.edit', 'backend.admin.brands.index', 'backend.admin.brands.create', 'backend.admin.brands.edit', 'backend.admin.categories.index', 'backend.admin.categories.create', 'backend.admin.categories.edit']) ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ request()->routeIs(['backend.admin.products.index', 'backend.admin.products.create', 'backend.admin.products.edit', 'backend.admin.brands.index', 'backend.admin.brands.create', 'backend.admin.brands.edit', 'backend.admin.categories.index', 'backend.admin.categories.create', 'backend.admin.categories.edit']) ? 'active' : '' }}">

                    <i class="fas fa-box nav-icon"></i>
                    <p>
                        Product
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @if (auth()->user()->hasAnyPermission(['product_view','product_update','product_delete']))
                    <li class="nav-item">
                        <a href="{{route('backend.admin.products.index')}}"
                            class="nav-link {{ request()->routeIs(['backend.admin.products.index', 'backend.admin.products.edit']) ? 'active' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Product List</p>
                        </a>
                    </li>
                    @endif
                    @can('product_create')
                    <li class="nav-item">
                        <a href="{{route('backend.admin.products.create')}}"
                            class="nav-link {{ request()->routeIs(['backend.admin.products.create']) ? 'active' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Product Create</p>
                        </a>
                    </li>
                    @endcan

                    @can('product_import')
                    <li class="nav-item">
                        <a href="{{route('backend.admin.products.import')}}"
                            class="nav-link {{ request()->routeIs(['backend.admin.products.import']) ? 'active' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Product Import</p>
                        </a>
                    </li>
                    @endcan
                    @if (auth()->user()->hasAnyPermission(['brand_create','brand_view','brand_update','brand_delete']))
                    <li class="nav-item">
                        <a href="{{route('backend.admin.brands.index')}}"
                            class="nav-link {{ request()->routeIs(['backend.admin.brands.index', 'backend.admin.brands.create', 'backend.admin.brands.edit']) ? 'active' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Brand</p>
                        </a>
                    </li>@endif
                    @if (auth()->user()->hasAnyPermission(['category_create','category_view','category_update','category_delete']))
                    <li class="nav-item">
                        <a href="{{route('backend.admin.categories.index')}}"
                            class="nav-link {{ request()->routeIs([ 'backend.admin.categories.index', 'backend.admin.categories.create', 'backend.admin.categories.edit']) ? 'active' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Category</p>
                        </a>
                    </li>@endif
                    @if (auth()->user()->hasAnyPermission(['unit_create','unit_view','unit_update','unit_delete']))
                    <li class="nav-item">
                        <a href="{{route('backend.admin.units.index')}}"
                            class="nav-link {{ request()->routeIs([ 'backend.admin.units.index', 'backend.admin.units.create', 'backend.admin.units.edit']) ? 'active' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Unit</p>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            @if (auth()->user()->hasAnyPermission([
            'sale_view'
            ]))
            <li class="nav-item">
                <a href="#" class="nav-link {{ request()->routeIs(['backend.admin.orders.index', 'backend.admin.orders.create', 'backend.admin.orders.edit']) ? 'menu-open' : '' }}">
                    <i class="fas fa-tags nav-icon"></i>
                    <p>
                        Sale
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @can('sale_view')
                    <li class="nav-item">
                        <a href="{{route('backend.admin.orders.index')}}"
                            class="nav-link {{ request()->routeIs(['backend.admin.orders.index']) ? 'active' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Sale List</p>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endif
            @if (auth()->user()->hasAnyPermission([
            'purchase_create',
            'purchase_view',
            'purchase_update',
            'purchase_delete',
            ]))
            <li class="nav-item">
                <a href="#" class="nav-link {{ request()->routeIs(['backend.admin.purchase.index', 'backend.admin.purchase.create', 'backend.admin.purchase.edit']) ? 'menu-open' : '' }}">
                    <i class="fas fa-shopping-bag nav-icon"></i>
                    <p>
                        Purchase
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @can('purchase_view')
                    <li class="nav-item">
                        <a href="{{route('backend.admin.purchase.index')}}"
                            class="nav-link {{ request()->routeIs(['backend.admin.purchase.index']) ? 'active' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Purchase List</p>
                        </a>
                    </li>
                    @endcan
                    @can('purchase_create')
                    <li class="nav-item">
                        <a href="{{route('backend.admin.purchase.create')}}"
                            class="nav-link {{ request()->routeIs(['backend.admin.purchase.create']) ? 'active' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Purchase Create</p>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endif
            @if (auth()->user()->hasAnyPermission([
            'reports_summary',
            'reports_sales',
            'reports_inventory',
            ]))
            <li class="nav-item">
                <a href="#" class="nav-link {{ request()->routeIs(['backend.admin.sale.report','backend.admin.sale.summery']) ? 'menu-open' : '' }}">
                    <i class="fas fa-chart-bar nav-icon"></i>
                    <p>
                        Reports
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @can('reports_summary')
                    <li class="nav-item">
                        <a href="{{route('backend.admin.sale.summery')}}"
                            class="nav-link {{ request()->routeIs(['backend.admin.sale.summery']) ? 'active' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Sales Summary</p>
                        </a>
                    </li>
                    @endcan
                    @can('reports_sales')
                    <li class="nav-item">
                        <a href="{{route('backend.admin.sale.report')}}"
                            class="nav-link {{ request()->routeIs(['backend.admin.sale.report']) ? 'active' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Sales</p>
                        </a>
                    </li>
                    @endcan
                    @can('reports_inventory')
                    <li class="nav-item">
                        <a href="{{route('backend.admin.inventory.report')}}"
                            class="nav-link {{ request()->routeIs(['backend.admin.inventory.report']) ? 'active' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Inventory</p>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endif
            {{-- settings --}}
            @if (auth()->user()->hasAnyPermission([
            //currency
            'currency_create',
            'currency_view',
            'currency_update',
            'currency_delete',
            'currency_set_default',
            //role
            'role_create',
            'role_view',
            'role_update',
            'role_delete',
            'permission_view',
            //user
            'user_create',
            'user_view',
            'user_update',
            'user_delete',
            'user_suspend',
            //setting
            'website_settings',
            'contact_settings',
            'socials_settings',
            'style_settings',
            'custom_settings',
            'notification_settings',
            'website_status_settings',
            'invoice_settings',
            ]))
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
                    @if (auth()->user()->hasAnyPermission([
                    'website_settings',
                    'contact_settings',
                    'socials_settings',
                    'style_settings',
                    'custom_settings',
                    'notification_settings',
                    'website_status_settings',
                    'invoice_settings',
                    ]))
                    <li class="nav-item">
                        <a href="{{ route('backend.admin.settings.website.general') }}?active-tab=website-info"
                            class="nav-link {{ $route === 'backend.admin.settings.website.general' ? 'active' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>General Settings</p>
                        </a>
                    </li>
                    @endif
                    @if (auth()->user()->hasAnyPermission(['currency_create','currency_view','currency_update','currency_delete']))
                    <li class="nav-item">
                        <a href="{{ route('backend.admin.currencies.index') }}"
                            class="nav-link {{ request()->routeIs([ 'backend.admin.currencies.index', 'backend.admin.currencies.create', 'backend.admin.currencies.edit']) ? 'active' : '' }}">
                            <i class="fas fa-coins nav-icon"></i>
                            <p>Currency</p>
                        </a>
                    </li>
                    @endif
                    @if (auth()->user()->hasAnyPermission([
                    'role_create',
                    'role_view',
                    'role_update',
                    'role_delete',
                    'permission_view',
                    ]))
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
                            @can('role_view')
                            <li class="nav-item">
                                <a href="{{ route('backend.admin.roles') }}"
                                    class="nav-link {{ $route === 'backend.admin.roles' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Roles</p>
                                </a>
                            </li>
                            @endcan
                            @can('permission_view')
                            <li class="nav-item">
                                <a href="{{ route('backend.admin.permissions') }}"
                                    class="nav-link {{ $route === 'backend.admin.permissions' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Permissions</p>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endif
                    @if (auth()->user()->hasAnyPermission([
                    //user
                    'user_create',
                    'user_view',
                    'user_update',
                    'user_delete',
                    'user_suspend',
                    ]))
                    <li class="nav-item">
                        <a href="{{ route('backend.admin.users') }}"
                            class="nav-link {{ $route === 'backend.admin.users' ? 'active' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>User Management</p>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
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