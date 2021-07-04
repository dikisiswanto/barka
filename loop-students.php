<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript">
  $( document ).ready(function() {
    var values = get_values();
    if (values['academic_year_id'] && values['class_group_id']) {
      get_students();
    }
  });

  function get_values() {
    var values = {
      academic_year_id: $('#academic_year_id').val(),
      class_group_id: $('#class_group_id').val()
    };
    return values;
  }

  function get_students() {
    const values = get_values();
    if (values['academic_year_id'] && values['class_group_id']) {
      _H.Loading(true);
      $.post( _BASE_URL + 'public/student_directory/get_students', values, function( response ) {
        _H.Loading(false);
        const res = response;
        const rows = res.rows;
        let html = '';
        let no = parseInt($('.number:last').text()) + 1;
        for (var z in rows) {
          const row = rows[ z ];
          const template = `
          <div class="profile-alumni">
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
                      <dt>${_IDENTITY_NUMBER}</dt>
                      <dd>${row.identity_number}</dd>
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
                  </dl>
                </div>
              </div>
            </div>
          </div>
          `;
          html += template;
        }
        const elementId = $(".student-directory");
        $(elementId).html(html);
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
    <h3 class="font-heading text-2xl font-black text-title"><span class="fa fa-student"></span> <?= ucwords($page_title) ?></h3>
    <form onsubmit="return false;" class="mb-3">
      <div class="grid gap-4 lg:grid-cols-3 items-center lg:w-3/4">
        <div class="w-full">
          <label class="mr-sm-2 sr-only" for="academic_year_id"><?=__session('_academic_year')?></label>
          <?=form_dropdown('academic_year_id', $academic_years, __session('current_academic_year_id'), 'class="form-select w-full" id="academic_year_id"');?>
        </div>
        <div class="w-full">
          <label class="mr-sm-2 sr-only" for="class_group_id">Kelas</label>
          <?=form_dropdown('class_group_id', $class_groups, '', 'class="form-select w-full" id="class_group_id"');?>
        </div>
        <div class="w-full">
          <button type="button" onclick="get_students()" class="bg-secondary opacity-80 transition duration-100 hover:opacity-100 text-white rounded py-2 px-5 text-center"><i class="fa fa-search mr-2"></i> CARI</button>
        </div>
      </div>
    </form>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 student-directory"></div>
    <div class="loading-area"></div>
  </div>
</main>
