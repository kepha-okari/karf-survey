<?php

/* @var $this yii\web\View */

$this->title = 'survey';
?>
<div class="answers-index" style="height:100vh;padding:0px" >

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Daily Summary</small>
      </h1>
 
    </section> 

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">


      <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-orange">
            <div class="inner">
              <h3>87</h3>
              <p>Total Respondents Today</p>
            </div>

            <div class="icon">
              <i class="fa fa-group"></i>
            </div>
                <a href="http://104.236.11.199/questionnaire/main/backend/web/index.php?r=responses/index" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
          </div>
      </div>
      <!-- ./col -->


      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3>240</h3>
            <p>Contacts Notified Respondents</p>
          </div>

          <div class="icon">
            <i class="fa fa-bell"></i>
          </div>
              <a href="http://104.236.11.199/questionnaire/main/backend/web/index.php?r=contacts/index" class="small-box-footer">
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
            <small><sup style="font-size: 20px"></sup></small>
              General Public
            </h3>

            <p >Current Contact Group</p>
        </div>
        <div class="icon">
          <i class="fa fa-group"></i>
        </div>
        <a href="http://104.236.11.199/questionnaire/main/backend/web/index.phpr=groups/index" class="small-box-footer">
                  More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3>6</h3>
            <p>Survey Sessions Today</p>
          </div>

          <div class="icon">
            <i class="fa fa-file"></i>
          </div>
                  More info <i class="fa fa-arrow-circle-right"></i>
              </a>
        </div>
      </div>
      <!-- ./col -->

        <div class="col-md-7" style="margin-top:40px;">
                  <!-- BAR CHART -->
                <div class="box-header with-border">
                    <h3 class="box-title">Number of respondents in the past 7 days</h3>
                </div>

              


                <!-- AREA CHART -->
                <div class="box box-default">
                  <div class="box-body">
                    <div class="chart">
                      <canvas id="areaChart" style="height:600px"></canvas>
                    </div>
                  </div>
                </div>

        </div>

      
        <div class="col-md-5" style="margin-top:80px;">

                  <div id="content  box box-body">
                      <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                          <li class="active"><a href="#red" data-toggle="tab">Question With Highest Respondents</a></li>
                          <li><a href="#orange" data-toggle="tab">Activities Summary</a></li>
                      </ul>
                      <div id="my-tab-content" class="tab-content">
                          <div class="tab-pane active" id="red">
                              <h3 style="margin-top:20px">WHICH OF THESE DID YOU DO?</h3>

                              <div>
                                  <span class="w3-badge w3-jumbo w3-red w3-padding">66</span>
                                  <p style="margin-top:20px;margin-left:10px">Respondents </p>
                              </div>

                              <div class="small-box bg-red">
                            
                               
                                
                              </div>
                              <table class="table table-bordered table-dark">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">OPTION</th>
                                    <th scope="col">PERCENTAGE</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <th scope="row">1</th>
                                    <td><strong>Visited an online site</strong></td>
                                    <td>76%</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">2</th>
                                    <td>Watched TV</td>
                                    <td>14%</td>
                                  </tr>
                                  <tr>
                                  <tr>
                                    <th scope="row">3</th>
                                    <td>Read a newspaper</td>
                                    <td>6%</td>
                                  </tr>
                                  <tr>
                                  <th scope="row">4</th>
                                    <td>Listened to radio</td>
                                    <td>4%</td>
                                </tbody>
                              </table>
                              

                          </div>

                          <div class="tab-pane" id="orange">

                              <h4  style="margin-top:60px; position:center">Top responses for closed question.</h4>
                              <table class="table table-bordered table-dark" style="margin-top:40px">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">QUESTION</th>
                                    <th scope="col">OPTION</th>
                                    <th scope="col">PERCENTAGE</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <th scope="row">1</th>
                                    <td>Which of these did you do?</td>
                                    <td>Visited an online site</td>
                                    <td>76%</td>
                                  </tr>
                                  <tr>
                                    <th scope="row">2</th>
                                    <td>Which radio station did you listen to?</td>
                                    <td>Citizen Radio</td>
                                    <td>51%</td>
                                  </tr>
                                  <tr>
                                  <tr>
                                    <th scope="row">3</th>
                                    <td>Which TV station did you watch?</td>
                                    <td>Citizen TV</td>
                                    <td>56%</td>
                                  </tr>
                                  <tr>
                                  <th scope="row">4</th>
                                  <td>Which Newspaper did you read?</td>
                                  <td>Daily Nation</td>
                                  <td>53%</td>
                                  </tr>
                                  <tr>
                                  <th scope="row">4</th>
                                  <td>what is you favourite site?</td>
                                  <td>Twitter</td>
                                  <td>54%</td>
                                  </tr>

                                </tbody>
                              </table>
                          </div>
              

                       
                      </div>
          <script type="text/javascript">
              jQuery(document).ready(function ($) {
                  $('#tabs').tab();
              });
              $('button').addClass('btn-primary').text('Switch to Orange Tab');
              $('button').click(function(){
                $('#tabs a[href=#orange]').tab('show');
              });
          </script>    
          <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
          <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        </div>
        <!-- /.col -->

  



      



    

      
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
      labels: ["Day 1", "Day 2", "Day 3", "Day 4", "Day 5", "Day 6", "Day 7"],
      datasets: [

        {
          label: "Digital Goods",
          fillColor: "rgba(66, 255, 79, 0.98)",
          strokeColor: "rgba(60,141,188,0.3)",
          pointColor: "#3b8bba",
          pointStrokeColor: "rgba(66, 255, 79, 0.98)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(60,141,188,1)",
          data: [28, 48, 40, 40, 45, 56, 87]
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
   
  });
</script>



  




