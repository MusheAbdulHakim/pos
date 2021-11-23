<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title">Menu</li>

        <li>
            <a href="{{route('dashboard')}}" class=" waves-effect">
                <i class="mdi mdi-airplay"></i>
                <span>Dashboard</span>
            </a>
        </li>
        @can('view-product-categories','view-product')
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="fas fa-list"></i>
                <span>Product</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                @can('view-product-categories')
               <li><a href="{{route('product.category')}}">Category</a></li>
               @endcan
               @can('view-products')
               <li><a href="{{route('products.index')}}">Product List</a></li>
                @endcan
                @can('create-product')
               <li><a href="{{route('products.create')}}">Add Product</a></li>
                @endcan
            </ul>
        </li>
        @endcan
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="mdi mdi-credit-card"></i>
                <span>Purchase</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
               @can('view-purchases')
               <li><a href="{{route('purchases.index')}}">Purchase List</a></li>
                @endcan
                @can('create-purchase')
               <li><a href="{{route('purchases.create')}}">Add Purchase</a></li>
                @endcan
            </ul>
        </li>
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="mdi mdi-cart"></i>
                <span>Sale</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
               @can('view-sales')
               <li><a href="{{route('purchases.index')}}">Sale List</a></li>
                @endcan
                @can('create-sale')
               <li><a href="{{route('purchases.create')}}">Add Sale</a></li>
                @endcan
                @can('view-pos')
                <li><a href="{{route('purchases.create')}}">Pos</a></li>
                @endcan
            </ul>
        </li>
        @can('view-expense-categories','view-expenses')
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="fas fa-wallet"></i>
                <span>Expense</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
               @can('view-expense-categories')
               <li><a href="{{route('expense.category')}}">Expense Category</a></li>
               @endcan
               @can('view-expenses')
               <li><a href="{{route('expenses.index')}}">Expenses</a></li>
               @endcan
               
            </ul>
        </li>
        @endcan
        @can('view-people')
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="fas fa-users"></i>
                <span>People</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
               @can('view-customer-types')
               <li><a href="{{route('customer-type')}}">Customer Type</a></li>
               @endcan
               @can('view-customers')
               <li><a href="{{route('customers.index')}}">Customers</a></li>
               @endcan
               @can('view-suppliers')
               <li>
                    <a href="{{route('suppliers.index')}}" class=" waves-effect">
                        <span>Suppliers</span>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan

        @can('view-authentication')
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="mdi mdi-lock"></i>
                <span>Authentication</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
               @can('view-permissions')
               <li><a href="{{route('permissions')}}">Permissions</a></li>
               @endcan
               @can('view-roles')
               <li><a href="{{route('roles.index')}}">Roles</a></li>
               @endcan
               @can('view-users')
               <li>
                    <a href="{{route('users.index')}}" class=" waves-effect">
                        <span>Users</span>
                    </a>
                </li>
                @endcan
            </ul>
        </li>
        @endcan
        @can('view-backups')
        <li>
            <a href="{{route('backup.index')}}" class=" waves-effect">
                <i class="fas fa-download"></i>
                <span>Backup</span>
            </a>
        </li>
        @endcan
        <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="mdi mdi-settings"></i>
                <span>Settings</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
               @can('view-settings')
                <li><a href="{{route('settings')}}">General Setting</a></li>
               @endcan
               @can('view-brands')
               <li><a href="{{route('brand')}}">Brand</a></li>
               @endcan
               @can('view-taxes')
               <li><a href="{{route('tax')}}">Tax</a></li>
               @endcan
               @can('view-units')
               <li><a href="{{route('unit')}}">Unit</a></li>
               @endcan
            </ul>
        </li>
    </ul>
</div>