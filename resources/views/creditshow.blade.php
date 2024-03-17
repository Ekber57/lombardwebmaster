<!DOCTYPE html>
<html>
<head>
    
<style>
    @print body {
        margin-left: 30%,
    }
th, td {
  border-style: dotted;
}
td {
    padding: 5px
}

.stamp {
  position: absolute;
  margin-left:70%; 
  margin-top:0%; 
 
  height: 200px;
}
</style>
</head>
<body>
@isset($message)
@component("components.alert",[
        "message" => $message])
@endcomponent
@endisset
<div class=" right-align ">
        <a href="/customers/create" class="waves-effect waves-light btn">müştəri əlavə et</a>
    </div>
<table style="width:100%">


  <tr>
    <td>KREDIT NOMRESI</td>
    <td> N  {{$credit->id }}</td>
   </tr> 
   
  <tr>
    <td>Musteri</td>
    <td>  {{$credit->customer()->name }} {{$credit->customer()->lastname }} {{$credit->customer()->middlename }}</td>
  </tr>

  <tr>
    <td> Muddet</td>
    <td> {{$credit->duration}} ay</td>
  </tr>
  <tr>
    <td> Mebleq</td>
    <td> {{$credit->amount}} ₼</td>
  </tr>
  <tr>
    <td> Qaliq</td>
    <td> {{$credit->balance}} ₼</td>
  </tr>
  <tr>
    <td> Faiz mebleqi</td>
    <td> {{$credit->balance - $credit->amount}} ₼</td>
  </tr>
  <tr>
    <td> Girovlar</td>
    <td> 
    @php
    $lines = explode("\n",$credit->note);
    foreach($lines as $line) {
        echo $line."<br>";
    }
    @endphp    
    </td>
  </tr>
  <tr>
    <td> Kredit mutexessisi </td>
    <td> {{ auth()->user()->name }} {{ auth()->user()->lastname }} {{ auth()->user()->middlename }} </td>
  </tr>

  <tr>
    <td> Tarix </td>
    <td> {{date("d.m.Y H:i")}} </td>
  </tr> 
  
</table>

<div style="margin: 5%"></div>
<table style="width:100%">


<thead>
  <th>ODENIS MEBLEQI</th>
  <th>ESAS MEBLEQ</th>
  <th>FAIZ MEBLEQI</th>
  <th>QALIQ MEBLEQI</th>
</thead>
 
@foreach ($data as $payment)
<tr>
<td>{{number_format(round($payment->payment,2),2)}} ₼</td>
<td>{{number_format(round($payment->base_debt,2),2)}} ₼</td>
<td>{{number_format(round($payment->percentage,2),2)}} ₼</td>
<td>{{number_format(round($payment->remainder,2),2)}} ₼</td>
</tr>

@endforeach

</table>
</body>
</html>



