<!DOCTYPE html>
<html lang="en">
	<head>
        <?php
        include 'head.php';
        include 'db.php';
        $id = $_SESSION['customerID'];

        //member details
        $member = mysqli_query($con,"select * from  customer where customerID = '$id'");
        $member_details = mysqli_fetch_array($member);
        ?>

	</head>

	<body class="no-skin">
    <?php include 'nav-bar.php'?>

		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

            <?php include 'sidenav.php'?>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>
							<li class="active">Dashboard</li>
						</ul><!-- /.breadcrumb -->

						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->
					</div>

					<div class="page-content">
                        <?php include 'settings.php';?>

                        <div class="panel panel-info w3-card-4">
                            <div class="panel-heading">Client Details</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <?php
                                        if($member_details['photo']!=''){
                                            ?>
                                            <img class="img-responsive img-thumbnail" width="100" height="100" src="photos/<?php echo $member_details['photo']; ?>" alt="">
                                            <figcaption>Profile Photo</figcaption>
                                            <?php
                                        }
                                        else{
                                            ?>
                                            <img class="img-responsive img-thumbnail" width="100" height="100" src="photos/default.jfif" alt="">
                                            <figcaption>No Profile Photo</figcaption>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="col-sm-2">
                                        <h5 class="dash-heads">Client Name</h5>
                                        <?php echo $member_details['full_names'];?>

                                        <h5 class="dash-heads">Member Since</h5>
                                        <?php echo $member_details['join_date'];?>
                                    </div>
                                    <div class="col-sm-2">
                                        <h5 class="dash-heads">Client ID</h5>
                                        <?php echo $member_details['customerID'];?>

                                        <h5 class="dash-heads">Account Number</h5>
                                        <?php
                                        $acct = mysqli_query($con,"select * from accounts where customerID = '$id'");
                                        $acct_details = mysqli_fetch_array($acct);
                                        echo $acct_details['accountNumber'];?>
                                    </div>
                                    <div class="col-sm-6 w3-card-4">
                                        <div class="panel panel-info">
                                            <div class="panel-heading fa fa-users fa-2x ">Guarantee Details</div>
                                            <div class="panel-body">


                                                <?php
                                                include 'db.php';
                                                $id = $_SESSION['customerID'];
                                                $query = mysqli_query($con,"select * from loan where (guarantor1 ='$id' and balance != '0') or (guarantor2='$id' and balance !='0')");
                                                $guarant_details = mysqli_fetch_array($query);
                                                $loan_ownerID = $guarant_details['customerid'];

                                                $loan_sql = mysqli_query($con,"select * from customer where customerID ='$loan_ownerID'");
                                                $loan_sql_details = mysqli_fetch_array($loan_sql);
                                                $loan_owner = $loan_sql_details['full_names'];

                                                if(mysqli_num_rows($query)>0){
                                                    ?>
                                                    <p>You are an active Guaranter to <b style="color: blue"><?php echo $loan_owner?></b></p>
                                                    <p>The Loan Balance is <b style="color: blue"><?php echo "Shs. ".number_format($guarant_details['balance']);?></b></p>
                                                    <?php
                                                }else{
                                                    echo "
                                                    <p>You dont have any Guarantee</p>
                                                    ";
                                                }
                                                ?>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-info w3-card-4">
                            <div class="panel-heading">Account Overview</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="panel panel-success ">
                                            <div class="panel-heading w3-blue">
                                                <span class="fa fa-money fa-2x left"> Loan Balance</span>
                                            </div>
                                            <div class="panel-body dash-content" >
                                                <?php
                                                $loan = mysqli_query($con,"select * from loan where customerid ='$id'");
                                                $loan_details = mysqli_fetch_array($loan);
                                                if($loan_details['balance']==0 and $loan_details['loan_status']=="pending"){
                                                    echo  "Shs ".number_format($loan_details['amount']);
                                                }
                                                if($loan_details['balance']!=0 and $loan_details['loan_status']=="pending"){
                                                    echo  "Shs ".number_format($loan_details['balance']);
                                                }else{
                                                    echo "No loan";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="panel panel-success">
                                            <div class="panel-heading w3-blue" >
                                                <span class="fa fa-money fa-2x left"> Balance</span>
                                            </div>
                                            <div class="panel-body dash-content">
                                                <?php
                                                $balance = mysqli_query($con,"select * from accounts where customerid ='$id'");
                                                $balance_details = mysqli_fetch_array($balance);
                                                $balance = $balance_details['accountBalance'];
                                                echo  "Shs ".number_format($balance_details['accountBalance']);
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="panel panel-success">
                                            <div class="panel-heading w3-blue">
                                                <span class="fa fa-money fa-2x left">Shares Capital</span>
                                            </div>
                                            <div class="panel-body dash-content">
                                                <?php
                                                $share = mysqli_query($con,"select sum(accountBalance) as balance from accounts");
                                                $total_money_details= mysqli_fetch_array($share);
                                                $total_money = $total_money_details['balance'];
                                                $my_share  = $balance_details['accountBalance'];


                                                $share_interest = ($my_share/$total_money)*100;

                                                echo round($share_interest, 3)  ." %";
                                                ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-info w3-card-4">
                            <div class="panel-heading">Recent Transactions</div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                                <thead>
                                                <tr style="color: #1B6AAA">
                                                    <th>Date</th>
                                                    <th>Type</th>
                                                    <th>Amount</th>
                                                    <th>Balance</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                include 'db.php';

                                                //Selectig the transaction details
                                                $query = mysqli_query($con,"select * from transactions where customerID='$id' and status ='approved' ORDER BY transactionDate ASC ");
                                                while ($transaction_details = mysqli_fetch_array($query)){
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $transaction_details['transactionDate'];?></td>
                                                        <td><?php echo $transaction_details['transaction_type'];?></td>
                                                        <td><?php echo number_format($transaction_details['transactionAmount']);?></td>
                                                        <td><?php echo number_format($transaction_details['balance']);?></td>
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
                        </div>


					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

			<?php include 'footer.php';?>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="assets/js/jquery-2.1.4.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="assets/js/jquery-ui.custom.min.js"></script>
		<script src="assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="assets/js/jquery.easypiechart.min.js"></script>
		<script src="assets/js/jquery.sparkline.index.min.js"></script>
		<script src="assets/js/jquery.flot.min.js"></script>
		<script src="assets/js/jquery.flot.pie.min.js"></script>
		<script src="assets/js/jquery.flot.resize.min.js"></script>

		<!-- ace scripts -->
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				$('.easy-pie-chart.percentage').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
					var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
					var size = parseInt($(this).data('size')) || 50;
					$(this).easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: parseInt(size/10),
						animate: ace.vars['old_ie'] ? false : 1000,
						size: size
					});
				})
			
				$('.sparkline').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
					$(this).sparkline('html',
									 {
										tagValuesAttribute:'data-values',
										type: 'bar',
										barColor: barColor ,
										chartRangeMin:$(this).data('min') || 0
									 });
				});
			
			
			  //flot chart resize plugin, somehow manipulates default browser resize event to optimize it!
			  //but sometimes it brings up errors with normal resize event handlers
			  $.resize.throttleWindow = false;
			
			  var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'150px'});
			  var data = [
				{ label: "social networks",  data: 38.7, color: "#68BC31"},
				{ label: "search engines",  data: 24.5, color: "#2091CF"},
				{ label: "ad campaigns",  data: 8.2, color: "#AF4E96"},
				{ label: "direct traffic",  data: 18.6, color: "#DA5430"},
				{ label: "other",  data: 10, color: "#FEE074"}
			  ]
			  function drawPieChart(placeholder, data, position) {
			 	  $.plot(placeholder, data, {
					series: {
						pie: {
							show: true,
							tilt:0.8,
							highlight: {
								opacity: 0.25
							},
							stroke: {
								color: '#fff',
								width: 2
							},
							startAngle: 2
						}
					},
					legend: {
						show: true,
						position: position || "ne", 
						labelBoxBorderColor: null,
						margin:[-30,15]
					}
					,
					grid: {
						hoverable: true,
						clickable: true
					}
				 })
			 }
			 drawPieChart(placeholder, data);
			
			 /**
			 we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
			 so that's not needed actually.
			 */
			 placeholder.data('chart', data);
			 placeholder.data('draw', drawPieChart);
			
			
			  //pie chart tooltip example
			  var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
			  var previousPoint = null;
			
			  placeholder.on('plothover', function (event, pos, item) {
				if(item) {
					if (previousPoint != item.seriesIndex) {
						previousPoint = item.seriesIndex;
						var tip = item.series['label'] + " : " + item.series['percent']+'%';
						$tooltip.show().children(0).text(tip);
					}
					$tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
				} else {
					$tooltip.hide();
					previousPoint = null;
				}
				
			 });
			
				/////////////////////////////////////
				$(document).one('ajaxloadstart.page', function(e) {
					$tooltip.remove();
				});
			
			
			
			
				var d1 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d1.push([i, Math.sin(i)]);
				}
			
				var d2 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d2.push([i, Math.cos(i)]);
				}
			
				var d3 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.2) {
					d3.push([i, Math.tan(i)]);
				}
				
			
				var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});
				$.plot("#sales-charts", [
					{ label: "Domains", data: d1 },
					{ label: "Hosting", data: d2 },
					{ label: "Services", data: d3 }
				], {
					hoverable: true,
					shadowSize: 0,
					series: {
						lines: { show: true },
						points: { show: true }
					},
					xaxis: {
						tickLength: 0
					},
					yaxis: {
						ticks: 10,
						min: -2,
						max: 2,
						tickDecimals: 3
					},
					grid: {
						backgroundColor: { colors: [ "#fff", "#fff" ] },
						borderWidth: 1,
						borderColor:'#555'
					}
				});
			
			
				$('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('.tab-content')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			
			
				$('.dialogs,.comments').ace_scroll({
					size: 300
			    });
				
				
				//Android's default browser somehow is confused when tapping on label which will lead to dragging the task
				//so disable dragging when clicking on label
				var agent = navigator.userAgent.toLowerCase();
				if(ace.vars['touch'] && ace.vars['android']) {
				  $('#tasks').on('touchstart', function(e){
					var li = $(e.target).closest('#tasks li');
					if(li.length == 0)return;
					var label = li.find('label.inline').get(0);
					if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
				  });
				}
			
				$('#tasks').sortable({
					opacity:0.8,
					revert:true,
					forceHelperSize:true,
					placeholder: 'draggable-placeholder',
					forcePlaceholderSize:true,
					tolerance:'pointer',
					stop: function( event, ui ) {
						//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
						$(ui.item).css('z-index', 'auto');
					}
					}
				);
				$('#tasks').disableSelection();
				$('#tasks input:checkbox').removeAttr('checked').on('click', function(){
					if(this.checked) $(this).closest('li').addClass('selected');
					else $(this).closest('li').removeClass('selected');
				});
			
			
				//show the dropdowns on top or bottom depending on window height and menu position
				$('#task-tab .dropdown-hover').on('mouseenter', function(e) {
					var offset = $(this).offset();
			
					var $w = $(window)
					if (offset.top > $w.scrollTop() + $w.innerHeight() - 100) 
						$(this).addClass('dropup');
					else $(this).removeClass('dropup');
				});
			
			})
		</script>
	</body>
</html>
