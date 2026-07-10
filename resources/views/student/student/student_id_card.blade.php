@extends('student.include.master')
@section('title', 'Student Id Card')
@section('content')



<style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background:none;
    }

    .id-card {
      width: 750px; /* Set your custom width */
      height: 450px; /* Set your custom height */
      background-image: url({{ static_asset('assets/assets_web/certificate/id_card_template.jpg') }}); /* Replace with your image */
      background-size: cover;
      background-position: center;
      border: 2px solid #333;
      border-radius: 10px;
     /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);*/
      overflow: hidden;
      margin: 40px auto;
      position: relative;
    }

    .content {
      position: absolute;
      bottom: 20px;
      left: 20px;
      color: #fff;
    }

   

    .details {
      font-size: 14px;
    }
    
    .name
    {
    margin-top: -382px;
    position: absolute;
    margin-left: 488px;
    width: 305px;
    font-size: 16px;
    color: #000;
    }
    
     .name1
    {
       margin-top: -342px;
    position: absolute;
    margin-left: 418px;
    width: 305px;
    font-size: 16px;
    color: #000;
}
    
    
      .name2
    {
        margin-top: -310px !important;
    position: absolute;
    margin-left: 418px;
    width: 305px;
    font-size: 16px;
    color: #000;
    }
    
       .name3
    {
       margin-top: -274px !important;
    position: absolute;
    margin-left: 418px;
    width: 305px;
    font-size: 16px;
    color: #000;
    }
    
        .name4
    {
       margin-top: -230px !important;
    position: absolute;
    margin-left: 418px;
    width: 305px;
    font-size: 16px;
    color: #000;
    }
    
         .name5
    {
        margin-top: -197px !important;
        position: absolute;
        margin-left: 418px;
        width: 463px;
        font-size: 16px;
        color: #000;
        font-weight:500 !important;
    }
    
         .addresss
    {
        margin-top: -156px !important;
        position: absolute;
        margin-left: 418px;
        width: 463px;
        font-size: 16px;
        line-height:10px!important;
        color: #000;
        font-weight:500 !important;
    }
    
          .name6
    {
        margin-top: -218px !important;
    position: absolute;
   margin-left: 518px;
    width: 305px;
    font-size: 16px;
    color: #000;
    }
    
           .name8
    {
       margin-top: -198px !important;
    position: absolute;
    margin-left: 215px;
    width: 305px;
    font-size: 16px;
    color: #000;
    }
    
            .name9
    {
       margin-top: -198px !important;
    position: absolute;
    margin-left: 359px;
    width: 305px;
    font-size: 16px;
    color: #000;
    }
    
              .name10
    {
       margin-top: -145px !important;
    position: absolute;
    margin-left: 175px;
    width: 305px;
    font-size: 19px;
    color: #000;
    }
    
      .name7
    {
        margin-top: -301px !important;
    position: absolute;
    margin-left: 39px;
  
    }
    
    .name11
    {
        margin-top: -191px !important;
    position: absolute;
    margin-left: 120px;
  
    }
        .responsive-image {
  height: 164px; /* Fixed height */
  width: auto;   /* Auto width to maintain aspect ratio */
  object-fit: cover; /* Ensures image covers the container nicely */
  border: 3px solid #8a8a8a; /* Optional: matches the gray border in your original */
}
  </style>
  
  
