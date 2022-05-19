<?php require_once ROOT . '/views/html/framing/header.php'; ?>
<?php require_once ROOT . '/views/html/framing/header_menu.php'; ?>

<section class="wrapper">
    <div class="login-form container">
        <h2 class="login-form__item title-form">Register</h2>

        <?php if (!empty($errors)): ?>
            <div class="errors">
                <?php foreach ($errors as $error): ?>
                    <ul>
                        <li class="errors__error"><?php echo $error; ?></li>
                    </ul>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class=success-message>
                <p><?php echo $success; ?></p>
            </div>
        <?php endif; ?>

        <form class="form" action="#" method="post">
            <input class="form__item" type="text" name="name" placeholder="name"
                   value=""/>
            <input class="form__item" type="email" name="email" placeholder="e-mail"
                   value=""/>
            <input class="form__item" type="password" name="password" placeholder="password"
                   value=""/>
            <input class="form__item" type="password" name="password_repeat" placeholder="repeat password"
                   value=""/>
            <input class="form__item button" type="submit" name="submit" value="Register"/>
        </form>

        <p class="text-form">
            Are you already registered?
            <br><br>
            <a class="text-link" href="/login">Login</a>
        </p>

    </div>
</section>

<?php require_once ROOT . '/views/html/framing/footer.php'; ?>
