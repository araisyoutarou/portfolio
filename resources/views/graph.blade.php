@extends('layouts.CalendarMemo')
@section('content')
<head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
</head>
    <div class="button">
        <button onclick="location.href='https://0f4d0c05e99346ba90e964c6116063e4.vfs.cloud9.ap-northeast-1.amazonaws.com/'">カレンダー</button>
        <button disabled>円グラフ</button>
    </div>

<h1 class="title">家計簿アプリ</h1>

<div class="years">
   <select name="year">
      <option value="未選択">選択してください</option>
      <option value="2022">2022年</option>
      <option value="2023">2023年</option>
      <option value="2024">2024年</option>
      <option value="2025">2025年</option>
      <option value="2026">2026年</option>
      <option value="2027">2027年</option>
      <option value="2028">2028年</option>
      <option value="2029">2029年</option>
      <option value="2030">2030年</option>
   </select>
</div>

<body>
    <div id="app" class="container p-3">
        <div class="row">
            <div class="col-md-6">

                <!-- 円グラフを表示するキャンバス -->
                <canvas id="chart" width="400" height="400"></canvas>

                <!-- 月を選択するセレクトボックス -->
                <div class="form-group">
                    <label>月数</label>
                    <select class="form-control" v-model="month" @change="getSales">
                        <option v-for="month in months" :value="month">@{{ month }} 月</option>
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
                sales: [],
                month: '{{ date('M') }}',
                months: [],
                chart: null
            },
            methods: {
                getMonths() {

                    // 登録月リストを取得
                    fetch('/ajax/graph/months')
                        .then(response => response.json())
                        .then(data => this.months = data);

                },
                getGraph() {

                    // 販売実績データを取得
                    fetch('/ajax/graph?month='+ this.month)
                        .then(response => response.json())
                        .then(data => {

                            if(this.chart) { // チャートが存在していれば初期化

                                this.chart.destroy();

                            }

                            // lodashでデータを加工
                            const groupedGraph = _.groupBy(data, 'spending_graph'); // 項目ごとにグループ化
                            const amounts = _.map(groupedSales, companySales => {

                                return _.sumBy(companySales, 'amount'); // 金額合計

                            });
                            const companyNames = _.keys(groupedSales); // 会社名

                            // 👇 円グラフを描画 ・・・ ④
                            const ctx = document.getElementById('chart').getContext('2d');
                            this.chart = new Chart(ctx, {
                                type: 'pie',
                                data: {
                                    datasets: [{
                                        data: amounts,
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
                                    labels: companyNames
                                },
                                options: {
                                    title: {
                                        display: true,
                                        fontSize: 45,
                                        text: '売上統計'
                                    },
                                    tooltips: {
                                        callbacks: {
                                            label(tooltipItem, data) {

                                                const datasetIndex = tooltipItem.datasetIndex;
                                                const index = tooltipItem.index;
                                                const amount = data.datasets[datasetIndex].data[index];
                                                const amountText = amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                                                const company = data.labels[index];
                                                return ' '+ company +' '+amountText +' 円';

                                            }
                                        }
                                    }
                                }
                            });

                        });

                }
            },
            mounted() {

                this.getYears();
                this.getSales();

            }
        });

    </script>
</body>

@endsection