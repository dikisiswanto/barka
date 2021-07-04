<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<script>
  let page = 1;
  const totalPage = <?= $total_page ?>;

  $(document).ready(function() {
    if (parseInt(totalPage) == page || parseInt(totalPage) == 0) {
      $('.more-comments').remove();
    }
  });

  function get_post_comments() {
    page++;
    const data = {
      page_number: page,
      comment_post_id: <?=$this->uri->segment(2)?>
    };
    if ( page <= parseInt(totalPage) ) {
      $.post( _BASE_URL + 'public/post_comments/get_post_comments', data, function( response ) {
        const res = _H.StrToObject( response );
        const rows = res.comments;
        let html = '';
        for (const z in rows) {
          const row = rows[ z ];
          html = `<div class="bg-white px-5 py-4 shadow space-y-2 border comment">
              <blockquote class="italic">"${row.comment_content}"</blockquote>
              <div class="text-xs space-x-3">
                <span><i class="fa fa-calendar-o fa-sm mr-1 text-secondary"></i> ${row.created_at.substr(8, 2)} ${row.created_at.substr(5, 2)} ${row.created_at.substr(0, 4)}</span>
                <span><i class="fa fa-user fa-sm mr-1 text-secondary"></i> ${row.comment_author}</span>
              </div>
            </div>`;
        }
        const elementId = $(".comment:last");
        $( html ).insertAfter( elementId );
        if ( page == parseInt(totalPage) ) $('.more-comments').remove();
      });
    }
  }
</script>

