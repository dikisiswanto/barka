<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<section class="lg:-mt-6">
  <?php $this->load->view(THEME_PATH . 'components/slider') ?>
</section>

<main class="container space-y-5 my-5 flex-1">
  <?php $this->load->view(THEME_PATH . 'components/newsticker') ?>

  <div class="bg-primary text-white lg:py-5">
    <div class="flex flex-col lg:flex-row divide-y-2 lg:divide-x-2 lg:divide-y-0">
      <div class="lg:w-1/2 py-3 px-5 lg:py-2 flex items-center space-x-5">
        <span class="fa fa-map-marker text-5xl font-bold text-tertiary"></span>
        <div class="flex flex-col space-y-2">
          <div class="group">
            <span class="block text-2xl font-heading font-bold"><?= $this->session->school_name ?></span>
            <span class="block text-sm italic"><?= $this->session->tagline ?></span>
          </div>
          <span><?= $this->session->street_address ?>, <?= $this->session->village ?>, <?= $this->session->sub_district ?>, <?= $this->session->district ?></span>
        </div>
      </div>
      <div class="lg:w-1/2 py-3 px-5 lg:py-2 flex items-center space-x-5">
        <span class="fa fa-comments-o text-5xl font-bold text-tertiary"></span>
        <div class="flex flex-col space-y-2">
          <span class="block text-2xl font-heading font-bold">Media Sosial</span>
          <ul class="grid w-3/4 grid-cols-4 gap-x-5">
            <?php if(NULL !== $this->session->facebook && $this->session->facebook) : ?>
              <li class="inline-block"><a target="_blank" rel="noopener" href="<?= $this->session->facebook ?>" class="h-8 w-8 rounded-full border-2 inline-flex items-center justify-center"><i class="fa fa-facebook text-lg" aria-label="facebook"></i></a></li>
            <?php endif ?>
            <?php if(NULL !== $this->session->twitter && $this->session->twitter) : ?>
              <li class="inline-block"><a target="_blank" rel="noopener" href="<?= $this->session->twitter ?>" class="h-8 w-8 rounded-full border-2 inline-flex items-center justify-center"><i class="fa fa-twitter text-lg" aria-label="twitter"></i></a></li>
            <?php endif ?>
            <?php if(NULL !== $this->session->instagram && $this->session->instagram) : ?>
              <li class="inline-block"><a target="_blank" rel="noopener" href="<?= $this->session->instagram ?>" class="h-8 w-8 rounded-full border-2 inline-flex items-center justify-center"><i class="fa fa-instagram text-lg" aria-label="instagram"></i></a></li>
            <?php endif ?>
            <?php if(NULL !== $this->session->youtube && $this->session->youtube) : ?>
              <li class="inline-block"><a target="_blank" rel="noopener" href="<?= $this->session->youtube ?>" class="h-8 w-8 rounded-full border-2 inline-flex items-center justify-center"><i class="fa fa-youtube-play text-lg" aria-label="youtube"></i></a></li>
            <?php endif ?>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="flex flex-col lg:flex-row items-start gap-x-6 relative space-y-5 lg:space-y-0">
    <div class="w-full lg:w-2/3 space-y-4">
      <h3 class="font-heading text-2xl capitalize font-black text-title"><span class="fa fa-newspaper-o"></span> Artikel terkini</h3>
      <div class="grid grid-cols-1 gap-5">
        <?php $posts = get_latest_posts(5); ?>
        <?php if($posts->num_rows() > 0) : ?>
          <?php foreach($posts->result() as $post) : ?>
            <div class="bg-white overflow-hidden relative flex flex-col lg:flex-row justify-between" data-aos="fade-up">

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
        <?php endif ?>
      </div>

      <?php $albums = get_albums(2); ?>
      <?php if($albums->num_rows() > 0) : ?>
        <h3 class="font-heading text-2xl capitalize font-black text-title py-2"><i class="fa fa-camera"></i>	Album Galeri</h3>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
          <?php foreach($albums->result() as $album) : ?>
            <figure class="shadow-md bg-white overflow-hidden">
              <img src="<?= base_url('media_library/albums/'.$album->album_cover) ?>" alt="<?= $album->album_title ?>" class="h-48 w-full object-fit object-cover flex items-center justify-center bg-gray-300">
              <figcaption class="py-2 text-center">
                <?= $album->album_title ?>
              </figcaption>
              <div class="px-3 py-2">
                <button type="button" onclick="photo_preview(<?=$album->id?>)" class="bg-secondary text-white block w-full py-2 text-center mx-2"><i class="fa fa-search mr-2"></i> Lihat</button>
              </div>
            </figure>
          <?php endforeach ?>
        </div>
      <?php endif ?>

      <?php $videos = get_videos(2) ?>
      <?php if($videos->num_rows() > 0) : ?>
        <h3 class="font-heading text-2xl capitalize font-black text-title py-2"><i class="fa fa-film"></i>	Video</h3>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
          <?php foreach($videos->result() as $video) : ?>
            <iframe width="100%" height="280" src="https://www.youtube.com/embed/<?= $video->post_content ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="w-full"></iframe>
          <?php endforeach ?>
        </div>
        <?php endif ?>
    </div>

    <div class="w-full lg:w-1/3 space-y-5 ">
      <?php $this->load->view(THEME_PATH . 'components/sidebar') ?>
    </div>
  </div>
</main>