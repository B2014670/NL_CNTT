<!-- Extract the data into separate arrays -->
<?php
$labels = array();
$sales = array();
$total = 0;
foreach ($data["saleChart"] as $i => $chart) :
  $labels[] = 'Tháng ' . $chart["month"];
  $sales[] = $chart["cost"];
  $total += $chart["cost"];
endforeach;
?>
<?php
$name = array();
$count = array();
$sum = 0;
foreach ($data["productChart"] as $i => $chart) :
  $name[] = $chart["name"];
  $count[] = $chart["gram"];
  $sum += $chart["gram"];
endforeach;
?>
<!-- end data -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Thống kê</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= DOCUMENT_ROOT ?>/admin">Trang chủ</a></li>
          <li class="breadcrumb-item active">Thống kê</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info mb-2">
          <div class="inner">
            <h3><?= $data["finishedOrders"] ?></h3>
            <p>Đơn hàng chưa hoàn thành</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success mb-2">
          <div class="inner">
            <h3><?= $data["countUser"] ?></h3>
            <p>Đăng kí mới</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning mb-2">
          <div class="inner">
            <h3><?= $data["countProduct"] ?></h3>
            <p>Sản phẩm đã thêm</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger mb-2">
          <div class="inner">
            <h3><?= $data["countSale"] ?></h3>
            <p>Khuyến mãi đã thêm</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-2">
        <select id="yearChart" class="custom-select" onchange="getComboA(this)">
          <option value="">Chọn năm</option>
          <?php if (!isset($_GET["year"]))  $_GET["year"] = ''; ?>
          <?php foreach ($data["yearOrder"] as $i => $select) : ?>
            <option value="<?= $select["year"] ?>" <?= $select["year"] == $_GET["year"] ? "selected" : "" ?>><?= $select["year"] ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-sm-2">
        <select class="custom-select" onchange="getComboB(this)">
          <!-- <?= $status["id"] == $order["status"] ? "selected" : "" ?> -->
          <option value="">Chọn Tháng</option>
          <option value="1">Tháng 1</option>
          <option value="2">Tháng 2</option>
          <option value="3">Tháng 3</option>
          <option value="4">Tháng 4</option>
          <option value="5">Tháng 5</option>
          <option value="6">Tháng 6</option>
          <option value="7">Tháng 7</option>
          <option value="8">Tháng 8</option>
          <option value="9">Tháng 9</option>
          <option value="10">Tháng 10</option>
          <option value="11">Tháng 11</option>
          <option value="12">Tháng 12</option>
        </select>
      </div>

    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6">
        <div class="card">          
          <div class="card-body">
            <div class="d-flex">
              <p class="ml-auto d-flex flex-column text-right">
                <span>Tổng doanh thu</span>
                <span class="text-bold text-lg"><?= number_format($total, 0, ',', ' ') ?>đ</span>
              </p>
            </div>
            <!-- /.d-flex -->

            <div class="position-relative mb-4">
              <canvas id="sales-chart1" height="200"></canvas>
            </div>
            <p class="text-center">Biểu đồ doanh thu <?= $_GET["month"] ?? "";
                                                      echo '/'; ?>
              <?= $_GET["year"] ? $_GET["year"] : '2023' ?></p>

          </div>
        </div>
      </div>
      <!-- /.col-md-6 -->
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <div class="d-flex">
              <p class="ml-auto d-flex flex-column text-right">
                <span>Tổng khối lượng</span>
                <span class="text-bold text-lg">
                  <?php
                  function outputWeight($kg)
                  {
                    $power = floor(log($kg, 10));    
                    switch($power) {
                      case 5  :
                      case 4  :
                      case 3  : $unit = 'tấn'; 
                                $power = 3;
                                break;
                      case 2  :
                      case 1  :    
                      case 0  : $unit = 'kilogram'; 
                                $power = 0;
                                break;
                      case -1 : 
                      case -2 : 
                      case -3 : $unit = 'gram'; 
                                $power = -3;
                                break;
                      case -4 : 
                      case -5 : 
                      case -6 : $unit = 'milligram'; 
                                $power = -6;
                                break;
                      default : return 'out of range';
                    }
                    return ($kg / pow(10, $power)) . ' ' . $unit;
                  }
                  echo outputWeight($sum/1000);
                ?>
                </span>
              </p>
            </div>
            <!-- /.d-flex -->

            <div class="position-relative mb-4">
              <canvas id="visitors-chart1" height="200"></canvas>
            </div>
            <p class="text-center">Biểu đồ doanh số <?= $_GET["month"] ?? "";
                                                    echo '/'; ?>
              <?= $_GET["year"] ? $_GET["year"] : '2023' ?></p>

          </div>
        </div>
      </div>
      <!-- /.col-md-6 -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</div>
