<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
        <?php echo NAME_SITE; ?>
        <?php echo $cabinet == true ? ' | cabinet' : ''; ?>
        <?php echo $category == true ? ' | ' . $selectCategory : ''; ?>
        <?php echo $postPage == true ? ' | post' : ''; ?>
        <?php echo $register == true ? ' | register' : ''; ?>
        <?php echo $login == true ? ' | login' : ''; ?>
    </title>
    <link rel="stylesheet" href="/views/template/css/normalize.css">
    <link rel="stylesheet" href="/views/template/css/style.css">
    <link rel="icon" href="/views/template/img/favicon.ico" type="image/x-icon">
</head>
<body>
