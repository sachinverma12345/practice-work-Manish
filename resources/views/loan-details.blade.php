<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="content">
            <table class="table table-bordered text-center">
                <thead>
                    <th>Id</th><th>Client ID</th><th>Num of Payment</th><th>First Payment Date</th><th>Last Payment Date</th><th>Loan Amount</th>
                </thead>
                <tbody>
                    @if(blank($loans))
                    <tr><td colspan="6">
                    No records found    
                    </td></tr>
                    @else
                    @foreach ($loans as $key=>$loan)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$loan->clientid}}</td>
                        <td>{{$loan->num_of_payment}}</td>
                        <td>{{$loan->first_payment_date}}</td>
                        <td>{{$loan->last_payment_date}}</td>
                        <td>{{$loan->loan_amount}}</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
