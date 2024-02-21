@extends('main')
@section("passage")
GIRIS
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
    "message" => $message])
    @endcomponent
    
@endisset
      



    <div class="row">
        <form class="col s12" action="/auth/register" method="post">
            @csrf
    

            <div class="row">
                <div class="input-field col s6">
                    <input  name="name"  id="name" type="text" class="validate">
                    <label for="name"> ad</label>
                </div>
              
                <div class="input-field col s6">
                    <input  name="lastname"  id="lastname" type="text" class="validate">
                    <label for="lastname"> soyad</label>
                </div>
              

             
            </div>
            
            <div class="row">
                <div class="input-field col s6">
                    <input  name="middlename"  id="middlename" type="text" class="validate">
                    <label for="middlename"> ata adi</label>
                </div>
                <div class="input-field col s6">
                    <input  name="password" id="password" type="text" class="validate">
                    <label for="password">sifre</label>
                </div>
             
            </div>
            
            <div class="row">
                
                <div class="input-field col s6">
                    <button class="btn waves-effect waves-light" type="submit" name="action">qeydiyyat et<i class="material-icons right">send</i>
                      </button>
                  
                </div>
         
             
            </div>
            
        </form>
    </div>
@endsection
