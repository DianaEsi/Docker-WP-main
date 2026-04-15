<?php function add_scripts_and_styles()
{
    wp_enqueue_style('main-style', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'add_scripts_and_styles');
add_action('after_setup_theme', 'add_menu');

function add_menu()
{
    register_nav_menu('top', 'Главное меню сайта');
}

function add_swiper_scripts()
{
    if (is_singular('apartment')) {
        wp_enqueue_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
        wp_enqueue_script('swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), null, true);

        //  кастомные стили для миниатюр
        wp_add_inline_style('swiper-css', '
            .gallery {
                position: relative;
                width: 100%;
            }

            .main-swiper {
                width: 100%;
                height: 500px;
            }

            .main-swiper .swiper-slide img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .thumb-swiper {
                position: absolute;
                bottom: 20px;
                left: 0;
                right: 0;
                height: 100px;
                padding: 0 20px;
                box-sizing: border-box;
                z-index: 10;
            }

            .thumb-swiper .swiper-slide {
                width: 100px;
                height: 80px;
                opacity: 0.7;
                cursor: pointer;
            }

            .thumb-swiper .swiper-slide img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 5px;
            }

            .thumb-swiper .swiper-slide-thumb-active {
                opacity: 1;
                border: 2px solid white;
            }

            /* Стрелки навигации поверх тоже */
            .swiper-button-next,
            .swiper-button-prev {
                z-index: 20;
            }

            @media (max-width: 768px) {
                .main-swiper {
                    height: 300px;
                }

                .thumb-swiper .swiper-slide {
                    width: 80px;
                }

                .thumb-swiper {
                    height: 70px;
                }
            }

            ');


        wp_add_inline_script('swiper-js', '
 document.addEventListener("DOMContentLoaded", function() {
                        new Swiper(".main-swiper", {

                            loop: true,
                            spaceBetween: 0,
                            thumbs: {
                                swiper: new Swiper(".thumb-swiper", {
                                    loop: true,
                                    spaceBetween: 10,
                                    slidesPerView: "auto",
                                    freeMode: true,
                                    watchSlidesProgress: true,
                                }),
                        }

                        ,
                    });
            });
        ');
    }
}

add_action('wp_enqueue_scripts', 'add_swiper_scripts');
