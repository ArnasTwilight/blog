<?php require_once ROOT . '/views/html/framing/header.php'; ?>
<?php require_once ROOT . '/views/html/framing/header_menu.php' ?>

<main>
    <section class="banner cabinet-banner">
    </section>
</main>

<section class="wrapper">
    <div class="container content_container cabinet">
        <div class="edit-form">

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

            <p class="list-reset user-img"><img src="/views/template/img/guest.png" alt="user_logo"></p>

            <form class="form" action="#" method="post">

                <input class="form__item" type="text" name="name" placeholder="<?php echo $userData['name']; ?>"
                       value=""/>
                <p class="form__item email">
                    <?php echo $userData['email']; ?>
                </p>
                <input class="form__item" type="password" name="password" placeholder="new password"
                       value=""/>
                <input class="form__item" type="password" name="password_repeat" placeholder="repeat password"
                       value=""/>
                <input class="form__item button" type="submit" name="submit" value="Edit"/>
            </form>

            <?php if ($admin != false): ?>
                <div class="admin-control">
                    <a class="button admin-button" href="/admin">Admin panel</a>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>

<?php require_once ROOT . '/views/html/framing/footer.php'; ?>
