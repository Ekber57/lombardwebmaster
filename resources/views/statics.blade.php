@extends("main")
@section("body")
<div class="row">
<div class="col s8">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<body>

<canvas id="myChart" style="width:100%;max-width:600px"></canvas>

<script>
const xValues = ["Umumi kredit sayi", "Aktiv kreditler", "Baqlanmis kreditler", "Satilmis kredit sayi", ];

const yValues = [{{$creditData->creditDataAll}}, {{$creditData->creditDataActives}}, {{$creditData->creditDataCloseds}}, {{$creditData->creditDataSelleds}}];
const barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
];

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
      text: "Kreditlerin Statsik Melumatlari"
    }
  }
});
</script>
</div>
<div class="col s4  "

    <ul class="collection">
        <li class="collection-item">Umumi verilmis mebleq <b>{{$creditData->amountDataAllGivedAmount}} </b> ₼</li>
        <li class="collection-item">Umumi odenilmis mebleq <b>{{$creditData->amountDataAllRecivedAmount}} </b> ₼</li>
        <li class="collection-item">Yalniz faiz odenisleri <b>{{$creditData->amountDataAllRecivedAmountForOnlyPercentage}} </b> ₼</li>
        <li class="collection-item">Odenis gozleyen mebleq <b>{{$creditData->amountDataAllWaited}} </b> ₼</li>
 
      </ul>


    </div>
    </div>
</div>
</body>
@endsection