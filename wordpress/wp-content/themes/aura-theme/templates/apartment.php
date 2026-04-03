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
            <h2>Описание</h2>
            <p>Студия с комфортом разместит одногоили двух гостей. Главная изюминка апартаментов — роскошный дизайн, который придется по вкусу всем ценителям богемного шика.</p>
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
        </section>
        <section class="included">
            <h2>
                <?= get_category( 4, ARRAY_A ) ['name'] ?>
            </h2>
            <div class="included__description">
                <?php 
                $posts = get_posts( [
                    'numberposts'=> -1,
                    'category_name'=> 'included',
                    'post_type'=> 'post',
                    'suppres_filter'=> true,
                ]) ;
                foreach ( $posts as $post ) {
                    setup_postdata( $post );
                ?>
                <div>
                    <p><?php the_title(); ?></p>
                    <ul>
                        <?php the_content(); ?>
                        <li>Телевизор с плоским экраном</li>
                        <li>Телевизор со Smart TV</li>
                    </ul>
                </div>

                <?php
                }
wp_reset_postdata();
                ?>


                <div>
                    <p>Спальные места</p>
                    <ul>
                        <li>Двуспальная кровать — Х шт.</li>
                        <li>Односпальная кровать — Х шт.</li>
                        <li>Диван-кровать — Х шт.</li>
                        <li>Кресло-кровать — Х шт.</li>
                    </ul>
                    <p class="notice">* Каждому гостю при заезде предоставляется чистое постельное бельё, полотенца и предметы первой необходимости.</p>
                </div>
                <div>
                    <p>Мебель</p>
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
            <h2>Правила проживания</h2>
            <div>
                <div class="rule">
                    <p>Число человек, пребывающих в квартире, не должно превышать число, оговоренное при бронировании.</p>
                </div>
                <div class="rule">
                    <p>Мусор можно выбросить в мусорный бак или оставить в квартире, не в подъезде.</p>
                </div>
                <div class="rule">
                    <p>Соблюдайте, пожалуйста, закон о тишине с 22:00 до 08:00.</p>
                </div>
                <div class="rule">
                    <p>Курение в квартире строго запрещено.</p>
                </div>
                <div class="rule">
                    <p>Если вы заселяетесь с животным, необходимо об этом сообщить. Депозит за животное увеличивается вдвойне, и проживание с животным оплачивается отдельно. Всю ответственность за поведение животного и причинение вреда имуществу вы берете на себя.</p>
                </div>
                <div class="rule">
                    <p>Обращаем ваше внимание, что у нас ведётся фото- и видеофиксация квартиры перед вашим заселением на предмет исправного технического состояния. Убедительная просьба: о неисправностях бытовой техники и мебели сообщайте сразу при заселении.</p>
                </div>
                <div class="rule">
                    <p>Если после вашего выселения будет обнаружен дефект или поломка, вы берете всю ответственность на себя, так как техническое состояние бытовых приборов и наличие возможных недостатков фиксируются в отчёте до вашего заселения.</p>
                </div>
                <div class="rule">
                    <p>*При длительном проживании для Вас предусмотрена бесплатная уборка*</p>
                </div>
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
            <p>Студия с комфортом разместит одногоили двух гостей. Главная изюминка апартаментов — роскошный дизайн, который придется по вкусу всем ценителям богемного шика.</p>
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