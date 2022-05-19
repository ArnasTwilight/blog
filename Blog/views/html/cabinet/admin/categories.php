<?php require_once ROOT . '/views/html/cabinet/admin/framing/header.php' ?>

<?php require_once ROOT . '/views/html/cabinet/admin/framing/left_admin_menu.php'?>

<main class="main">
    <div class="content">
        <div class="block list">
            <table class="table">
                <tr class="title-table">
                    <th class="title-table__item">№</th>
                    <th class="title-table__item">ID</th>
                    <th class="title-table__item">Category</th>
                    <th class="title-table__item action">Edit</th>
                    <th class="title-table__item action">Delete</th>
                </tr>
                <?php if (!empty($categories)):?>
                    <?php $i = $countCategories; ?>
                    <?php foreach ($categories as $item): ?>
                        <tr class="row">
                            <td class="cell"><?php echo $i--; ?></td>
                            <td class="cell"><?php echo $item['id']; ?></td>
                            <td class="cell"><?php echo $item['category']; ?></td>
                            <td class="cell action-ico"><a class="edit"
                                                           href="/admin/categories/edit/<?php echo $item['id']; ?>">&#9998;</a>
                            </td>
                            <td class="cell action-ico"><a class="delete"
                                                           href="/admin/categories/delete/<?php echo $item['id']; ?>">&#128465;</a>
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
