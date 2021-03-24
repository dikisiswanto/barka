<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript">
	let page = 1;
	const total_page = "<?=$total_page;?>";

	$(document).ready(function() {
		if (parseInt(total_page) == page || parseInt(total_page) == 0) {
			$('.more-files').remove();
		}
	});
	
	function setLoading(state) {
		const loading = `
			<div class="fixed top-0 right-0 left-0 bottom-0 w-full min-h-screen bg-black bg-opacity-20 flex items-center justify-center text-white z-50 flex-col">
				<i class="fa fa-spinner fa-spin text-5xl" aria-label="Loading..."></i>
				<span>Memuat...</span>
			</div>
		`
		if (state) {
			$('.loading-area').html(loading);
		} else {
			$('.loading-area').html('')
		}
	}

	function get_files() {
		page++;
		var data = {
			page_number: page,
			slug: '<?=$this->uri->segment(2)?>'
		};
		if ( page <= parseInt(total_page) ) {
			_H.Loading( true );
			$.post( _BASE_URL + 'public/download/get_files', data, function( response ) {
				_H.Loading( false );
				var res = _H.StrToObject( response );
				var rows = res.rows;
				var str = '';
				var no = parseInt($('.number:last').text()) + 1;
				for (var z in rows) {
					var row = rows[ z ];
					str += '<tr>';
					str += '<td class="number">' + no + '</td>';
					str += '<td>' + row.file_title + '</td>';
					str += '<td>' + (_H.FormatBytes(row.file_size * 1024)) + '</td>';
					str += '<td>' + row.file_ext + '</td>';
					str += '<td>' + row.file_counter + '</td>';
					str += '<td>';
					str += '<a href="' + _BASE_URL + 'public/download/force_download/' + row.id + '"><i class="fa fa-download"></i></a>';
					str += '</td>';
					str += '</tr>';
					no++;
				}
				var elementId = $("tbody > tr:last");
				$( str ).insertAfter( elementId );
				if ( page == parseInt(total_page) ) $('.more-files').remove();
			});
		}
	}
</script>
<div class="col-lg-12 col-md-12 col-sm-12 ">
	<h5 class="page-title mb-3"><?=strtoupper($page_title)?></h5>
	<div class="card rounded-0 border border-secondary mb-3">
		<div class="card-body p-2 mb-0">
			<table class="table table-striped table-bordered mb-0">
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
						<tr>
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
		</div>
	</div>
	<div class="justify-content-between align-items-center float-right mb-3 w-100 more-files">
		<button type="button" onclick="get_files()" class="btn action-button rounded-0 float-right"><i class="fa fa-refresh"></i> File Lainnya</button>
	</div>
</div>
