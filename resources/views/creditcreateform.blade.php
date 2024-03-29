@extends('main')
@section("passage")
MUSTERI FORMASI
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
        @isset($message)
        @component("components.alert",[
            "message" => $message,
            ])
               
           @endcomponent
        @else
        <form class="col s12" action="/credits" method="post">
            @csrf
            <div class="row" >
                <div class="input-field col s6">
                    <input hidden value="{{$customer->id}}" name="customer_id" type="text" class="validate">
                    <input disabled value="{{$customer->name}}" name="name"  id="firstname" type="text" class="validate">
                    <label for="firstname">Ad</label>
                </div>
                <div class="input-field col s6">
                    <input disabled value="{{$customer->lastname}}" name="lastname" id="lastname" type="text" class="validate">
                    <label for="lastname">Soyad</label>
                </div>
             
            </div>
         
            <div class="row">
                <div class="input-field col s4">
                    <input disabled value="{{$customer->middlename}}" name="middlename"  id="middlename" type="text" class="validate">
                    <label for="middlename">Ata adi</label>
                </div>
                <div class="input-field col s4">
                    <input  name="amount" id="amount" type="text" class="validate">
                    <label for="amount">Mebleq</label>
                </div>
                <div class="input-field col s4">
                    <input  name="duration" id="duration" type="text" class="validate">
                    <label for="duration">Muddet</label>
                </div>
             
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <textarea name="note" id="note" class="materialize-textarea"></textarea>
                    <label for="note">Elave qeydler</label>
                </div>
                <div class="input-field col s4  ">
                    <input 
                    
                    @can("change percentage")
                    @else
                    value="{{$percentage}}"
                    disabled
                    @endcan 
                    value="{{$percentage}}"
                    name="percentage" id="percentage" type="number" class="validate">
                    <label for="percentage">Faiz dərəcəsi</label>
                    <p>
                        <label>
                          <input
                          @can("change percentage")
                          @else
                          checked
                          disabled
                          @endcan 
                          id="detectorForSystemPercentage" type="checkbox" />
                          <span>sistem faizi</span>
                        </label>
                      </p>
                </div>
             
            </div>

            <div class="row">
                
                <div class="input-field col s6">
                    <button class="btn waves-effect waves-light" type="submit" name="action">elave et<i class="material-icons right">send</i>
                      </button>
                            
                </div>
         
             
            </div>
            
        </form>
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
