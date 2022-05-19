<?php require_once ROOT . '/views/html/cabinet/admin/framing/header.php' ?>

<?php require_once ROOT . '/views/html/cabinet/admin/framing/left_admin_menu.php'?>

<main class="main">
    <div class="content">
        <div class="block create-block">
            <h2>Edit post #<?php echo $numPost; ?></h2>
            <form class="form" action="#" method="post">
                <input class="form__item" type="text" name="title" placeholder="Title (255 character)"
                       value="<?php echo $post['title'] ?>"/>

                <select class="form__item select-category" name="category">
                    <?php foreach ($categoryList as $category): ?>
                        <option><?php echo $category['category']; ?></option>
                    <?php endforeach; ?>
                </select>

                <textarea class="form__item textarea short-content" name="short_content"
                          placeholder="Short content (255 character)"><?php echo $post['short_content'] ?></textarea>
                <textarea class="form__item textarea" name="content"
                          placeholder="Content"><?php echo $post['content'] ?></textarea>
                <input class="form__item button" type="submit" name="submit" value="Edit"/>
            </form>
        </div>
    </div>
</main>

<?php require_once ROOT . '/views/html/cabinet/admin/framing/footer.php' ?>
