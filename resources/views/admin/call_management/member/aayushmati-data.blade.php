@extends('admin.include.master')
@section('title', 'Aayushmati Data')
@section('content')

    <style>
        table.table-bordered td,
        table.table-bordered th {
            border: 1px solid #dee2e6 !important;
        }
     
.dashboard-card {
    border: none;
    border-radius: 15px;
    transition: 0.3s;
}
.dashboard-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}
.card-number {
    font-size: 32px;
    font-weight: 700;
}
.view-btn {
    border-radius: 30px;
    padding: 6px 18px;
    font-size: 14px;
}

.card {
    transition: 0.3s ease;
}
.card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.2);
}
</style>

    <div style="background:linear-gradient(45deg,#f33057,rgb(56,88,249));"
        class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
        <div>
            <h4 class="fw-medium mb-2">{{ $page_title }}</h4>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">{{ $page_title }}</li>
                <li class="breadcrumb-item active">Members</li>
            </ol>
        </div>
    </div>

    <div class="main-content app-content">
        <div class="container-fluid">
            <div class="card card-table">

                <div class="card-header">
                    <h5 class="card-title">Aayushmati Data</h5>
                </div>

                <div class="card-body">

                   @php
						$labels = [
							0 => '15 Days (Current Month)',
							1 => '30 Days (Next Month)',
							2 => '60 Days',
							3 => '90 Days'
						];

						$colors = [
							0 => 'linear-gradient(45deg, #4e73df, #224abe)', // Blue
							1 => 'linear-gradient(45deg, #1cc88a, #13855c)', // Green
							2 => 'linear-gradient(45deg, #f6c23e, #dda20a)', // Yellow
							3 => 'linear-gradient(45deg, #e74a3b, #be2617)', // Red
						];
					@endphp

					<div class="row">

					@foreach($labels as $offset => $label)

					<div class="col-md-3 mb-4">
						<div class="card shadow text-center p-4 border-0 rounded-4 text-white"
							 style="background: {{ $colors[$offset] }};">

							<h6 class="mb-2">{{ $label }}</h6>

							<h2 class="fw-bold">{{ $counts[$offset] ?? 0 }}</h2>

							<a href="{{ route('admin.upcomingaayushmati.month',$offset) }}" 
							   class="btn btn-light btn-sm mt-3 px-4 rounded-pill">
							   View
							</a>

						</div>
					</div>

					@endforeach

					</div>




                     

                </div>
            </div>
        </div>
    </div>
     

    <script>
        function fetchMembers(page = 1) {
            $.ajax({
                url: "{{ route('admin.member.list') }}",
                type: "GET",
                data: {
                    page: page,
                    membership_number: $('#membership_number').val(),
                    name: $('#name').val(),
                    mobile: $('#mobile').val(),
                    status: $('#status').val()
                },
                success: function (data) {
                    $('#member-table').html(data);
                }
            });
        }

        $(document).on('click', '.pagination a', function (e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            fetchMembers(page);
        });

        $('#membership_number, #name, #mobile').on('keyup', function () {
            fetchMembers();
        });
        $('#status').on('change', function () {
            fetchMembers();
        });

        $('#resetFilter').on('click', function () {
            $('#membership_number,#name,#mobile').val('');
            $('#status').val('');
            fetchMembers();
        });
        $(document).on('click', '.openCallModal', function () {

            let memberId = $(this).data('id');
            let memberName = $(this).data('name');

            $('#member_id').val(memberId);
            $('#member_name').text(memberName);

        });
    </script>

@endsection