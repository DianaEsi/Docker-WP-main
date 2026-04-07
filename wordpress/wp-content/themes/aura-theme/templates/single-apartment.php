<?php
/*
Template Name: Квартира
*/
get_header();
?>


<!-- Галерея -->
<section class="gallery">
    <img src="" alt="Галерея фотографий квартиры">

</section>
<div class="apartment__description">
    <div class="dd">
        <section class="description">

        <?php
            $args = array(
            'post_type' => 'apartment',
            'posts_per_page' => -1
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) {
            while ($query->have_posts()) {
            $query->the_post();

            $description = get_post_meta(get_the_ID(),'description', true );
            $square = get_post_meta( get_the_ID(),'square', true );
            $count = get_post_meta( get_the_ID(),'count', true );
            $rooms = get_post_meta( get_the_ID(),'rooms', true );
            $floor = get_post_meta( get_the_ID(),'floor', true );
            $address = get_post_meta( get_the_ID(),'adress', true );
            }
            }
        ?>


            <h2>Описание</h2>
            <p><?php echo $description; ?></p>
            <div class="apartment__info">
                <div class="square">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/square.svg" alt="Площадь">
                    <p><?php echo $square; ?> м<sup>2</sup></p>
                </div>
                <div class="count">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon_quest.svg" alt="Иконка человечка">
                    <p>до <?php echo $count; ?> чел</p>
                </div>
                <p><?php echo $rooms; ?> комн</p>
                <p><?php echo $floor; ?> этаж</p>
            </div>
            <div class="apartment__location">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon_location.svg" alt="Иконка локации">
                <p><?php echo $address; ?></p>
            </div>

        </section>
        <section class="included">
            <h2>Удобства</h2>
            <div class="included__description">
                <div>
                    <p>Видео/аудио</p>
                    <ul>
                        <li>Телевизор с плоским экраном</li>
                        <li>Телевизор со Smart TV</li>
                    </ul>
                </div>

                <div>
                    <p>Интернет</p>
                    <ul>
                        <li>Wi-Fi</li>
                        <li>Интернет</li>
                    </ul>
                </div>
                <div>
                    <p>Ванная комната</p>
                    <ul>
                        <li>Ванна или душевая кабина</li>
                        <li>Тапочки</li>
                        <li>Унитаз</li>
                        <li>Санузел</li>
                        <li>Туалет</li>
                        <li>Банные принадлежности</li>
                        <li>Гигиенические средства</li>
                        <li>Туалетные средства</li>
                    </ul>
                </div>
                <div>
                    <p>Электроника</p>
                    <ul>
                        <li>Фен</li>
                        <li>Кофемашина</li>
                        <li>Микроволновая</li>
                        <li>Утюг</li>
                        <li>Плита для приготовления пищи</li>
                        <li>Холодильник</li>
                    </ul>
                </div>

                <div>
                    <p>Спальные места</p>
                    <ul>
                        <li>Двуспальная кровать — Х шт.</li>
                        <li>Односпальная кровать — Х шт.</li>
                        <li>Диван-кровать — Х шт.</li>
                        <li>Кресло-кровать — Х шт.</li>
                    </ul>
                    <p class="notice">* Каждому гостю при заезде предоставляется чистое постельное бельё, полотенца и предметы первой необходимости.</p>
                    <div>
                        <p style="
    margin-top: 20px;
