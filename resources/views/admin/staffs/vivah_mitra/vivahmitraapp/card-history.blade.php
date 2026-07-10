@extends('admin.include.master')
@section('title', 'Card History')

@section('content')


    <style>
        .stat-card {
            border-radius: 12px;
            padding: 20px;
            color: #fff;
            position: relative;
            overflow: hidden;
            transition: 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .stat-icon {
            font-size: 40px;
            opacity: 0.3;
            position: absolute;
            right: 20px;
            bottom: 10px;
        }

        .stat-title {
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 8px;
            opacity: 0.9;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
        }
    </style>


    <div style="background:linear-gradient(45deg,#f33057,rgb(56,88,249));"
        class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">

        <div>
            <h4 class="fw-medium mb-2">Card Transactions</h4>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">Card Management</li>
                <li class="breadcrumb-item active">History</li>
                <li class="breadcrumb-item active">
                    {{ $user->first_name ?? '-' }}
                </li>
            </ol>
        </div>
    </div>

    <div class="main-content app-content">
        <div class="container-fluid">

            <div class="row mt-4 mb-4">

                <div class="col-md-4">
                    <div class="stat-card" style="background: linear-gradient(45deg,#4e73df,#224abe);">
                        <div class="stat-title">Current User Stock</div>
                        <div class="stat-value">{{ $userStock->quantity ?? 0 }}</div>
                        <i class="fas fa-id-card stat-icon"></i>
                    </div>
                </div>

                {{-- <div class="col-md-4">
                    <div class="stat-card" style="background: linear-gradient(45deg,#1cc88a,#13855c);">
                        <div class="stat-title">Total Cards (All Users)</div>
                        <div class="stat-value">{{ $totalCards }}</div>
                        <i class="fas fa-layer-group stat-icon"></i>
                    </div>
                </div> --}}

                {{-- <div class="col-md-4">
                    <div class="stat-card" style="background: linear-gradient(45deg,#858796,#60616f);">
                        <div class="stat-title">Users Having Stock</div>
                        <div class="stat-value">{{ $totalUsersWithStock }}</div>
                        <i class="fas fa-users stat-icon"></i>
                    </div>
                </div> --}}

            </div>


            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        Transaction History of {{ $user->first_name ?? '-' }}
                    </h5>
                </div>

                <div class="card-body">
                    <div id="card-history-table">
                        @include('admin.staffs.vivah_mitra.vivahmitra.history_table', ['transactions' => $transactions])
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

<script>
    $(document).on('click', '#card-history-table .pagination a', function (e) {
        e.preventDefault();

        let url = $(this).attr('href');

        $.ajax({
            url: url,
            type: "GET",
            success: function (data) {
                $('#card-history-table').html(data);
            }
        });
    });
</script>