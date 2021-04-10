<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <header class="article-nav">
    <a href="<?php echo esc_url(home_url('/')); ?>" class="article-logo">
      <?php bloginfo('name'); ?>
      <br />
      <span class="magazine-subtitle">
        <?php bloginfo('description'); ?>
      </span>
    </a>
  </header>
