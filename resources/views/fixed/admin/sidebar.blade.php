<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('img/avatar.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Junior Developer</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">Menu</li>

                <li class="nav-item">
                    <a href="{{ route('logs') }}" class="nav-link"><i class="fas fa-calendar"></i> Logs</a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('courses.create') }}" class="nav-link"><i class="fas fa-book"></i> Courses</a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('categories.create') }}" class="nav-link"><i class="fa fa-list-alt"></i>
                        Categories</a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('topics.create') }}" class="nav-link"><i class="fa fa-list-alt"></i>
                        Topics</a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('users.create') }}" class="nav-link"><i class="fa fa-user"></i>
                        Users</a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/orders') }}" class="nav-link"><i class="fas fa-shopping-cart"></i> Orders</a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('contact.create') }}" class="nav-link"><i class="fas fa-envelope"></i> Contact Mails</a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
