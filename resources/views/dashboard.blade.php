<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Total User</h5>
                        </div>
                        <div class="card-body">
                            {{filled($userCount) ? $userCount : 0}}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">Loan Details Toal Amount</h5>
                        </div>
                        <div class="card-body">
                            {{filled($loanCount) ? $loanCount : 0}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
