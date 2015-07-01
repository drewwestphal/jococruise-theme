<?php get_header(); ?>
<section id="content" role="main">
<?php if ( is_front_page() ) { ?>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="header">
	<h1 class="entry-title"><?php the_title(); ?></h1> <?php edit_post_link(); ?>
	</header>
	<section class="entry-content">
	<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
	<?php the_content(); ?>
	<div class="entry-links"><?php wp_link_pages(); ?></div>
	</section>
	</article>
	<?php if ( ! post_password_required() ) comments_template( '', true ); ?>
	<?php endwhile; endif; ?>
	</section>
	<?php get_sidebar(); ?>
	<?php get_footer(); ?>
<?php } elseif ( is_page( 'Artists' ) ){ ?>

		<?php include('page-artists.php'); ?>
		
<?php } elseif ( is_page( 'FAQ' ) ){ ?>

		<?php include('page-faq.php'); ?>
		
<?php } elseif ( is_page( 'News' ) ){ ?>

		<?php include('page-news.php'); ?>
		
<?php } elseif ( is_page( 'The Experience' ) ){ ?>

		<?php include('page-experience.php'); ?>

<?php } elseif ( is_page( 'Sponsors' ) ){ ?>

		<?php include('page-sponsors.php'); ?>

<?php } else { 
    // regular old page style
    ?> 
    
    
    <section class="joco-page" id="page-page">
		<?php include 'bumper_top.php'; ?>
        <div class="container nav-spacer">
            <div class="col-xs-12">
                <h1><?php the_title() ?></h1>
                <?php if (have_posts()) : while (have_posts()) : the_post();?>
                    <p><?php the_content(); ?></p>
                <?php endwhile; endif; ?>
            </div>
        </div>
        <?php include 'bumper_bottom.php'; ?>
        <?php get_footer(); ?>
    </section>

    <?php }; ?>