">Мебель</p>
                        <ul>
                            <li>Стулья</li>
                            <li>Стол</li>
                            <li>Тумбы</li>
                            <li>Эксклюзивная мебель</li>
                            <li>Шкаф для одежды</li>
                            <li>Мягкая мебель</li>
                            <li>Журнальный столик</li>
                            <li>Вешалки</li>
                            <li>Обеденный стол</li>
                            <li>Зеркало</li>
                            <li>Стул</li>
                        </ul>
                    </div>
                </div>
                <div>
                    <p>Прочее</p>
                    <ul>
                        <li>Чайник</li>
                        <li>Стиральная машина</li>
                        <li>Набор посуды</li>
                        <li>Кухонный уголок</li>
                        <li>Кухня</li>
                        <li>Гладильная доска</li>
                        <li>Столовые приборы</li>
                        <li>Стаканы</li>
                        <li>Кухонная утварь</li>
                        <li>Информационная карта, меню</li>
                        <li>Сушилка для белья</li>
                        <li>Онлайн-регистрация до заезда</li>
                        <li>Письменные принадлежности</li>
                        <li>Номер для некурящих</li>
                        <li>Кухонная посуда</li>
                        <li>Гостиная зона</li>
                        <li>Обеденная зона</li>
                    </ul>
                </div>


            </div>
            <div>
                <a href="">Смотреть все Удобства</a>
            </div>
        </section>
        <section class="check-out-time">
            <h2>Расчётный час</h2>
            <p><img src="<?php echo get_template_directory_uri(); ?>/assets/images/check-in.svg" alt="Стрелка заезд"> Заезд с 14:00</p>
            <p><img src="<?php echo get_template_directory_uri(); ?>/assets/images/check-out.svg" alt="Стрелка выезд"> Выезд до 12:00</p>
            <p class="check-out-time__note">*После 12:00 возможно продление с дополнительной оплатой по предварительному согласованию.</p>
        </section>

        <section class="rules">
            <h2><?= get_category(7, ARRAY_A)['name'] ?></h2>
            <div>
                <?php
                $posts = get_posts([
                    'numberposts' => -1,
                    'category_name' => 'rules',
                    'post_type' => 'post',
                    'suppres_filter' => true,
                ]);
                foreach ($posts as $post) {
                    setup_postdata($post);
                ?>
                    <div class="rule">
                        <?php the_content(); ?>
                    </div>
                <?php
                }
                wp_reset_postdata();
                ?>
                <div class="rule-notice">
                    <p>*Обратите внимание — сумма за непрожитые дни не возвращается!*</p>
                </div>
                <p>Просим вас бережно относиться к имуществу в квартире</p>
                <p>Мы готовы выслушать и учесть любые Ваши пожелания! </p>
                <p>Вы можете позвонить, написать нам, и мы обязательно отреагируем на ваши просьбы.</p>
            </div>
        </section>
    </div>
    <div class="card">
        <article class="apartment">
            <p>Студия с комфортом разместит одного или двух гостей. Главная изюминка апартаментов — роскошный дизайн, который придется по вкусу всем ценителям богемного шика.</p>
            <div>
                <div class="apartment__info">
                    <div class="square">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/square.svg" alt="Площадь">
                        <p>32 м<sup>2</sup></p>
                    </div>
                    <div class="count">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon_quest.svg" alt="Иконка человечка">
                        <p>до 5 чел</p>
                    </div>
                    <p>1 комн</p>
                    <p>1 этаж</p>
                </div>
                <div class="apartment__location">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon_location.svg" alt="Иконка локации">
                    <p>г. Владикавказ; ул. Ген. Плиева, 17</p>
                </div>
            </div>
            <p class="card__rules">Правила проживания</p>
            <p><img src="<?php echo get_template_directory_uri(); ?>/assets/images/check-in.svg" alt="Стрелка заезд"> Заезд с 14:00</p>
            <p><img src="<?php echo get_template_directory_uri(); ?>/assets/images/check-out.svg" alt="Стрелка выезд"> Выезд до 12:00</p>
            <p class="rule">Депозит — 3 000 ₽ </p>
            <div class="apartment__price">
                <p>от 6 000 ₽<span> / 1 сутки</span></p>
            </div>
            <button class="booking">Забронировать</button>
        </article>

    </div>
</div>

<?php get_template_part('templates/feedback'); ?>

<?php get_footer(); ?>