@extends('main')
@section('body')
<div class=" right-align ">
<a href="/auth/register" class="waves-effect waves-light btn">mütəxəssis əlavə et</a>
</div>
  
    <table class="centered striped">
        <thead>
            <tr>
                <th>Ad</th>
                <th>Soyad</th>
                <th>Ata adı</th>
                
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
                <tr >
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->lastname }}</td>
                    <td>{{ $user->middlename }}</td>
                
                    <td>
                        <!-- Dropdown Trigger -->
                        <a class='dropdown-trigger btn ' href='#' data-target='user_option{{$user->id}}'><i class="material-icons">add</i></a>
                        <!-- Dropdown Structure -->
                        <ul id='user_option{{$user->id}}' class='dropdown-content' style="min-width:15%">
                          <li><a href="/auth/users/show/{{$user->id}}"><i class="material-icons">edit</i>icazeleri goster</a></li>
                        </ul>

                    </td>
                </tr>
            @endforeach


        </tbody>
    </table>

    {{ $users->render('custompagination') }}

        
@endsection
