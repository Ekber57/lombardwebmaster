@extends('main')
@section("passage")

@endsection
@section('body')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            @component("components.alert",[
                "message" => $error,
                "error" => $error
                ])
               @endcomponent
            @endforeach
        </ul>
    </div>
@endif
<div class="row">
    <h1 style="margin-left:3%"> ELIT LOMBARD</h1>
    {{-- <div class="col s12">This div is 12-columns wide on all screen sizes</div> --}}
    <div class="col s6"><img src="https://iili.io/JGH4rXI.md.png" alt="JGH4rXI.md.png" border="0">
 </div>
    <div class="col s6">
        @isset($message)
        @component("components.alert",[
            "message" => $message,
            ])
               
           @endcomponent
        @else
        <form class="col s12" action="/calculator" method="post">
            @csrf
            <div class="row" >
                <div class="input-field col s4">
                 
                    <input  name="amount"  id="amount" type="number" class="validate">
                    <label for="amount">Məbləğ</label>
                </div>
                <div class="input-field col s4  ">
                    <input  name="duration" id="duration" type="number" class="validate">
                    <label for="duration">Müddət</label>
                </div>
                <div class="input-field col s4  ">
                    <input  name="percentage" id="percentage" type="number" class="validate">
                    <label for="percentage">Faiz dərəcəsi</label>
                    <p>
                        <label>
                          <input id="detectorForSystemPercentage" type="checkbox" />
                          <span>sistem faizi</span>
                        </label>
                      </p>
                </div>
             
            </div>
         
      
            
            <div class="row">
                
                <div class="input-field col s6">
                    <button class="btn waves-effect waves-light" type="submit" name="action">hesabla<i class="material-icons right">send</i>
                      </button>
                            
                </div>
         
             
            </div>
            
        </form>

        @isset($result)
             <table class="centered striped">
            <thead>
                <tr>

                    <th>Aylıq ödəniş</th>
                    <th>Əsas borc</th>
                    <th>Faiz</th>
                    <th>Qalıq </th>
                    <th>Ödəniş tarixi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($result as $credit)
                    <tr>

                        <td>{{number_format(round($credit["payment"],2),2)}} ₼</td>
                        <td>{{number_format(round($credit["base_debt"],2),2)}} ₼</td>
                        <td>{{number_format(round($credit["percentage"],2),2)}} ₼</td>
                        <td>{{number_format(round($credit["remainder"],2),2)}} ₼</td>
                        <td>{{$credit["payment_date"]}}</td>
             
                    </tr>
                @endforeach


            </tbody>
        </table>
        @endisset
       















        @endisset
    </div>
    <script>
        $("#detectorForSystemPercentage").on("change",function() {
           
            if(this.checked) {
                $("#percentage").focus()
                $("#percentage").val("{{$percentage}}")
            }
            else {
                $("#percentage").val(0)
            }
        })
    </script>
@endsection
