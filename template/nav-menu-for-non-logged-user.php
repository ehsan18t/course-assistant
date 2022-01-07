<?php $page = basename($_SERVER['PHP_SELF']); ?>

<div class="nav-menu-wrapper">
    <div class="nav-menu-container-right">
        <?php
            if ($page == 'login.php')
                echo '<a href="' . SIGNUP_PAGE . '" class="nav-menu-btn">Sign Up</a>';
            else
                echo '<a href="' . LOGIN_PAGE . '" class="nav-menu-btn">Sign In</a>';
        ?>
    </div>
</div>
</nav>