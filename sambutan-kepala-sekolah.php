<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<main class="container space-y-5 my-5 flex-1">
  <div class="flex flex-col lg:flex-row items-start gap-x-6 relative space-y-5 lg:space-y-0">
    <article class="w-full lg:w-2/3 space-y-4">
      <h2 class="text-title lg:text-3xl text-xl font-bold font-heading">Sambutan <?= ucwords($this->session->_headmaster) ?></h2>

      <p><?=get_opening_speech()?></p>

      <?php $posts = get_random_posts(4) ?>
      <?php if($posts->num_rows() > 0) : ?>
        <h3 class="font-heading text-lg lg:text-xl font-bold">Artikel Untuk Dibaca</h3>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
          <?php foreach($posts->result() as $post) : ?>
            <div class="space-y-2">
              <a href="<?=site_url('read/'.$post->id.'/'.$post->post_slug)?>" class="block h-48 max-w-full flex-shrink-0 bg-gray-300 flex items-center justify-center">
                <?php $post_image = 'media_library/posts/medium/'.$post->post_image; ?>
                <?php $poster = is_file('./'.$post_image) ? base_url($post_image) : base_url('media_library/images/'. $this->session->logo) ?>
                <?php $poster_class = is_file('./'.$post_image) ? 'w-full object-cover object-center h-inherit' : 'w-16' ?>
                <img src="<?= $poster ?>" alt="<?= $post->post_title ?>" class="<?= $poster_class ?>">
              </a>
              <a href="<?=site_url('read/'.$post->id.'/'.$post->post_slug)?>" class="block hover:text-secondary">
                <h4 class="lg:text-lg font-heading font-bold"><?= $post->post_title ?></h4>
                <p class="text-sm"><?=day_name(date('N', strtotime($post->created_at)))?>, <?=indo_date(date('Y-m-d', strtotime($post->created_at)))?></p>
              </a>
            </div>
          <?php endforeach ?>
        </div>
      <?php endif ?>
    </article>
    <div class="w-full lg:w-1/3 space-y-5 sticky top-4">
      <?php $this->load->view(THEME_PATH . 'components/sidebar') ?>
    </div>
  </div>
</main>