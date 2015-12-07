<html>
<head>

    <?php  foreach ($aCss as $sCss) { ?>
        <link href="<?= $sCss ?>" type="text/css" rel="stylesheet" >
    <?php } ?>

    <?php  foreach ($aScripts as $sScript) { ?>
        <script src="<?= $sScript ?>" type="text/javascript"></script>
    <?php } ?>
</head>
<body>

<div class="navbar navbar-inverse navbar-fixed-top">

    <div class="navbar-header">
        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a href="/" class="navbar-brand">Pet Shop</a>
    </div>
</div>

<div class="container">
    <div class="principal">
        <?php
        if (!empty($sMsg)) {
        ?>
        <p class="alert alert-<?= $sStatus ?> "><?= $sMsg ?></p>
<?php } ?>