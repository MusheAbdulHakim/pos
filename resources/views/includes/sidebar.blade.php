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
        @can('view-expenses')
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
               <li><a href="{{route('settings')}}">General Setting</a></li>
               <li><a href="{{route('brand')}}">Brand</a></li>
               <li><a href="{{route('tax')}}">Tax</a></li>
               <li><a href="{{route('unit')}}">Unit</a></li>
            </ul>
        </li>
    </ul>
</div>