<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=page_info" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=arrow_forward" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=keyboard_arrow_down" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=swap_vert" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=arrow_downward" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=close" />

    <title>AURA - Управляющая компания</title>
    <?php wp_head(); ?>
</head>

<body>
    <!-- Меню -->
    <header class="menu">
        <div class="container">
            <div class="container__mobile-header">
                <a href="index.html">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo_aura_png.png" alt="AURA логотип" class="logo">
                </a>
                <button class="burger" href="nav ><img src=" <?php echo get_template_directory_uri(); ?>/assets/images/burger.svg" alt=""></button>
            </div>
            <div class="container__header">
                <div class="nav">

                    <nav class="nav nav__menu">
                        <span class="material-symbols-sharp"> close </span>
                        <?php
                        wp_nav_menu([
                            "theme_location" => "top",
                            "container" => "",
                            "menu_class" => "nav__list",
                            "menu_id" => "",
                        ]);
                        ?>
                    </nav>

                    <div class="nav nav__socials">
                        <div class="nav__icons">
                            <div>
                                <a href="https://wa.me/79288602062">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/WhatsApp.svg" alt="WhatsApp" class="whatsapp">
                                </a>
                            </div>
                            <div>
                                <a href="https://t.me/79288602062">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Telegram.svg" alt="Telegram" class="telegram">
                                </a>
                            </div>
                        </div>
                        <div class="tel">
                            <p>Телефон менеджера</p>
                            <a href="tel:+79288602062">+7 (928) 860-20-62</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>