<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo asset('css/vendor/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo asset('css/style.css') ?>">
</head>
<body>
    <header>
        <?php render('error.messages', $data) ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarColor01">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item <?= routeIs('') ? 'active' : '' ?>">
                            <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item <?= routeIs('about') ? 'active' : '' ?>">
                            <a class="nav-link" href="/about">About</a>
                        </li>
                        <li class="nav-item <?= routeIs('mail') ? 'active' : '' ?>">
                            <a class="nav-link" href="/mail">E-Mail</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>