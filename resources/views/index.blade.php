@extends("main")
@section("body")

<div class="row">
    <h1>F R A N K L I N</h1>
    {{-- <div class="col s12">This div is 12-columns wide on all screen sizes</div> --}}
    <div class="col s6"><img src="https://iili.io/JGH4rXI.md.png" alt="JGH4rXI.md.png" border="0">
 </div>
    <div class="col s6">
        <table class="centered striped">
            <thead>
                <tr>
                    <th>musteri</th>
                    <th>odenis</th>
                    <th>qaliq</th>
          
                </tr>
            </thead>
    
            <tbody>
                @foreach ($payments as $payment)
                    <tr >
                        <td>{{ $payment->amount }}</td>
                        <td>{{ $payment->amount }}</td>
                        <td>{{ $payment->remainder }}</td>
               
             
                    </tr>
                @endforeach
    
    
            </tbody>
        </table>
    










    </div>
  </div>
@endsection