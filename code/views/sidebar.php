<nav id="sidebar" class="sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">RomiToGo!</span>
        </a>

        <ul class="sidebar-nav">
            <?php if($_SESSION['isAdmin']) : ?>
                <li class="sidebar-header">
                    Socios
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/mis-negocios">
                        <i class="home" data-feather="user"></i> <span class="align-middle">Negocios</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="pages-profile.html">
                        <i class="align-middle" data-feather="user"></i> <span class="align-middle">Platillos </span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="pages-profile.html">
                        <i class="align-middle" data-feather="user"></i> <span class="align-middle">Menu </span>
                    </a>
                </li>

            <?php endif ?>
        </ul>
    </div>
</nav>