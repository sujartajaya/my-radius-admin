@extends('layout.app')
    @section('content')
<div id="datachart" class="max-w-sm mx-auto grid gap-6 lg:grid-cols-3 items-start lg:max-w-none mt-10">
  <div class="flex flex-col h-80 p-6 rounded-2xl bg-white border border-slate-200  shadow shadow-slate-950/5 justify-between">
    <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
  </div>
  <div class="flex flex-col h-80 p-6 rounded-2xl bg-white border border-slate-200  shadow shadow-slate-950/5 justify-between">
    <canvas id="myChart1" style="width:100%;max-width:600px"></canvas>
  </div>
  <div class="flex flex-col h-80 p-6 rounded-2xl bg-white border border-slate-200  shadow shadow-slate-950/5 justify-between">
    <canvas id="myChart2" style="width:100%;max-width:600px"></canvas>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script>
<?php if(!$data['error']) { 
            $load = $data['system'][0]['total-memory'] - $data['system'][0]['free-memory'];
            $cpuload = $data['system'][0]['cpu-load'];
            $cpufree = 100 - $cpuload;
            $hddtotal = $data['system'][0]['total-hdd-space'];
            $hddload = $hddtotal - $data['system'][0]['free-hdd-space'];
        ?>
const yValues = [{{$load}}, {{$data['system'][0]['free-memory']}}];
const xValues = ["Usage", "Free"];

const barColors = [
  "#b91d47",
  "#00aba9"
];

const xCpuLoad = ["Load","Free"];
const yCpuLoad = [{{$cpuload}},{{$cpufree}}];
const xHddLoad = ['Usage',"Free"];
const yHddLoad = [{{$hddload}},{{$data['system'][0]['free-hdd-space']}}];
new Chart("myChart", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Memory Usage"
    }
  }
});
new Chart("myChart1", {
  type: "pie",
  data: {
    labels: xCpuLoad,
    datasets: [{
      backgroundColor: barColors,
      data: yCpuLoad
    }]
  },
  options: {
    title: {
      display: true,
      text: "CPU Usage"
    }
  }
});
new Chart("myChart2", {
  type: "pie",
  data: {
    labels: xHddLoad,
    datasets: [{
      backgroundColor: barColors,
      data: yHddLoad
    }]
  },
  options: {
    title: {
      display: true,
      text: "Hdd Usage"
    }
  }
});
<?php } else { ?>
const datachart = document.getElementById('datachart');
datachart.classList.add('hidden');
<?php } ?>
</script>
    @endsection
