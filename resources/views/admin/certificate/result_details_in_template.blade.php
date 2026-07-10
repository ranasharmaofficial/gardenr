<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Certificate</title>
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
    }

    th, td {
      border: 1px solid #000;
      padding: 6px 3px;
      text-align: center;
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
            top: 20px;
            left: 75px;
            font-size: 14px;
            font-weight: bold;
        }

        .enroll_no {
            position: absolute;
            top: 270px;
            right: 184px;
			font-size: 14px;
            font-weight: bold;
        }
		
		.semester_year {
            position: absolute;
            top: 250px;
            right: 210px;
			font-size: 14px;
            font-weight: bold;
        }
		
		.roll_number {
            position: absolute;
            top: 294px;
            right: 210px;
			font-size: 14px;
            font-weight: bold;
        }
		
		.examination {
            position: absolute;
            top: 190px;
            left: 385px;
            font-size: 14px;
            font-weight: bold;
        }

        .student_name {
            position: absolute;
            top: 251px;
            left: 155px;
            font-size: 14px;
            font-weight: bold;
        }

        .father_name {
            position: absolute;
            top: 272px;
            left: 155px;
            font-size: 14px;
            font-weight: bold;
        }
		
		.mother_name {
            position: absolute;
            top: 293px;
            left: 155px;
            font-size: 14px;
            font-weight: bold;
        }
		.subcourse_name {
            position: absolute;
            top: 317px;
            left: 155px;
            font-size: 14px;
            font-weight: bold;
        }
		.franchise_details {
            position: absolute;
            top: 339px;
            left: 155px;
            font-size: 14px;
            font-weight: bold;
        }

        .session {
            position: absolute;
            top: 510px;
            left: 340px;
            font-size: 16px;
        }

        .session_to {
            position: absolute;
            top: 510px;
            right: 240px;
            font-size: 16px;
        }

        .date_issue {
            position: absolute;
            bottom: 350px;
            left: 160px;
            font-size: 14px;
        }

        .enrollment_no_bottom {
            position: absolute;
            bottom: 250px;
            left: 160px;
            font-size: 14px;
        }
		
		.marksheet-table{
			position:absolute;
			top:400px;
			left:30px;
		}
    </style>
</head>
<body onload="window.print();">
    <div class="certificate">
        <img src="{{ static_asset('assets/assets_web/certificate/icvt_result_template.jpg')}}" class="bg-img">
        
		@php
			$franchise_details = \App\Models\User::where('id', $result_details->franchise_id)->pluck('partner_code')->first();
		@endphp
           <div class="serial_no">{{ $result_details->serial_number }}</div>
        <div class="enroll_no">{{ $result_details->enrollment_number }}</div>
        <div class="examination">June 2024</div>
        <div class="student_name">{{ $result_details->english_name }}</div>
        <div class="father_name">{{ $result_details->fathers_name }}</div>
        <div class="mother_name">{{ $result_details->mothers_name }}</div>
		
        <div class="subcourse_name">{{ $result_details->subcourse_name }}</div>
        <div class="franchise_details">{{ $franchise_details }}</div>
        <div class="semester_year">{{ $result_details->semester }}</div>
        <div class="roll_number">{{ $result_details->roll_number }}</div>
        
        <div class="date_issue">{{ date('d M, Y', strtotime($result_details->created_at)) }}</div>
         
		 <!-- Main Table -->
		 
		 
			<div class="marksheet-table">
				@if($result_marksheet)
					<table>
						<thead>
						  <tr class="header-top">
							<th with="70px" rowspan="2">Sub Code</th>
							<th rowspan="2">Subject Name</th>
							<th colspan="3">Marks Obtained</th>
							<th rowspan="2">Pass Marks</th>
							<th rowspan="2">Full Marks</th>
							<th rowspan="2">Grade</th>
						  </tr>
						  <tr class="sub-header">
							<th>Theory</th>
							<th>Internal</th>
							<th>Total Marks</th>
						  </tr>
						</thead>
						<tbody>
							@php
								$marks_obtained = 0;
								$full_marks = 0;
							@endphp
							@foreach($result_marksheet as $mark)
								<tr>
									<td>{{ $mark->subject_code }}</td>
									<td>{{ $mark->subject_name }}</td>
									<td>{{ $mark->marks_obtained }}</td>
									<td></td>
									<td>{{ $mark->marks_obtained }}</td>
									<td>{{ $mark->pass_marks }}</td>
									<td>{{ $mark->full_marks }}</td>
									<td>{{ $mark->grade }}</td>
								</tr>
								@php
									$marks_obtained = $marks_obtained+$mark->marks_obtained;
									$full_marks = $full_marks+$mark->full_marks;
								@endphp
								@php
									$percentage = ($full_marks > 0) ? ($marks_obtained / $full_marks) * 100 : 0;
								@endphp
							@endforeach
						 
						  
						  <tr>
							<td colspan="4" class="left-align"><strong>Total</strong></td>
							<td><strong>{{ $marks_obtained }}</strong></td>
							<td></td>
							<td><strong>{{ $full_marks }}</strong></td>
							<td></td>
						  </tr>
						  
						</tbody>
					  </table>

					  <!-- Result Row -->
					  <table style="margin-top: 8px;">
						<tr class="footer-row">
						  <td colspan="4">Result : <strong>FIRST DIVISION</strong></td>
						  <td colspan="2">TOTAL: {{ $marks_obtained }}</td>
						  <td colspan="2">PERCENT: {{$percentage}}%</td>
						</tr>
						@php
			
						@endphp
						<tr class="footer-row">
						  <td colspan="2">IN WORDS :</td>
						  <td colspan="6">{{ numberToWords($marks_obtained) }} OUT OF {{ numberToWords($full_marks) }}</td>
						</tr>
					  </table>

					  <!-- Final Footer Table -->
					  <table style="margin-top: 8px;">
						<tr class="final-row">
						  <th>SEMESTER - I</th>
						  <th>SEMESTER - II</th>
						  <th>GRAND TOTAL</th>
						  <th colspan="5">AGGREGATE %</th>
						</tr>
						<tr>
						  <td>---</td>
						  <td>---</td>
						  <td>---</td>
						  <td colspan="5">---</td>
						</tr>
					  </table>
				@endif
			</div>
  

       
    </div>
</body>
</html>