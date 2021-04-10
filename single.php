<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>estra magazine</title>
  <link rel="stylesheet" href="css/style.css" />
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
</head>

<body>
<?php get_header(); ?>
<?php if (have_posts()) : the_post(); ?>
  <div class="single-eyecatch eyecatch">
    <?php if (has_post_thumbnail()) : ?>
      <?php the_post_thumbnail(); ?>
    <?php else : ?>
      <img src="<?php echo get_template_directory_uri(); ?>/img/no-images.png" alt="no-img">
    <?php endif; ?>
    <!-- サムネイルの表示 -->
  </div>
  <div class="single-container container">
    <div class="single-header__contain">
      <div class="style__border">
        <?php if (has_category()) : ?>
          <div class="category-tag single-category-tag"><?php echo get_the_category_list(' '); ?></div>
          <!-- 順序なしの箇条書きリストでカテゴリを取得 -->
        <?php endif; ?>
        <!-- カテゴリーの出力 -->
        <h1 class="single-title">
          <?php the_title(); ?>
          <!-- ?php the_title( $before, $after, $echo ); ?
            パラメータ
            $before（文字列） （オプション） タイトルの前に置くテキスト
              初期値： なし
            $after（文字列） （オプション） タイトルの後ろに置くテキスト
              初期値： なし
            $echo（真偽値） （オプション） タイトルを表示（TRUE）または返します（FALSE）。
              初期値： TRUE
            使用例
              ?php the_title( '<h3>', '</h3>' ); ?
              これは、（HTML の）h3 として画面にタイトルを表示します。 -->
          <!-- タイトルの出力 -->
        </h1>
        <div class="flex tags-date">
          <div class="single-tags">
            <p class="single-tag__chilg"><?php the_tags('', '  '); ?></p>
            <!-- タグの出力 -->
          </div>
          <p class="single-date"><?php echo get_the_date('Y-m-d'); ?></p>
          <!-- 投稿日時の出力 -->
        </div>
      </div>
    </div>
    <div class="main-text">
      <?php the_content(); ?>
      <!-- 本文の出力 -->
    </div>
  </div>
<?php endif; ?>
<!-- メインループ（記事情報取得）の終了 -->
<div class="new-articles new-articles__single">
  <h2 class="section-title">RELATION</h2>
  <div class="flex">
    <?php if (has_category()) {
      $cats = get_the_category();
      // ループ外のため、get_the_category
      $catkwds = array();
      foreach ($cats as $cat) {
        $catkwds[] = $cat->term_id;
      }
    } ?>
    <?php $args = array(
      'post_type' => 'post',
      'posts_per_page' => '3',
      'post__not_in' => array($post->ID),
      'category__in' => $catkwds,
      'orderby' => 'rand'
    );
    $my_query = new WP_Query($args); ?>
    <?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
    <!-- サブループの開始 -->
      <a href="<?php the_permalink(); ?>" class="magazine-colum">
      <!-- 個別記事へのリンクを出力 -->
        <?php if (has_post_thumbnail()) : ?>
          <?php the_post_thumbnail(); ?>
        <?php else : ?>
          <img src="<?php echo get_template_directory_uri(); ?>/img/no-images.png" alt="no-img">
        <?php endif; ?>
        <!-- サムネイルの出力 -->
        <?php if (!is_category() && has_category()) : ?>
          <p class="category-tag">
            <?php
            $postcat = get_the_category();
            echo $postcat[0]->name;
            ?>
          </p>
        <?php endif; ?>
        <!-- カテゴリーの出力 -->
        <div class="text-content">
          <p class="article__date"><?php echo get_the_date('Y-m-d'); ?></p>
          <!-- 日付の出力 -->
          <h3 class="article__title">
            <?php the_title(); ?>
            <!-- タイトルの出力 -->
          </h3>
          <div class="article-tags">
            <p class="article-tags__inner">
              <?php $posttags = get_the_tags();
              if ($posttags) {
                foreach ($posttags as $tag) {
                  echo '<span class="tag-span">' . $tag->name . '</span>';
                }
              } ?></p>
              <!-- タグの出力 -->
          </div>
        </div>
      </a>
    <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>
    <!-- サブループの終了 -->
  </div>
</div>
<?php get_footer(); ?>

</body>

</html>