<main class="container space-y-5 my-5 flex-1">
  <div class="flex flex-col lg:flex-row items-start gap-x-6 relative space-y-5 lg:space-y-0">
    <article class="w-full lg:w-2/3 space-y-4">
      <h2 class="text-title lg:text-3xl text-xl font-bold font-heading"><?= $query->post_title ?></h2>
      <ul class="lg:space-x-5 flex flex-col lg:flex-row flex-wrap text-sm">
        <li><span class="fa fa-calendar mr-2 text-secondary"></span> <?=day_name(date('N', strtotime($query->created_at)))?>, <?=indo_date(substr($query->created_at, 0, 10))?></li>
        
        <li>
          <span class="fa fa-tag mr-2 text-secondary"></span>
          <?php if($tag = $query->post_tags) : ?>
            <?php $post_tags = explode(',', $tag); ?>
            <?php foreach($post_tags as $tag) : ?>
              <a href="<?= site_url('tag/'.url_title(strtolower(trim($tag)))) ?>" class="mr-2"><?= ucwords($tag) ?></a>
            <?php endforeach ?>
          <?php endif ?>
        </li>
        <li><span class="fa fa-user mr-2 text-secondary"></span> <?=$post_author?></li>
        <li><span class="fa fa-comments mr-2 text-secondary"></span> <?= $post_comments->num_rows() ?> komentar</li>
      </ul>

      <?php if($post_type == 'post' && is_file('./media_library/posts/large/'.$query->post_image)) : ?>
        <img src="<?=base_url('media_library/posts/large/'.$query->post_image)?>" alt="<?= $query->post_title ?>" class="max-w-full w-full h-auto">
      <?php endif ?>

      <div class="content space-y-4">
        <?= $query->post_content ?>
      </div>


      <span class="block font-bold">Bagikan artikel ini:</span>
      <div class="flex space-x-2">
          <a href="http://www.facebook.com/sharer.php?u=<?=site_url('read/'.$query->id.'/'.$query->post_slug)?>" target="_blank" rel="noopener" class="inline-flex items-center justify-center w-10 h-10 bg-facebook text-white rounded-full hover:ring-2 hover:ring-tertiary hover:ring-offset-2 transition duration-100">
            <i class="fa fa-facebook text-xl"></i>
          </a>
          <a href="http://twitter.com/share?url=<?=site_url('read/'.$query->id.'/'.$query->post_slug)?>" target="_blank" rel="noopener" class="inline-flex items-center justify-center w-10 h-10 bg-twitter text-white rounded-full hover:ring-2 hover:ring-tertiary hover:ring-offset-2 transition duration-100">
            <i class="fa fa-twitter text-xl"></i>
          </a>
          <a href="https://telegram.me/share/url?url=<?=site_url('read/'.$query->id.'/'.$query->post_slug)?>" target="_blank" rel="noopener" class="inline-flex items-center justify-center w-10 h-10 bg-telegram text-white rounded-full hover:ring-2 hover:ring-tertiary hover:ring-offset-2 transition duration-100">
            <i class="fa fa-telegram text-xl"></i>
          </a>
          <a href="https://api.whatsapp.com/send?text=<?=site_url('read/'.$query->id.'/'.$query->post_slug)?>" target="_blank" rel="noopener" class="inline-flex items-center justify-center w-10 h-10 bg-whatsapp text-white rounded-full hover:ring-2 hover:ring-tertiary hover:ring-offset-2 transition duration-100">
            <i class="fa fa-whatsapp text-xl"></i>
          </a>
      </div>

      <?php if($post_comments->num_rows() > 0) : ?>
        <section class="space-y-2 py-5">
          <h4 class="text-lg font-bold font-heading"><?= $post_comments->num_rows() ?> Komentar</h4>
          <?php foreach($post_comments->result() as $comment) : ?>  
            <div class="bg-white px-5 py-4 shadow space-y-2 border comment">
              <blockquote class="italic">"<?=strip_tags($comment->comment_content)?>"</blockquote>
              <div class="text-xs space-x-3">
                <span><i class="fa fa-calendar-o fa-sm mr-1 text-secondary"></i> <?=date('d M Y H:i', strtotime($comment->created_at))?></span>
                <span><i class="fa fa-user fa-sm mr-1 text-secondary"></i> <?=$comment->comment_author?></span>
              </div>
            </div>
            <?php if(! empty($comment->comment_reply)) : ?>
              <div class="bg-white px-5 py-4 shadow space-y-2 border comment">
                <blockquote class="italic">"<?=strip_tags($comment->comment_reply)?>"</blockquote>
                <div class="text-xs space-x-3">
                  <span><i class="fa fa-user fa-sm mr-1 text-secondary"></i> <?=$comment->comment_author?></span>
                </div>
              </div>
            <?php endif ?>
          <?php endforeach ?>
          <button type="button" onclick="get_post_comments()" class="bg-secondary opacity-80 transition duration-100 hover:opacity-100 text-white rounded py-2 px-5 more-comments"><i class="fa fa-refresh"></i> Komentar Lainnya</button>
        </section>
      <?php endif ?>

      <?php if((
            $query->post_comment_status == 'open' &&
            $this->session->comment_registration == 'true' &&
            $this->auth->hasLogin()
          ) ||
          (
            $query->post_comment_status == 'open' &&
            $this->session->comment_registration == 'false'
          )) : ?>

        <form action="" class="space-y-2 py-5" method="POST">
          <h4 class="text-lg font-bold font-heading">Beri Komentar</h4>
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
            <label for="comment_content" class="lg:w-1/4 pt-1">Komentar <span style="color: red">*</span></label>
            <div class="lg:w-3/4">
              <textarea class="form-textarea w-full" id="comment_content" name="comment_content" rows="4"></textarea>
            </div>
          </div>
          <?php if (NULL !== __session('recaptcha_status') && __session('recaptcha_status') == 'enable') : ?>
            <div class="flex flex-col lg:flex-row">
              <label class="lg:w-1/4 pt-1"></label>
              <div class="lg:w-3/4">
                <div class="g-recaptcha" data-sitekey="<?=$recaptcha_site_key?>"></div>
              </div>
            </div>
          <?php endif ?>
          <input type="hidden" name="comment_post_id" id="comment_post_id" value="<?=$this->uri->segment(2)?>" class="hidden w-0">
          <div class="flex flex-col lg:flex-row pt-3">
            <span class="lg:w-1/4">
            </span>
            <button type="submit" onclick="post_comments(); return false;" class="bg-secondary opacity-80 transition duration-100 hover:opacity-100 text-white rounded py-2 px-5"><i class="fa fa-send mr-2"></i> Kirim</button>
          </div>
        </form>
      <?php endif ?>

      <?php if($query->post_type == 'post') : ?>
        <?php $posts = get_related_posts($query->post_categories, $this->uri->segment(2), 5) ?>
        <?php if($posts->num_rows() > 0) : ?>
          <div class="py-5">
            <h3 class="font-heading text-lg lg:text-xl font-bold py-2">Artikel Terkait</h3>
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
          </div>
        <?php endif ?>
      <?php endif ?>
    </article>
    <div class="w-full lg:w-1/3 space-y-5">
      <?php $this->load->view(THEME_PATH . 'components/sidebar') ?>
    </div>
  </div>
</main>