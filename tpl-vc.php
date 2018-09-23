<?php

// Template Name: Visual Composer
$h = new unload_Helper;
$h->unload_header();
$h->unload_headerTop(get_the_ID());
while (have_posts()): the_post();
    the_content();
endwhile;

get_footer();
