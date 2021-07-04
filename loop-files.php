<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript">
  let page = 1;
  const total_page = "<?=$total_page;?>";

  $(document).ready(function() {
    if (parseInt(total_page) == page || parseInt(total_page) == 0) {
      $('.more-files').remove();
    }
  });

  function get_files() {
    page++;
    const data = {
      page_number: page,
      slug: '<?=$this->uri->segment(2)?>'
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
          html += '<td class="number">' + no + '</td>';
          html += '<td>' + row.file_title + '</td>';
          html += '<td>' + (_H.FormatBytes(row.file_size * 1024)) + '</td>';
          html += '<td>' + row.file_ext + '</td>';
          html += '<td>' + row.file_counter + '</td>';
          html += '<td>';
          html += '<a href="' + _BASE_URL + 'public/download/force_download/' + row.id + '"><i class="fa fa-download"></i></a>';
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
    <h3 class="font-heading text-2xl font-black text-title"><span class="fa fa-bar"></span> <?= ucwords($page_title) ?></h3>
    <table class="table w-full table-auto">
      <thead>
        <tr>
          <th width="40px">NO</th>
          <th>NAMA FILE</th>
          <th>UKURAN</th>
          <th>TIPE</th>
          <th>DIUNDUH</th>
          <th width="40px" class="text-center"><i class="fa fa-download"></i></th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; foreach($query->result() as $row) { ?>
          <tr class="text-center">
            <td class="number"><?=$no?></td>
            <td><?=$row->file_title?></td>
            <td><?=filesize_formatted($row->file_size * 1024)?></td>
            <td><?=$row->file_ext?></td>
            <td><?=$row->file_counter?> Kali</td>
            <td class="text-center">
              <a href="<?=site_url('public/download/force_download/'.$row->id)?>"><i class="fa fa-download"></i></a>
            </td>
          </tr>
          <?php $no++; } ?>
      </tbody>
    </table>
    <button type="button" onclick="get_files()" class="bg-secondary opacity-80 transition duration-100 hover:opacity-100 text-white rounded py-2 px-5 text-center more-files"><i class="fa fa-refresh"></i> Tampilkan Lebih Banyak</button>
  </div>
</main>