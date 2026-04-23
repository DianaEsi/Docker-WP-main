<?php
/*
Template Name: О компании
*/
get_header();
?>


<!-- Главный экран -->
<main>
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/main_image.png" alt="Фоновое изображение">
    <h1>AURA — Управляющая компания</h1>
    <p>Посуточная аренда квартир во Владикавказе</p>
</main>

<section class="booking">

    <div class="booking__section">

        <h2 class="booking-title">Бронирование</h2>

        <div id="hr-widget"></div>
        <script type="module" src="https://homereserve.ru/widget.js"></script>
        <script type="module">
            window.homereserve.initWidgetSearch({
                "token": "thEoIlQkYg"
            })
        </script>
    </div>


    <div class="marquee-container">
        <div class="marquee-text">
            <span>Высокий уровень сервиса </span>
            <span>Актуальные цены</span>
            <span>Отсутствие скрытых платежей</span>
        </div>

    </div>

</section>
<!-- О нас -->
<section class="about">
    <div class="about_column-1">
        <h2>О нас</h2>
        <p>Aura — это сервис посуточной аренды квартир, ориентированный на комфортное и спокойное проживание гостей в поездках любого формата.</p>
        <p>Сегодня в нашем управлении тщательно отобранные объекты, каждый из которых соответствует высоким стандартам чистоты, уюта и функциональности. Все квартиры полностью оборудованы для комфортного проживания: удобные спальные места, современная техника, свежее постельное бельё и продуманные детали, которые делают отдых приятным и беззаботным.</p>
        <p>Мы сопровождаем гостей на каждом этапе — от быстрого бронирования до комфортного выезда. Оперативная поддержка, комфорт, прозрачные условия, честные цены и внимание к мелочам — то, за что нас выбирают снова.</p>
    </div>
    <div class="about_column-2">
        <div>
            <p><span>5+ лет</span><br>на рынке</p>
        </div>
        <div>
            <p><span>32 квартиры</span><br>в управлении</p>
        </div>
        <div>
            <p><span>1000+</span><br>успешных бронирований</p>
        </div>
    </div>
</section>

<!-- Каталог -->

<section class="desktop " id="apartments">
    <h2 class="desktop">Выберите квартиру для комфортного проживания</h2>
    <?php get_template_part('templates/filter'); ?>
</section>
<!-- Карточка услуги -->
<section class="catalog" id="apartments">
    <h2 class="mobile">Квартиры<a href="<?php echo get_permalink(14); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow_forward.svg" alt="Стрелка" style="position: relative;left: 30%;"></a></h2>

    <div class="apartments">
        <?php
        $args = array(
            'post_type' => 'apartment',
            'posts_per_page' => 5,
            'post_status' => 'publish'
        );
        $query = new WP_Query($args);

        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                $apartment_id = get_the_ID();
                $square = get_post_meta($apartment_id, 'apartment_square', true);
                $count = get_post_meta($apartment_id, 'apartment_count', true);
                $rooms = get_post_meta($apartment_id, 'apartment_rooms', true);
                $floor = get_post_meta($apartment_id, 'apartment_floor', true);
                $address = get_post_meta($apartment_id, 'apartment_address', true);
                $price = get_post_meta($apartment_id, 'apartment_price', true);
                if (empty($price)) $price = '6 000';
        ?>
                <article class="apartment">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('large', array('class' => 'apart__n')); ?>
                    <?php else : ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/apart_1.png" class="apart__n" alt="Квартира">
                    <?php endif; ?>

                    <div>
                        <div class="apartment__info" style="padding-left: 15px;">
                            <?php if ($square): ?>
                                <div class="square">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/square.svg" alt="Площадь">
                                    <p><?php echo esc_html($square); ?> м<sup>2</sup></p>
                                </div>
                            <?php endif; ?>
                            <?php if ($count): ?>
                                <div class="count">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon_quest.svg" alt="Иконка человечка">
                                    <p>до <?php echo esc_html($count); ?> чел</p>
                                </div>
                            <?php endif; ?>
                            <?php if ($rooms): ?><p><?php echo esc_html($rooms); ?> комн</p><?php endif; ?>
                            <?php if ($floor): ?><p><?php echo esc_html($floor); ?> этаж</p><?php endif; ?>
                        </div>
                        <?php if ($address): ?>
                            <div class="apartment__location">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon_location.svg" alt="Иконка локации">
                                <p><?php echo esc_html($address); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="apartment__price">
                        <p>от <?php echo esc_html($price); ?> ₽<span> / 1 сутки</span></p>
                    </div>
                    <a href="<?php the_permalink(); ?>" class="more">Подробнее</a>
                    <!-- <button class="more" data-id="<?php echo $apartment_id; ?>">Подробнее</button> -->
                </article>
        <?php
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p>Квартиры не найдены</p>';
        endif;
        ?>
    </div>
</section>

<!-- Сотрудничество -->
<section class="cooperation">
    <h2>Сотрудничество</h2>
    <div class="cooperation__rectangle">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/handshake.png" alt="Сотрудничество" class="handshake">
        <h3>Увеличьте доход от вашей недвижимости вместе с Aura</h3>
        <div>
            <p>Aura — управляющая компания по посуточной аренде, которая берёт на себя полное управление квартирой и помогает собственникам получать стабильный доход без лишних забот.</p>
            <a href="<?php echo get_permalink(12); ?>" class="cooperation__button">Подробнее о сотрудничестве <img src="<?php echo get_template_directory_uri(); ?>/assets/images/arrow_forward.svg" alt="Стрелка вперед"></a>
        </div>
    </div>
</section>



<?php get_template_part('templates/feedback'); ?>

<?php get_template_part('templates/reviews'); ?>

<?php get_footer(); ?>