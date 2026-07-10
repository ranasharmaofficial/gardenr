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
        
		
		.serial_no {
            position: absolute;
            top: 20px;
            left: 75px;
            font-size: 14px;
            font-weight: bold;
        }

        .enroll_no {
            position: absolute;
            top: 20px;
            right: 44px;
            font-size: 14px;
            font-weight: bold;
        }

        .name {
            position: absolute;
            top: 404px;
            left: 240px;
            font-size: 18px;
            font-weight: bold;
        }

        .father_name {
            position: absolute;
            top: 404px;
            left: 501px;
            font-size: 16px;
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
            bottom: 290px;
            left: 160px;
            font-size: 14px;
        }

        .enrollment_no_bottom {
            position: absolute;
            bottom: 250px;
            left: 160px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <img src="{{ static_asset('assets/assets_web/certificate/certificate_template.jpg')}}" class="bg-img">
        
           <div class="serial_no">11001155</div>
        <div class="enroll_no">ENR-2025-0024</div>
        <div class="name">Rahul Kumar</div>
        <div class="father_name">S/D/o: Mohan Kumar</div>
        <div class="session">2024</div>
        <div class="session_to">2025</div>
        <div class="enrollment_no_bottom">ENR-2025-0024</div>
        <div class="date_issue">16-04-2025</div>
         

       
    </div>
</body>
</html>