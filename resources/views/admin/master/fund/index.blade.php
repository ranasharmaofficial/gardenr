@extends('admin.include.master')
@section('title') {{ $page_title }} @endsection
@section('content')
<style>
    .fund-card {
        padding: 22px;
        border-radius: 15px;
        color: #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        transition: 0.3s;
    }
    .fund-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 18px rgba(0,0,0,0.25);
    }
    .credit-bg {
        background: linear-gradient(135deg, #28a745, #56d47d);
    }
    .debit-bg {
        background: linear-gradient(135deg, #dc3545, #ff6b81);
    }
    .fund-bg {
        background: linear-gradient(135deg, #007bff, #4dabff);
    }
    .fund-icon {
        font-size: 40px;
        opacity: 0.9;
    }
</style>
			<!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );" class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">{{ $page_title }}</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a class="" href="javascript:void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item  active fw-normal" aria-current="page">{{ $page_title }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>

            </div>
            <!-- Page Header Close -->



            <!--APP-CONTENT START-->
            <div class="main-content app-content">
                <div class="container-fluid">
				<!-- Start:: row-2 -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card custom-card">
                            <div class="card-header d-flex justify-content-between align-items-center">

								<h5 class="mb-0">{{ $page_title }}</h5>

								<a href="javascript:void(0)"
								   class="btn btn-danger btn-sm float-end"
								   data-bs-toggle="modal"
								   data-bs-target="#fundModal"
								   onclick="openAddFundModal()">
								   Add Fund
								</a>



							</div>


                            <div class="card-body">
								<div class="row g-3">

    {{-- Total Credit --}}
    <div class="col-md-4">
        <div class="fund-card credit-bg text-center">
            <div class="fund-icon mb-2">💰</div>
            <h6 class="mb-1">TOTAL CREDIT</h6>
            <h3 class="fw-bold">₹{{ number_format($totalCredit, 2) }}</h3>
        </div>
    </div>

    {{-- Total Debit --}}
    <div class="col-md-4">
        <div class="fund-card debit-bg text-center">
            <div class="fund-icon mb-2">📤</div>
            <h6 class="mb-1">TOTAL DEBIT</h6>
            <h3 class="fw-bold">₹{{ number_format($totalDebit, 2) }}</h3>
        </div>
    </div>

    {{-- Total Available Fund --}}
    <div class="col-md-4">
        <div class="fund-card fund-bg text-center">
            <div class="fund-icon mb-2">🏦</div>
            <h6 class="mb-1">AVAILABLE FUND</h6>
            <h3 class="fw-bold">₹{{ number_format($companyWallet->balance, 2) }}</h3>
        </div>
    </div>

</div>
                            <div class="table-responsive">

                                <table id="" class="table table-bordered text-nowrap mt-3" style="width:100%">
                                    <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Date & Time</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Balance After</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($transactions as $index => $t)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $t->created_at->format('d-m-Y') }}</td>

                                            <td class="text-center">
                                                @if($t->type == 'credit')
                                                    <span class="badge bg-success">Credit</span>
                                                @else
                                                    <span class="badge bg-danger">Debit</span>
                                                @endif
                                            </td>

                                            <td class="text-end">₹ {{ number_format($t->amount, 2) }}</td>
                                            <td class="text-end">₹ {{ number_format($t->balance_after, 2) }}</td>
                                            <td>{{ $t->remarks }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">
                                                No transactions found.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>


                                </table>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End:: row-2 -->



                </div>
            </div>
            <!--APP-CONTENT CLOSE-->

		<div class="modal fade" id="fundModal" tabindex="-1">
		  <div class="modal-dialog">
			<div class="modal-content">

			  <div class="modal-header">
				<h5 class="modal-title" id="fundModalTitle">Add Fund</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			  </div>

			  <div class="modal-body">

				<div class="alert alert-danger d-none" id="fundError"></div>

				<form id="fundForm">

					<input type="hidden" id="fund_id">

					<div class="mb-3">
						<label class="form-label">Fund Name</label>
						<input type="text" id="fund_name" class="form-control" placeholder="Fund Name">
					</div>

					<div class="mb-3">
						<label class="form-label">Amount</label>
						<input type="number" id="fund_amount" class="form-control" placeholder="Amount (optional)">
					</div>

					<div class="mb-3">
						<label class="form-label">Type</label>
						<select id="fund_type" class="form-control">
							<option value="credit">Credit</option>
							<option value="debit">Debit</option>
						</select>
					</div>

					<div class="mb-3">
						<label class="form-label">Status</label>
						<select id="fund_status" class="form-control">
							<option value="1">Active</option>
							<option value="0">Inactive</option>
						</select>
					</div>

				</form>

			  </div>

			  <div class="modal-footer">
				<button class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
				<button class="btn btn-primary" id="saveFundBtn" onclick="saveFund()">Save</button>
				<button class="btn btn-primary" id="updateFundBtn" onclick="updateFund()" style="display:none;">Update</button>
			  </div>

			</div>
		  </div>
		</div>





<script>
function openAddFundModal() {
    $('#fund_id').val('');
    $('#fund_name').val('');
    $('#fund_amount').val('');
    $('#fund_type').val('credit');
    $('#fund_status').val('1');

    $("#fundModalTitle").text("Add Fund");
    $('#saveFundBtn').show();
    $('#updateFundBtn').hide();

    $("#fundError").addClass("d-none").html("");
}


function saveFund() {
    $("#fundError").addClass("d-none").html("");

    let btn = $("#saveFundBtn");
    let original = btn.text();

    btn.prop("disabled", true).text("Saving...");

    $.ajax({
        url: "{{ route('admin.funds.store') }}",
        type: "POST",
        data: {
            name: $('#fund_name').val(),
            amount: $('#fund_amount').val(),
            type: $('#fund_type').val(),
            status: $('#fund_status').val(),
            _token: "{{ csrf_token() }}"
        },

        success: function(res){
            btn.prop("disabled", false).text(original);

            if(res.success){
                $('#fundModal').modal('hide');

                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: res.message,
                    timer: 1500,
                    showConfirmButton: false
                });

                setTimeout(() => location.reload(), 1500);
            }
        },

        error: function(xhr){
            btn.prop("disabled", false).text(original);

            if(xhr.status === 422){
                let msg = "";
                $.each(xhr.responseJSON.errors, (k, v) => msg += v[0] + "<br>");
                $("#fundError").removeClass("d-none").html(msg);
            }
        }
    });
}


