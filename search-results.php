<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<main class="container space-y-5 my-5 flex-1">
  <div class="flex flex-col lg:flex-row items-start gap-x-6 relative space-y-5 lg:space-y-0">
    <section class="w-full lg:w-2/3 space-y-4">
      <h3 class="font-heading text-2xl capitalize font-black text-title"><span class="fa fa-search"></span> <?= ucwords($page_title) ?></h3>
      <div class="grid grid-cols-1 gap-5">
        <?php if($query->num_rows() > 0) : ?>
          <?php foreach($query->result() as $post) : ?>
            <div class="bg-white overflow-hidden relative flex flex-col lg:flex-row justify-between post" data-aos="fade-up">

              <div class="w-full h-48 lg:h-full lg:w-5/12 flex-shrink-0 bg-gray-300 flex items-center justify-center">

                <?php $post_image = 'media_library/posts/medium/'.$post->post_image; ?>
                <?php $poster = is_file('./'.$post_image) ? base_url($post_image) : base_url('media_library/images/'. $this->session->logo) ?>
                <?php $poster_class = is_file('./'.$post_image) ? 'w-full object-cover object-center h-inherit' : 'w-16' ?>
                <?php $link = site_url('read/'.$post->id.'/'.$post->post_slug) ?>
                <img src="<?= $poster ?>" alt="<?= $post->post_title ?>" class="<?= $poster_class ?>">
              </div>
              
              <div class="flex flex-col absolute top-0 left-0 px-3 py-2 bg-secondary text-white text-center">
                <?php $date = explode('-', date('Y-m-d', strtotime($post->created_at))) ?>
                <span class="text-3xl font-black"><?= $date[2] ?></span>
                <span class="tracking-wide uppercase"><?= substr(bulan($date[1]), 0, 3) ?></span>
              </div>
              <div class="w-full lg:w-7/12 space-y-2 py-2 lg:px-4 flex flex-col justify-between">
                <div class="space-y-2">
                  <a href="<?= $link ?>" class="transition duration-200 hover:text-secondary">
                    <h2 class="font-black text-lg lg:text-xl font-heading"><?= $post->post_title ?></h2>
                  </a>
                  <p class="break-normal whitespace-normal">
                    <?= substr(strip_tags($post->post_content), 0, 165) ?>
                  </p>
                </div>
                <a href="<?= $link ?>" class="block text-secondary">Baca selengkapnya <span class="fa fa-chevron-right text-xs ml-1"></span></a>
              </div>
            </div>
          <?php endforeach ?>
          <?php else : ?>
            <div class="text-center">
              Tidak ditemukan hasil yang sesuai...
            </div>
        <?php endif ?>
      </div>
    </section>
    <div class="w-full lg:w-1/3 space-y-5 sticky top-4">
      <?php $this->load->view(THEME_PATH . 'components/sidebar') ?>
    </div>
  </div>
</main>
