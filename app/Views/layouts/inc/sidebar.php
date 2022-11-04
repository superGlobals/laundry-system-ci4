<ul class="side-nav">

                <li class="side-nav-title side-nav-item">Navigation</li>

                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarDashboards" aria-expanded="false" aria-controls="sidebarDashboards" class="side-nav-link">
                        <a href="<?= base_url('/') ?>" class="side-nav-link">
                        <i class="uil-home-alt"></i>      
                        <span> Dashboards </span>
                    </a>
                    
                </li>

                <li class="side-nav-title side-nav-item">Apps</li>

                <li class="side-nav-item">
                    <a href="<?= base_url('/admin/new-laundry') ?>" class="side-nav-link">
                        <i class="uil-comments-alt"></i>
                        <span> New Laundry </span>
                    </a>
                </li>

                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarEcommerce" aria-expanded="false" aria-controls="sidebarEcommerce" class="side-nav-link">
                        <i class="uil-store"></i>
                        <span> User Management </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarEcommerce">
                        <ul class="side-nav-second-level">
                            <li>
                                <a href="<?= base_url('/admin/user-management') ?>">User</a>
                            </li>
                            <li>
                                <a href="<?= base_url('/admin/customer-management') ?>">Customer</a>
                            </li>
                           
                        </ul>
                    </div>
                </li>

                <li class="side-nav-item">
                    <a href="<?= base_url('/admin/supply-inventory') ?>" class="side-nav-link">
                        <i class="uil-comments-alt"></i>
                        <span> Supply Inventory </span>
                    </a>
                </li>

                <li class="side-nav-item">
                    <a href="<?= base_url('/admin/laundry-services') ?>" class="side-nav-link">
                        <i class="uil-comments-alt"></i>
                        <span> Laundry Services Category </span>
                    </a>
                </li>
            </ul>