<!-- Page Header -->
            <div style="background:linear-gradient(45deg, #f33057, rgb( 56, 88, 249 ) );"  class="d-sm-flex d-block align-items-center justify-content-between page-header-breadcrumb">
                <div>
                    <h4 class="fw-medium mb-2">Student</h4>
                    <div class="ms-sm-1 ms-0">
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Student</a></li>
                                <li class="breadcrumb-item active fw-normal" aria-current="page">Profile Details</li>
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
                            <div class="card-header">
                                <div class="card-title">
                                    Profile Details
                                </div>
								{{--<a style="right: 5px;position: absolute;float: right;" href="{{ url('admin/add-subcourse') }}" class="btn btn-danger-light btn-wave btn-sm float-right">Add Sub Course</a>--}}
                            </div>
                            <div class="card-body">
								<div class="table-responsive">
									<table id="responsiveDataTabless" class="table table-bordered text-nowrap mt-3" style="width:100%">
										<thead>
											<tr>
												<th scope="col">Enrollment Number</th>
												<th scope="col">DOB</th>
												<th scope="col">English Name</th>
												<th scope="col">Course</th>
												<th scope="col">Mobile</th>
												 
												<th scope="col" class="text-right">Id Card</th>
											</tr>
										</thead>
										<tbody>

											@php
												$state = \App\Models\State::where('id', $student_list->state)->first();
												$courseName = \App\Models\Course::where('id', $student_list->course_id)->pluck('courseTitle')->first();
												$SubCourseName = \App\Models\SubCourse::where('id', $student_list->subcourse_id)->pluck('title')->first();
													$franchiseDetails = \App\Models\User::where('id', $student_list->franchise_id)->first();
											@endphp
											<tr>
												<td>{{ $student_list->enrollment_number }}</td>
												<td>{{ date('d-M-Y', strtotime($student_list->dob)) }}</td>
												<td>{{ $student_list->english_name }}</td>
												<td>
													<p><strong>Course:</strong>&nbsp;&nbsp;&nbsp;{{ $courseName }}</p> 
													<p><strong>Sub Course:</strong>&nbsp;&nbsp;&nbsp;{{ $SubCourseName }}</p> 
												</td>
												 
												<td>{{ $student_list->mobile }}</td>
												 
												<td>
                                                    <a class="btn btn-primary btn-sm" onclick="downloadCard({{ $student_list->id }}, '{{ $student_list->english_name }}')">Download&nbsp;ID&nbsp;Card</a>
                                                </td>
											</tr>
												<!-- HIDDEN ID CARD FOR DOWNLOAD -->
<div style="visibility:hidden; position:absolute; left:-9999px;">
    <div class="id-card" id="idCard-{{ $student_list->id }}">
        <div class="content">
            <div class="name">{{ $student_list->enrollment_number }}</div>
            <div class="name1">{{ $student_list->english_name }}</div>
            <div class="name2">{{ $student_list->fathers_name }}</div>
            <div class="name3">{{ $SubCourseName }}</div>
            <div class="name4">{{ $student_list->mobile }}</div>
            <div class="name5">{{ $franchiseDetails->institute_name }}</div>
            <div class="addresss">{{ $student_list->name_address_guardian }}</div>
				{{--<div class="name6">{{ $student_list->mobile }}</div> addresss  --}}
            <div class="name7"><img src="{{ static_asset('uploads/tender/'.$student_list->image) }}" class="responsive-image" crossorigin="anonymous"></div>
             {{--<div class="name11"><img src="https://icvt.org.in/public/assets/assets_web/certificate/sign.png"></div>--}}
            
        </div>
    </div>
</div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
function downloadCard(id, name) {
    const card = document.getElementById('idCard-' + id);
    card.style.visibility = 'visible';
    card.style.position = 'static'; // reset off-screen positioning

    const images = card.querySelectorAll('img');
	const promises = [];

	images.forEach((img) => {
		if (!img.complete) {
			promises.push(new Promise(resolve => {
				img.onload = img.onerror = resolve;
			}));
		}
	});

	Promise.all(promises).then(() => {
		html2canvas(card).then(canvas => {
			const link = document.createElement('a');
			link.download = `${name.replace(/\s+/g, '_')}_ID_Card.png`;
			link.href = canvas.toDataURL('image/png');
			link.click();

			card.style.visibility = 'hidden';
			card.style.position = 'absolute';
			card.style.left = '-9999px';
		});
	});
}

	
</script>	

@endsection

