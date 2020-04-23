<?php get_header();
    $col = ( is_active_sidebar('sidebar') ) ? 'has-sidebar col-md-12 col-lg-8 col-xl-9' : 'no-sidebar col-md-12';
?>
<div class="main-contaier">
    <div class="container">
        <div class="row">
        <?php
            while ( have_posts() ) {
                the_post();
                $sticky_class = ( is_sticky() ) ? 'arimolite-post-sticky' : null;
                $featured_image = null;
                $thumbnail_caption = null;
                if ( has_post_thumbnail() ) {
                    $featured_image = arimolite_resize_image( get_post_thumbnail_id(), null, 1530, 700, true, true );
                    $featured_image = $featured_image['url'];	
                    $thumbnail_caption = get_post(get_post_thumbnail_id())->post_excerpt;
                } ?>
            <div class="arimolite-single-post <?php echo esc_attr($col); ?>">
                <article <?php post_class(); ?>>
                    <div class="post-inner">
                        <div class="post-header">
                            <?php get_template_part('template-parts/post', 'format'); ?>
                            <div class="date-post">
                                <span class="month"><?php echo get_the_date( 'M'); ?></span>
                                <span class="day"><?php echo get_the_date( 'd'); ?></span>
                                <span class="year"><?php echo get_the_date( 'Y'); ?></span>
                            </div>
                            <?php echo '<div class="image-caption">' . $thumbnail_caption . '</div>';?>
                        </div>
                        <div class="post-info">
                            <div class="post-cats"><i class="far fa-bookmark"></i><?php the_category(', '); ?></div>
                            <h1 class="post-title"><?php the_title(); ?></h1>
                            <?php get_template_part('template-parts/post', 'meta'); ?>                      
                            <div class="post-content">
                                <?php
                                    the_content();
                                    wp_link_pages(
                                        array(
                                            'before'   => '<p class="page-nav">' . esc_html__( 'Pages:', 'arimolite' ),
                                            'after'    => '</p>'
                                        )
                                    );
                                ?>
                            </div>
                            <?php get_template_part('template-parts/post', 'footer'); ?>
                        </div>
                    </div>
                </article>
                <?php get_template_part( 'template-parts/single', 'post-related' ); ?>
                <?php
                    if ( comments_open() || get_comments_number() ) :
                        comments_template('', true);
                    endif;
                ?>    
            </div>
            <?php if ( is_active_sidebar('sidebar') ) { ?>
            <div class="col-md-12 col-lg-4 col-xl-3">
                <?php get_sidebar() ?>
            </div>
            <?php } ?>
        <?php } ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
