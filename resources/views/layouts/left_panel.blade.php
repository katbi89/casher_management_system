<!-- Left Panel -->

<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="/">Casher</a>
            <a class="navbar-brand hidden" href="/"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="/"> <i class="menu-icon fa fa-dashboard"></i>Home</a>
                </li>

                @if (Auth::user()->role == 'admin')
                <h3 class="menu-title">Pages</h3><!-- /.menu-title -->

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Users</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-bars"></i><a href="{{url('/all-users')}}">All Users</a></li>
                        <li><i class="fa fa-bars"></i><a href="{{url('/add-user')}}">Add User</a></li>
                    </ul>
                </li>

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Products</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-bars"></i><a href="{{url('/all-products')}}">All Products</a></li>
                        <li><i class="fa fa-bars"></i><a href="{{url('/add-product')}}">Add Product</a></li>
                        <li><i class="fa fa-bars"></i><a href="{{url('/add-details-for-product')}}">Add Details For Product</a></li>
                        <li><i class="fa fa-bars"></i><a href="{{url('/out-of-stock')}}">Products are almost out of stock</a></li>
                    </ul>
                </li>

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Discount</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-bars"></i><a href="{{url('/all-discounts')}}">ALL Discounts</a></li>
                        <li><i class="fa fa-bars"></i><a href="{{url('/make-discount')}}">Make Discount</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{url('/all-orders')}}"><i class="menu-icon fa fa-tasks"></i>Orders</a>
                </li>

                <li>
                    <a href="{{url('/customers')}}"> <i class="menu-icon fa fa-tasks"></i>Customers</a>
                </li>

                <li>
                    <a href="{{url('/special-customers')}}"> <i class="menu-icon fa fa-tasks"></i>Special Customers</a>
                </li>
                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->

<!-- Left Panel -->