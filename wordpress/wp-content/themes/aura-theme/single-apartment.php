<?php

/**
 * Шаблон отдельной квартиры
 */
get_header();



if (have_posts()) : while (have_posts()) : the_post();
        $apartment_id = get_the_ID();

        // Мета-поля
        $description = get_post_meta($apartment_id, 'apartment_description', true);
        $square      = get_post_meta($apartment_id, 'apartment_square', true);
        $count       = get_post_meta($apartment_id, 'apartment_count', true);
        $rooms       = get_post_meta($apartment_id, 'apartment_rooms', true);
        $floor       = get_post_meta($apartment_id, 'apartment_floor', true);
        $address     = get_post_meta($apartment_id, 'apartment_address', true);
        $tv          = get_post_meta($apartment_id, 'amenities_tv', true);
        $bathroom    = get_post_meta($apartment_id, 'amenities_bathroom', true);
        $price       = get_post_meta($apartment_id, 'apartment_price', true);
        if (empty($price)) $price = '6 000';

        // Приводим к массиву
        if (!is_array($tv)) $tv = maybe_unserialize($tv);
        if (!is_array($bathroom)) $bathroom = maybe_unserialize($bathroom);

        // Получаем галерею
        $gallery_ids = get_post_meta($apartment_id, 'apartment_gallery', true);
        $gallery_images = array();
        if (!empty($gallery_ids)) {
            $ids = explode(',', $gallery_ids);
            foreach ($ids as $id) {
                $img_url = wp_get_attachment_url(trim($id));
                if ($img_url) $gallery_images[] = $img_url;
            }
        }
        if (has_post_thumbnail()) {
            array_unshift($gallery_images, get_the_post_thumbnail_url($apartment_id, 'large'));
        }
