<?php require_once ROOT . '/views/html/framing/header.php'; ?>
<?php require_once ROOT . '/views/html/framing/header_menu.php'; ?>
    <section class="wrapper">
        <div class="login-form container">
            <h2 class="login-form__item title-form">Login</h2>

            <?php if (!empty($errors)): ?>
                <div class="errors">
                    <?php foreach ($errors as $error): ?>
                        <ul>
                            <li class="errors__error"><?php echo $error; ?></li>
                        </ul>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form class="form" action="#" method="post">
                <input class="form__item" type="email" name="email" placeholder="e-mail"
                       value="<?php echo $email; ?>"/>
                <input class="form__item" type="password" name="password" placeholder="password"
                       value=""/>
                <input class="form__item button" type="submit" name="submit" value="Login"/>
            </form>

            <p class="text-form">
                You have not yet registered on the site?
                <br>
                <br>
                <a class="text-link" href="/register">Register</a>
            </p>

        </div>
    </section>
<?php require_once ROOT . '/views/html/framing/footer.php'; ?>

