<li class="nav-item dropdown no-caret mr-3 dropdown-notifications">
    <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownAlerts"
        href="javascript:void(0);" role="button" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        <i class="fa fa-bell-o"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right border-0 shadow animated--fade-in-up"
        aria-labelledby="navbarDropdownAlerts">
        <h6 class="dropdown-header dropdown-notifications-header">
            <i class="mr-2 fa fa-sign-out"></i>
            Logout
            <form action="{{route('logout')}}" method="post">
                @csrf
                <button class="btn btn-link">Logout</button>
            </form>
        </h6>
        <a class="dropdown-item dropdown-notifications-item" href="javascript:void(0)">
            <div class="dropdown-notifications-item-content">
                <form action="{{route('logout')}}" method="post">
                    @csrf
                    <button class="btn btn-link">Logout</button>
                </form>
            </div>
        </a>
        <a class="dropdown-item dropdown-notifications-footer" href="javascript:void(0)">View All</a>
    </div>
</li>