function editFund(id){
    $("#fundError").addClass("d-none").html("");

    $.ajax({
        url: "{{ url('admin/funds/edit') }}/" + id,
        type: "GET",

        success: function(res){

            $('#fund_id').val(res.id);
            $('#fund_name').val(res.name);
            $('#fund_amount').val(res.amount);
            $('#fund_type').val(res.type);
            $('#fund_status').val(res.status);

            $("#fundModalTitle").text("Edit Fund");
            $('#saveFundBtn').hide();
            $('#updateFundBtn').show();

            $('#fundModal').modal('show');
        }
    });
}


function updateFund(){

    $("#fundError").addClass("d-none").html("");

    let id = $('#fund_id').val();

    let btn = $("#updateFundBtn");
    let original = btn.text();

    btn.prop("disabled", true).text("Updating...");

    $.ajax({
        url: "{{ url('admin/funds/update') }}/" + id,
        type: "POST",
        data: {
            name: $('#fund_name').val(),
            amount: $('#fund_amount').val(),
            type: $('#fund_type').val(),
            status: $('#fund_status').val(),
            _token: "{{ csrf_token() }}"
        },

        success: function(res){
            btn.prop("disabled", false).text(original);

            if(res.success){
                $('#fundModal').modal('hide');

                Swal.fire({
                    icon: "success",
                    title: "Updated!",
                    text: res.message,
                    timer: 1500,
                    showConfirmButton: false
                });

                setTimeout(() => location.reload(), 1500);
            }
        },

        error: function(xhr){
            btn.prop("disabled", false).text(original);

            if(xhr.status === 422){
                let msg = "";
                $.each(xhr.responseJSON.errors, (k, v) => msg += v[0] + "<br>");
                $("#fundError").removeClass("d-none").html(msg);
            }
        }
    });
}


</script>




@endsection

