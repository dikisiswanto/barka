<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>

<form action="<?= site_url('hasil-pencarian') ?>" method="POST" class="relative">
  <input type="search" class="shadow h-10 w-full border focus:border-secondary outline-none pl-8 pr-3 transition duration-200" name="keyword" placeholder="Cari...">
  <span class="fa fa-search absolute ml-3 text-gray-400 left-0 top-0 pt-0.5 transform translate-y-1/2"></span>
</form>
<?php if($this->uri->segment(1) != 'sambutan-kepala-sekolah') : ?>
  <div class="bg-white space-y-3 py-3">
    <img src="<?= base_url('media_library/images/'). __session('headmaster_photo') ?>" class="w-11/12 mx-auto">
    <div class="space-y-3 p-4">
      <h5 class="text-center uppercase font-bold"><?= __session('headmaster') ?></h5>
      <p class="text-center">- <?= __session('_headmaster') ?> -</p>
      <p class="text-justify"><?= substr(word_limiter(strip_tags(get_opening_speech()), 20), 0, strrpos(trim(word_limiter(strip_tags(get_opening_speech()), 20), " "), " "))."..."?></p>
    </div>
    <div class="text-center">
      <a href="<?= site_url(opening_speech_route()) ?>" class="text-sm">Selengkapnya</a>
    </div>
  </div>
<?php endif ?>

<div class="bg-white space-y-3 py-3">
  <h5 class="text-title font-bold font-heading text-lg lg:text-xl px-4">Berlangganan</h5>
  <form class="px-4 space-y-3">
    <div class="relative">
      <input type="text" id="subscriber" onkeydown="if (event.keyCode == 13) { subscribe(); return false; }" class="h-10 w-full border focus:outline-none px-4 focus:border-secondary" placeholder="Email Address...">
      <div class="absolute right-0 top-0 transform -mt-1 translate-y-1/2 mr-3">
        <button type="button" onclick="if (event.keyCode == 13) { subscribe(); return false; }"
          class="text-gray-500"><i class="fa fa-envelope"></i></button>
      </div>
    </div>
  </form>
</div>

<?php $categories = get_post_categories(10) ?>
<?php if($categories->num_rows() > 0) : ?>
  <div class="bg-white space-y-3 py-3">
    <h5 class="text-title font-bold font-heading text-lg lg:text-xl px-4">Kategori</h5>
    <div class="px-4 divide-y">
      <?php foreach($categories->result() as $category) : ?>
        <a href="<?= site_url('category/'.$category->category_slug) ?>" title="<?= $category->category_description ?>" class="block py-2 focus:text-secondary"><?= $category->category_name ?></a>
      <?php endforeach ?>
    </div>
  </div>
<?php endif ?>

<?php $links = get_links() ?>
<?php if($links->num_rows() > 0) : ?>
  <div class="bg-white space-y-3 py-3">
    <h5 class="text-title font-bold font-heading text-lg lg:text-xl px-4">Tautan</h5>
    <div class="px-4 divide-y">
      <a href="https://www.trivusi.web.id" title="Trivusi.web.id" target="_blank" class="block py-2 focus:text-secondary">Trivusi.web.id</a>
      <?php foreach($links->result() as $link) : ?>
        <a href="<?= $link->link_url ?>" title="<?= $link->link_title ?>" target="<?= $link->link_target ?>" class="block py-2 focus:text-secondary"><?= $link->link_title ?></a>
      <?php endforeach ?>
    </div>
  </div>
<?php endif ?>

<?php $polling = get_active_question() ?>
<?php if($polling) : ?>
  <div class="bg-white space-y-3 py-3">
    <h5 class="text-title font-bold font-heading text-lg lg:text-xl px-4">Jajak Pendapat</h5>
    <div class="px-4 space-y-3">
      <p><?= $polling->question ?></p>
      <?php $options = get_answers($polling->id) ?>

      <?php foreach($options->result() as $option) : ?>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="answer_id" id="answer_id_<?= $option->id ?>" value="<?= $option->id ?>">
          <label class="form-check-label" for="answer_id_<?= $option->id ?>"><?= $option->answer ?></label>
        </div>
      <?php endforeach ?>

      <div class="flex gap-x-3">
        <button type="button" name="button" onclick="vote(); return false;" class="bg-primary text-white py-2 px-4"><i class="fa fa-send"></i> Submit</button>
        <a href="<?= site_url('hasil-jajak-pendapat') ?>" class="bg-secondary text-white py-2 px-4"><i class="fa fa-bar-chart"></i> Hasil</a>
      </div>
    </div>
  </div>
<?php endif ?>

<?php $banners = get_banners() ?>
<?php if($banners->num_rows() > 0) : ?>
  <div class="bg-white space-y-3 py-3">
    <h5 class="text-title px-4 text-lg lg:text-xl font-bold font-heading">Banner</h5>
    <div class="space-y-3 px-4">
      <?php foreach($banners->result() as $banner) : ?>
        <a href="<?= $banner->link_url ?>" title="<?= $banner->link_title ?>">
          <img src="<?= base_url('media_library/banners/'.$banner->link_image) ?>" class="w-full py-3">
        </a>
      <?php endforeach ?>
    </div>
  </div>
<?php endif ?>
