<div class="menu">

    <div>
        <h1 class="title hidden">Admin</h1>
    </div>

    <ul class="nav">

        <li class="nav__link <?php if ($newPost): echo $linkHere; endif;?>">
            <a class="icon" href="/admin">&#9998;</a>
            <a class="name-link hidden" href="/admin">New post</a>
        </li>

        <li class="nav__link <?php if ($newCategory): echo $linkHere; endif;?>">
            <a class="icon" href="/admin/category">&#9998;</a>
            <a class="name-link hidden" href="/admin/category">New category</a>
        </li>

        <li class="nav__link <?php if ($listPost): echo $linkHere; endif;?>">
            <a class="icon" href="/admin/list"><?php if ($editPost): echo '&#9660;'; else: echo '&#8801;'; endif;?></a>
            <a class="name-link hidden" href="/admin/list">List of posts</a>
        </li>

        <?php if ($editPost): ?>
            <li class="nav__link <?php echo $linkHere;?> indent">
                <a class="icon" href="">&#128736;</a>
                <a class="name-link hidden" href="">Edit post</a>
            </li>
        <?php endif; ?>

        <li class="nav__link <?php if ($listCategories): echo $linkHere; endif;?>">
            <a class="icon" href="/admin/categories"><?php if ($editCategory): echo '&#9660;'; else: echo '&#8801;'; endif;?></a>
            <a class="name-link hidden" href="/admin/categories">List of categories</a>
        </li>
        <?php if ($editCategory): ?>
            <li class="nav__link <?php echo $linkHere;?> indent">
                <a class="icon" href="">&#128736;</a>
                <a class="name-link hidden" href="">Edit category</a>
            </li>
        <?php endif; ?>

        <li class="nav__link">
            <a class="icon" href="/cabinet">&#8656;</a>
            <a class="name-link hidden" href="/cabinet">Go to site</a>
        </li>
    </ul>

</div>
