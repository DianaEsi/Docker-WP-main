<?php
$args = [
    'post_type' => 'review',
    'posts_per_page' => -1
];

$query = new WP_Query($args);

if ($query->have_posts()) : ?>

    <section class="reviews">
        <h2>Отзывы</h2>
        <div class="column-reviews">



            <?php while ($query->have_posts()) : $query->the_post();

                $review_user_name = get_post_meta(get_the_ID(), 'review_user-name', true);
                $rating = get_post_meta(get_the_ID(), 'review_rating', true);
                $comment = get_post_meta(get_the_ID(), 'review_comment', true);



                if (!empty($review_user_name) || !empty($rating) || !empty($comment)) : ?>

                    <article class="user-review">
                        <div>
                    <?php
                    $image_id = get_post_meta(get_the_ID(), 'review_user_image', true);

                    if ($image_id) {
                        echo wp_get_attachment_image($image_id, 'thumbnail', false, ['class' => 'user-img']);
                    }
                    ?>
                            <div style="display: grid; padding-top: 0px; padding-left: 10px;">
                                <p class="user-name"><?php echo esc_html($review_user_name); ?></p>
                                <div class="rating">
                                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                                        <?php if ($i <= $rating) : ?>
                                            <span class="star filled">⭐️</span>
                                        <?php else : ?>
                                            <span class="star">☆</span>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </div>
                            </div>


                        </div>

                        <p class="user-comment"><?php echo esc_html($comment); ?></p>
                    </article>

            <?php endif;
            endwhile; ?>
        </div>
    </section>
<?php
    wp_reset_postdata();

endif; ?>