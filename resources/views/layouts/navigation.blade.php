<ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-speedometer') }}"></use>
            </svg>
            {{ __('Dashboard') }}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->is('roles*') ? 'active' : ''}}" href="{{ route('roles.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-group') }}"></use>
            </svg>
            {{ __('Roles') }}
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link {{ request()->is('permissions*') ? 'active' : ''}}" href="{{ route('permissions.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-room') }}"></use>
            </svg>
            {{ __('Permissions') }}
        </a>
    </li>

    <li class="nav-group {{ request()->is('users*') || request()->is('leave-applications*') ? 'show' : '' }}">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-people') }}"></use>
            </svg>
            Employee
        </a>
        <ul class="nav-group-items">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('users*') ? 'active' : ''}}" href="{{ route('users.index') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
                    </svg>
                    Users
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('leave-applications*') ? 'active' : ''}}" href="{{ route('leave-applications.index') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-calendar') }}"></use>
                    </svg>
                    Leave Applications
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-title">Master Data</li>

    <li class="nav-group {{ request()->is('banks*') || request()->is('departments*') || request()->is('job-titles*') || request()->is('branches*') || request()->is('employment-statuses*') || request()->is('position-levels*') || request()->is('leave-types*') || request()->is('shifts*') ? 'show' : '' }}">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-layers') }}"></use>
            </svg>
            Master Data HRIS
        </a>
        <ul class="nav-group-items">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('banks*') ? 'active' : ''}}" href="{{ route('banks.index') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-institution') }}"></use>
                    </svg>
                    Banks
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('departments*') ? 'active' : ''}}" href="{{ route('departments.index') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-sitemap') }}"></use>
                    </svg>
                    Departments
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('job-titles*') ? 'active' : ''}}" href="{{ route('job-titles.index') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-briefcase') }}"></use>
                    </svg>
                    Job Titles
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('position-levels*') ? 'active' : ''}}" href="{{ route('position-levels.index') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-chart-line') }}"></use>
                    </svg>
                    Position Levels
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('employment-statuses*') ? 'active' : ''}}" href="{{ route('employment-statuses.index') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-id-badge') }}"></use>
                    </svg>
                    Employment Status
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('leave-types*') ? 'active' : ''}}" href="{{ route('leave-types.index') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-calendar') }}"></use>
                    </svg>
                    Leave Types
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('shifts*') ? 'active' : ''}}" href="{{ route('shifts.index') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-clock') }}"></use>
                    </svg>
                    Shifts
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-title">Settings</li>

    <li class="nav-group {{ request()->is('settings*') ? 'show' : '' }}">
        <a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-settings') }}"></use>
            </svg>
            Settings
        </a>
        <ul class="nav-group-items">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('settings/company*') ? 'active' : ''}}" href="{{ route('company-settings.edit') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-building') }}"></use>
                    </svg>
                    Company Settings
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('branches*') ? 'active' : ''}}" href="{{ route('branches.index') }}">
                    <svg class="nav-icon">
                        <use xlink:href="{{ asset('icons/coreui.svg#cil-location-pin') }}"></use>
                    </svg>
                    Branches
                </a>
            </li>
        </ul>
    </li>
</ul>
