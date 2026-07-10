<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Result</title>
 <style>
        @page {
            size: A4;
            margin: 0;
        }

        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }

        .certificate {
            position: relative;
            width: 100%;
            height: 100vh;
            page-break-after: avoid;
        }

        .bg-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }
		
		 table {
      width: 110%;
      border-collapse: collapse;
      font-size: 13px;
    }

    th, td {
      border: 1px solid #000;
      padding: 2px 3px;
      text-align: center;
    }

    th[colspan], td[colspan] {
      text-align: center;
    }

    .header-top th {
      background-color: transparent;
      font-weight: bold;
    }

    .sub-header th {
     background-color: transparent;
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
      background-color: transparent;
    }
        
		
		.serial_no {
            position: absolute;
            top: 17px;
            left: 685px;
            font-size: 13px;
            font-weight: bold;
        }
		.semester_year {
            position: absolute;
            top: 293px;
            left: 500px;
			font-size: 13px;
            font-weight: bold;
            text-transform:uppercase;
        }
		 .enroll_no {
            position: absolute;
            top: 328px;
            left: 500px;
			font-size: 13px;
            font-weight: bold;
        }
		.roll_number {
            position: absolute;
            top: 362px;
            left: 500px;
			font-size: 13px;
            font-weight: bold;
        }
		
		.student_image {
            position: absolute;
            top: 254px;
            right: 24px;
			font-size: 13px;
            font-weight: bold;
        }
		
		.examination {
            position: absolute;
            top: 236px;
            left: 385px;
            font-size: 15px;
            font-weight: bold;
        }

        .student_name {
            position: absolute;
            top: 293px;
            left: 157px;
            font-size: 13px;
            font-weight: bold;
            text-transform:uppercase;
        }

        .father_name {
            position: absolute;
            top: 328px;
            left: 157px;
            font-size: 13px;
            font-weight: bold;
        }
		
		.mother_name {
            position: absolute;
            top: 363px;
            left: 157px;
            font-size: 13px;
            font-weight: bold;
            text-transform:uppercase;
        }
		.subcourse_name {
            position: absolute;
            top: 397px;
            left: 157px;
            font-size: 13px;
            font-weight: bold;
            text-transform:uppercase;
        }
		.franchise_details {
            position: absolute;
            top: 432px;
            left: 157px;
            font-size: 13px;
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
            bottom: 175px;
            left: 124px;
            font-size: 13px;
        }

        .enrollment_no_bottom {
            position: absolute;
            bottom: 250px;
            left: 160px;
            font-size: 12px;
        }
		
		.marksheet-table{
			position:absolute;
			top:640px;
			left:170px;
			width:50%px;
			
		}
		 @media print {
            html, body {
                width: 100%;
                height: 100%;
            }

            .certificate {
                height: 100vh;
                page-break-after: avoid;
            }

            .bg-img {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }
        }
   .qr_code {
            position: absolute;
            bottom: 90px;
            left: 374px;
            font-size: 14px;
            font-weight: bold;
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
			$franchise_details = \App\Models\User::where('id', $result_details->franchise_id)->pluck('partner_code')->first();
			$student_image_path = public_path('uploads/tender/'.$result_details->image)
		@endphp
		
		
           <div class="serial_no">{{ $result_details->serial_number }}</div>
        <div class="enroll_no">{{ $result_details->enrollment_number }}</div>
        <div class="examination">{{ $result_details->examination }}</div>
        <div class="student_name">{{ $result_details->english_name }}</div>
        <div class="father_name">{{ $result_details->fathers_name }}</div>
        <div class="mother_name">{{ $result_details->mothers_name }}</div>
		
        <div class="subcourse_name">{{ $result_details->subcourse_name }}</div>
        <div class="franchise_details">{{ $franchise_details }}</div>
        <div class="semester_year">{{ $result_details->semester }}</div>
        <div class="roll_number">{{ $result_details->roll_number }}</div>
        
        <div class="date_issue">{{ date('d M, Y', strtotime($result_details->issue_date)) }}</div>
        <div class="student_image"><img style="height:120px;width:108px; border-radius:10px;" src="file://{{ $student_image_path }}"></div>
         
		 <!-- Main Table -->
		 
		 
			 <div class="qr_code">
				<img src="{{ $qrPath }}" width="60">
			</div>
		 <div class="marksheet-table">
			 <table>
				<tr>
				  <th>EXAMINATION</th>
				  <th>TOTAL MARKS</th>
				  <th>MARKS OBTAINED</th>
				</tr>
				@php
				$total_full_marks = 0;
				$total_marks_obtained = 0;
			@endphp

			@foreach($result_marksheet as $val)
				<tr>
					<td>{{ $val->subject_name }}</td>
					<td>{{ $val->full_marks }}</td>
					<td>{{ $val->marks_obtained }}</td>
				</tr>
				 @php
					// Add each subject's marks to total
					$total_full_marks += $val->full_marks;
					$total_marks_obtained += $val->marks_obtained;
				@endphp
			@endforeach

			<tr class="total-row">
				<td><strong>Total:</strong></td>
				<td><strong>{{ $total_full_marks }}</strong></td>
				<td><strong>{{ $total_marks_obtained }}</strong></td>
			</tr>
 
			  </table>

			  <div class="footer">
				<p><strong>PERCENTAGE:</strong> {{ $result_details->total_percentage }} &nbsp;&nbsp; <strong>MARKS OBTAINED:</strong> {{ $result_details->remarks }}</p>

				<table class="grade-table">
				  <tr><td><strong>DISTRIBUTION OF GRADES/MARKS</strong></td></tr>
				  <tr><td>EXCELLENT : 85%–100% &nbsp; || &nbsp; VERY GOOD : 70%–84%</td></tr>
				  <tr><td>GOOD : 55%–69% &nbsp; || &nbsp; SATISFACTORY : 40%–54%</td></tr>
				  <tr><td>FAIL : BELOW 40%</td></tr>
				</table>
			  </div>
			</div>
  

       
    </div>
</body>
</html>