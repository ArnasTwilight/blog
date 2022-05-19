
<header class="header">
    <div class="header-menu container">

        <ul class="logotype-place list-reset">
            <?php if(!empty($userId)): ?>
                <li class="logotype-place__item logotype">
                    <img src="/views/template/img/guest.png" alt="user_logo">
                </li>
                <li class="logotype-place__item">
                    <a href="/cabinet" class="nav-link nav-link-menu <?php echo $cabinet == true ? 'header-active' : ''; ?>"><?php echo $userName; ?></a>
                </li>
            <?php endif; ?>
        </ul>

        <div class="links-place">
            <nav class="nav-list">


                <a class="nav-list__item nav-link nav-link-menu <?php echo $home == true ? 'header-active' : ''; ?>"
                   href="<?php echo $home == true ? '' : '/'; ?>">Home</a>

                    <?php if(!empty($userId)): ?>

                        <a class="nav-list__item nav-link nav-link-menu" href="/logout">Logout</a>
                    <?php else: ?>
                        <a class="nav-list__item nav-link nav-link-menu <?php echo $login == true ? 'header-active' : ''; ?>" href="/login">Login</a>
                    <?php if ($login == true or $register == true):?>
                            <a class="nav-list__item nav-link nav-link-menu <?php echo $register == true ? 'header-active' : ''; ?>" href="/register">Register</a>
                    <?php endif; ?>

                    <?php endif; ?>


            </nav>
        </div>

    </div>
</header>