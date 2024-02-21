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
        "message" => $message
        
        ])
           
       @endcomponent
        @else
        <form class="col s12" action="/customers/{{$customer->id}}" method="post">
            @csrf
            @method("put")
            <div class="row" >
                <div class="input-field col s6">
                    <input value="{{$customer->name}}" name="name"  id="firstname" type="text" class="validate">
                    <label for="firstname">Ad</label>
                </div>
                <div class="input-field col s6">
                    <input value="{{$customer->lastname}}" name="lastname" id="lastname" type="text" class="validate">
                    <label for="lastname">Soyad</label>
                </div>
             
            </div>
         
            <div class="row">
                <div class="input-field col s6">
                    <input value="{{$customer->middlename}}" name="middlename"  id="middlename" type="text" class="validate">
                    <label for="middlename">Ata adi</label>
                </div>
                <div class="input-field col s6">
                    <input value="{{$customer->adress}}" name="adress" id="adress" type="text" class="validate">
                    <label for="adress">Adress</label>
                </div>
             
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input value="{{$customer->phone}}" name="phone"  id="phone" type="number" class="validate">
                    <label for="phone">Telefon nomresi</label>
                </div>
                <div class="input-field col s6">
                    <input value="{{$customer->fincode}}" name="fincode" id="fincode" type="text" class="validate">
                    <label for="fincode">Finkod</label>
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


@endsection
