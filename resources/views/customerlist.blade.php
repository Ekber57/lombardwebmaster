@extends('main')
@section('body')
<div class=" right-align ">
<a href="/customers/create" class="waves-effect waves-light btn">müştəri əlavə et</a>
</div>
        
    <table class="centered striped">
        <thead>
            <tr>
                <th>Ad</th>
                <th>Soyad</th>
                <th>Ata adı</th>
                <th>Telefon</th>
                <th>Adress</th>
                <th>Finkod</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($customers as $customer)
                <tr >
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->lastname }}</td>
                    <td>{{ $customer->middlename }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->adress }}</td>
                    <td>{{ $customer->fincode }}</td>
                    <td>
                        <!-- Dropdown Trigger -->
                        <a class='dropdown-trigger btn ' href='#' data-target='customer_option{{$customer->id}}'><i class="material-icons">add</i></a>
                        <!-- Dropdown Structure -->
                        <ul id='customer_option{{$customer->id}}' class='dropdown-content' style="min-width:15%">
                          <li><a href="/customers/{{$customer->id}}/edit"><i class="material-icons">edit</i>məlumatları yenilə</a></li>
                          <li><a href="/credits/create/{{$customer->id}}"><i class="material-icons">account_balance</i>kredit ver</a></li>
                        </ul>

                    </td>
                </tr>
            @endforeach


        </tbody>
    </table>

    {{ $customers->render('custompagination') }}

        
@endsection
