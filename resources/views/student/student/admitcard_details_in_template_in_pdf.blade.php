<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Admit Card</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }
        .certificate {
            position: relative;
            width: 100%;
            height: 100%;
        }
        .bg-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            z-index: -1;
        }

		 table {
      width: 100%;
      border-collapse: collapse;
      font-size: 13px;
      position:absolute;
      top:-1px;
    }

    th, td {
      border: 1px solid #000;
      padding: 2px 3px;
      text-align: left;
    }

    th[colspan], td[colspan] {
      text-align: center;
    }

    .header-top th {
      background-color: #f2dede;
      font-weight: bold;
    }

    .sub-header th {
      background-color: #f9e6e6;
      font-weight: bold;
    }

    .left-align {
      text-align: left;
    }

    .footer-row td {
      font-weight: bold;
      text-align: left;
      padding-left: 8px;
    }

    .final-row th {
      background-color: #f2dede;
    }


		.serial_no {
            position: absolute;
            top: 104px;
            left: 580px;
            font-size: 12px;
            font-weight: bold;
        }

        .enroll_no {
            position: absolute;
            top: 135px;
            left: 242px;
			font-size: 12px;
            font-weight: bold;
        }
         .name_of_academy{
            position: absolute;
            top: 160px;
            left: 242px;
            font-size: 12px;
            font-weight: bold;
            text-transform:uppercase;
        }
        .subcourse_name {
            position: absolute;
            top: 186px;
            left: 242px;
            font-size: 12px;
            font-weight: bold;
        }
        .student_name {
            position: absolute;
            top: 212px;
            left: 242px;
            font-size: 12px;
            font-weight: bold;
        }

        .father_name {
            position: absolute;
            top: 237px;
            left: 242px;
            font-size: 12px;
            font-weight: bold;
        }
        .date_of_birth{
            position: absolute;
            top: 262px;
            left: 242px;
            font-size: 12px;
            font-weight: bold;
        }
         .mode_exame{
            position: absolute;
            top: 299px;
            left: 242px;
			font-size: 12px;
            font-weight: bold;
            text-transform:uppercase;

        }
        	.roll_number {
            position: absolute;
            top: 322px;
            left: 242px;
			font-size: 12px;
            font-weight: bold;
        }
        .franchise_details {
            position: absolute;
            top: 346px;
            left: 242px;
			font-size: 12px;
            font-weight: bold;
            text-transform:uppercase;
        }
        


		.semester_year {
            position: absolute;
            top: 248px;
            right: 220px;
			font-size: 12px;
            font-weight: bold;
        }

	
        
        
        
        
        
       

		.student_image {
            position: absolute;
            top: 121px;
            right: 20px;
			font-size: 12px;
            font-weight: bold;
        }

		.examination {
            position: absolute;
            top: 180px;
            left: 242px;
            font-size: 12px;
            font-weight: bold;
        }
       

        
        
		.mother_name {
            position: absolute;
            top: 289px;
            left: 143px;
            font-size: 12px;
            font-weight: bold;
        }
		
		.franchise_detailsss {
            position: absolute;
            top: 320px;
            left: 242px;
            font-size: 12px;
            font-weight: bold;
        }

        .session {
            position: absolute;
            top: 4940px;
            left: 340px;
            font-size: 14px;
        }

        .session_to {
            position: absolute;
            top: 510px;
            right: 240px;
            font-size: 14px;
        }

        .date_issue {
            position: absolute;
            bottom: 290px;
            left: 120px;
            font-size: 12px;
        }

        .enrollment_no_bottom {
            position: absolute;
            bottom: 250px;
            left: 242px;
            font-size: 12px;
        }

		.marksheet-table{
			position:absolute;
			top:415px;
			left:30px;
		}
    </style>
</head>
<body>
	@php
		//dd($backgroundImage);
	@endphp
    <div class="certificate">
	{{--<img src="{{ $backgroundImage }}" class="bg-img">--}}
        <img src="file://{{ $backgroundImage }}" class="bg-img">

		@php
			$franchise_details = \App\Models\User::where('id', $student_details->franchise_id)->first();
			$student_image_path = public_path('uploads/tender/'.$student_details->image)
		@endphp
           <div class="serial_no">{{ $student_details->serial_number }}</div>
        <div class="enroll_no">{{ $student_details->enrollment_number }}</div>
        <div class="name_of_academy">{{ $course_details->courseTitle }}</div>

        <div class="student_name">{{ $student_details->english_name }}</div>
        <div class="father_name">{{ $student_details->fathers_name }}</div>
        {{--<div class="mother_name">{{ $student_details->mothers_name }}</div>--}}
        <div class="date_of_birth">{{ date('d M, Y', strtotime($student_details->dob))  }}</div>
         <div class="mode_exame">{{ $check_admit_card->exam_type }}</div>

        <div class="subcourse_name">{{ $subcourse_details->title }}</div>

        <div class="semester_year">{{ $student_details->semester }}</div>
        <div class="roll_number">{{ $student_details->roll_number }}</div>
        <div class="franchise_details">{{ $franchise_details->institute_name }}</div>

        {{-- <div class="date_issue">{{ date('d M, Y', strtotime($student_details->created_at)) }}</div> --}}
        <div class="student_image"><img style="height:160px;width:auto;" src="file://{{ $student_image_path }}"></div>

		 <!-- Main Table -->


			<div class="marksheet-table">
				@if($check_admit_card)
					@php
						$admit_card_subjects = \App\Models\AdmitCardSubject::where('admit_card_id', $check_admit_card->id)->get()
					@endphp
					<table class="table" id="marks-table">

						<tbody>

							@if($admit_card_subjects)
								@foreach($admit_card_subjects as $subject)
											<tr>
												<td width="110px">{{ date('d M, Y', strtotime($subject->exam_date)) }}</td>
												<td width="120px">{{ $subject->exam_time }}</td>
												<td width="120px">{{ $subject->subject_code }}</td>
												<td width="265px">{{ $subject->subject_name }}</td>
											</tr>
								@endforeach
							@endif
						</tbody>
					</table>
				@endif
			</div>



    </div>
</body>
</html>
