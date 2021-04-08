<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-chart-area"></i>
        </div>
        <div class="sidebar-brand-text mx-3">MAS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
    <a class="nav-link" href="{{route("dashboard")}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>
    @if (Auth::user()->hasRole("ROLE_INSTRUCTOR"))
        <!-- Nav Item - Pages Collapse Menu -->
            @if (!Auth::user()->hasRole("ROLE_STUDENT") && !Auth::user()->hasRole("ROLE_STUDENT"))
                <li class="nav-item">
                    <a class="nav-link" href="{{route("profile")}}">
                        <i class="fas fa-fw fa-user"></i>
                        <span>Profile</span> 
                    </a>
                </li>
            @endif
                
                <li class="nav-item">
                    <a class="nav-link" href="{{route("students")}}">
                        <i class="fas fa-fw fa-users"></i>
                    <span>Students</span> 
                    </a>
                </li>
            
                <li class="nav-item">
                    <a class="nav-link" href="{{route("groups")}}">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Groups</span>
                    </a>
                </li>
            
                <li class="nav-item">
                    <a class="nav-link" href="{{route("evaluations")}}">
                        <i class="fas fa-fw fa-check"></i>
                        <span>Evaluations</span>
                    </a>
                </li>
                <li class="nav-item">
                        <a class="nav-link" href="{{route("viewMarks")}}">
                            <i class="fas fa-fw fa-check"></i>
                            <span>Marks</span>
                        </a>
                    </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route("rubrics")}}">
                        <i class="fas fa-fw fa-table"></i>
                        <span>Build Rubric</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route("studentInstructor")}}">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Students (instructor role)</span>
                    </a>
                </li>
            
@endif
</ul>