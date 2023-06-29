<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<?php

$this->load->view("admin/common/header.php");
$this->load->view("admin/common/sidebar.php"); 
//$this->load->library('javascript/jquery');
?>

<style>


</style>
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/util.css">
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->base_url(); ?>signin/css/main.css">
<!-- Page wrapper  -->

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  

<!-- Page wrapper  -->
<div class="page-wrapper">


    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-primary">Dashboard</h3> </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-body">
				
				
				
             
			 <div class="row">
				         <!-- /# column -->
                    <div class="col-lg-6">
                        <div class="card">
                          
                            <div class="sales-chart">
                               <div id="activeUser"></div>
                            </div>
                        </div>
                        <!-- /# card -->
                    </div>
                    <!-- /# column -->
                
				
				         <!-- /# column -->
                    <div class="col-lg-6">
                        <div class="card">
                          
                            <div class="sales-chart">
                              <div id="activeSubs" ></div>
                            </div>
                        </div>
                        <!-- /# card -->
                    </div>
                    <!-- /# column -->
                
				
                </div>
				
				<div class="row">
				         <!-- /# column -->
                    <div class="col-lg-6">
                        <div class="card">
                          
                            <div class="sales-chart">
                               <div id="activeDomains"></div>
                            </div>
                        </div>
                        <!-- /# card -->
                    </div>
                    <!-- /# column -->
                
				
				         <!-- /# column -->
                    <div class="col-lg-6">
                        <div class="card">
                          
                            <div class="sales-chart">
                              <div id="activeTicktes" ></div>
                            </div>
                        </div>
                        <!-- /# card -->
                    </div>
                    <!-- /# column -->
                
				
                </div>
				
				<div class="row">
				  
				
				         <!-- /# column -->
                    <div class="col-lg-12">
                        <div class="card">
                          
                            <div class="sales-chart">
                              <div id="totalRevenue"  style="width: 800px; height: 500px;"></div>
                            </div>
                        </div>
                        <!-- /# card -->
                    </div>
                    <!-- /# column -->
                
				
                </div>
				
				</div>
            </div>
        </div>
    </div>
</div>


<?php


$rating_data = array(
 array('Active', 'Users'),
 array('Active Users',25),
	);

$encoded_users = json_encode($activeUser);
$encoded_subs = json_encode($activeSubs);
$encoded_Domains = json_encode($activeDomains);
$encoded_Revenue = json_encode($activeRevenue);

$encoded_Tickets = json_encode($activeTickets);

?>

    <script type="text/javascript">
	// Users
		 google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(USerChart);
      function USerChart() {
        var data = google.visualization.arrayToDataTable(
          <?php  echo $encoded_users; ?>
        );

      var options1 = {
        legend: 'none',
        pieSliceText: 'label',
        title: 'Users',
        pieStartAngle: 100,
      };

        var chart = new google.visualization.PieChart(document.getElementById('activeUser'));
        chart.draw(data, options1);
      }
	
	// Subscriptions
	 google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable(
          <?php  echo $encoded_subs; ?>
        );

      var options2 = {
        legend: 'none',
        pieSliceText: 'label',
        title: 'Subscriptions',
        pieStartAngle: 100,
      };

        var chart = new google.visualization.PieChart(document.getElementById('activeSubs'));
        chart.draw(data, options2);
      }
	  
	// Domains  
	   google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawDomain);
      function drawDomain() {
        var data = google.visualization.arrayToDataTable(
          <?php  echo $encoded_Domains; ?>
        );

      var options2 = {
        legend: 'none',
        pieSliceText: 'label',
        title: 'Domains',
        pieStartAngle: 100,
      };

        var chart = new google.visualization.PieChart(document.getElementById('activeDomains'));
        chart.draw(data, options2);
      }
	  
	  
	  	// Tickets
	   google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawTickets);
      function drawTickets() {
        var data = google.visualization.arrayToDataTable(
          <?php  echo $encoded_Tickets; ?>
        );

      var options2 = {
        legend: 'none',
        pieSliceText: 'label',
        title: 'Tickets',
        pieStartAngle: 100,
      };

        var chart = new google.visualization.PieChart(document.getElementById('activeTicktes'));
        chart.draw(data, options2);
      }
	  
		// revenue    
	   google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawRevenue);

      function drawRevenue() {
        var data = google.visualization.arrayToDataTable(
		// [
          // ['Year', 'Sales', 'Expenses', 'Profit'],
          // ['2014', 1000, 400, 200],
          // ['2015', 1170, 460, 250],
          // ['2016', 660, 1120, 300],
          // ['2017', 1030, 540, 350]
        // ]
		<?php 	 	 echo $encoded_Revenue ; ?>
		);

        var options = {
          chart: {
            title: 'Company Performance',
            subtitle: 'Sales: 2018-2019',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('totalRevenue'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
    
    <script>
    
    
    
    </script>
    
    
    
    
    

<?php $this->load->view("admin/common/footer.php"); ?>