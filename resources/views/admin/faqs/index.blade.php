@extends('admin.include.master')
@section('title', 'FAQ List')
@section('content')

<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <a class="btn btn-primary float-right" href="{{ url('admin/faqs/create') }}">Add New FAQ</a>
                    <div class="breadcrumb mt-3 border-bottom pb-2">
                        <a href="{{ url('') }}"><i class="fa fa-home" aria-hidden="true"></i> Home</a>/FAQ
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card card-table">
                    <div class="card-body booking_card">

                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="card-title float-left mt-2">FAQ List</h4>
                            </div>
                        </div>

                        <form method="GET" class="form">
                            <div class="row">
                                <div class="col-md-3">
                                    <select class="form-control" name="type" id="type">
                                        <option value="">Select Type</option>
                                        <option value="0" @if($request->type == 0) selected @endif>Common</option>
                                        <option value="1" @if($request->type == 1) selected @endif>Product</option>
                                        <option value="2" @if($request->type == 2) selected @endif>Service</option>
                                    </select>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
                                </div>

                                <div class="col-md-3">
                                    <select class="form-control" name="category" id="category_id">
                                        <option value="">Select Category</option>
                                    </select> 
                                </div>

                                <div class="col-md-3">
                                    <input type="text" class="form-control" name="search" placeholder="Search Title" value="@isset($request->search){{$request->search}}@endisset">
                                </div>

                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-danger"> Search </button>
                                    <a href="{{ url('admin/faqs') }}" class="btn btn-warning"> Reset </a>
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table id="hotel_table" class="table table-stripped table table-hover table-center mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Type</th>
                                        <th>Category</th>
                                        <th>Question</th>
                                        <th>Answer</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($faqs as $key => $value)
									@php
										$cat_name = \App\Models\FaqCategory::where('id', $value->faq_category)->first();
									@endphp
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>@if($value->faq_type==1)
												Product
											@elseif($value->faq_type==2)
												Service
											@elseif($value->faq_type==0)
												Common
											@endif
											 
                                        <td>{{ $cat_name->name }}</td>
                                        <td>{{ $value->question }}</td>
                                        <td>{!! $value->answer !!}</td>
                                        <td>
                                            <div class="actions"> @if($value->status == 1) <a href="#" class="btn btn-sm bg-success-light mr-2">Active</a> @else <a href="#" class="btn btn-sm bg-danger-light mr-2">Inactive</a> @endif </div>
                                        </td>
                                        <td>{{ convert_datetime_to_date_format($value->created_at, 'd M Y') }}</td>
                                        <td class="text-right">
                                            <div class="dropdown dropdown-action"> 
                                                <a class="text-primary" href="{{ route('admin.faqs.edit',$value->id) }}"><i class="fas fa-pencil-alt m-r-5"></i> Edit</a>
                                                <a class="text-danger" onclick="return confirm('Are you sure, you want to delete this?')" href="{{route('admin.faqs.delete',$value->id)}}"><i class="fas fa-trash-alt m-r-5"></i>Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="pagination">
                                {{ $faqs->appends(request()->input())->links() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
		$(document).ready(function () {
            var idType = "{{$request->type}}";
            getFaqs(idType);

            $('#type').on('change', function () {
                var idType = this.value;
                console.log(idType);
				getFaqs(idType);
            });

            function getFaqs(idType){
                $("#category_id").html('');
                $.ajax({
                    url: "{{ route('admin.fetch_faq_category')}}",
                    type: "POST",
                    data: {
                        faq_type: idType,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',

                    success: function (result) {
                        console.log(result);
                        $('#category_id').html('<option value="">Choose Section</option>');
                        $.each(result.categories, function (key, value) {
                            if(value.id == "{{$request->category}}"){
                                var output = '<option value="' + value.id + '" selected>' + value.name + '</option>';
                            }else{
                                var output = '<option value="' + value.id + '">' + value.name + '</option>';
                            }
                            $("#category_id").append(output);
                        });
                    }
                });
            }
        });

        
        
    </script>
@endsection

