@extends('main')
@section("body")
<style>
th,td {
    text-align: center
}
</style>
<div class="row">

<div class="col s4">
    <img src="{{asset("/books.png")}}" height="400">
</div>

<div class="col s8">
  <div class=" right-align ">
    <a href="/credits/create/{{$customer->id}}" class="waves-effect waves-light btn">kredit ver</a>
</div>
    <table>
        <thead>
          <tr>
              <th>Ad</th>
              <th>Soyad</th>
              <th>Ata adi</th>
              <th>Nomre</th>
          </tr>
        </thead>

        <tbody>
        
          <tr>
            <td>{{$customer->name}}</td>
            <td>{{$customer->lastname}}</td>
            <td>{{$customer->middlename}}</td>
            <td>{{$customer->phone}}</td>
          </tr>
        </tbody>
      </table>

      <h5>Kreditler</h5>
      <table>
        <thead>
          <tr>
              <th>Kredit nomresi</th>
              <th>Mebleq</th>
              <th>Qaliq</th>
              <th>Statusu</th>
          </tr>
        </thead>

        <tbody>
        @foreach ($credits as $credit )
        <tr>
          <td>N {{$credit->id}}</td>
          <td>{{$credit->amount}} ₼</td>
          <td>{{$credit->remainder}} %</td>
          <td>
         @switch($credit->status)
             @case(0)
                 aktiv
                 @break
             @case(1)
                 baqlanmis
                 @break
             @case(2)
                 satilib
                 @break
            
             @default
               {{"aktiv"}}
         @endswitch
          </td>        <td>
            <a class='dropdown-trigger btn ' href='#' data-target='customer_option{{$credit->id}}'><i class="material-icons">add</i></a>
            <!-- Dropdown Structure -->
            <ul id='customer_option{{$credit->id}}' class='dropdown-content' style="min-width:15%">
              @if ($credit->status == 0)
              <li><a  href="/payments/pay/{{$credit->id}}"><i class="material-icons">attach_money</i>odenis et</a></li>

  
              @endif
    
              <li><a href="/credits/{{ $credit->id }}"><i
                class="material-icons">remove_red_eye</i>melumatlari  goster</a></li>
           
              <li><a href="/credits/showcheck/{{ $credit->id }}"><i
                class="material-icons">assignment
              </i>  ceki   goster</a></li>
           
            </ul>

        </td>
        </tr>
        @endforeach
   
        </tbody>
      </table>
      {{ $credits->render('custompagination') }}

      
      <h5>Gecikmeler</h5>
      <table>
        <thead>
          <tr>
              <th>Kredit nomresi</th>
              <th>Mebleq</th>
              <th>Cerime</th>
              <th>Gecikib</th>
          </tr>
        </thead>

        <tbody>
        @foreach ($delayings as $delay )
        <tr>
          <td>N {{$delay->credit_id}}</td>
          <td>{{$delay->amount}} ₼</td>
          <td>{{$delay->penalty_amount}} ₼</td>
          <td>{{$delay->delayed_days}} gün</td>
        </tr>
        @endforeach
   
        </tbody>
      </table>
      {{ $delayings->render('custompagination') }}
</div>

</div>

@endsection