<?php
echo $this->Html->script('qr-code-styling-1-5-0.min.js');
echo $this->Html->css('animate.min');
echo $this->Html->css('jquery.CalendarHeatmap');
echo $this->Html->script('moment.min.js');
echo $this->Html->script('jquery.CalendarHeatmap.min.js');
echo $this->Html->script('https://cdn.jsdelivr.net/npm/apexcharts');
echo $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js');
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-9">
            <div class="card bg-body-tertiary border-0 shadow mb-4">
                <div class="card-body">
                    <div class="card-title mb-0">Posting Activities</div>
                    <div class="tricolor_line mb-4"></div>
                    <div id="heatmap-1"></div>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>

</div>



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