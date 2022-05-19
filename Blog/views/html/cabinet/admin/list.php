<?php require_once ROOT . '/views/html/cabinet/admin/framing/header.php' ?>

<?php require_once ROOT . '/views/html/cabinet/admin/framing/left_admin_menu.php' ?>

    <main class="main">
        <div class="content">
            <div class="block list">
                <table class="table">
                    <tr class="title-table">
                        <th class="title-table__item">Count</th>
                        <th class="title-table__item">ID</th>
                        <th class="title-table__item">Category</th>
                        <th class="title-table__item">Title</th>
                        <th class="title-table__item">Date post</th>
                        <th class="title-table__item hidden">Short content</th>
                        <th class="title-table__item hidden">Is new</th>
                        <th class="title-table__item action">Edit</th>
                        <th class="title-table__item action">Delete</th>
                    </tr>
                    <tr>
                    <?php if (!empty($list)): ?>
                    <?php $i = $countNews; ?>
                        <?php foreach ($list as $item): ?>
                            <tr class="row">
                                <td class="cell"><?php echo $i--; ?></td>
                                <td class="cell"><?php echo $item['id']; ?></td>
                                <td class="cell"><?php echo $item['category']; ?></td>
                                <td class="cell"><?php echo $item['title']; ?></td>
                                <td class="cell"><?php echo $item['date_post']; ?></td>
                                <td class="cell hidden"><?php echo $item['short_content']; ?></td>
                                <td class="cell hidden"><?php echo $item['is_new']; ?></td>
                                <td class="cell action-ico"><a class="edit"
                                                               href="/admin/edit/<?php echo $item['id']; ?>">&#9998;</a>
                                </td>
                                <td class="cell action-ico"><a class="delete"
                                                               href="/admin/delete/<?php echo $item['id']; ?>">&#128465;</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </table>

                <?php echo $pagination->getLinks(); ?>

            </div>
        </div>
    </main>

<?php require_once ROOT . '/views/html/cabinet/admin/framing/footer.php' ?>