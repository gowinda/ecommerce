<!-- START SIDEBAR-->
<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
{{--                <img src="./assets/img/admin-avatar.png" width="45px" />--}}
                <i class="fa fa-user fa-2x" style="color: #ffffff"></i>
            </div>
            <div class="admin-info">
                <div class="font-strong">{{ auth()->user()->name }}</div><small>{{ucfirst(auth()->user()->role)}}</small></div>
        </div>
        <ul class="side-menu metismenu">
            <li>
                <a class="active" href="{{ route('home') }}"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li class="heading">FEATURES</li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-images"></i>
                    <span class="nav-label">Slider Manger</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{ route('slider.create') }}">Add Slider</a>
                    </li>
                    <li>
                        <a href="{{ route('slider.index') }}">List Slider</a>
                    </li>

                </ul>
            </li>

            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-sitemap"></i>
                    <span class="nav-label">Category Manger</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{ route('category.create') }}">Add Category</a>
                    </li>
                    <li>
                        <a href="{{ route('category.index') }}">Catogory List</a>
                    </li>

                </ul>
            </li>

            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-shopping-basket"></i>
                    <span class="nav-label">Products Manger</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{ route('product.create') }}">Add Product</a>
                    </li>
                    <li>
                        <a href="{{ route('product.index') }}">Product List</a>
                    </li>

                </ul>
            </li>

            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-shopping-cart"></i>
                    <span class="nav-label">Orders Manger</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="colors.html">Colors</a>
                    </li>

                </ul>
            </li>

            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-users"></i>
                    <span class="nav-label">Users Manger</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="colors.html">Colors</a>
                    </li>

                </ul>
            </li>

            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-comments"></i>
                    <span class="nav-label">Review Manger</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="colors.html">Colors</a>
                    </li>

                </ul>
            </li>

            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-file"></i>
                    <span class="nav-label">Pages Manger</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{ route('page.index') }}">Page List</a>
                    </li>

                </ul>
            </li>

        </ul>
    </div>
</nav>
<!-- END SIDEBAR-->
