@extends('main')
@section('body')

@isset($message)
@component("components.alert",[
    "message" => $message

    ]) 
@endcomponent
@endisset
    <table class="centered striped">
        <thead>
            <tr>
                <th>Ad</th>
                <th>Soyad</th>
                <th>Ata adı</th>
                
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>
                    {{$user->name}}
                </td>
                <td>
                    {{$user->lastname}}
                </td>
                <td>
                    {{$user->middlename}}
                </td>
            </tr>

        </tbody>
    </table>

    <table class="centered striped">
        <thead>
            <tr>
                <th>Icaze</th>
                <th>Status</th>
                
            </tr>
        </thead>

        <tbody>
            @foreach ($permissions as $permission )
            <tr>
            <td>   {{$permission->name}} </td>
            <td>
                @if ($user->hasPermissionTo($permission->name))
                <div class="switch">
                    <label>
                      Off
                      <input disabled checked type="checkbox">
                      <span  class="lever"></span>
                      On
                    </label>
                  </div>
                @else
                  <!-- Switch -->
                  <div class="switch">
                    <label>
                      Off
                      <input disabled  type="checkbox">
                      <span  class="lever"></span>
                      On
                    </label>
                  </div>

                @endif
            
            </td>
            <td>
                <form action="/auth/users/show/{{$user->id}}/edit" method="POST">
                    @csrf
                    <button name="permission" value="{{$permission->name}}">
                        
                        @if ($user->hasPermissionTo($permission->name))
                        <i class="material-icons"  style="color:rgb(34, 171, 180)">lock</i>
                       
                        @else
                        <i class="material-icons"  style="color:rgb(34, 171, 180)">vpn_key
                        </i>
                        @endif
                    </button>
                </form>



            </td>
            </tr>
            @endforeach

        </tbody>
    </table>
    
        
@endsection
