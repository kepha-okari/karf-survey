<?php

/* @var $this yii\web\View */

$this->title = 'mswali';
?>
<div class="answers-index" style="height:100vh;padding:0px" >

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
 
    </section> 

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">


      <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= 10 ?></h3>

              <p>Registered Users</p>
            </div>
            <div class="icon">
              <i class="ion io'mswali'n-person-add"></i>
            </div>
                <a href="http://161.35.6.91/mswali/mswali_app/backend/web/index.php?r=users/index" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
          </div>
        </div>
        <!-- ./col -->
        
      <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>
                <small><sup style="font-size: 20px">Kshs</sup></small>
                 <?= 10 ?>
              </h3>

              <p >Collected Revenue</p>
            </div>
            <div class="icon">
              <i class="ion ion-podium"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
      </div>
        <!-- ./col -->

      <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= 10 ?></h3>

              <p>Active Players Today</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
      </div>


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>
                <small><sup style="font-size: 20px"></sup></small>
                <?= 10 ?>
                </h3>

              <p >Total Prize Winners</p>
            </div>
            <div class="icon">
              <i class="fa fa-star-o"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

        <div class="col-md-6" style="margin-top:40px;">
            <div class="col-12">
                    <!-- BAR CHART -->
                  <div class="box box-success">
                      <div class="box-header with-border">
                          <h3 class="box-title">PLAYERS vs WINNERS</h3>
                      </div>
                      <div class="box-body">
                          <div class="chart">
                              <canvas id="barChart" style="height:380px"></canvas>
                          </div>
                      </div>
                  </div>

                  <!-- AREA CHART -->
                  <div class="box box-default">
                    <div class="box-body">
                      <div class="chart">
                        <canvas id="areaChart" style="height:0px"></canvas>
                      </div>
                    </div>
                  </div>
            </div>

        </div>

        
      


        <div class="col-lg-3 col-xs-6" style="margin-top:40px;">
          <!-- DONUT CHART -->
          <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Questions Summary</h3>
            </div>

            <div class="box-body">
              <canvas id="pieChart" style="height:250px"></canvas>
            </div>

          </div>
        </div>
      

        <div class="col-md-3 col-sm-6 col-xs-12" style="margin-top:40px;">
          <div class="info-box">
            <span class="info-box-icon bg-orange"><i class="fa fa-gamepad"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Game Sessions Played</span>
              <span class="info-box-number"><?= 100 ?></span>
            </div>
            
            <!-- /.info-box-content -->
          </div>

          <a href="http://161.35.6.91/mswali/mswali_app/backend/web/index.php?r=game-sessions/index" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12" style="margin-top:40px;">
          <div class="info-box">
            <span class="info-box-icon bg-orange"><i class="fa fa-gamepad"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Game Sessions Played</span>
              <span class="info-box-number"><?= 100 ?></span>
            </div>
            
            <!-- /.info-box-content -->
          </div>

          <a href="http://161.35.6.91/mswali/mswali_app/backend/web/index.php?r=game-sessions/index" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <div class="col-md-3 col-sm-6 col-xs-12" style="margin-top:40px;">
          <div class="info-box">
            <span class="info-box-icon bg-orange"><i class="fa fa-gamepad"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Game Sessions Played</span>
              <span class="info-box-number"><?= 100 ?></span>
            </div>
            
            <!-- /.info-box-content -->
          </div>

          <a href="http://161.35.6.91/mswali/mswali_app/backend/web/index.php?r=game-sessions/index" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-users"></i></span>

            <div class="info-box-content" style="margin-top:40px;">
              <span class="info-box-text">New Users Today</span>
              <span class="info-box-number"><?= 100 ?></span>

              <div class="progress">
                <div class="progress-bar" style="width: 40%"></div>
              </div>
                  <span class="progress-description">
                    
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        
        <div class="col-lg-6 col-xs-6" style="margin-top:40px;">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner info-box-number">
            <span class="info-box-text" style="font-size: 20px;margin-bottom:10px;">CUMULATIVE REWARD PAYMENTS</span>

              <h3>
                <small><sup style="font-size: 30px">Kshs</sup></small>
              </h3>
              
              <span class="info-box-number" style="font-size: 40px"><?= 10 ?></span>
            </div>
            <div class="icon">
              <i class="fa fa-credit-card"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      
      </div>
      <!-- /.row -->
      
    </section>
    <!-- /.content -->


  </div>

  
<!-- jQuery 2.2.0 -->
<script src="http://localhost/mswali/mswali_app/backend/web/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="http://localhost/mswali/mswali_app/backend/web/bootstrap/js/bootstrap.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="http://localhost/mswali/mswali_app/backend/web/plugins/chartjs/Chart.min.js"></script>
<!-- FastClick -->
<script src="http://localhost/mswali/mswali_app/backend/web/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="http://localhost/mswali/mswali_app/backend/web/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="http://localhost/mswali/mswali_app/backend/web/dist/js/demo.js"></script>

<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
    // This will get the first returned node in the jQuery collection.
    var areaChart = new Chart(areaChartCanvas);

    var areaChartData = {
      labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Sarturday"],
      datasets: [
        {
          label: "Electronics",
          fillColor: "rgba(210, 214, 222, 1)",
          strokeColor: "rgba(210, 214, 222, 1)",
          pointColor: "rgba(210, 214, 222, 1)",
          pointStrokeColor: "#c1c7d1",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: [65, 105, 80, 100, 56, 55, 40]
        },
        {
          label: "Digital Goods",
          fillColor: "rgba(66, 255, 79, 0.98)",
          strokeColor: "rgba(60,141,188,0.3)",
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(66, 255, 79, 0.98)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(60,141,188,1)",
          data: [28, 48, 40, <?= 1000 ?>, <?= 2000 ?>, <?= 200 ?>, 17]
        }
      ]
    };

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: false,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - Whether the line is curved between points
      bezierCurve: true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension: 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot: false,
      //Number - Radius of each point dot in pixels
      pointDotRadius: 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth: 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius: 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke: true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth: 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true
    };

    //Create the line chart
    areaChart.Line(areaChartData, areaChartOptions);

 
    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
    var pieChart = new Chart(pieChartCanvas);
    var PieData = [
      
      {
        value: 500,
        color: "#00a65a",
        highlight: "#00a65a",
        label: "Active Questions"
      },
      
      {
        value: 800,
        color: "#00c0ef",
        highlight: "#00c0ef",
        label: "Reserved Questions"
      },
      {
        value: 200,
        color: "#f56954",
        highlight: "#f56954",
        label: "Flaged Questions"
      },
    
    ];
    var pieOptions = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke: true,
      //String - The colour of each segment stroke
      segmentStrokeColor: "#fff",
      //Number - The width of each segment stroke
      segmentStrokeWidth: 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps: 100,
      //String - Animation easing effect
      animationEasing: "easeOutBounce",
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate: true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale: false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
    };
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions);

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $("#barChart").get(0).getContext("2d");
    var barChart = new Chart(barChartCanvas);
    var barChartData = areaChartData;
    
    barChartData.datasets[1].fillColor = "#00a65a";
    barChartData.datasets[1].strokeColor = "#00a65a";
    barChartData.datasets[1].pointColor = "#00a65a";

    var barChartOptions = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: true,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - If there is a stroke on each bar
      barShowStroke: true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth: 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing: 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing: 1,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to make the chart responsive
      responsive: true,
      maintainAspectRatio: true
    };

    barChartOptions.datasetFill = false;
    barChart.Bar(barChartData, barChartOptions);
  });
</script>


