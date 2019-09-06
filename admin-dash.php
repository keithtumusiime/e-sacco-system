<!DOCTYPE html>
<html lang="en">
<head>
<title>Administrator Dashboard</title>
    <?php
    include 'head1.php';
    include 'db.php';
    $id = $_SESSION['customerID'];

    //member details
    $member = mysqli_query($con,"select * from  customer where customerID = '$id'");
    $member_details = mysqli_fetch_array($member);
    ?>

</head>



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Dashboard<small>Admin</small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

            <?php include 'sidenav1.php'?>

                <div class="main-content">
                    <div class="page-content">
                        <div class="panel panel-info w3-card-4">
                            <div class="panel-heading">Client Details</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="panel panel-success ">
                                                <div class="panel-heading w3-blue">
                                                    <span class="fa fa-users fa-3x left"> </span>

                                                   <span class="w3-right">
                                                        <?php
                                                        $member_sql = mysqli_query($con,"select count(customerID) as members from customer where status ='approved'");
                                                        $member = mysqli_fetch_array($member_sql);

                                                        ?>
                                                       <b><?php echo $member['members']?>
                                                           <br>
                                                           <small>All Members</small>
                                                       </b>

                                                   </span>
                                                </div>
                                                <div class="panel-body dash-content" >
                                                    <a href="">View Members <span class="w3-right fa fa-arrow-circle-o-right"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="panel panel-success ">
                                                <div class="panel-heading w3-orange w3-text-white">
                                                    <span class="fa fa-chevron-circle-up fa-3x left"> </span>

                                                    <span class="w3-right">
                                                        <?php
                                                        $loan_sql = mysqli_query($con,"select count(customerid) as loan from loan where balance !=0 and adminAction = 'Accepted'");
                                                        $loan = mysqli_fetch_array($loan_sql);

                                                        ?>
                                                        <b><?php echo $loan['loan']?>
                                                            <br>
                                                           <small>Active Loans</small>
                                                       </b>

                                                   </span>
                                                </div>
                                                <div class="panel-body dash-content" >
                                                    <a href="">View Active Loans <span class="w3-right fa fa-arrow-circle-o-right"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="panel panel-success ">
                                                <div class="panel-heading w3-red w3-text-white">
                                                    <span class="fa fa-credit-card-alt fa-3x left"> </span>

                                                    <span class="w3-right">
                                                        <?php
                                                        $pend_sql = mysqli_query($con,"select count(customerid) as pending_loan from loan WHERE  adminAction = 'pending'");
                                                        $pending_loan = mysqli_fetch_array($pend_sql);

                                                        ?>
                                                        <b><?php echo $pending_loan['pending_loan']?>
                                                            <br>
                                                           <small>Pending Loans</small>
                                                       </b>

                                                   </span>
                                                </div>
                                                <div class="panel-body dash-content" >
                                                    <a href="">View Pending Loans <span class="w3-right fa fa-arrow-circle-o-right"></span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="panel panel-success ">
                                                <div class="panel-heading w3-green w3-text-white">
                                                    <span class="fa fa-google-wallet fa-3x left"> </span>

                                                    <span class="w3-right">
                                                        <?php
                                                        $total_sql = mysqli_query($con,"select sum(accountBalance) as total_money from accounts");
                                                        $total_balance = mysqli_fetch_array($total_sql);
                                                        $bal = mysqli_fetch_array(mysqli_query($con, "select sum(balance) as new_balance from loan"));
                                                        $loan_bal = $bal['new_balance'];
                                                        $sacco = $total_balance['total_money'];
                                                        $new_bal = $sacco - $loan_bal;

                                                        ?>
                                                        <b><?php echo "Shs. ".number_format($new_bal).".00";?>
                                                            <br>
                                                           <small>Total Funds</small>
                                                       </b>

                                                   </span>
                                                </div>
                                                <div class="panel-body dash-content" >
                                                    <a href="">Total Funds <span class="w3-right fa fa-arrow-circle-o-right"></span></a>
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
                                    <div class="col-md-6">
                                        <script>
                                            window.onload = function () {

                                                var options = {
                                                    animationEnabled: true,
                                                    title: {
                                                        text: "Interest rates movements"
                                                    },
                                                    axisY: {
                                                        title: "total amount Given (Shs)",
                                                        suffix: "%",
                                                        includeZero: false
                                                    },
                                                    axisX: {
                                                        title: "Months"
                                                    },
                                                    data: [{
                                                        type: "column",
                                                        yValueFormatString: "#,##0.0#"%"",
                                                        dataPoints: [
                                                            { label: "Jan", y: 10.09 },
                                                            { label: "Jan", y: 10.09 },
                                                            { label: "Feb", y: 9.40 },
                                                            { label: "Mar", y: 8.50 },
                                                            { label: "Apr", y: 7.96 },
                                                            { label: "May", y: 7.80 },
                                                            { label: "Jun", y: 7.56 },
                                                            { label: "Jul", y: 7.20 },
                                                            { label: "Aug", y: 7.20 },
                                                            { label: "Sep", y: 7.20 },
                                                            { label: "Oct", y: 7.20 },
                                                            { label: "Nov", y: 7.20 },
                                                            { label: "Dec", y: 7.1 }

                                                        ]
                                                    }]
                                                };
                                                $("#salesChart").CanvasJSChart(options);

                                            }
                                        </script>
                                        <div class="chart">
                                            <!-- Sales Chart Canvas -->
                                            <canvas id="salesChart" style="height: 200px;"></canvas>
                                          </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="panel panel-success">
                                            <div class="panel-heading">Active Loans</div>
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                                            <thead>
                                                            <tr>
                                                                <th>Member Name</th>
                                                                <th>Applied Amount</th>
                                                                <th>Balance Due</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                            include 'db.php';

                                                            //Selectig the transaction details
                                                            $query = mysqli_query($con,"select * from loan where balance != 0 and adminAction = 'Accepted'");
                                                            while ($query_details = mysqli_fetch_array($query)){
                                                                $id = $query_details['customerid'];
                                                                $names = mysqli_query($con,"select * from customer where customerID = '$id'");
                                                                $customer_details = mysqli_fetch_array($names);

                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $customer_details['full_names'];?></td>
                                                                    <td><?php echo $query_details['amount'];?></td>
                                                                    <td><?php echo $query_details['balance'];?></td>
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
                            </div>
                        </div>



                        <div class="panel panel-info w3-card-4">
                            <div class="panel-heading">Recent Transactions</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="panel panel-success ">
                                                <div class="panel-heading w3-orange w3-text-white">
                                                    <span class="fa fa-chevron-circle-up fa-3x left"> </span>

                                                    <span class="w3-right">
                                                        <?php
                                                        $loan_sql = mysqli_query($con,"select count(customerid) as loan from loan where balance !=0 and adminAction = 'Accepted'");
                                                        $loan = mysqli_fetch_array($loan_sql);

                                                        ?>
                                                        <b><?php echo $loan['loan']?>
                                                            <br>
                                                           <small>Active Loans</small>
                                                       </b>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="panel panel-success ">
                                                <div class="panel-heading w3-red w3-text-white">
                                                    <span class="fa fa-credit-card-alt fa-3x left"> </span>

                                                    <span class="w3-right">
                                                        <?php
                                                        $pend_tra = mysqli_query($con,"select count(customerID) as pending_transaction from transactions WHERE  status = 'pending'");
                                                        $pending_tra = mysqli_fetch_array($pend_tra);
                                                        ?>
                                                        <b><?php echo $pending_tra['pending_transaction']?>
                                                            <br>
                                                           <small>Pending Transactions</small>
                                                       </b>
                                                   </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="panel panel-success ">
                                                <div class="panel-heading w3-green w3-text-white">
                                                    <span class="fa fa-google-wallet fa-3x left"> </span>

                                                    <span class="w3-right">
                                                        <?php
                                                        $interest_sql = mysqli_query($con,"select sum(interest) as interest from loan");
                                                        $interest= mysqli_fetch_array($interest_sql);
                                                        $total_interest = $interest['interest'];

                                                        ?>
                                                        <b><?php echo "Shs. ".number_format($total_interest).".00";?>
                                                            <br>
                                                           <small>Total Interests on loans</small>
                                                       </b>
                                                   </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div><!-- /.page-content -->
                    </div>
                </div><!-- /.main-content -->
                <?php include 'footer.php';?>
                
    </section>
  
</div>




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
