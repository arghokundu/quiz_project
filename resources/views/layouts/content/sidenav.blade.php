    <!-- ==================================================================
         2. SIDEBAR NAVIGATION (#sideNavbar)
         ================================================================== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <aside id="sideNavbar" aria-label="Main Navigation">

        <!-- Brand Logo Header -->
        <div class="sidebar-header">
            <a href="/" class="brand-logo" id="brandLogo">
                <div class="brand-icon">
                    <i class="bi bi-layers-half"></i>
                </div>
                <span class="brand-text">Quiz<span>System</span></span>
            </a>
            <button type="button" class="btn-sidebar-toggle d-lg-none" aria-label="Close sidebar">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <!-- Scrollable Navigation Body -->
        <div class="sidebar-body">


            <!-- ----------------------------------------------------------------
             SECTION 1: CORE / MAIN MENU
             ---------------------------------------------------------------- -->
            <div class="sidebar-heading">Core</div>
            <div class="sidebar-heading-divider"></div>

            <ul class="sidebar-nav">
                <!-- Active Single Link: Overview -->
                <li class="nav-item">
                    <a href="/" class="nav-link-custom active" id="navDashboard">
                        <div class="link-left">
                            <span class="nav-icon"><i class="bi bi-grid-1x2-fill"></i></span>
                            <span class="nav-text">Dashboard</span>
                        </div>
                        <div class="link-right">
                            <span class="badge badge-custom badge-primary">New</span>
                        </div>
                    </a>
                </li>
            </ul>

            <!-- ----------------------------------------------------------------
             SECTION 2: MANAGEMENT & EMPLOYEES
             ---------------------------------------------------------------- -->
            <div class="sidebar-heading">Management</div>
            <div class="sidebar-heading-divider"></div>
            {{--@if(session()->has('adminId'))--}}
            <ul class="sidebar-nav">
                <!-- Dropdown Menu: Employees & User Management -->
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link-custom" data-sidebar-toggle="dropdown"
                        aria-expanded="false" id="navDropdownUsers">
                        <div class="link-left {{request()->is('showAllCategory') ||
                            request()->is('categoryAdd') || request()->is('editCate/*') ? 'active' : '' }}">
                            <span class="nav-icon">
                                <i class="fa-regular fa-rectangle-list"></i>
                            </span>
                            <span class="nav-text">
                                Category
                            </span>
                        </div>
                        <div class="link-right">
                            <i class="bi bi-chevron-right dropdown-chevron"></i>
                        </div>
                    </a>

                    <ul class="sidebar-submenu" style="display: none;">
                        <li>
                            <a href="/showAllCategory" class="submenu-link 
                                {{request()->is('showAllCategory') || request()->is('categoryAdd')
                                    || request()->is('editCate/*') ? 'active' : '' }}">
                                <i class="fa-solid fa-layer-group"></i>
                                Category List
                            </a>
                        </li>
                    </ul>

                </li>
            </ul>
            {{--@endif--}}
            
            <ul class="sidebar-nav">
                <!-- Dropdown Menu: Employees & User Management -->
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link-custom" data-sidebar-toggle="dropdown"
                        aria-expanded="false" id="navDropdownUsers">
                        <div class="link-left {{request()->is('showAllQuiz') ||
                            request()->is('add/Quiz') || request()->is('edit/quiz/*') 
                            ||  request()->is('viewspecific/quiz/*') ? 'active' : '' }}">
                            <span class="nav-icon">
                                <i class="fa-regular fa-rectangle-list"></i>
                            </span>
                            <span class="nav-text">
                                Quizs
                            </span>
                        </div>
                        <div class="link-right">
                            <i class="bi bi-chevron-right dropdown-chevron"></i>
                        </div>
                    </a>

                    <ul class="sidebar-submenu" style="display: none;">
                        <li>
                            <a href="/showAllQuiz" class="submenu-link 
                                {{request()->is('showAllQuiz') ||  request()->is('add/Quiz') 
                                || request()->is('edit/quiz/*') || request()->is('viewspecific/quiz/*') ? 'active' : '' }}">
                                <i class="fa-solid fa-layer-group"></i>
                                Quiz Name List
                            </a>
                        </li>
                    </ul>

                </li>
            </ul>

            <ul class="sidebar-nav">
                <!-- Dropdown Menu: Employees & User Management -->
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link-custom" data-sidebar-toggle="dropdown"
                        aria-expanded="false" id="navDropdownUsers">
                        <div class="link-left {{request()->is('showAllQuiz/mcq') ||
                            request()->is('showAll/mcq/*') || request()->is('') 
                            ||  request()->is('') ? 'active' : '' }}">
                            <span class="nav-icon">
                                <i class="fa-regular fa-rectangle-list"></i>
                            </span>
                            <span class="nav-text">
                                Mcq
                            </span>
                        </div>
                        <div class="link-right">
                            <i class="bi bi-chevron-right dropdown-chevron"></i>
                        </div>
                    </a>

                    <ul class="sidebar-submenu" style="display: none;">
                        <li>
                            <a href="/showAllQuiz/mcq" class="submenu-link 
                                {{request()->is('showAllQuiz/mcq') ||  request()->is('showAll/mcq/*') 
                                || request()->is('') || request()->is('') ? 'active' : '' }}">
                                <i class="fa-solid fa-layer-group"></i>
                                Mcq Questions List
                            </a>
                        </li>
                    </ul>

                </li>
            </ul>


        </div>
    </aside>