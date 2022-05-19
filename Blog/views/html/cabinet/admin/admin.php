<?php require_once ROOT . '/views/html/cabinet/admin/framing/header.php' ?>

<?php require_once ROOT . '/views/html/cabinet/admin/framing/left_admin_menu.php'?>

<main class="main">
    <div class="content">
        <div class="block create-block">

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
                <div class=success>
                    <p><?php echo $success; ?></p>
                </div>
            <?php endif; ?>

            <h2>Create a new post</h2>
            <form class="form" action="#" method="post">
                <input class="form__item" type="text" name="title" maxlength="255" placeholder="Title (255 character)"
                       value=""/>

                <select class="form__item select-category" name="select_category">
                    <?php foreach ($categoryList as $category): ?>
                        <option><?php echo $category['category']; ?></option>
                    <?php endforeach; ?>
                </select>

                <textarea class="form__item textarea short-content" name="short_content" maxlength="255"
                          placeholder="Short content (255 character)"></textarea>
                <textarea class="form__item textarea" name="content" placeholder="Content"></textarea>
                <input class="form__item button" type="submit" name="submit" value="Create"/>
            </form>
        </div>
    </div>
</main>

<?php require_once ROOT . '/views/html/cabinet/admin/framing/footer.php' ?>

