<?php get_header('search'); ?>
    <section>
        <h2>「<?php echo esc_html($_GET['s']); ?>」の検索結果：<?php echo $wp_query->found_posts; ?>件</h2>

        <ul class="news-area">
        <?php if(!have_posts()): ?>
            <li>お探しの記事が存在しません。</li>
            <div class="searchbox">
                <?php get_search_form(); ?>
            </div>
        <?php endif; ?>
            <?php while(have_posts()): the_post(); ?>
                <?php
                    $cat = get_the_category();
                    $catname = $cat[0]->cat_name;
                ?>
                <li><a href="<?php the_permalink(); ?>"></span><?php echo get_the_date('Y年n月j日'); ?></span><?php the_title(); ?></a></li>
            <?php endwhile; ?>
        </ul>
    </section>

    
<?php get_footer(); ?>

<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package spritual
 */

get_header('search');
?>

	<main id="primary" class="site-main">

        <?php if(!have_posts()): ?>
            <li>お探しの記事が存在しません。</li>
            <div class="searchbox">
                <?php get_search_form(); ?>
            </div>
        <?php endif; ?>
		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'spritual' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
?>

<?php get_header('search'); ?>
<section>
    <?php
    $category = get_the_category();
    $cat_name = $category[0]->cat_name;
    ?>
    <h2 class="cat-name"><?php echo $cat_name; ?></h2>

</section>


<div class="container">
    <main>
    <?php
        $args = array(
            'posts_per_page' => get_option('posts_per_page'), // 表示件数の指定
            'category' => $category[0]->cat_ID, // カテゴリーを指定
            'paged' => get_query_var( 'paged', 1 )
        );
        $posts = get_posts($args);
        foreach($posts as $post):
            setup_postdata($post);
        ?>
        <article class="post-home">
            <div class="post-thumb">

                <?php if(has_post_thumbnail()): ?>
                    <img class="post-img" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="">
                <?php else: ?>
                    <img class="post-img" src="https://placehold.jp/600x400.png">
                <?php endif; ?>
            </div>
            <div class="post-moji">
                <div class="post-title">
                    <h2 class="stripe"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a><h2>
                </div>

                <p class="post-date"><span><?php echo get_the_date('Y年n月j日'); ?></span></p>
                <p class="post-desc"><?php echo get_the_excerpt(); ?></p>
            </div>
        </article>
        <?php endforeach; ?>
        <?php the_posts_pagination(
            array(
                'mid_size'      => 2, // 現在ページの左右に表示するページ番号の数
                'prev_next'     => true, // 「前へ」「次へ」のリンクを表示する場合はtrue
                'prev_text'     => __( '前へ'), // 「前へ」リンクのテキスト
                'next_text'     => __( '次へ'), // 「次へ」リンクのテキスト
                'type'          => 'list', // 戻り値の指定 (plain/list)
            )
        ); 
        echo 'pagination';
        wp_reset_postdata();
         ?>
    </main>
    <aside>
        <?php get_sidebar(); ?>

    </aside>
</div>






<?php get_footer(); ?>