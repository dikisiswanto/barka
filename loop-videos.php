<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript">
  let page = 1;
  const total_page = "<?=$total_page;?>";
  $(document).ready(function() {
    if (parseInt(total_page) == page || parseInt(total_page) == 0) {
      $('.more-videos').remove();
    }
  });

  function get_videos() {
    page++;
    const data = {
      page_number: page
    };
    if ( page <= parseInt(total_page) ) {
      _H.Loading( true );
      $.post( _BASE_URL + 'public/gallery_videos/get_videos', data, function( response ) {
        _H.Loading( false );
        const res = response;
        const rows = res.rows;
        let html = '';
        for (let z in rows) {
          const row = rows[ z ];
          const template = `
            <iframe width="100%" height="280" src="https://www.youtube.com/embed/${row.post_content}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="w-full videos"></iframe>
          `;
          html += template;
        }
        var el = $(".videos:last");
        $( html ).insertAfter(el);
        if (page == parseInt(total_page)) $('.more-videos').remove();
      });
    }
  }
</script>

<main class="container space-y-5 my-5 flex-1">
  <h2 class="text-title text-2xl font-bold font-heading"><?= $page_title ?></h2>
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
    <?php foreach($query->result() as $video) : ?>
      <iframe width="100%" height="280" src="https://www.youtube.com/embed/<?= $video->post_content ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="w-full videos"></iframe>
    <?php endforeach ?>
  </div>
  <div class="loading-area"></div>
  <button type="button" onclick="get_videos(); return false;" class="bg-secondary opacity-80 transition duration-100 hover:opacity-100 text-white rounded py-2 px-5 more-videos"><i class="fa fa-refresh"></i> Tampilkan Lebih Banyak</button>
</main>
