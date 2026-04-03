<?php
/*
Template Name: Квартиры
*/
get_header();
?>


<div class="catalog-page">
    <h1 class="">Выберите квартиру для комфортного проживания</h1>

<?php get_template_part('templates/filter'); ?>
    <!-- Карточка услуги -->
    <section class="catalog">
        <div class="apartments">
            <article class="apartment">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/apart_1.png" alt="Квартира" class="apart__n">
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
                <div class="apartment__price">
                    <p>от 6 000 ₽<span> / 1 сутки</span></p>
                </div>
                <button class="more">Подробнее</button>
                <button class="booking">Забронировать</button>
            </article>

            <article class="apartment">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/apart_1.png" alt="Квартира" class="apart__n">
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
                <div class="apartment__price">
                    <p>от 6 000 ₽<span> / 1 сутки</span></p>
                </div>
                <button class="more">Подробнее</button>
                <button class="booking">Забронировать</button>
            </article>
        </div>
    </section>
</div>

<?php get_template_part('templates/reviews'); ?>
<?php get_footer(); ?>