<!-- /.content -->
<!-- jQuery -->
<script src="<?= URL_PUBLIC ?>/admin/plugins/jquery/jquery.min.js"></script>
<script src="<?= URL_PUBLIC ?>/admin/plugins/chart.js/Chart.min.js"></script>

<script>
  function getComboA(selectObject) {
    var value = selectObject.value;
    window.location.href = 'http://localhost/admin/home?year=' + value;
  }

  function getComboB(selectObject) {
    var year = document.getElementById("yearChart").value;
    var value = selectObject.value;
    window.location.href = 'http://localhost/admin/home?year=' + year + '&&month=' + value;
  }

  function number_format(number, decimals, dec_point, thousands_sep) {
    // *     example: number_format(1234.56, 2, ',', ' ');

    // *     return: '1 234,56'
    number = (number + '').replace(',', '').replace(' ', '');
    var n = !isFinite(+number) ? 0 : +number,
      prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
      sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
      dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
      s = '',
      toFixedFix = function(n, prec) {
        var k = Math.pow(10, prec);
        return '' + Math.round(n * k) / k;
      };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
      s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
      s[1] = s[1] || '';
      s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
  }
</script>

<script>
  'use strict'
  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }
  var mode = 'index'
  var intersect = true

  const chart1 = document.getElementById('sales-chart1');
  var salesChart = new Chart(chart1, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($labels); ?>,
      datasets: [{
        backgroundColor: '#007bff',
        borderColor: '#007bff',
        data: <?php echo json_encode($sales); ?>
      }, ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,

            // Include a dollar sign in the ticks
            callback: function(value) {
              return number_format(value) + ' đ';
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      },
      tooltips: {
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
        callbacks: {
          label: function(tooltipItem, chart) {
            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel + ' ' + number_format(tooltipItem.yLabel) + ' đ';
          }
        }
      }
    }
  })



  const chart2 = document.getElementById('visitors-chart1');

  var salesChart = new Chart(chart2, {
    type: 'bar',
    data: {
      labels: <?php echo json_encode($name); ?>,
      datasets: [{
        backgroundColor: '#007bff',
        borderColor: '#007bff',
        data: <?php echo json_encode($count); ?>
      }, ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,

            // Include a kg sign in the ticks
            callback: function(value) {
              if (value >= 1000) {
                value /= 1000
                value += 'kg'
              } else
                value += 'g'

              return value
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      },
      tooltips: {
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
        callbacks: {
          label: function(tooltipItem, chart) {
            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
            if (tooltipItem.yLabel >= 1000) {
              tooltipItem.yLabel /= 1000
              tooltipItem.yLabel += 'kg'
            } else
              tooltipItem.yLabel += 'gram'
            return datasetLabel + ' ' + tooltipItem.yLabel;
          }
        }
      }
    }
  })
  // var visitorsChart = new Chart(ctx, {
  //   data: {
  //     labels: <?php echo json_encode($labels); ?>,
  //     datasets: [{
  //       type: 'line',
  //       data: <?php echo json_encode($count); ?>,
  //       backgroundColor: 'transparent',
  //       borderColor: '#007bff',
  //       pointBorderColor: '#007bff',
  //       pointBackgroundColor: '#007bff',
  //       fill: false
  //       // pointHoverBackgroundColor: '#007bff',
  //       // pointHoverBorderColor    : '#007bff'
  //     }, ]
  //   },
  //   options: {
  //     maintainAspectRatio: false,
  //     tooltips: {
  //       mode: mode,
  //       intersect: intersect
  //     },
  //     hover: {
  //       mode: mode,
  //       intersect: intersect
  //     },
  //     legend: {
  //       display: false
  //     },
  //     scales: {
  //       yAxes: [{
  //         // display: false,
  //         gridLines: {
  //           display: true,
  //           lineWidth: '4px',
  //           color: 'rgba(0, 0, 0, .2)',
  //           zeroLineColor: 'transparent'
  //         },
  //         ticks: $.extend({
  //           beginAtZero: true,
  //           suggestedMax: 10
  //         }, ticksStyle)
  //       }],
  //       xAxes: [{
  //         display: true,
  //         gridLines: {
  //           display: false
  //         },
  //         ticks: ticksStyle
  //       }]
  //     }
  //   }
  // })
</script>