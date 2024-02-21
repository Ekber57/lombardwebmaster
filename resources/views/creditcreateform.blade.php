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
                    <textarea id="phone" class="materialize-textarea"></textarea>
                    <label for="phone">Elave qeydler</label>
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
