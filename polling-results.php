<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<script src="<?=base_url('assets/plugins/Chart.js');?>"></script>
<script type="text/javascript">
  $( document ).ready( function() {
    const element_id = document.getElementById('canvas');
    new Chart(element_id, {
      type: 'bar',
      data: {
        labels: <?=$labels;?>,
        datasets: [{
          label: '',
          data: <?=$data;?>,
          borderWidth: 2,
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
          borderColor: 'rgba(75, 192, 192, 1)'
        }]
      },
      options: {
        responsive: true,
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero:true
            }
          }]
        }
      }
    });
  });
</script>
<main class="container space-y-5 my-5 flex-1">
  <div class="flex flex-col lg:flex-row items-start gap-x-6 relative space-y-5 lg:space-y-0">
    <div class="w-full lg:w-2/3 space-y-4">
      <h3 class="font-heading text-2xl capitalize font-black text-title"><span class="fa fa-bar-chart"></span> <?= ucwords($page_title) ?></h3>
      <canvas id="canvas"></canvas>
    </div>
    <div class="w-full lg:w-1/3 space-y-5 ">
      <?php $this->load->view(THEME_PATH . 'components/sidebar') ?>
    </div>
  </div>
</main>
