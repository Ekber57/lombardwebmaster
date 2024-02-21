@extends('main')
@section('passage')
    MUSTERI FORMASI
@endsection
@section('body')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    @component('components.alert', [
                        'message' => $error,
                        'error' => $error,
                    ])
                    @endcomponent
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        @isset($message)
            @component('components.alert', [
                'message' => $message,
            ])
            @endcomponent
        @else
            <form id="payform" class="col s12" action="/payments/pay" method="post">
                @csrf
                <div class="row">
                    <div class="input-field col s4">
                        <input hidden value="{{ $credit->id }}" name="credit_id" type="text" class="validate">
                        <input disabled value="{{ $customer->name }}" name="name" id="firstname" type="text"
                            class="validate">
                        <label for="firstname">Ad</label>
                    </div>
                    <div class="input-field col s4">
                        <input disabled value="{{ $customer->lastname }}" name="lastname" id="lastname" type="text"
                            class="validate">
                        <label for="lastname">Soyad</label>
                    </div>
                    <div class="input-field col s4">
                        <input disabled value="{{ $customer->middlename }}" name="middlename" id="middlename" type="text"
                            class="validate">
                        <label for="middlename">Ata adi</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s4">

                        <input disabled value="{{ $credit->amount }} ₼" name="name" id="credit_amount" type="text"
                            class="validate">
                        <label for="credit_amount">Kredit meblegi </label>
                    </div>

                    <div class="input-field col s4">

                        <input disabled value="{{ $credit->balance - $credit->amount }} ₼" name="name" id="percentage"
                            type="text" class="validate">
                        <label for="percentage">Faiz meblegi </label>
                    </div>
                    <div class="input-field col s4">

                        <input disabled value="{{ $credit->remainder }} ₼" name="name" id="remainder" type="text"
                            class="validate">
                        <label for="remainder">Qaliq meblegi </label>
                    </div>

                </div>
                <div class="row">
                    <div class="input-field col s4">

                        <input disabled value="{{ $credit->percentage_amount }} ₼" name="name" id="minimum" type="text"
                            class="validate">
                        <label for="minimum">Minimum odenis meblegi </label>
                    </div>

                    <div class="input-field col s4">

                        <input disabled value="{{ $credit->remainder + $credit->percentage_amount }} ₼" name="name"
                            id="percentage" type="text" class="validate">
                        <label for="percentage">Maksimal odenis meblegi </label>
                    </div>

                    <div class="input-field col s4">

                        <input name="amount" id="amounttopay" type="text" class="validate">
                        <label for="amounttopay"> Odenis meblegi </label>
                    </div>


                </div>



                <div class="row">

                    <div class="input-field col s6">
                     

                    </div>


                </div>

            </form>
        @endisset





        <!-- Modal Trigger -->
        <a class="waves-effect waves-light btn modal-trigger" href="#paycheck">Odenis et</a>

        <!-- Modal Structure -->
        <div id="paycheck" class="modal">
            <div class="modal-content">
                <h4>Odenis Melumatlari</h4>
                <p><table>
               
            
                    <tbody>
                      <tr>
                          <td>Musteri </td>
                          <td> <b> {{$credit->customer()->name}} {{$credit->customer()->lastname}} {{$credit->customer()->middlename}}</b></td>
                      </tr>
                      <tr>
                          <td>Kredit nomresi</td>
                          <td> <b>  {{$credit->id}}</b></td>
                      </tr>
                      <tr>
                          <td>Odenilen mebleq</td>
                          <td id="payamount"></td>
                      </tr>
                      <tr>
                          <td>Odenis tarixi</td>
                          <td><b>{{date("d-m-Y")}}</b></td>
                      </tr>
                 
         
                    </tbody>
                  </table></p>
            </div>
            <div class="modal-footer">
                <button id="paybutton" class="btn waves-effect waves-light" type="submit" name="action">Testiqle <i
                    class="material-icons right">send</i>
            </button>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function(){
            $("#paybutton").on("click",function(){
              

                $("#payform").submit()
            })
            $("#amounttopay").on("change",function(){
                $("#payamount").html("<b>"+this.value+" ₼"+"<b>")
            })

            $('#paycheck').modal();
          });
        
        </script>


@endsection
