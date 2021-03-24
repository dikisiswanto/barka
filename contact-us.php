<style type="text/css">
.mapouter {
  position:relative;
  text-align:right;
}
.gmap_canvas {
  overflow:hidden;
  background:none!important;
}
</style>
<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<main class="container space-y-5 my-5 flex-1">
  <div class="flex flex-col lg:flex-row items-start gap-x-6 relative space-y-5 lg:space-y-0">
    <section class="w-full lg:w-2/3 space-y-4">
      <h3 class="font-heading text-2xl capitalize font-black text-title"><span class="fa fa-phone"></span> <?= ucwords($page_title) ?></h3>
      <div class="mapouter border border-secondary mb-3">
        <div class="gmap_canvas">
          <?=__session('map_location') ?>
        </div>
      </div>
      <form action="" method="post" class="space-y-3">
        <div class="flex flex-col lg:flex-row">
          <label for="comment_author" class="lg:w-1/4 pt-1">Nama Lengkap <span style="color: red">*</span></label>
          <div class="lg:w-3/4">
            <input type="text" class="form-input w-full" id="comment_author" name="comment_author">
          </div>
        </div>
        <div class="flex flex-col lg:flex-row">
          <label for="comment_email" class="lg:w-1/4 pt-1">Email <span style="color: red">*</span></label>
          <div class="lg:w-3/4">
            <input type="text" class="form-input w-full" id="comment_email" name="comment_email">
          </div>
        </div>
        <div class="flex flex-col lg:flex-row">
          <label for="comment_url" class="lg:w-1/4 pt-1">URL</label>
          <div class="lg:w-3/4">
            <input type="text" class="form-input w-full" id="comment_url" name="comment_url">
          </div>
        </div>
        <div class="flex flex-col lg:flex-row">
          <label for="comment_content" class="lg:w-1/4 pt-1">Pesan <span style="color: red">*</span></label>
          <div class="lg:w-3/4">
            <textarea class="form-textarea pt-1 w-full" id="comment_content" name="comment_content" rows="4"></textarea>
          </div>
        </div>
        <?php if (NULL !== __session('recaptcha_status') && __session('recaptcha_status') == 'enable') { ?>
          <div class="flex flex-col lg:flex-row">
            <label class="lg:w-1/4 pt-1"></label>
            <div class="lg:w-3/4">
              <div class="g-recaptcha" data-sitekey="<?=$recaptcha_site_key?>"></div>
            </div>
          </div>
        <?php } ?>
        <div class="flex flex-col lg:flex-row pt-3">
          <span class="lg:w-1/4"></span>
          <button type="button" onclick="send_message(); return false;" class="bg-secondary opacity-80 transition duration-100 hover:opacity-100 text-white rounded py-2 px-5"><i class="fa fa-send"></i> Kirim</button>
        </div>
      </form>
    </section>
    <div class="w-full lg:w-1/3 space-y-5 sticky top-4">
      <?php $this->load->view(THEME_PATH . 'components/sidebar') ?>
    </div>
  </div>
</main>