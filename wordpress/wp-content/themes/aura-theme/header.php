<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>AURA - Управляющая компания</title>
    <?php wp_head(); ?>
</head>

<body>
    <!-- Меню -->
    <header class="menu">
        <div class="container">
            <div class="container__mobile-header">
                <?php if (is_front_page()) : ?>
                <a href="/">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo_aura_png.png" alt="AURA логотип" class="logo">
                </a>

                <?php else : ?>

                    <a href="/">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo_aura_png.png" alt="AURA логотип" class="logo" style="display: none">
                </a>

                <?php endif; ?>



                <button class="burger"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/burger.svg" alt=""></button>
            </div>
            <div class="container__header">
                <div class="nav">

                    <nav class="nav__menu">
                        <button class="close" style="border-style: none; background-color: unset; margin-left: 200px;"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/close.svg" alt="Закрыть"></button>


                        <?php if (is_singular('apartment')) : ?>
                            <ul class="nav__list">
                                <li>
                                    <a href="<?php echo get_post_type_archive_link('apartment'); ?>">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow_left.svg" alt="Стрелка назад"  style="vertical-align: middle"> К остальным квартирам
                                    </a>
                                </li>
                            </ul>

                        <?php elseif (is_page('cooperation')) : ?>
                            <ul class="nav__list">
                                <li>
                                    <a href="/"  style="vertical-align: middle"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow_left.svg" alt="Стрелка назад"  style="vertical-align: middle"> На главную</a>
                                </li>
                            </ul>


                        <?php else : ?>

                            <?php
                            wp_nav_menu([
                                "theme_location" => "top",
                                "container" => "",
                                "menu_class" => "nav__list",
                                "menu_id" => "",
                            ]);
                            ?>



                        <?php endif; ?>
                    </nav>





                    <script>
                        const burger = document.querySelector('.burger');
                        const nav = document.querySelector('.nav');
                        const close = document.querySelector('.close');

                        burger.addEventListener('click', () => {
                            nav.classList.add('active');
                        });

                        close.addEventListener('click', () => {
                            nav.classList.remove('active');
                        });
                    </script>


                    <div class="nav__socials">
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