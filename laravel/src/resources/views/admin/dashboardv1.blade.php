@extends('layout.app')
    @section('content')
    <div class="max-w-sm mx-auto grid gap-6 lg:grid-cols-3 items-start lg:max-w-none mt-20">
        <div class="flex flex-col h-80 p-6 rounded-2xl bg-white border border-slate-200  shadow shadow-slate-950/5 justify-between"
        id="memory" style="width:100%; max-width:600px; height:350px;">
        </div>
        <div class="flex flex-col h-80 p-6 rounded-2xl bg-white border border-slate-200  shadow shadow-slate-950/5 justify-between"
        id="cpu" style="width:100%; max-width:600px; height:350px;">
        </div>
        <div class="flex flex-col h-80 p-6 rounded-2xl bg-white border border-slate-200  shadow shadow-slate-950/5 justify-between"
        id="hdd" style="width:100%; max-width:600px; height:350px;">
        </div>
        <script src="https://www.gstatic.com/charts/loader.js"></script>
        <script>
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        google.charts.setOnLoadCallback(cpuChart);
        google.charts.setOnLoadCallback(hddChart);


        function drawChart() {

        // Set Data
        const data = google.visualization.arrayToDataTable([
        ['MEMORY', 'Usage'],
        <?php if(!$data['error']) { 
            $load = $data['system'][0]['total-memory'] - $data['system'][0]['free-memory'];
        ?>
        ['Load',{{ $load }}],
        ['Free',{{ $data['system'][0]['free-memory'] }}],
        <?php } ?>
        ]);

        // Set Options
        const options = {
        title:'Memory Usage'
        };

        // Draw
        const chart = new google.visualization.PieChart(document.getElementById('memory'));
        chart.draw(data, options);

        }

        function cpuChart() {
            // Set Data
            const data = google.visualization.arrayToDataTable([
            ['CPU', 'Usage'],
            <?php if(!$data['error']) { 
                $load = 100 - $data['system'][0]['cpu-load'];
            ?>
            ['Free',{{ $load }}],
            ['Load',{{ $data['system'][0]['cpu-load'] }}],
            <?php } ?>
            ]);

            // Set Options
            const options = {
            title:'CPU Usage'
            };

            // Draw
            const chart = new google.visualization.PieChart(document.getElementById('cpu'));
            chart.draw(data, options);
        }
        </script>
    </div>    
    @endsection
