<?php get_header("search"); ?>
<?php
    $archive_url = esc_url(home_url('/archive/'));
    $now_url = (empty($_SERVER['HTTPS']) ? 'http://' : 'https://'). $_SERVER['HTTP_HOST']. $_SERVER['REQUEST_URI'];
?>
<section>
    <h2 class="archive-name">
    <?php if($archive_url == $now_url): ?>
        <?php echo "全記事"; ?>
    <?php elseif(is_category() || is_tag() || is_tax()): ?>
        <?php echo single_term_title('',false); ?>
    <?php elseif(is_post_type_archive()): ?>
        <?php echo post_type_archive_title('',false); ?>
    <?php elseif(is_year()): ?>
        <?php the_time("Y年"); ?>
    <?php elseif(is_month()): ?>
        <?php the_time("Y年n月"); ?>
    <?php elseif(is_day()): ?>
        <?php the_time("Y年n月j日") ?>
    <?php endif; ?>    
    </h2>
</section>

<div id="container">
    <main>
        <?php
        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
            // 取得する内容を配列に記載します（不要箇所は省略可）
        $args = array(
            'category'         => 1, // 読み込みたいカテゴリID（複数の場合は '1,2'）
            'orderby'          => 'ID', // 何順で記事を読み込むか（省略時は日付順）
            'order'            => 'DESC', // 昇順(ASC)か降順か(DESC）
            'exclude'          => '111, 125', // 一覧に表示したくない記事のID（複数時は,区切り）
            'post_type' => array('post'),
            'post_status' => array('publish'),
            'paged' => $paged,
            'posts_per_page' => 10
        );

        //配列で指定した内容で、記事情報を取得
        $the_query = new WP_Query( $args );

        // 取得した記事情報の表示
        if ( $the_query->have_posts() ): // 記事情報がある場合はforeachで記事情報を表示

        // ↓ ループ開始 ↓
        while ( $the_query->have_posts() ):
            $the_query->the_post(); // アーカイブページ同様にthe_titleなどで記事情報を表示できるようにする
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
                <p>【カテゴリー】<?php the_category('、'); ?></p>
                <p>【タグ】<?php the_tags('', '、'); ?></p>
            </div>
        </article>
        <?php endwhile;?>
        
        <?php the_posts_pagination(
            array(
                'base' => str_replace(999, '%#%', esc_url(get_pagenum_link(999))),
                'show_all' => true,
                'type' => 'list',
                'format' => '?paged=%#%',
                'current' => max(1, get_query_var('paged')),
                'total' => $the_query->max_num_pages,
                'mid_size'      => 2, // 現在ページの左右に表示するページ番号の数
                'prev_next'     => true, // 「前へ」「次へ」のリンクを表示する場合はtrue
                'prev_text'     => __( '<<'), // 「前へ」リンクのテキスト
                'next_text'     => __( '>>'), // 「次へ」リンクのテキスト
                'type'          => 'list', // 戻り値の指定 (plain/list)
            )
        ); 
        
        wp_reset_postdata(); ?>
    <?php else: ?>
    <p>記事はありません。</p>
    <?php endif; ?>

    <?php
        // 一覧情報取得に利用したループをリセットする
        wp_reset_postdata();
    ?>
    </main>
</div>

<?php get_footer(); ?>
