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
        </article>
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