    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark header p-3">
        <a class="navbar-brand ms-5" href="#"> Furni<span>.</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mr-4">
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa-solid fa-user"></i> Profile</a>
                </li>
                <li class="nav-item">
                    <form id="logout-form" action="{{ route('custom.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a class="nav-link" href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out-alt"></i> Logout
                    </a>
                </li>

            </ul>
        </div>
    </nav>
