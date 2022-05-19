<?php require_once ROOT . '/views/html/framing/header.php'; ?>
<?php require_once ROOT . '/views/html/framing/header_menu.php'; ?>

<section class="wrapper">
    <div class="container one-post">
        <article class="post">
            <a class="post__item category" href="/category/<?php echo $post['category_id']; ?>">
                <?php echo $post['category']; ?>
            </a>
            <h3 class="post__item post-title">
                <?php echo $post['title']; ?>
            </h3>
            <p class="post__item"><?php echo $post['content']; ?></p>
            <time class="post__item post-date"><?php echo $post['date_post']; ?></time>
        </article>
    </div>
</section>

<?php require_once ROOT . '/views/html/framing/footer.php'; ?>

