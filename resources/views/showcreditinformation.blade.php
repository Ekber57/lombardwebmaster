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
    <table>
        <thead>
          <tr>
              <th>Kredit nomresi</th>
              <th>Kredit mebleqi</th>
              <th>Qaliq</th>
              <th>Faiz</th>
              <th>Verilme tarixi</th>
          </tr>
        </thead>

        <tbody>
        
          <tr>
            <td>{{$credit->id}}</td>
            <td>{{$credit->amount}}</td>
            <td>{{$credit->remainder}}</td>
            <td>{{$credit->percentage}}</td>
            <td>{{ \Carbon\Carbon::parse($credit->created_at)->format('d.m.Y') }}</td>

          </tr>
        </tbody>
      </table>

      <h5>Odenisler</h5>
      <table>
        <thead>
          <tr>
              <th>Odenis mebleqi</th>
              <th>Qaliq</th>
              <th>Tarix</th>
              {{-- <th>Statusu</th> --}}
          </tr>
        </thead>

        <tbody>
            @if ($payments->count() == 0)
            <tr>
           <td>  Bu kredit ucun odenis edilmeyib</td>
            </tr>
        @endif
        @foreach ($payments as $payment )
        <tr>
          <td>{{$payment->amount}}</td>
          <td>{{$payment->remainder}}</td>
          <td>{{ \Carbon\Carbon::parse($payment->created_at)->format('d.m.Y') }}</td>

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
    
              <li><a href="/payments/showcheck/{{ $payment->id }}"><i
                class="material-icons">remove_red_eye</i>ceki  goster</a></li>
           
            </ul>

        </td>
        </tr>
        @endforeach
  
        </tbody>
      </table>
</div>

{{ $payments->render('custompagination') }}
</div>



@endsection