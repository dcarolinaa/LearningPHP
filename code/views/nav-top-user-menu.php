<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
    <img src="<?php echo $userAvatar; ?>" class="avatar img-fluid rounded me-1" alt="Charles Hall" /> 
    <span class="text-dark"><?php echo $username; ?></span>
</a>

<div class="dropdown-menu dropdown-menu-end">
    <a class="dropdown-item" href="<?php echo $userMenu['profile']; ?>">
        <i class="align-middle me-1" data-feather="user"></i> Profile
    </a>
    <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i> Analytics</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="<?php echo $userMenu['settings']; ?>">
        <i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy
    </a>
    <a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
    <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="<?php echo $userMenu['logout']; ?>">Log out</a>
</div>