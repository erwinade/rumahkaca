<?php include 'header.php'; ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
<?php 
date_default_timezone_set('Asia/Jakarta');
$wktu = date('Y-m-d  H:i:s');

if(isset($_GET['id_lampu'])){
    $id = $_GET['id_lampu'];
    $value_lampu = $_GET['value'];

    if($value_lampu == 1){ $value = 0;}
    if($value_lampu == 0){ $value = 1;}

    // echo $id;
    // echo "<br>";
    // echo $value_lampu;
    // echo "<br>";
    // echo $value;

    $sql = " UPDATE sensors SET value = '$value' , updated_at = '$wktu' WHERE id = '".$id."' ";
   if(mysqli_query($conn,$sql)){
    //   echo "Berhasil";
   }else{
    //   echo "gagal";
   }
}

$plants = ("SELECT * FROM plants");
$sql = mysqli_query($conn,$plants);
$sum_plants = mysqli_num_rows($sql);

$sen_tnh = ("SELECT * FROM sensors WHERE type = 'tanah' ");
$sen_tnhs = mysqli_query($conn,$sen_tnh);
$sum_tnh = mysqli_num_rows($sen_tnhs);

$sen_lux = ("SELECT * FROM sensors WHERE type = 'cahaya' ");
$sen_luxs = mysqli_query($conn,$sen_lux);
$sum_lux = mysqli_num_rows($sen_luxs);

$sen_temp = ("SELECT * FROM sensors WHERE type = 'suhu' ");
$sen_temps = mysqli_query($conn,$sen_temp);
$sum_temp = mysqli_num_rows($sen_temps);

$sen_hum = ("SELECT * FROM sensors WHERE type = 'lembab' ");
$sen_hums = mysqli_query($conn,$sen_hum);
$sum_hum = mysqli_num_rows($sen_hums);

$tnhs = query("SELECT AVG(value) FROM sensors WHERE type = 'tanah' ");
foreach ($tnhs as $tnh) {
}

$luxs = query("SELECT AVG(value) FROM sensors WHERE type = 'cahaya' ");
foreach ($luxs as $lux) {
}

$temps = query("SELECT AVG(value) FROM sensors WHERE type = 'suhu' ");
foreach ($temps as $temp) {
}

$hums = query("SELECT AVG(value) FROM sensors WHERE type = 'lembab' ");
foreach ($hums as $hum) {
}
?>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-s font-weight-bold text-primary text-uppercase mb-1">
                                Total Tanaman</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $sum_plants; ?></div>
                        </div>
                        <div class="col-auto">
                            <!-- <i class="fas fa-calendar fa-2x text-gray-300"></i> -->
                            <i class="fas fa-leaf fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-s font-weight-bold text-success text-uppercase mb-1">
                                Lembab Tanah (<?= $sum_tnh; ?>)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= round($tnh["AVG(value)"],2); ?> %</div>
                        </div>
                        <div class="col-auto">
                            <!-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> -->
                            <i class="fas fa-tint fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-s font-weight-bold text-info text-uppercase mb-1">Cahaya (<?= $sum_lux;?>)
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= round($lux["AVG(value)"],2); ?> lux</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <!-- <i class="fas fa-clipboard-list fa-2x text-gray-300"></i> -->
                            <i class="far fa-sun fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-s font-weight-bold text-warning text-uppercase mb-1">
                                Suhu (<?= $sum_temp;?>) &nbsp;Lembab (<?= $sum_hum;?>)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= round($temp["AVG(value)"],2); ?> &deg;C &nbsp; <?= round($hum["AVG(value)"],2); ?> %</div>
                        </div>
                        <div class="col-auto">
                            <!-- <i class="fas fa-comments fa-2x text-gray-300"></i> -->
                            <i class="fas fa-temperature-high fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                            <div id="canvas-holder" style="width:100%">
                                <canvas id="gauge1"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div id="canvas-holder" style="width:100%">
                                <canvas id="gauge2"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div id="canvas-holder" style="width:100%">
                                <canvas id="gauge3"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div id="canvas-holder" style="width:100%">
                                <canvas id="gauge4"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div id="canvas-holder" style="width:100%">
                                <canvas id="gauge5"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-7 mt-2">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Monitoring Kelistrikan</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <canvas id="chartListrik"></canvas>
                </div>
            </div>
        </div>

    </div>

    <!-- Content Kontrol --> 
    <div class="row">

        <div class="col-lg-8 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                    <?php
                    $relays = query("SELECT * FROM sensors WHERE type = 'relay' ");
                    foreach($relays as $relay):
                        if($relay['value'] == 1) {$status_lampu = "ON";}
                        if($relay['value'] == 0) {$status_lampu = "OFF";}
                    ?>
                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-2">
                        <div id="card" class="card card-info m-0 border-primary" style="border: 1px solid;border-radius: 3px;">
                            <div class="card-header" style="background-color:#d9edf7;#bce8f1;color:#31708f; border:-1px!important; ">
                                <div class="row">
                                    <div class="col-12 text-right">
                                            <span style="font-size:14px;font-weight:400">Lamp Status (<?= $status_lampu; ?>)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body text-center">
                                <a href="?id_lampu=<?= $relay['id']; ?>&value=<?= $relay['value']; ?>"><img src="img/<?= $status_lampu; ?>.png" alt="center" alt="" width="80" height="120"></a>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div> 
                    <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Status Pintu -->
        <div class="col-xl-4 col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <!-- Informasi Status Pintu -->
                        <div class="col-xl-12 col-md-8">
                            <div id="card" class="card card-info m-0 border-primary" style="border: 1px solid;border-radius: 3px;">
                                <div class="card-header" style="background-color:#d9edf7;#bce8f1;color:#31708f; border:-1px!important; ">
                                    <div class="row">
                                        <div class="col-12 text-right">
                                                <span style="font-size:15px;font-weight:400">Status Pintu (Terbuka)</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body text-center">
                                    <img src="img/bdoor_open.gif" alt="center" alt="" width="80" height="125"> 
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Aktivitas Harian</h6>
                </div>
                <div class="card-body">
                    <h4 class="small font-weight-bold">Penyiraman <span
                            class="float-right">20%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <h4 class="small font-weight-bold">Pemberian Pupuk <span
                            class="float-right">40%</span></h4>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<?php include 'footer.php'; ?>

