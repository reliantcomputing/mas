<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">MAS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <li class="nav-item">
                        <a href="{{asset("home")}}" class="nav-link text-muted waves-effect waves-dark">
                            Home
                        </a>
                    </li>
                </li>
            </ul>
            @guest
            <ul class="navbar-nav my-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Register
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{route("instructorRegistration")}}">Instructor</a>
                          <a class="dropdown-item" href="{{route("studentRegistration")}}">Student</a>
                        </div>
                      </li>
                    <li class="nav-item">
                        <a href="{{asset("login")}}" class="nav-link text-muted waves-effect waves-dark">
                            Login
                        </a>
                    </li>
                </ul> 
            @endguest
            @auth
            <ul class="navbar-nav my-lg-0">
                    <li class="nav-item">
                        <a href="{{asset("dashboard")}}" class="nav-link text-muted waves-effect waves-dark">
                            Dashboard
                        </a>
                    </li>
                </ul>                   
            @endauth
        </div>
    </div>
</nav>
