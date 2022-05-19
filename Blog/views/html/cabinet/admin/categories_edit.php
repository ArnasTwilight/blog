<?php require_once ROOT . '/views/html/cabinet/admin/framing/header.php' ?>

<?php require_once ROOT . '/views/html/cabinet/admin/framing/left_admin_menu.php'?>

<main class="main">
    <div class="content">

        <div class="block create-category">

                    <?php if (!empty($errors)):?>
                        <div class="errors">
                            <?php foreach ($errors as $error):?>
                                <ul>
                                    <li class="errors__error"><?php echo $error; ?></li>
                                </ul>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($success)):?>
                        <div class=success>
                            <p><?php echo $success; ?></p>
                        </div>
                    <?php endif; ?>

            <h2>Edit category <?php echo '#' . $category;?></h2>
            <form class="form" action="#" method="post">

                <input class="form__item" type="text" name="name_category" maxlength="255"
                       placeholder="Name Category (255 character)" value="<?php echo $category; ?>"/>
                <input class="form__item button" type="submit" name="submit" value="Edit"/>

            </form>
        </div>

        <aside class="category">
            <h3>Created categories:</h3>
            <p>
                <?php if(!empty($categoryList)): ?>
                    <?php foreach ($categoryList as $category): ?>
                        <a href="/category/<?php echo $category['id']; ?>"
                        class="category__item"><?php echo $category['category']; ?></a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </p>
        </aside>

    </div>
</main>

<?php require_once ROOT . '/views/html/cabinet/admin/framing/footer.php' ?>

