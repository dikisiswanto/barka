<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>

<title><?= isset($page_title) ? $page_title . ' | ' : '' ?> <?= __session('school_name') ?></title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="keywords" content="<?= __session('meta_keywords') ?>"/>
<meta name="description" content="<?= __session('meta_description') ?>"/>
<meta name="subject" content="Situs Pendidikan">
<meta name="copyright" content="<?= __session('school_name') ?>">
<meta name="language" content="Indonesia">
<meta name="robots" content="index,follow" />
<meta name="revised" content="Sunday, July 18th, 2010, 5:15 pm" />
<meta name="Classification" content="Education">
<meta name="author" content="Anton Sofyan, 4ntonsofyan@gmail.com">
<meta name="designer" content="Anton Sofyan, 4ntonsofyan@gmail.com">
<meta name="theme:name" content="Barka">
<meta name="theme:author" content="Diki Siswanto">
<meta name="theme:version" content="<?= THEME_VERSION ?>">
<meta name="reply-to" content="4ntonsofyan@gmail.com">
<meta name="owner" content="Anton Sofyan">
<meta name="url" content="http://www.sekolahku.web.id">
<meta name="identifier-URL" content="http://www.sekolahku.web.id">
<meta name="category" content="Admission, Education">
<meta name="coverage" content="Worldwide">
<meta name="distribution" content="Global">
<meta name="rating" content="General">
<meta name="revisit-after" content="7 days">
<meta http-equiv="Expires" content="0">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">
<meta http-equiv="Copyright" content="<?= __session('school_name') ?>" />
<meta http-equiv="imagetoolbar" content="no" />
<meta name="revisit-after" content="7" />
<meta name="webcrawlers" content="all" />
<meta name="rating" content="general" />
<meta name="spiders" content="all" />
<meta itemprop="name" content="<?= __session('school_name') ?>" />
<meta itemprop="description" content="<?= __session('meta_description') ?>" />
<meta itemprop="image" content="<?= base_url('media_library/images/'. __session('logo')) ?>" />
<meta name="csrf-token" content="<?= __session('csrf_token') ?>">
<?php if (isset($post_type) && $post_type == 'post') : ?>
  <meta property="og:url" content="<?= current_url() ?>" />
  <meta property="og:type" content="article" />
  <meta property="og:title" content="<?= $query->post_title ?>" />
  <meta property="og:description" content="<?= word_limiter(strip_tags($query->post_content), 30) ?>" />
  <meta property="og:image" content="<?= base_url('media_library/posts/large/'.$query->post_image) ?>" />
<?php endif ?>
<link rel="icon" href="<?= base_url('media_library/images/'.__session('favicon')) ?>">
<link rel="alternate" type="application/rss+xml" title="<?= __session('school_name') ?> Feed" href="<?= base_url('feed') ?>" />