<script>

var data = [0,0]
var value = 0;

var config = {
  type: 'gauge',
  data: {
    //labels: ['Success', 'Warning', 'Warning', 'Error'],
    datasets: [{
      data: data,
      value: value,
      backgroundColor: ['yellow', 'grey'],
      borderWidth: 2
    }]
  },
  options: {
    responsive: true,
    title: {
      display: true,
      text: 'Voltage'
    }
  }
};

var config2 = {
  type: 'gauge',
  data: {
    //labels: ['Success', 'Warning', 'Warning', 'Error'],
    datasets: [{
      data: data,
      value: value,
      backgroundColor: ['green', 'grey'],
      borderWidth: 2
    }]
  },
  options: {
    responsive: true,
    title: {
      display: true,
      text: 'Energy'
    }
  }
};

var config3 = {
  type: 'gauge',
  data: {
    //labels: ['Success', 'Warning', 'Warning', 'Error'],
    datasets: [{
      data: data,
      value: value,
      backgroundColor: ['red', 'grey'],
      borderWidth: 2
    }]
  },
  options: {
    responsive: true,
    title: {
      display: true,
      text: 'Watt'
    }
  }
};

var config4 = {
  type: 'gauge',
  data: {
    //labels: ['Success', 'Warning', 'Warning', 'Error'],
    datasets: [{
      data: data,
      value: value,
      backgroundColor: ['blue', 'grey'],
      borderWidth: 2
    }]
  },
  options: {
    responsive: true,
    title: {
      display: true,
      text: 'Current'
    }
  }
};

var config5 = {
  type: 'gauge',
  data: {
    //labels: ['Success', 'Warning', 'Warning', 'Error'],
    datasets: [{
      data: data,
      value: value,
      backgroundColor: ['purple', 'grey'],
      borderWidth: 2
    }]
  },
  options: {
    responsive: true,
    title: {
      display: true,
      text: 'Frequency'
    }
  }
};

window.onload = function() {
  var ctx = document.getElementById('gauge1').getContext('2d');
  window.myGauge = new Chart(ctx, config);

  var ctx2 = document.getElementById('gauge2').getContext('2d');
  window.myGauge2 = new Chart(ctx2, config2);

  var ctx3 = document.getElementById('gauge3').getContext('2d');
  window.myGauge3 = new Chart(ctx3, config3);

  var ctx4= document.getElementById('gauge4').getContext('2d');
  window.myGauge4 = new Chart(ctx4, config4);

  var ctx5= document.getElementById('gauge5').getContext('2d');
  window.myGauge5 = new Chart(ctx5, config5);
};


// chart line 

var ctx6 = document.getElementById("chartListrik");
  var myChart = new Chart(ctx6, {
    type: 'line',
    data: {
      labels: [],
      datasets: [{
        label: 'Kelistrikan',
        data: [],
        fill: false,
        borderColor: 'rgb(75, 192, 192)',
      }]
    },
    options: {
      scales: {
        xAxes: [],
        yAxes: [{
          ticks: {
            beginAtZero:true
          }
        }]
      }
    },
    
  });


var updateChart = function() {
$.ajax({
      url: "get_data_kelistrikan.php",
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        config.data.datasets.forEach(function(dataset) {
            dataset.data = [
                data.gauge.voltage,200
            ];
            dataset.value = data.gauge.voltage;
        });

        config2.data.datasets.forEach(function(dataset) {
            dataset.data = [
                data.gauge.energy,200
            ];
            dataset.value = data.gauge.energy;
        });

        config3.data.datasets.forEach(function(dataset) {
            dataset.data = [
                data.gauge.watt,200
            ];
            dataset.value = data.gauge.watt;
        });

        config4.data.datasets.forEach(function(dataset) {
            dataset.data = [
                data.gauge.current,200
            ];
            dataset.value = data.gauge.current;
        });

        config5.data.datasets.forEach(function(dataset) {
            dataset.data = [
                data.gauge.frequency,200
            ];
            dataset.value = data.gauge.frequency;
        });

        myChart.data.labels = data.labels;
        myChart.data.datasets[0].data = data.values;
        myChart.update();

        window.myGauge.update();
        window.myGauge2.update();
        window.myGauge3.update();
        window.myGauge4.update();
        window.myGauge5.update();
        // console.log(data);
      },
      error: function(data){
        console.log(data);
      }
    });
}

updateChart();
  setInterval(() => {
    updateChart();
  }, 1000);
</script>