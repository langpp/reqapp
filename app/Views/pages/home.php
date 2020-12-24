<?php echo $this->extend('default_layout') ?>
<?php echo $this->section('content') ?>
<ol class="breadcrumb float-xl-right">
  <li class="breadcrumb-item"><a href="#">Home</a></li>
  <li class="breadcrumb-item active">Dashboard</li>
</ol>

<h1 class="page-header">Dashboard</h1>

<div class="row">

  <div class="col-xl-3 col-md-6">
    <div class="widget widget-stats bg-blue">
      <div class="stats-icon"><i class="fa fa-user-plus"></i></div>
      <div class="stats-info">
        <h4>Permintaan Masuk</h4>
        <p><?php echo count($permintaanMasuk) ?></p>
      </div>
      <div class="stats-link">
        <a href="/permintaan-masuk">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="widget widget-stats bg-info">
      <div class="stats-icon"><i class="fa fa-medal"></i></div>
      <div class="stats-info">
        <h4>Permintaan Diproses</h4>
        <p><?php echo count($permintaanDiproses) ?></p>
      </div>
      <div class="stats-link">
        <a href="/permintaan-diproses">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="widget widget-stats bg-orange">
      <div class="stats-icon"><i class="fa fa-people-carry"></i></div>
      <div class="stats-info">
        <h4>Permintaan Selesai</h4>
        <p><?php echo count($permintaanSelesai) ?></p>
      </div>
      <div class="stats-link">
        <a href="/permintaan-selesai">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-md-6">
    <div class="widget widget-stats bg-red">
      <div class="stats-icon"><i class="fa fa-school"></i></div>
      <div class="stats-info">
        <h4>Permintaan Ditolak</h4>
        <p><?php echo count($permintaanDitolak) ?></p>
      </div>
      <div class="stats-link">
        <a href="/permintaan-ditolak">View Detail <i class="fa fa-arrow-alt-circle-right"></i></a>
      </div>
    </div>
  </div>

</div>

<div class="row">

  <div class="col-xl-8">

    <div class="panel panel-inverse" data-sortable-id="index-1">
      <div class="panel-heading">
        <h4 class="panel-title">Permintaan Terbanyak</h4>
        <div class="panel-heading-btn">
          <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
          <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
          <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
          <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
        </div>
      </div>
      <div class="panel-body pr-1">
        <div id="interactive-chart" class="height-sm"></div>
      </div>
    </div>
  </div>

  <div class="col-xl-4">
    <div class="panel panel-inverse" data-sortable-id="index-6">
      <div class="panel-heading">
        <h4 class="panel-title">Permintaan Terbaru</h4>
        <div class="panel-heading-btn">
          <a href="#" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
          <a href="#" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
          <a href="#" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
          <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
        </div>
      </div>
      <div class="table-responsive">
        <table class="table table-valign-middle table-panel mb-0">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Tanggal</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
foreach ($permintaanTerbaru as $data) {?>
              <tr>
                <td><?php echo $data->order_id ?></td>
                <td><?php echo strftime("%d %B %Y %H:%M", strtotime($data->created_at)) ?></td>
                <td><a type="button" class="btn btn-primary btn-xs detail" href="/permintaan-masuk/detail/<?php echo str_replace("#", "", $data->order_id) ?>"><i class="fa fa-eye"></i></a></td>
                </td>
              </tr>
            <?php
}
?>
          </tbody>
        </table>
      </div>
    </div>

  </div>

</div>

<?php echo $this->endSection() ?>

<?php echo $this->section('script') ?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script>
  $(function() {

    $.ajax({
      type: "GET",
      url: "/home/permintaan-terbanyak",
      processData: false,
      contentType: false,
      dataType: "json",
      success: function(data) {

        Highcharts.chart('interactive-chart', {
          chart: {
            type: 'column'
          },
          title: {
            text: 'Permintaan Terbanyak'
          },
          subtitle: {
            text: 'Berdasarkan Kebutuhan'
          },
          xAxis: {
            type: 'category',
            labels: {
              rotation: -45,
              style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
              }
            }
          },
          yAxis: {
            min: 0,
            title: {
              text: 'Jumlah'
            }
          },
          legend: {
            enabled: false
          },
          tooltip: {
            pointFormat: 'Total Permintaan: <b>{point.y}</b>'
          },
          series: [{
            name: 'Kebutuhan',
            data: data,
            dataLabels: {
              enabled: true,
              rotation: -90,
              color: '#FFFFFF',
              align: 'right',
              // format: '{point.y:.1f}', // one decimal
              y: 10, // 10 pixels down from the top
              style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
              }
            }
          }]
        });

      },
      error: function(data) {
        console.log('error');
      },
    });



  });
</script>
<?php echo $this->endSection() ?>