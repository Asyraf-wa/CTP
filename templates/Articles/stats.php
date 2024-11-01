<?php
echo $this->Html->script('qr-code-styling-1-5-0.min.js');
echo $this->Html->css('animate.min');
echo $this->Html->css('jquery.CalendarHeatmap');
echo $this->Html->script('moment.min.js');
echo $this->Html->script('jquery.CalendarHeatmap.min.js');
echo $this->Html->script('https://cdn.jsdelivr.net/npm/apexcharts');
echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js');
?>

<style>
    .min_height {
        min-height: 280px;
    }
</style>

<div class="container mt-4"><!--container-->
    <div class="row">
        <div class="col-md-9"><!--Posting Heatmap-->
            <div class="card bg-body-tertiary border-0 shadow mb-4 min_height">
                <div class="card-body">
                    <div class="card-title mb-0">Posting Activities</div>
                    <div class="tricolor_line mb-4"></div>
                    <div id="heatmap-1"></div>
                </div>
            </div>
        </div><!--/Posting Heatmap-->
        <div class="col-md-3">
            <div class="card bg-body-tertiary border-0 shadow mb-4 min_height">
                <div class="card-body text-center">
                    <div class='mt-4 mb-3'>
                        <h1 class="gradient-animate"><b class="logo">&lt;/&gt;</b></h1>
                        Code The Pixel has been online since<br />June 11, 2017<br />
                    </div>
                    <?php
                    // start date and time
                    $startDate = new DateTime('2017-06-11 10:00:00');
                    // Get the timestamp of the start date
                    $startTimestamp = $startDate->getTimestamp();
                    ?>

                    <style>
                        .years {
                            font-weight: bold;
                        }
                    </style>
                    <div id="live-counting"></div>
                    <script>
                        // Get the start timestamp from PHP
                        var startTimestamp = <?php echo $startTimestamp; ?> * 1000;

                        function updateTime() {
                            var currentTime = new Date().getTime();
                            var difference = currentTime - startTimestamp;

                            var years = Math.floor(difference / (1000 * 60 * 60 * 24 * 365));
                            var days = Math.floor((difference % (1000 * 60 * 60 * 24 * 365)) / (1000 * 60 * 60 * 24));
                            var hours = Math.floor((difference % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            var minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
                            var seconds = Math.floor((difference % (1000 * 60)) / 1000);

                            document.getElementById("live-counting").innerHTML =
                                "<span class='years'>" + years + " years </span><br/>" +
                                "<span class='days'>" + days + " days </span><br/>" +
                                "<span>" + hours + " hours </span>" +
                                "<span>" + minutes + " minutes </span>" +
                                "<span>" + seconds + " seconds </span>";
                        }

                        // Update the time every second
                        setInterval(updateTime, 1000);
                    </script>
                </div>
            </div>
        </div>
    </div>



    <!--TreeMap-->
    <div class="card-title mb-0">Top 20 Posting</div>
    <div class="tricolor_line mb-4"></div>
    <div id="chart"></div>
    <script>
        var options = {
            chart: {
                height: 350,
                type: "treemap",
                toolbar: {
                    show: false
                }
            },
            series: [{
                data: <?php echo $data; ?>
            }],
            tooltip: {
                enabled: true,
                shared: true,
                theme: "dark",
                onDatasetHover: {
                    highlightDataSeries: true,
                }
            },
            plotOptions: {
                treemap: {
                    distributed: true
                }
            },
            dataLabels: {
                enabled: true,
                style: {
                    fontSize: '35px',
                    fontWeight: 'bold',
                }
            },
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);

        chart.render();
    </script>
    <!--/TreeMap-->


    <!--BarChart-->
    <div class="card bg-body-tertiary border-0 shadow mb-4">
        <div class="card-body">
            <div class="card-title mb-0">Most Read Posting</div>
            <div class="tricolor_line mb-4"></div>
            <canvas id="myChart"></canvas>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',

            data: {
                //labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Hits',
                    data: <?php echo $barData; ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(89, 233, 28, 0.2)', 'rgba(255, 5, 5, 0.2)', 'rgba(255, 128, 0, 0.2)', 'rgba(153, 153, 153, 0.2)', 'rgba(15, 207, 210, 0.2)', 'rgba(44, 13, 181, 0.2)', 'rgba(86, 172, 12, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(89, 233, 28, 1)', 'rgba(255, 5, 5, 1)', 'rgba(255, 128, 0, 1)', 'rgba(153, 153, 153, 1)', 'rgba(15, 207, 210, 1)', 'rgba(44, 13, 181, 1)', 'rgba(86, 172, 12, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    title: {
                        display: false,
                        text: 'Articles',
                        font: {
                            size: 15
                        }
                    },
                    legend: {
                        display: false,
                        labels: {
                            color: 'rgb(255, 99, 132)'
                        }
                    },
                }
            }
        });
    </script>
    <!--/BarChart-->

</div><!--/container-->






<script>
    var data = <?php echo json_encode($formattedResults); ?>;
    $("#heatmap-1").CalendarHeatmap(data, {
        title: null,
        months: 12,
        //weekStartDay: 1,
        //lastMonth: 1,
        //lastMonth: "current month",
        //lastYear: "current year",
        labels: {
            days: true,
            months: true,
            custom: {
                weekDayLabels: null,
                monthLabels: null
            }
        },
        tiles: {
            shape: "square"
        },
        legend: {
            show: true,
            align: "right",
            minLabel: "Less",
            maxLabel: "More",
            divider: " to "
        },
        tooltips: {
            show: false,
            options: {}
        }
    });
</script>