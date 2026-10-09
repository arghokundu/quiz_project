<!-- ================================================================
           3.1 TOP HEADER (#mainHeader)
           ================================================================ -->
<header id="mainHeader" role="banner">
    <div class="header-container">

        <!-- Left Controls: Hamburger + Search -->
        <div class="header-left">
            <button type="button" class="btn-sidebar-toggle" id="sidebarToggleBtn" aria-label="Toggle navigation menu"
                title="Toggle Sidebar">
                <i class="bi bi-list"></i>
            </button>

            <!-- Global Search Form -->
            <!-- <div class="header-search d-none d-md-block" id="headerSearch">
              <i class="bi bi-search search-icon"></i>
              <input type="text" class="form-control" placeholder="Search anything (e.g. orders, users, reports)..." aria-label="Search">
              <span class="search-shortcut">Ctrl + K</span>
            </div> -->
        </div>

        <!-- Right Controls: Actions & Profile -->
        <div class="header-right">

            <!-- Mobile Search Icon Trigger (Visible on small screens) -->
            <button type="button" class="header-action-btn d-md-none" id="mobileSearchBtn" aria-label="Search"
                title="Search">
                <i class="bi bi-search"></i>
            </button>

            <!-- Theme Switcher (Dark / Light) -->
            <button type="button" class="header-action-btn" id="themeToggleBtn" aria-label="Toggle dark mode"
                title="Toggle Theme">
                <i class="bi bi-moon-stars-fill"></i>
            </button>

            <!-- Fullscreen Toggle -->
            <button type="button" class="header-action-btn d-none d-sm-inline-flex" id="fullscreenToggleBtn"
                aria-label="Toggle Fullscreen" title="Toggle Fullscreen">
                <i class="bi bi-arrows-fullscreen"></i>
            </button>

            <!-- Notifications Dropdown -->
            <div class="dropdown">
                <button type="button" class="header-action-btn" id="notificationsDropdown" data-bs-toggle="dropdown"
                    aria-expanded="false" title="Notifications">
                    <i class="bi bi-bell"></i>
                    <span class="badge-indicator pulse"></span>
                </button>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-custom p-0" style="width: 320px;"
                    aria-labelledby="notificationsDropdown">
                    <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
                        <h6 class="mb-0 fw-bold" style="font-size: 0.9rem;">Notifications</h6>
                        <span class="badge badge-custom badge-primary">3 New</span>
                    </div>
                    <div class="list-group list-group-flush" style="max-height: 280px; overflow-y: auto;">
                        <a href="#" class="list-group-item list-group-item-action p-3 border-bottom">
                            <div class="d-flex align-items-start gap-2">
                                <div class="stat-card-icon primary p-2"
                                    style="width: 32px; height: 32px; font-size: 0.9rem;">
                                    <i class="bi bi-cart-check"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="small fw-semibold text-primary">New Order #89241 Received</div>
                                    <div class="text-muted small" style="font-size: 0.75rem;">Customer: Sarah Jenkins -
                                        $240.00</div>
                                    <div class="text-muted small mt-1" style="font-size: 0.7rem;"><i
                                            class="bi bi-clock me-1"></i>5 mins ago</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action p-3 border-bottom">
                            <div class="d-flex align-items-start gap-2">
                                <div class="stat-card-icon success p-2"
                                    style="width: 32px; height: 32px; font-size: 0.9rem;">
                                    <i class="bi bi-shield-check"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="small fw-semibold text-success">Server Backup Completed</div>
                                    <div class="text-muted small" style="font-size: 0.75rem;">Database replica saved
                                        successfully.</div>
                                    <div class="text-muted small mt-1" style="font-size: 0.7rem;"><i
                                            class="bi bi-clock me-1"></i>1 hour ago</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action p-3">
                            <div class="d-flex align-items-start gap-2">
                                <div class="stat-card-icon warning p-2"
                                    style="width: 32px; height: 32px; font-size: 0.9rem;">
                                    <i class="bi bi-person-plus"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="small fw-semibold text-warning">New Team Member Joined</div>
                                    <div class="text-muted small" style="font-size: 0.75rem;">Alex Rodriguez assigned to
                                        Design.</div>
                                    <div class="text-muted small mt-1" style="font-size: 0.7rem;"><i
                                            class="bi bi-clock me-1"></i>3 hours ago</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="p-2 text-center border-top">
                        <a href="#" class="small fw-semibold text-primary">View All Notifications</a>
                    </div>
                </div>
            </div>

            <!-- Sign In & Sign Up Header Quick Actions -->
            @guest
            <div class="d-none d-sm-flex align-items-center gap-2 me-1">
                <a href="/login"
                    class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1 px-2.5 py-1"
                    style="font-size: 0.825rem; font-weight: 500;">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span>Log In</span>
                </a>
                <a href="/register" class="btn btn-sm btn-primary d-inline-flex align-items-center gap-1 px-2.5 py-1"
                    style="font-size: 0.825rem; font-weight: 500;">
                    <i class="bi bi-person-plus-fill"></i>
                    <span>Sign Up</span>
                </a>
            </div>
            @endguest

            <!-- User Profile Dropdown -->
            <div class="dropdown">
                <button type="button" class="user-profile-btn" id="userProfileDropdown" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <div class="avatar-wrapper">
                        <div class="user-avatar">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <span class="status-indicator status-online" title="Online"></span>
                    </div>
                    <div class="user-info">
                        @auth
                        <span class="user-name">
                            {{ Auth::user()->name }}
                        </span>
                        @else
                        <span class="user-name">
                            Guest
                        </span>
                        @endauth
                        <span class="user-role">Administrator</span>
                    </div>
                    <i class="bi bi-chevron-down text-muted ms-1 d-none d-sm-inline" style="font-size: 0.75rem;"></i>
                </button>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-custom" aria-labelledby="userProfileDropdown">
                    <li class="dropdown-header-custom">Account & Authentication</li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bi bi-person text-secondary"></i> My Profile
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">
                            <i class="bi bi-gear text-secondary"></i> Account Settings
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item text-danger" href="/logout">
                            <i class="bi bi-box-arrow-right"></i> Sign Out
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</header>