<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= asset('css/style.css') ?>">
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>
<header>
    <?php render('error.messages') ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01"
                    aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
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
                    <?php if (auth()->user()) { ?>
                        <li class="nav-item <?= routeIs('mail') ? 'active' : '' ?>">
                            <a class="nav-link" href="/mail">E-Mail</a>
                        </li>
                    <?php } ?>
                    <li class="divider"></li>
                    <?php if (!auth()->user()) { ?>
                        <li><a href="/login" class="nav-link">Login</a></li>
                        <li><a href="/register" class="nav-link">Register</a></li>
                    <?php } else { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="logged" role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false" href="#"><?=
                                ucfirst(auth()->user()->getUsername()) ?></a>
                            <div class="dropdown-menu" aria-labelledby="logged">
                                <a href="/profile" class="dropdown-item">Account</a>
                                <a class="dropdown-item" href="/logout">Logout</a>
                            </div>
                        </li>
                    <?php } ?>

                </ul>
            </div>
        </div>
    </nav>
</header>