?>

        <!-- Галерея -->
        <section class="gallery">
            <?php if (!empty($gallery_images)) : ?>

                <div class="swiper thumb-swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($gallery_images as $img) : ?>
                            <div class="swiper-slide">
                                <img src="<?php echo esc_url($img); ?>" alt="<?php the_title_attribute(); ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>


                <div class="swiper main-swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($gallery_images as $img) : ?>
                            <div class="swiper-slide">
                                <img src="<?php echo esc_url($img); ?>" alt="<?php the_title_attribute(); ?>">
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            <?php else : ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/apart_1.png" alt="Квартира">
            <?php endif; ?>
        </section>


        <div class="apartment__description">
            <div class="dd">
                <?php if (!empty($description)) : ?>
                    <section class="description">
                        <h2>Описание</h2>
                        <p><?php echo nl2br(esc_html($description)); ?></p>
                    </section>
                <?php endif; ?>

                <?php if (!empty($square) || !empty($count) || !empty($rooms) || !empty($floor) || !empty($address)) : ?>
                    <section class="characteristics">
                        <h2>Характеристики</h2>
                        <div class="apartment__info">
                            <?php if (!empty($square)) : ?>
                                <div class="square">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/square.svg" alt="Площадь">
                                    <p><?php echo esc_html($square); ?> м<sup>2</sup></p>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($count)) : ?>
                                <div class="count">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon_quest.svg" alt="Гости">
                                    <p>до <?php echo esc_html($count); ?> чел</p>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($rooms)) : ?><p><?php echo esc_html($rooms); ?> комн</p><?php endif; ?>
                            <?php if (!empty($floor)) : ?><p><?php echo esc_html($floor); ?> этаж</p><?php endif; ?>
                        </div>
                        <?php if (!empty($address)) : ?>
                            <div class="apartment__location">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon_location.svg" alt="Адрес">
                                <p><?php echo esc_html($address); ?></p>
                            </div>
                        <?php endif; ?>
                    </section>
                <?php endif; ?>

                <?php if (!empty($tv) || !empty($bathroom)) : ?>
                    <section class="included">
                        <h2>Удобства</h2>
                        <div class="included__description">
                            <?php if (!empty($tv)) : ?>
                                <div>
                                    <p>Видео/аудио</p>
                                    <ul>
                                        <?php foreach ($tv as $item) : ?>
                                            <li><?php echo esc_html(str_replace('_', ' ', $item)); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($bathroom)) : ?>
                                <div>
                                    <p>Ванная комната</p>
                                    <ul>
                                        <?php foreach ($bathroom as $item) : ?>
                                            <li><?php echo esc_html(str_replace('_', ' ', $item)); ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    </section>
                <?php endif; ?>

                <section class="check-out-time">
                    <h2>Расчётный час</h2>
                    <p><img src="<?php echo get_template_directory_uri(); ?>/assets/images/check-in.svg" alt="Заезд"> Заезд с 14:00</p>
                    <p><img src="<?php echo get_template_directory_uri(); ?>/assets/images/check-out.svg" alt="Выезд"> Выезд до 12:00</p>
                    <p class="check-out-time__note">*После 12:00 возможно продление с дополнительной оплатой по предварительному согласованию.</p>
                </section>

                <?php $rules_cat = get_category(7); ?>
                <?php if ($rules_cat && !is_wp_error($rules_cat)) : ?>
                    <section class="rules">
                        <h2><?php echo esc_html($rules_cat->name); ?></h2>
                        <div>
                            <?php
                            $rules_posts = get_posts([
                                'numberposts' => -1,
                                'category' => 7,
                                'post_type' => 'post',
                            ]);
                            foreach ($rules_posts as $post) {
                                setup_postdata($post);
                                echo '<div class="rule">' . get_the_content() . '</div>';
                            }
                            wp_reset_postdata();
                            ?>
                            <div class="rule-notice">
                                <p>*Обратите внимание — сумма за непрожитые дни не возвращается!*</p>
                            </div>
                            <p>Просим вас бережно относиться к имуществу в квартире</p>
                            <p>Мы готовы выслушать и учесть любые Ваши пожелания!</p>
                            <p>Вы можете позвонить, написать нам, и мы обязательно отреагируем на ваши просьбы.</p>
                        </div>
                    </section>
                <?php endif; ?>
            </div>

            <div class="card">
                <article class="apartment">
                    <?php if (!empty($description)) : ?>
                        <p><?php echo esc_html(mb_substr($description, 0, 150)) . '...'; ?></p>
                    <?php endif; ?>
                    <div>
                        <div class="apartment__info">
                            <?php if (!empty($square)) : ?>
                                <div class="square">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/square.svg" alt="Площадь">
                                    <p><?php echo esc_html($square); ?> м<sup>2</sup></p>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($count)) : ?>
                                <div class="count">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon_quest.svg" alt="Гости">
                                    <p>до <?php echo esc_html($count); ?> чел</p>
                                </div>
                            <?php endif; ?>
                            <?php if (!empty($rooms)) : ?><p><?php echo esc_html($rooms); ?> комн</p><?php endif; ?>
                            <?php if (!empty($floor)) : ?><p><?php echo esc_html($floor); ?> этаж</p><?php endif; ?>
                        </div>
                        <?php if (!empty($address)) : ?>
                            <div class="apartment__location">
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon_location.svg" alt="Адрес">
                                <p><?php echo esc_html($address); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <p class="card__rules">Правила проживания</p>
                    <p><img src="<?php echo get_template_directory_uri(); ?>/assets/images/check-in.svg" alt="Заезд"> Заезд с 14:00</p>
                    <p><img src="<?php echo get_template_directory_uri(); ?>/assets/images/check-out.svg" alt="Выезд"> Выезд до 12:00</p>
                    <p class="rule">Депозит — 3 000 ₽</p>
                    <div class="apartment__price">
                        <p>от <?php echo esc_html($price); ?> ₽<span> / 1 сутки</span></p>
                    </div>
                    <button class="booking">Забронировать</button>
                </article>
            </div>
        </div>

        <?php get_template_part('templates/feedback'); ?>

<?php endwhile;
endif; ?>

<?php get_footer(); ?>