@extends('admin.include.master')
@section('title', $page_title)

@section('content')
<style>
    .remark-wrap {
        white-space: normal !important;
        word-wrap: break-word;
        word-break: break-word;
        max-width: 300px;   /* adjust as needed */
    }
</style>


    <div style="background:linear-gradient(45deg,#f33057,rgb(56,88,249));"
        class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">

        <div>
            <h4 class="fw-medium mb-2">Wallet Transactions</h4>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.vivahMitraIncentive') }}">Incentive</a>
                </li>
                <li class="breadcrumb-item active">Details</li>
                <li class="breadcrumb-item active">
                    {{ $user->first_name ?? '-' }}
                </li>
            </ol>
        </div>

    </div>

    <div class="main-content app-content">
        <div class="container-fluid">

            <div class="card mt-3">
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-3">
                            <strong>Name</strong>
                            <p class="mb-0">{{ $user->first_name ?? '-' }}</p>
                        </div>

                        <div class="col-md-3">
                            <strong>Mobile</strong>
                            <p class="mb-0">{{ $user->mobile ?? '-' }}</p>
                        </div>

                        <div class="col-md-3">
                            <strong>Wallet Balance</strong>
                            <p class="mb-0 text-success fw-bold">
                                ₹ {{ number_format($user->wallet_balance ?? 0, 2) }}
                            </p>
                        </div>

                        <div class="col-md-3">
                            <strong>Address</strong>
                            <p class="mb-0">{{ $user->address ?? '-' }}</p>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">Transaction History</h5>
					<a href="{{ url('admin/print-user-payment-statement/'.$wallet_id) }}" style="float:right;" class="btn btn-danger btn-sm">Print Details</a>
                </div>

                <div class="card-body table-responsive">
                    <div id="transaction-table">
                        @include(
                            'admin.staffs.incentives.vivahMitra.partials.transaction_table',
                            ['transactions' => $transactions]
                        )
                </div>
                </div>
        </div>

    </div>
        </div>

    <script>
        $(document).on('click', '.pagination a', function (e) {
        e.preventDefault();

            let page = $(this).attr('href').split('page=')[1];

            $.ajax({
                url: "{{ route('admin.vivahMitraIncentive.details', $wallet_id) }}",
                type: "GET",
                data: { page: page },
                success: function (data) {
                    $('#transaction-table').html(data);
            }
        });
    });
    </script>

@endsection
