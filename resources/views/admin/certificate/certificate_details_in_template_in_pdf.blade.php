<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Certificate</title>
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
		
		.serial_no {
            position: absolute;
            top: 17px;
            left: 685px;
            font-size: 14px;
            font-weight: bold;
        }
        

        .enroll_no {
            position: absolute;
            top: 28px;
            right: 50px;
            font-size: 14px;
            font-weight: bold;
        }

        .name {
            position: absolute;
    top: 345px;
    left: 50%;
    transform: translateX(-50%);
    font-size: 22px;
    font-weight: bold;
    text-transform: uppercase;
    text-align: center;
    white-space: nowrap;
        }

        .father_name {
           position: absolute;
            top: 414px;
            left: 318px;
            font-size: 22px;
            font-weight: bold;
        }

        .session {
           position: absolute;
            top: 544px;
            left: 346px;
            font-size: 19px;
            font-weight:600;
            font-family: "Noto Sans JP", sans-serif;
        }

        .session_to {
            position: absolute;
            top: 544px;
            left: 465px;
            font-size: 19px;
            font-weight:600;
            font-family: "Noto Sans JP", sans-serif;
        }
        .course_details{
            position: absolute;
    top: 499px;
    left: 50%;
    transform: translateX(-50%);
    font-family: "Noto Sans JP", sans-serif;
    font-size: 23px;
    text-transform: uppercase;
    font-weight: 600;
    text-align: center;
    width: 90%; /* adjust as per design */
        }
   
        .division{
             position: absolute;
            top: 695px;
            left: 304px;
            font-size: 19px;
            font-weight:bold;
            text-transform:uppercase;
        }
        .tccode{
             position: absolute;
            bottom: 288px;
            left: 180px;
            font-size: 14px;
            font-weight:bold;
        }

        .date_issue {
            position: absolute;
            bottom: 230px;
            left: 180px;
            font-size: 14px;
            font-weight:bold;
        }

        .enrollment_no_bottom {
           position: absolute;
            bottom: 260px;
            left: 180px;
            font-size: 14px;
            font-weight:bold;
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
            left: 74px;
            font-size: 14px;
            font-weight: bold;
        }
		
		
       @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap');
    </style>
   
</head>
   
</head>
<body>
	 
    <div class="certificate">
	{{--<img src="{{ $backgroundImage }}" class="bg-img">--}}
        <img src="file://{{ $backgroundImage }}" class="bg-img">
        
		@php
		// dd($result_details->session);
			$franchise_details = \App\Models\User::where('id', $result_details->franchise_id)->pluck('partner_code')->first();
			$session_details = \App\Models\Session::where('id', $result_details->session)->first();
			$student_image_path = public_path('uploads/tender/'.$result_details->image)
		@endphp
            
		 
		 @php
			//list($startYear, $endSuffix) = explode('-', $result_details->session);
			//$endYear = substr($startYear, 0, 2) . $endSuffix;
		 @endphp
			 
			  <div class="course_details">{{ $result_details->subcourse_name }}</div>
			  
			  <div class="qr_code">
				<img src="{{ $qrPath }}" width="60">
			</div>
			
			  <div class="tccode">{{$franchise_details}}</div>
			  <div class="serial_no">{{ $result_details->serial_number }}</div>
       <div class="name">{{ $result_details->english_name }}</div>
        <div class="father_name"> {{ $result_details->fathers_name }}</div>
        <div class="session">{{ $session_details->from_session }}</div>
        <div class="session_to">{{ $session_details->to_session  }}</div>
        <div class="enrollment_no_bottom">{{ $result_details->enrollment_number }}</div>
         <div class="division">{{ $result_details->result }}</div>
        <div class="date_issue">{{ date('d M, Y', strtotime($result_details->issue_date)) }}</div>
  

       
    </div>
</body>
</html>