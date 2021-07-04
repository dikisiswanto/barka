<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript">
let page = 1;
const total_page = "<?=$total_page;?>";
$(document).ready(function() {
  if (parseInt(total_page) == page || parseInt(total_page) == 0) {
    $('.more-employees').remove();
  }
});

function get_employees() {
  page++;
  var data = {
    page_number: page
  };
  if ( page <= parseInt(total_page) ) {
    _H.Loading( true );
    $.post( _BASE_URL + 'public/employee_directory/get_employees', data, function( response ) {
      _H.Loading( false );
      const res = response;
      const rows = res.rows;
      let html = '';
      let no = parseInt($('.number:last').text()) + 1;
      for (var z in rows) {
        const row = rows[ z ];
        const template = `
        <div class="profile-employees">
          <div class="shadow bg-white flex flex-col lg:flex-row lg:items-center justify-between py-2 px-3">
            <div class="lg:w-1/4"><img src="${row.photo}" class="thumbnail w-full text-center mx-auto"/></div>
            <div class="lg:w-3/4">
              <div class="py-2 px-3">
                <dl class="block flex-wrap text-gray-500 divide-y">
                  <div class="flex justify-between">
                    <dt>Nama Lengkap</dt>
                    <dd>${row.full_name}</dd>
                  </div>

                  <div class="flex justify-between">
                    <dt>NIK</dt>
                    <dd>${row.nik}</dd>
                  </div>

                  <div class="flex justify-between">
                    <dt>Jenis Kelamin</dt>
                    <dd>${row.gender}</dd>
                  </div>

                  <div class="flex justify-between">
                    <dt>Tempat Lahir</dt>
                    <dd>${row.birth_place}</dd>
                  </div>

                  <div class="flex justify-between">
                    <dt>Tanggal Lahir</dt>
                    <dd>${row.birth_date}</dd>
                  </div>

                  <div class="flex justify-between">
                    <dt>Jenis GTK</dt>
                    <dd>${row.employment_type}</dd>
                  </div>
                </dl>
              </div>
            </div>
          </div>
        </div>
        `;
        html += template;
      }
      var elementId = $(".profile-employees:last");
      $( html ).insertAfter( elementId );
      if ( page == parseInt(total_page) ) $('.more-employees').remove();
    });
  }
}
</script>
<style>
  .thumbnail {
    height: 6rem;
    width: auto;
  }
  @media screen and (min-width: 1024px) {
    .thumbnail {
      width: 100%;
      height: auto;
    }
  }
</style>
<main class="container space-y-5 my-5 flex-1">
  <div class="space-y-4">
    <h3 class="font-heading text-2xl font-black text-title"><span class="fa fa-bar"></span> <?= ucwords($page_title) ?></h3>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
      <?php foreach($query->result() as $row) : ?>
        <div class="profile-employees">
          <div class="shadow bg-white flex flex-col lg:flex-row lg:items-center justify-between py-2 px-3">
            <div class="w-full lg:w-1/4">
              <?php
              $photo = 'no-image.png';
              if ($row->photo && is_file($_SERVER['DOCUMENT_ROOT'] . '/media_library/employees/'.$row->photo)) {
                $photo = $row->photo;
              }
              echo '<img src="' . base_url('media_library/employees/'.$photo).'" class="thumbnail w-auto flex-shrink-0 text-center mx-auto">';
              ?>
            </div>
            <div class="w-full lg:w-3/4">
              <div class="py-2 px-3">
                <dl class="block flex-wrap text-gray-500 divide-y">
                  <div class="flex justify-between">
                    <dt>Nama Lengkap</dt>
                    <dd><?=$row->full_name?></dd>
                  </div>

                  <div class="flex justify-between">
                    <dt>NIK</dt>
                    <dd><?=$row->nik?></dd>
                  </div>

                  <div class="flex justify-between">
                    <dt>Jenis Kelamin</dt>
                    <dd><?=$row->gender?></dd>
                  </div>

                  <div class="flex justify-between">
                    <dt>Tempat Lahir</dt>
                    <dd><?=$row->birth_place?></dd>
                  </div>

                  <div class="flex justify-between">
                    <dt>Tanggal Lahir</dt>
                    <dd><?=indo_date($row->birth_date)?></dd>
                  </div>

                  <div class="flex justify-between">
                    <dt>Jenis GTK</dt>
                    <dd><?=$row->employment_type?></dd>
                  </div>
                </dl>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach ?>
    </div>
    <button type="button" onclick="get_employees()" class="bg-secondary opacity-80 transition duration-100 hover:opacity-100 text-white rounded py-2 px-5 text-center more-employees"><i class="fa fa-refresh"></i> Tampilkan Lebih Banyak</button>
  </div>
</main>
