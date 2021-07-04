<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<script type="text/javascript">
  let page = 1;
  const total_page = "<?=$total_page;?>";
  $(document).ready(function() {
    if (parseInt(total_page) == page || parseInt(total_page) == 0) {
      $('.more-albums').remove();
    }
  });
  function get_albums() {
    page++;
    const data = {
      page_number: page
    };
    if ( page <= parseInt(total_page) ) {
      _H.Loading( true );
      $.post( _BASE_URL + 'public/gallery_photos/get_albums', data, function( response ) {
        _H.Loading( false );
        const res = response;
        const rows = res.rows;
        let html = '';
        for (var z in rows) {
          const row = rows[ z ];
          const template = `
          <figure class="shadow-md bg-white overflow-hidden album flex flex-col justify-between">
            <img src="${_BASE_URL}media_library/albums/${row.album_cover}" alt="${row.album_title}" class="h-48 w-full object-fit object-cover flex items-center justify-center bg-gray-300">
            <figcaption class="py-2 text-center">
              ${row.album_title}
            </figcaption>
            <div class="px-3 py-2">
              <button type="button" onclick="photo_preview(${row.id})" class="bg-secondary text-white block w-full py-2 text-center mx-2"><i class="fa fa-search mr-2"></i> Lihat</button>
            </div>
          </figure>
          `;
          html += template;
        }
        var elementId = $(".album:last");
        $( html ).insertAfter( elementId );
        if (page == parseInt(total_page)) $('.more-albums').remove();
      });
    }
  }
</script>

<main class="container space-y-5 my-5 flex-1">
  <h2 class="text-title text-2xl font-bold font-heading"><?= $page_title ?></h2>
  <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
    <?php foreach($query->result() as $album) : ?>
      <figure class="shadow-md bg-white overflow-hidden album flex flex-col justify-between">
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
  <button type="button" onclick="get_albums(); return false;" class="bg-secondary opacity-80 transition duration-100 hover:opacity-100 text-white rounded py-2 px-5 more-albums"><i class="fa fa-refresh"></i> Tampilkan Lebih Banyak</button>
</main>