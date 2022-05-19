<?php require_once ROOT . '/views/html/framing/header.php'; ?>
<?php require_once ROOT . '/views/html/framing/header_menu.php'; ?>

<section class="wrapper">
    <div class="content-container container">

        <div class="title-categories">
            <h1><?php echo $selectCategory; ?></h1>
        </div>

        <div class="post-container">
            <?php foreach ($categoryPost as $news): ?>
                <article class="post">
                    <a href="#" class="post__item category"><?php echo $news['category']; ?></a>
                    <h3 class="post__item">
                        <a class="nav-link"
                           href="/post/<?php echo $news['id']; ?>"><?php echo $news['title']; ?></a>
                    </h3>
                    <p class="post__item">
                        <?php echo $news['short_content'] . ' &#8230'; ?>
                    </p>
                    <time class="post__item post-date"><?php echo $news['date_post']; ?></time>
                </article>
            <?php endforeach; ?>
        </div>

        <aside class="side-bar">
            <h3 class="side-bar__item list-reset side-bar-title">Category</h3>
            <?php foreach ($categoryList as $category): ?>
                <a class="side-bar__item category"
                   href="/category/<?php echo $category['id']; ?>"><?php echo $category['category']; ?></a>
            <?php endforeach; ?>
        </aside>

        <?php echo $pagination->getLinks(); ?>

    </div>
</section>

<?php require_once ROOT . '/views/html/framing/footer.php'; ?>

