@extends('main')
@section('body')
    <div class=" right-align ">
        <a href="/customers/create" class="waves-effect waves-light btn">müştəri əlavə et</a>
    </div>
    <div class="row">
        <form id="myForm" method="GET" action="/customers?filter=true" class="col s12">
            <div class="row">
                <div class="input-field col s6">
                    <textarea id="query" class="materialize-textarea"></textarea>
                    <i onclick="search()" type="submit" class="material-icons prefix">search </i>
                    {{-- <button>send</button> --}}
                    <label for="query"> ad soyad ata adi ve ya nomre</label>
                </div>
            </div>
        </form>
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
                <tr>
                    <td onclick="showCustomer({{ $customer->id }})">{{ $customer->name }}</td>
                    <td onclick="showCustomer({{ $customer->id }})">{{ $customer->lastname }}</td>
                    <td onclick="showCustomer({{ $customer->id }})">{{ $customer->middlename }}</td>
                    <td onclick="showCustomer({{ $customer->id }})">{{ $customer->phone }}</td>
                    <td onclick="showCustomer({{ $customer->id }})">{{ $customer->adress }}</td>
                    <td onclick="showCustomer({{ $customer->id }})">{{ $customer->fincode }}</td>
                    <td>
                        <!-- Dropdown Trigger -->
                        <a class='dropdown-trigger btn ' href='#' data-target='customer_option{{ $customer->id }}'><i
                                class="material-icons">add</i></a>
                        <!-- Dropdown Structure -->
                        <ul id='customer_option{{ $customer->id }}' class='dropdown-content' style="min-width:15%">
                            <li><a href="/credits/create/{{ $customer->id }}"><i
                                        class="material-icons">account_balance</i>kredit ver</a></li>
                            <li><a href="/customers/show/{{ $customer->id }}"><i
                                        class="material-icons">remove_red_eye</i>melumatlari goster</a></li>

                            <li><a href="/customers/{{ $customer->id }}/edit"><i class="material-icons">edit</i>məlumatları
                                    yenilə</a></li>

                        </ul>

                    </td>
                </tr>
            @endforeach


        </tbody>
    </table>
    @if ($customers->count() == 0)
        @component('components.alert', [
            'message' => ' axtarisiniza uygun hec bir musteri tapilmadi',
            'error' => '1',
        ])
        @endcomponent
    @endif
    {{ $customers->render('custompagination') }}
    <script>
        function search() {

            var query = $('#query').val();
            // Filter or process the input data here as needed
            // For example, you might encode it for URL usage

            // Redirect to the search page with filtered query
            window.location.href = "/customers?filter=" + encodeURIComponent(query);
        }
        $(document).ready(function() {
            $("#query").focus();
            $('#query').keypress(function(event) {

                // Check if the Enter key was pressed (key code 13)
                if (event.which === 13) {
                    event.preventDefault(); // Prevent the default form submission

                    // Get the input value
                    var query = $('#query').val();

                    // Filter or process the input data here as needed
                    // For example, you might encode it for URL usage

                    // Redirect to the search page with filtered query
                    window.location.href = "/customers?filter=" + encodeURIComponent(query);
                }

            });

          
        });
        function showCustomer(id) {
              
                window.location.href = '/customers/show/' + id
            }
    </script>
@endsection
