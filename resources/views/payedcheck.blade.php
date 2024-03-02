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
 <img class="stamp" src="https://iili.io/JEsQWB4.png" alt="JEsQWB4.png"  border="0">
<table style="width:100%">


  <tr>
    <td>QEBZ NOMRESI</td>
    <td> N  {{$payment->id }}</td>
  </tr>
  <tr>
    <td>Musteri</td>
    <td>  {{$payment->credit()->customer()->name }} {{$payment->credit()->customer()->lastname }} {{$payment->credit()->customer()->middlename }}</td>
  </tr>

  <tr>
    <td> Odenis</td>
    <td> {{$payment->amount}} ₼</td>
  </tr>
  <tr>
    <td> Qaliq</td>
    <td> {{$payment->credit()->remainder}} ₼</td>
  </tr>
  <tr>
    <td> Odenisi eden </td>
    <td> {{ auth()->user()->name }} {{ auth()->user()->lastname }} {{ auth()->user()->middlename }} </td>
  </tr>

  <tr>
    <td> Tarix </td>
    <td> {{date("d.m.Y H:i")}} </td>
  </tr>
 
</table>

</body>
</html>



