<?php defined('BASEPATH') OR exit('No direct script access allowed') ?>
<script type="text/javascript">
  let page = 1;
  const total_page = "<?= $total_page ?>";

  $(document).ready(function() {
    if (parseInt(total_page) == page || parseInt(total_page) == 0) {
      $('.more-files').remove();
    }
  });

  function get_files() {
    page++;
    const data = {
      page_number: page,
      slug: '<?= $this->uri->segment(2) ?>'
    };
    if ( page <= parseInt(total_page) ) {
      _H.Loading( true );
      $.post( _BASE_URL + 'public/download/get_files', data, function( response ) {
        _H.Loading( false );
        const res = response ;
        const rows = res.rows;
        let html = '';
        let no = parseInt($('.number:last').text()) + 1;
        for (const z in rows) {
          var row = rows[ z ];
          html += '<tr>';
          html += '<td class="number border-b py-2">' + no + '</td>';
          html += '<td class="border-b py-2">' + row.file_title + '</td>';
          html += '<td class="border-b py-2">' + (_H.FormatBytes(row.file_size * 1024)) + '</td>';
          html += '<td class="border-b py-2">' + row.file_ext + '</td>';
          html += '<td class="border-b py-2">' + row.file_counter + '</td>';
          html += '<td class="text-center border-b py-2">';
          html += '<a href="' + _BASE_URL + 'public/download/force_download/' + row.id + '" class="text-secondary"><i class="fa fa-download"></i></a>';
          html += '</td>';
          html += '</tr>';
          no++;
        }
        var elementId = $("tbody > tr:last");
        $( str ).insertAfter( elementId );
        if ( page == parseInt(total_page) ) $('.more-files').remove();
      });
    }
  }
</script>

<main class="container space-y-5 my-5 flex-1">
  <div class="space-y-4">
    <h1 class="font-heading text-2xl font-black text-title"><span class="fa fa-bar"></span> <?= ucwords($page_title) ?></h1>
    <table class="table w-full table-auto py-2">
      <thead>
        <tr>
          <th class="border-b py-2" width="40px">NO</th>
          <th class="border-b py-2">NAMA FILE</th>
          <th class="border-b py-2">UKURAN</th>
          <th class="border-b py-2">TIPE</th>
          <th class="border-b py-2">DIUNDUH</th>
          <th class="border-b py-2" width="40px" class="text-center"><i class="fa fa-download"></i></th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; foreach($query->result() as $row) : ?>
          <tr class="text-center">
            <td class="number border-b py-2"><?= $no ?></td>
            <td class="border-b py-2"><?= $row->file_title ?></td>
            <td class="border-b py-2"><?= filesize_formatted($row->file_size * 1024) ?></td>
            <td class="border-b py-2"><?= $row->file_ext ?></td>
            <td class="border-b py-2"><?= $row->file_counter ?> Kali</td>
            <td class="text-center border-b py-2">
              <a href="<?= site_url('public/download/force_download/'.$row->id) ?>" class="text-secondary"><i class="fa fa-download"></i></a>
            </td>
          </tr>
          <?php $no++; endforeach ?>
      </tbody>
    </table>
    <button type="button" onclick="get_files()" class="bg-secondary opacity-80 transition duration-100 hover:opacity-100 text-white rounded py-2 px-5 text-center more-files"><i class="fa fa-refresh"></i> Tampilkan Lebih Banyak</button>
  </div>
</main>