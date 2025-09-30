<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>MINI</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- JS -->
    <!-- please note: The JavaScript files are loaded in the footer to speed up page construction -->
    <!-- See more here: http://stackoverflow.com/q/2105327/1114320 -->

    <!-- CSS -->
    <link href="<?= URL; ?>css/style.css" rel="stylesheet"> <!-- Changed to short echo tag for modern syntax -->
</head>
<body>
    <!-- logo -->
    <div class="logo">
        MINI
    </div>

    <!-- navigation -->
    <div class="navigation">
        <a href="<?= URL; ?>">home</a> <!-- Changed to short echo tag for modern syntax -->
        <a href="<?= URL; ?>home/exampleone">subpage</a> <!-- Changed to short echo tag for modern syntax -->
        <a href="<?= URL; ?>home/exampletwo">subpage 2</a> <!-- Changed to short echo tag for modern syntax -->
        <a href="<?= URL; ?>songs">songs</a> <!-- Changed to short echo tag for modern syntax -->
    </div>
