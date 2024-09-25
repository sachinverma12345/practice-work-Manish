<x-app-layout>
    <a href="{{ route('loan_details.process') }}" class="btn btn-primary" style="float: right; margin-right:151px">Process
        Data</a>
    <div class="py-12">
        <div class="content">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close btn-outline" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered text-center">
                    @if (blank($emiDetails))
                        <p>No EMI details found.</p>
                    @else
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    @foreach ($columns as $column)
                                        <th>{{ ucfirst(str_replace('_', ' ', $column)) }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($emiDetails as $emi)
                                    <tr>
                                        @foreach ($columns as $column)
                                            <td>{{ $emi->$column }}</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
