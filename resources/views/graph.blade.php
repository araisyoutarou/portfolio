@extends('layouts.app')
@section('content')
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
</head>
    <div class="button">
        <button onclick="location.href='https:/'">カレンダー</button>
        <button disabled>円グラフ</button>
    </div>
<h1 class="title">家計簿アプリ</h1>
<div class="years">
    <th>年を選択</th>
    <select id="yearSelect" name="year" onChange="showCalender()"> 
      <option value="/?year=2023">2023年</option>
      <option value="/?year=2022">2022年</option>
      <option value="/?year=2021">2021年</option>
      <option value="/?year=2020">2020年</option>
      <option value="/?year=2019">2019年</option>
      <option value="/?year=2018">2018年</option>
   </select>
   <th>月を選択</th>
   <select id="monthSelect" name="month" onChange="showCalender()">
      <option value="&month=year">年間</option>
      <option value="&month=1">1月</option>
      <option value="&month=2">2月</option>
      <option value="&month=3">3月</option>
      <option value="&month=4">4月</option>
      <option value="&month=5">5月</option>
      <option value="&month=6">6月</option>
      <option value="&month=7">7月</option>
      <option value="&month=8">8月</option>
      <option value="&month=9">9月</option>
      <option value="&month=10">10月</option>
      <option value="&month=11">11月</option>
      <option value="&month=12">12月</option>
   </select>
</div>
<div id="app" class="container p-3">
    <div class="row">
        <div class="col-md-6">
            <!--  円グラフを表示するキャンバス -->
            <canvas id="chart" width="400" height="400"></canvas>
            <!--  年を選択するセレクトボックス -->
            <div class="form-group">
                <label>販売年</label>
                <select class="form-control" v-model="year" @change="getSales">
                    <option v-for="year in years" :value="year">@{{ year }} 年</option>
                </select>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.11"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.15/lodash.min.js"></script>
<script>
    new Vue({
        el: '#app',
        data: {
            graph: [],
            month: '{{ date('n') }}',
            months: [],
            chart: null
        },
        methods: {
            getMonths() {
                // 月リストを取得
                fetch('/ajax/graph/months')
                    .then(response => response.json())
                    .then(data => this.,months = data);
                },
            getGraph() {
                // 登録データを取得
                fetch('/ajax/graph?month='+ this.month)
                    .then(response => response.json())
                    .then(data => {
                        if(this.chart) { // チャートが存在していれば初期化
                            this.chart.destroy();
                    }
                    // lodashでデータを加工
                    const groupedGraph = _.groupBy(data, 'spending_name'); // 項目ごとにグループ化
                    const amounts = _.map(groupedGraph, spendingGraph => {
                        return _.sumBy(spendingGraph, 'price_graph'); // 金額合計
                    });
                    const spendingNames = _.keys(groupedGraph); // 項目名
                    // 円グラフを描画
                    const ctx = document.getElementById('chart').getContext('2d');
                    this.chart = new Chart(ctx, {
                        type: 'pie',
                        data: {
                            datasets: [{
                                data: prices,
                                backgroundColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(255, 159, 64)',
                                    'rgb(255, 205, 86)',
                                    'rgb(75, 192, 192)',
                                    'rgb(54, 162, 235)',
                                    'rgb(153, 102, 255)',
                                    'rgb(201, 203, 207)'
                                ]
                            }],
                            labels: spendingNames
                        },
                        options: {
                            title: {
                                display: true,
                                fontSize: 45,
                                text: '家計簿'
                            },
                            tooltips: {
                                callbacks: {
                                    label(tooltipItem, data) {
                                        const datasetIndex = tooltipItem.datasetIndex;
                                        const index = tooltipItem.index;
                                        const price = data.datasets[datasetIndex].data[index];
                                        const priceText = amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                                        const spending = data.labels[index];
                                        return ' '+ spending +' '+priceText +' 円';
                                    }
                                }
                            }
                        }
                    });
                });
            }
        },
        mounted() {
            this.getMonths();
            this.getGraph();
        }
    });
</script>
@endsection