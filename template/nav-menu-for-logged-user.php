<div class="nav-menu-icon-container">
    <button class="nav-menu-icon">
        <svg class="nav-menu-icon-size" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <title>Menu</title>
            <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
        </svg>
    </button>
</div>

<div class="nav-menu-container">
    <div class="nav-menu-wrapper">
        <a href="<?php echo PAGES['home']; ?>" class="nav-menu-item mr-4c">
            Home
        </a>
        <a href="<?php echo PAGES['profile']; ?>" class="nav-menu-item mr-4c">
            Profile
        </a>
        <a href="<?php echo PAGES['add-post']; ?>" class="nav-menu-item mr-4c">
            Add Post
        </a>
        <a href="<?php echo PAGES['stats']; ?>" class="nav-menu-item">
            Course
        </a>
    </div>

    <div class="search-bar">
        <div class="search-bar-container">
            <form action="<?php echo PAGES['home']; ?>" method="get">
                <input type="text" class="search-bar-input" name="search-text" placeholder="Search anything...">
                <div class="search-btn-size">
                    <input type="button" name="search">
                    <i class="fa fa-search search-btn-icon"></i>
                    </input>
                </div>
            </form>
        </div>
        <div class="nav-menu-container-right">
            <a href="<?php echo PAGES['logout']; ?>" class="nav-menu-btn">Logout</a>
        </div>
    </div>
</div>
</nav>