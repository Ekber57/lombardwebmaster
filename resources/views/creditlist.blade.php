@extends('main')
@section('body')

    @if (count($credits) == 0)
        <div class="centered">
            <p>
                @switch($filter)
                    @case('today')
                        Bu gün üçün ödəniş gözləyən kredit yoxdur
                    @break

                    @case('selled')
                        Satışa heçbir kredit çıxarılmayıb
                    @break

                    @case('delayed')
                        Gecikmədə olan kredit yoxdur
                    @break

                    @case('active')
                        Aktiv kredit yoxdur
                    @break

                    @case('closed')
                        Bağlanmış kredit yoxdur

                        @default
                    @endswitch
                </p>
            </div>
        @else
            <table class="centered striped">
                <thead>
                    <tr>

                        <th>Müştəri</th>
                        <th>Anutet məbləği</th>
                        <th>Kredit məbləği</th>
                        <th>Umumi məbləğ</th>
                        <th>Qalıq</th>
                        <th>Faiz</th>
                        <th>Esas mebleq</th>
                        <th>Faiz mebleqi</th>
                        <th>Ödəniş  məbləği</th>
                        <th>Ödəniş tarixi</th>
                        @if ($filter == 'delayed')
                            <th>Gecikmə müddəti</th>
                        @endif
                        <th>Əlaqə</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach ($credits as $credit)
                        <tr>

                            <td onclick="showCustomer({{$credit->customer_id}})">{{ $credit->name . ' ' . $credit->lastname . ' ' . $credit->middlename }}</td>
                            <td>{{ $credit->annuted }} ₼</td>
                            <td>{{ $credit->amount }} ₼</td>
                            <td>{{ $credit->balance }} ₼</td>
                            <td>{{ $credit->remainder }} ₼</td>
                            <td>{{ $credit->percentage }} %</td>
                            <td>{{ $credit->base_debt }} ₼</td>
                            <td>{{ $credit->percentage_amount }} ₼</td>
                            <td>{{ $credit->payment_amount }} ₼</td>
                            <td>{{ \Carbon\Carbon::parse($credit->next_payment_date)->format('d.m.Y') }}</td>


                            @php
                                if ($filter == 'delayed') {
                                    $date1 = \Carbon\Carbon::parse(\Carbon\Carbon::today('Asia/Baku')->format('Y-m-d'));
                                    $date2 = \Carbon\Carbon::parse($credit->next_payment_date);

                                    // Calculate the difference between two dates
                                    echo "<td>".$diffInDays = $date1->diffInDays($date2)." gün</td>";
                                }
                            @endphp
                                <td>{{ $credit->phone }}</td>

                            <td>
                                <a class='dropdown-trigger btn ' href='#' data-target='customer_option{{$credit->id}}'><i class="material-icons">add</i></a>
                                <!-- Dropdown Structure -->
                                <ul id='customer_option{{$credit->id}}' class='dropdown-content' style="min-width:15%">
                                  <li><a href="/payments/pay/{{$credit->id}}"><i class="material-icons">attach_money</i>odenis et</a></li>
                               
                                </ul>

                            </td>
                        </tr>
                    @endforeach


                </tbody>
            </table>

            {{ $credits->render('custompagination') }}
        @endif

<script>
function showCustomer(id) {
    window.location.href = '/customers/show/'+id
}
</script>
    @endsection
