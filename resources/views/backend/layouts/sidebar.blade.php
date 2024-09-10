@php
    $route = request()
        ->route()
        ->getName();
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
            <li class="nav-header">WORKLOAD</li>

            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="fab fa-blogger-b nav-icon"></i>
                    <p>
                        Blogs
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-chevron-circle-right nav-icon"></i>
                            <p>
                                <span class="text-lightblue">Category Base</span>
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('backend.admin.create.blog.category') }}"
                                    class="nav-link {{ $route === 'backend.admin.create.blog.category' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add New</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('backend.admin.blog.categories') }}"
                                    class="nav-link {{ $route === 'backend.admin.blog.categories' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Category List</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-chevron-circle-right nav-icon"></i>
                            <p>
                                <span class="text-lightblue">Article Base</span>
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('backend.admin.create.blog') }}"
                                    class="nav-link {{ $route === 'backend.admin.create.blog' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Create New Blog</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('backend.admin.blogs') }}"
                                    class="nav-link {{ $route === 'backend.admin.blogs' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Blog List</p>
                                </a>
                            </li>
                        </ul>
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
                        <a href="#" class="nav-link">
                            <i class="fas fa-chevron-circle-right nav-icon"></i>
                            <p>
                                <span class="text-lightblue">Users & Permissions</span>
                                <i class="fas fa-angle-left right"></i>
                            </p>
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
                            <li class="nav-item">
                                <a href="{{ route('backend.admin.users') }}"
                                    class="nav-link {{ $route === 'backend.admin.users' ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>User Management</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('backend.admin.pages') }}"
                            class="nav-link {{ $route === 'backend.admin.pages' ? 'active' : '' }}">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Page Builder</p>
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
