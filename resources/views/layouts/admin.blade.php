<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #f3f4f6;
            color: #111827;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 240px;
            background: #111827;
            color: #e5e7eb;
            padding: 1.5rem 1rem;
            display: flex;
            flex-direction: column;
        }

        .brand {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 2rem;
        }

        .nav-link {
            display: block;
            padding: 0.5rem 0.75rem;
            border-radius: 0.375rem;
            color: #9ca3af;
            text-decoration: none;
            margin-bottom: 0.25rem;
        }

        .nav-link:hover,
        .nav-link--active {
            background: #1f2937;
            color: #f9fafb;
        }

        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            height: 64px;
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.5rem;
        }

        .topbar-user {
            font-size: 0.9rem;
            color: #6b7280;
        }

        .content {
            padding: 1.5rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.4rem 0.9rem;
            border-radius: 9999px;
            border: none;
            cursor: pointer;
            font-size: 0.85rem;
        }

        .btn-primary {
            background: #2563eb;
            color: #f9fafb;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid #d1d5db;
            color: #374151;
        }

        .card {
            background: #ffffff;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 10px 15px -3px rgba(15, 23, 42, 0.08);
            border: 1px solid #e5e7eb;
        }

        .muted {
            color: #6b7280;
            font-size: 0.9rem;
        }

        .nav-group {
            margin-bottom: 0.25rem;
        }

        .nav-group-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.5rem 0.75rem;
            border-radius: 0.375rem;
            color: #9ca3af;
            cursor: pointer;
        }

        .nav-group-header:hover {
            background: #1f2937;
            color: #f9fafb;
        }

        .nav-group-header--active {
            background: #1f2937;
            color: #f9fafb;
        }

        .nav-group-toggle {
            transition: transform 0.2s;
        }

        .nav-group-toggle--open {
            transform: rotate(90deg);
        }

        .nav-group-items {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .nav-group-items--open {
            max-height: 500px;
        }

        .nav-group-link {
            padding-left: 2rem;
        }

        @media print {

            .sidebar,
            .topbar,
            .btn,
            form {
                display: none !important;
            }

            .main {
                margin: 0 !important;
                padding: 0 !important;
            }

            .content {
                padding: 0 !important;
            }

            .card {
                box-shadow: none !important;
                border: none !important;
                padding: 0 !important;
            }
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 2% auto;
            padding: 0;
            border-radius: 12px;
            width: 80%;
            max-width: 900px;
            height: 90vh;
            display: flex;
            flex-direction: column;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            overflow: hidden;
        }

        .modal-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f9fafb;
        }

        .modal-body {
            flex: 1;
            padding: 0;
            overflow: hidden;
        }

        .modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
            background: #f9fafb;
        }

        .close-modal {
            color: #9ca3af;
            font-size: 1.5rem;
            font-weight: bold;
            cursor: pointer;
            transition: color 0.2s;
        }

        .close-modal:hover {
            color: #111827;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <div class="layout">
        <aside class="sidebar">
            <div class="brand">
                Admin Panel
            </div>
            <nav>
                @auth
                    @if(auth()->user()->hasRole('admin'))
                        <a href="{{ route('admin.dashboard') }}"
                            class="nav-link {{ request()->routeIs('admin.dashboard') ? 'nav-link--active' : '' }}">
                            Dashboard
                        </a>
                        <a href="{{ route('admin.users.index') }}"
                            class="nav-link {{ request()->routeIs('admin.users.*') ? 'nav-link--active' : '' }}">
                            Users
                        </a>
                        <a href="{{ route('admin.roles.index') }}"
                            class="nav-link {{ request()->routeIs('admin.roles.*') ? 'nav-link--active' : '' }}">
                            Roles
                        </a>
                        <a href="{{ route('admin.permissions.index') }}"
                            class="nav-link {{ request()->routeIs('admin.permissions.*') ? 'nav-link--active' : '' }}">
                            Permissions
                        </a>
                        <div class="nav-group">
                            @php
                                $manageWebsiteRoutes = [
                                    'admin.sliders.*',
                                    'admin.photo-galleries.*',
                                    'admin.video-galleries.*',
                                    'admin.header-logos.*',
                                    'admin.blogs.*',
                                    'admin.hero-sections.*',
                                    'admin.abouts.*',
                                    'admin.introductions.*',
                                    'admin.woman-empower-cards.*',
                                    'admin.missions.*',
                                    'admin.request-submissions.*',
                                    'admin.member-registrations.*',
                                    'admin.agent-registrations.*',
                                    'admin.sub-agent-registrations.*',
                                    'admin.contacts.*',
                                    'admin.our-details.*',
                                    'admin.vacancies.*',
                                    'admin.job-applications.*',
                                ];
                                $isManageWebsiteActive = false;
                                foreach ($manageWebsiteRoutes as $route) {
                                    if (request()->routeIs($route)) {
                                        $isManageWebsiteActive = true;
                                        break;
                                    }
                                }
                            @endphp
                            <div class="nav-group-header {{ $isManageWebsiteActive ? 'nav-group-header--active' : '' }}"
                                onclick="toggleNavGroup(this)">
                                <span>Manage Website</span>
                                <span
                                    class="nav-group-toggle {{ $isManageWebsiteActive ? 'nav-group-toggle--open' : '' }}">›</span>
                            </div>
                            <div class="nav-group-items {{ $isManageWebsiteActive ? 'nav-group-items--open' : '' }}">
                                <!-- <a href="{{ route('admin.sliders.index') }}"
                                                                                                                                            class="nav-link nav-group-link {{ request()->routeIs('admin.sliders.*') ? 'nav-link--active' : '' }}">
                                                                                                                                            Sliders
                                                                                                                                        </a>
                                                                                                                                        <a href="{{ route('admin.photo-galleries.index') }}"
                                                                                                                                            class="nav-link nav-group-link {{ request()->routeIs('admin.photo-galleries.*') ? 'nav-link--active' : '' }}">
                                                                                                                                            Photo Galleries
                                                                                                                                        </a>
                                                                                                                                        <a href="{{ route('admin.video-galleries.index') }}"
                                                                                                                                            class="nav-link nav-group-link {{ request()->routeIs('admin.video-galleries.*') ? 'nav-link--active' : '' }}">
                                                                                                                                            Video Galleries
                                                                                                                                        </a>
                                                                                                                                        <a href="{{ route('admin.header-logos.index') }}"
                                                                                                                                            class="nav-link nav-group-link {{ request()->routeIs('admin.header-logos.*') ? 'nav-link--active' : '' }}">
                                                                                                                                            Settings
                                                                                                                                        </a>
                                                                                                                                        <a href="{{ route('admin.blogs.index') }}"
                                                                                                                                            class="nav-link nav-group-link {{ request()->routeIs('admin.blogs.*') ? 'nav-link--active' : '' }}">
                                                                                                                                            Blogs
                                                                                                                                        </a>
                                                                                                                                        <a href="{{ route('admin.hero-sections.index') }}"
                                                                                                                                            class="nav-link nav-group-link {{ request()->routeIs('admin.hero-sections.*') ? 'nav-link--active' : '' }}">
                                                                                                                                            Hero Sections
                                                                                                                                        </a>
                                                                                                                                        <a href="{{ route('admin.abouts.index') }}"
                                                                                                                                            class="nav-link nav-group-link {{ request()->routeIs('admin.abouts.*') ? 'nav-link--active' : '' }}">
                                                                                                                                            Abouts
                                                                                                                                        </a>
                                                                                                                                        <a href="{{ route('admin.introductions.index') }}"
                                                                                                                                            class="nav-link nav-group-link {{ request()->routeIs('admin.introductions.*') ? 'nav-link--active' : '' }}">
                                                                                                                                            Introductions
                                                                                                                                        </a>
                                                                                                                                        <a href="{{ route('admin.woman-empower-cards.index') }}"
                                                                                                                                            class="nav-link nav-group-link {{ request()->routeIs('admin.woman-empower-cards.*') ? 'nav-link--active' : '' }}">
                                                                                                                                            Woman Empower Members
                                                                                                                                        </a>
                                                                                                                                        <a href="{{ route('admin.missions.index') }}"
                                                                                                                                            class="nav-link nav-group-link {{ request()->routeIs('admin.missions.*') ? 'nav-link--active' : '' }}">
                                                                                                                                            Missions
                                                                                                                                        </a>
                                                                                                                                        <a href="{{ route('admin.request-submissions.index') }}"
                                                                                                                                            class="nav-link nav-group-link {{ request()->routeIs('admin.request-submissions.*') ? 'nav-link--active' : '' }}">
                                                                                                                                            Complaints
                                                                                                                                        </a> -->
                                <a href="{{ route('admin.member-registrations.index') }}"
                                    class="nav-link nav-group-link {{ request()->routeIs('admin.member-registrations.*') ? 'nav-link--active' : '' }}">
                                    Member Registrations
                                </a>
                                <a href="{{ route('admin.agent-registrations.index') }}"
                                    class="nav-link nav-group-link {{ request()->routeIs('admin.agent-registrations.*') ? 'nav-link--active' : '' }}">
                                    Agent Registrations
                                </a>
                                <a href="{{ route('admin.sub-agent-registrations.index') }}"
                                    class="nav-link nav-group-link {{ request()->routeIs('admin.sub-agent-registrations.*') ? 'nav-link--active' : '' }}">
                                    Sub Agent Registrations
                                </a>
                                <a href="{{ route('admin.contacts.index') }}"
                                    class="nav-link nav-group-link {{ request()->routeIs('admin.contacts.*') ? 'nav-link--active' : '' }}">
                                    Contacts
                                </a>
                                <!-- <a href="{{ route('admin.our-details.index') }}"
                                            class="nav-link nav-group-link {{ request()->routeIs('admin.our-details.*') ? 'nav-link--active' : '' }}">
                                            Our Details
                                        </a> -->
                                <!-- Nested Career Menu -->
                                <div class="nav-group" style="padding-left: 0.75rem; margin-top: 0.25rem;">
                                    @php
                                        $careerRoutes = ['admin.vacancies.*', 'admin.job-applications.*'];
                                        $isCareerActive = false;
                                        foreach ($careerRoutes as $route) {
                                            if (request()->routeIs($route)) {
                                                $isCareerActive = true;
                                                break;
                                            }
                                        }
                                    @endphp
                                    <div class="nav-group-header {{ $isCareerActive ? 'nav-group-header--active' : '' }}"
                                        onclick="toggleNavGroup(this)" style="font-size: 0.85rem; padding: 0.4rem 0.75rem;">
                                        <span>Career</span>
                                        <span
                                            class="nav-group-toggle {{ $isCareerActive ? 'nav-group-toggle--open' : '' }}">›</span>
                                    </div>
                                    <div class="nav-group-items {{ $isCareerActive ? 'nav-group-items--open' : '' }}">
                                        <a href="{{ route('admin.vacancies.index') }}"
                                            class="nav-link nav-group-link {{ request()->routeIs('admin.vacancies.*') ? 'nav-link--active' : '' }}"
                                            style="padding-left: 1.5rem; font-size: 0.8rem;">
                                            Vacancies
                                        </a>
                                        <a href="{{ route('admin.job-applications.index') }}"
                                            class="nav-link nav-group-link {{ request()->routeIs('admin.job-applications.*') ? 'nav-link--active' : '' }}"
                                            style="padding-left: 1.5rem; font-size: 0.8rem;">
                                            Job Applications
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="nav-group">
                                                                                                                                    <div class="nav-group-header {{ request()->routeIs('admin.events.*') || request()->routeIs('admin.woman-notices.*') ? 'nav-group-header--active' : '' }}"
                                                                                                                                        onclick="toggleNavGroup(this)">
                                                                                                                                        <span>Events & Notices</span>
                                                                                                                                        <span
                                                                                                                                            class="nav-group-toggle {{ request()->routeIs('admin.events.*') || request()->routeIs('admin.woman-notices.*') ? 'nav-group-toggle--open' : '' }}">›</span>
                                                                                                                                    </div>
                                                                                                                                    <div
                                                                                                                                        class="nav-group-items {{ request()->routeIs('admin.events.*') || request()->routeIs('admin.woman-notices.*') ? 'nav-group-items--open' : '' }}">
                                                                                                                                        <a href="{{ route('admin.events.index') }}"
                                                                                                                                            class="nav-link nav-group-link {{ request()->routeIs('admin.events.*') ? 'nav-link--active' : '' }}">
                                                                                                                                            Events
                                                                                                                                        </a>
                                                                                                                                        <a href="{{ route('admin.woman-notices.index') }}"
                                                                                                                                            class="nav-link nav-group-link {{ request()->routeIs('admin.woman-notices.*') ? 'nav-link--active' : '' }}">
                                                                                                                                            Woman Notices
                                                                                                                                        </a>
                                                                                                                                    </div>
                                                                                                                                </div> -->
                    @endif
                    <a href="{{ route('profile.edit') }}"
                        class="nav-link {{ request()->routeIs('profile.*') ? 'nav-link--active' : '' }}">
                        My profile
                    </a>
                @endauth
            </nav>
        </aside>

        <div class="main">
            <header class="topbar">
                <div>
                    @yield('header')
                </div>
                <div class="topbar-user">
                    @auth
                        {{ auth()->user()->name ?? auth()->user()->email }}
                        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-outline" style="margin-left: 0.75rem;">
                                Logout
                            </button>
                        </form>
                    @endauth
                </div>
            </header>

            <main class="content">
                @yield('content')
            </main>
        </div>
    </div>
    <script>
        function toggleNavGroup(header) {
            const items = header.nextElementSibling;
            const toggle = header.querySelector('.nav-group-toggle');
            const isOpen = items.classList.contains('nav-group-items--open');

            if (isOpen) {
                items.classList.remove('nav-group-items--open');
                toggle.classList.remove('nav-group-toggle--open');
            } else {
                items.classList.add('nav-group-items--open');
                toggle.classList.add('nav-group-toggle--open');
            }
        }
    </script>
</body>

</html>