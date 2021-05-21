<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ecom
 */

get_header();
?>

<main id="primary" class="site-main">

    <section class="container pb-5 pt-4">
        <div id="carouselExampleDark" class="carousel carousel-dark slide overflow-hidden rounded"
            data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="10000">
                    <img src="<?php echo get_template_directory_uri() . '/img/slider/slide-1.jpg' ?>"
                        class="d-block w-100">
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="<?php echo get_template_directory_uri() . '/img/slider/slide-2.jpg' ?>"
                        class="d-block w-100">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    </section>

    <section class="container">
        <h1 class="text-center pt-5">Popular Products</h1>
        <p class="text-center m-auto">We offer a number of high quality toys to help <br> keep your pets healthy and
            spoiled.
        </p>

        <div class="pt-5 pb-5">
            <?php echo do_shortcode('[products columns="4" limit="4"]') ?>
        </div>

    </section>

</main><!-- #main -->

<?php
get_footer();