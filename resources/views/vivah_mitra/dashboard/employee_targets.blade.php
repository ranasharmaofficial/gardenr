@extends('vivah_mitra.layouts.master')
@section('title') Employee Target @endsection

@section('meta_tags')

@endsection
@section('content')
	<style >
	.features-box {
		background: #fff;
		border-radius: 14px;
		padding: 5px;
		box-shadow: 0 6px 14px rgba(0,0,0,0.08);
		transition: 0.3s;
		text-align: center;
	}
	
	.policy-accordion {
    max-width: 900px;
    margin: auto;
}

.accordion-item {
    background: #fff;
    border-radius: 10px;
    margin-bottom: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    overflow: hidden;
    border-left: 5px solid #007bff;
}

.accordion-header {
    padding: 15px 20px;
    cursor: pointer;
    font-weight: 600;
    position: relative;
    font-size: 16px;
    background: #f8f9fc;
}

.accordion-header .icon {
    position: absolute;
    right: 20px;
    font-size: 20px;
    font-weight: bold;
}

.accordion-body {
    display: none;
    padding: 15px 20px;
    font-size: 15px;
    color: #555;
    line-height: 1.7;
}

.accordion-item.active .accordion-body {
    display: block;
}

.accordion-item.active .icon::before {
    content: "-";
}

.icon::before {
    content: "+";
}

/* Color variants */
.blue { border-left-color: #007bff; }
.green { border-left-color: #28a745; }
.info { border-left-color: #17a2b8; }
.orange { border-left-color: #fd7e14; }
.red { border-left-color: #dc3545; }
.warning { border-left-color: #ffc107; }
	
	 
	</style >
	<!-- jQuery (ONLY ONCE) -->
 


   <!-- Header -->
    <header class="header">
        <div class="main-bar">
            <div class="container">
                <div class="header-content">
                    <div class="left-content">
                        <a href="javascript:void(0);" class="back-btn">
                            <svg width="18" height="18" viewbox="0 0 10 16" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M9.03033 0.46967C9.2966 0.735936 9.3208 1.1526 9.10295 1.44621L9.03033 1.53033L2.561 8L9.03033 14.4697C9.2966 14.7359 9.3208 15.1526 9.10295 15.4462L9.03033 15.5303C8.76406 15.7966 8.3474 15.8208 8.05379 15.6029L7.96967 15.5303L0.96967 8.53033C0.703403 8.26406 0.679197 7.8474 0.897052 7.55379L0.96967 7.46967L7.96967 0.46967C8.26256 0.176777 8.73744 0.176777 9.03033 0.46967Z" fill="#a19fa8"></path>
							</svg>
                        </a>
                    </div>
                    <div class="mid-content">
                        <h5 class="mb-0">Employee Target </h5>
                    </div>
                    <div class="right-content">
                        <a href="javascript:void(0);" class="menu-toggler">
							<svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path opacity="0.4" d="M16.0755 2H19.4615C20.8637 2 22 3.14585 22 4.55996V7.97452C22 9.38864 20.8637 10.5345 19.4615 10.5345H16.0755C14.6732 10.5345 13.537 9.38864 13.537 7.97452V4.55996C13.537 3.14585 14.6732 2 16.0755 2Z" fill="#a19fa8"></path>
								<path fill-rule="evenodd" clip-rule="evenodd" d="M4.53852 2H7.92449C9.32676 2 10.463 3.14585 10.463 4.55996V7.97452C10.463 9.38864 9.32676 10.5345 7.92449 10.5345H4.53852C3.13626 10.5345 2 9.38864 2 7.97452V4.55996C2 3.14585 3.13626 2 4.53852 2ZM4.53852 13.4655H7.92449C9.32676 13.4655 10.463 14.6114 10.463 16.0255V19.44C10.463 20.8532 9.32676 22 7.92449 22H4.53852C3.13626 22 2 20.8532 2 19.44V16.0255C2 14.6114 3.13626 13.4655 4.53852 13.4655ZM19.4615 13.4655H16.0755C14.6732 13.4655 13.537 14.6114 13.537 16.0255V19.44C13.537 20.8532 14.6732 22 16.0755 22H19.4615C20.8637 22 22 20.8532 22 19.44V16.0255C22 14.6114 20.8637 13.4655 19.4615 13.4655Z" fill="#a19fa8"></path>
							</svg>
						</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->

     @include('vivah_mitra.includes.sidebar')

    <!-- Page Content -->
    <div class="page-content">

        <div class="content-inner pt-0">
			<div class="container fb">
                 
                <div class="dashboard-area m-b30">
					<!-- Features -->
                    <div class="features-box  mt-3">
					<div class="policy-accordion">

    <h2 style="text-align:center; margin-bottom:20px;">
       कर्मचारी नियमावली (Employee Policy & Service Rules)
	</h2>
	<h2 style="text-align:center; margin-bottom:20px;">
      प्रभावी तिथि: 1 May 2026
	</h2>
	<p>यह नियमावली संस्था के सभी स्थायी, अस्थायी, संविदा, प्रोबेशनरी एवं आउटसोर्स कर्मचारियों पर समान रूप से लागू होगी। यह दस्तावेज़  (Sign) किया जाएगा।<p>
	<div class="accordion-item blue">
        <div class="accordion-header">
            भाग – 1 : सामान्य एवं कानूनी प्रावधान
            <span class="icon"></span>
        </div>
        <div style="text-align:left;" class="accordion-body">
            <p>1. नियमावली का उद्देश्य एवं दायरा</p>
			<p>2. सेवा शर्तों की स्वीकृति (Deemed Acceptance Clause)</p>
			<p>3. नियुक्ति का प्रकार (स्थायी/संविदा/प्रोबेशन)</p>
			<p>4. प्रोबेशन अवधि एवं कन्फर्मेशन नियम</p>
			<p>5. कार्यस्थल अनुशासन एवं आचार संहिता</p>
			<p>6. संस्था की नीतियों में संशोधन का अधिकार</p>
			<p>7. प्रबंधन का अंतिम निर्णय अधिकार</p>
			<p>8. गोपनीयता एवं नॉन-डिस्क्लोजर एग्रीमेंट (NDA)</p>
			<p>9. डेटा प्रोटेक्शन एवं आईटी पॉलिसी</p>
			<p>10. हितों के टकराव (Conflict of Interest) नियम</p>
			<p>11. एंटी-करप्शन एवं एंटी-फ्रॉड नीति</p>
			<p>12. POSH (कार्यस्थल पर यौन उत्पीड़न निषेध) नीति</p>
			<p>13. समान अवसर एवं भेदभाव निषेध नीति</p>
			<p>14. लागू कानूनों का अनुपालन (Labour Laws Compliance)</p>
			<p>15. विवाद समाधान एवं न्याय क्षेत्र (Jurisdiction Clause)</p>
        </div>
    </div>
	
	<div class="accordion-item blue">
        <div class="accordion-header">
            भाग – 2 : वेतन, भत्ते एवं वित्तीय नियम
            <span class="icon"></span>
        </div>
        <div style="text-align:left;" class="accordion-body">
            <p>16. वेतन संरचना (CTC / Gross / Net)</p>
			<p>17. वेतन भुगतान की तिथि एवं माध्यम</p>
			<p>18. प्रोबेशन के दौरान वेतन नियम</p>
			<p>19. इंसेंटिव स्कीम – शर्तें एवं अपवाद</p>
			<p>20. दैनिक इंसेंटिव जेनरेशन प्रक्रिया</p>
			<p>21. मासिक एवं वार्षिक इंसेंटिव नीति</p>
			<p>22. टारगेट आधारित भुगतान शर्तें</p>
			<p>23. बोनस नीति (Performance / Festival / Special)</p>
			<p>24. सेक्रेटरी मनी – पात्रता एवं उपयोग नियम</p>
			<p>25. एक्सपेंस क्लेम प्रक्रिया</p>
			<p>26. फर्जी क्लेम पर दंडात्मक कार्रवाई</p>
			<p>27. पीएफ कटौती एवं वैधानिक अंशदान</p>
			<p>28. ESI (यदि लागू हो) नियम</p>
			<p>29. टैक्स कटौती (TDS) नियम</p>
			<p>30. आवास भत्ता नीति</p>
			<p>31. मोबाइल रिचार्ज / कम्युनिकेशन अलाउंस</p>
			<p>32. यात्रा एवं फील्ड भत्ता नियम</p>
			<p>33. ओवरपेमेंट रिकवरी क्लॉज</p>
        </div>
    </div>
	
	<div class="accordion-item blue">
        <div class="accordion-header">
            भाग – 3 : कार्य प्रणाली एवं टारगेट
            <span class="icon"></span>
        </div>
        <div style="text-align:left;" class="accordion-body">
            <p>34. कार्य समय (Working Hours)</p>
			<p>35. कार्य क्षेत्र (Working Area) निर्धारण</p>
			<p>36. दैनिक कार्य लक्ष्य</p>
			<p>37. मासिक लक्ष्य</p>
			<p>38. वार्षिक लक्ष्य</p>
			<p>39. लक्ष्य मूल्यांकन प्रणाली</p>
			<p>40. ऑनलाइन रिपोर्टिंग नियम</p>
			<p>41. ऑटो मोड सिस्टम (Auto Mode System) नीति</p>
			<p>42. गलत रिपोर्टिंग पर कार्रवाई</p>
			<p>43. मंथली रूटीन एवं समीक्षा बैठक</p>
			<p>44. KPI एवं परफॉर्मेंस मैट्रिक्स</p>
			<p>45. फील्ड वर्क एवं ऑफिस वर्क नियम</p>
			<p>46. ट्रांसफर एवं कार्य क्षेत्र परिवर्तन नियम</p>
        </div>
    </div>
	
	<div class="accordion-item blue">
        <div class="accordion-header">
            भाग – 4 : प्रशिक्षण एवं विकास
            <span class="icon"></span>
        </div>
        <div style="text-align:left;" class="accordion-body">
            <p>47. अनिवार्य प्रशिक्षण नीति</p>
			<p>48. प्रारंभिक (Induction) प्रशिक्षण</p>
			<p>49. री-ट्रेनिंग एवं अपग्रेडेशन</p>
			<p>50. प्रशिक्षण फीस (यदि लागू हो)</p>
			<p>51. प्रशिक्षण उपस्थिति अनिवार्यता</p>
			<p>52. प्रशिक्षण अनुपस्थिति पर दंड</p>
			<p>53. प्रमोशन हेतु प्रशिक्षण अनिवार्यता</p>
        </div>
    </div>
	
	<div class="accordion-item blue">
        <div class="accordion-header">
            भाग – 5 : अवकाश, उपस्थिति एवं अनुशासन
            <span class="icon"></span>
        </div>
        <div style="text-align:left;" class="accordion-body">
            <p>54. उपस्थिति (Attendance) प्रणाली</p>
			<p>55. बायोमैट्रिक/ऑनलाइन अटेंडेंस नियम</p>
			<p>56. लेट मार्क एवं पेनल्टी</p>
			<p>57. अवकाश के प्रकार (CL/SL/EL)</p>
			<p>58. छुट्टी लेने की प्रक्रिया</p>
			<p>59. बिना अनुमति अनुपस्थिति (LOP)</p>
			<p>60. मेडिकल लीव नियम</p>
			<p>61. अनुशासनहीनता की श्रेणियाँ</p>
			<p>62. चेतावनी, नोटिस एवं निलंबन</p>
			<p>63. आंतरिक जांच प्रक्रिया (Domestic Enquiry)</p>
        </div>
    </div>
	
	<div class="accordion-item blue">
        <div class="accordion-header">
            भाग – 6 : प्रमोशन, सम्मान एवं लाभ
            <span class="icon"></span>
        </div>
        <div style="text-align:left;" class="accordion-body">
            <p>64. प्रमोशन क्राइटेरिया</p>
			<p>65. प्रमोशन में प्रबंधन का अधिकार</p>
			<p>66. डिमोशन एवं रोलबैक नियम</p>
			<p>67. क्वार्टरली सम्मान समारोह</p>
			<p>68. परफॉर्मेंस अवॉर्ड नीति</p>
			<p>69. ईयरली टूर क्वालीफाई नियम</p>
			<p>70. विशेष उपलब्धि सम्मान</p>
        </div>
    </div>
	
	<div class="accordion-item blue">
        <div class="accordion-header">
            भाग – 7 : प्रमोशन, सम्मान एवं लाभ
            <span class="icon"></span>
        </div>
        <div style="text-align:left;" class="accordion-body">
            <p>71. इस्तीफा देने की प्रक्रिया</p>
			<p>72. नोटिस पीरियड नियम</p>
			<p>73. सैलरी इन लियू ऑफ नोटिस</p>
			<p>74. सेवा समाप्ति के आधार</p>
			<p>75. अनुशासनात्मक बर्खास्तगी</p>
			<p>76. फुल एंड फाइनल सेटलमेंट</p>
			<p>77. कंपनी संपत्ति की वापसी</p>
			<p>78. अनुभव प्रमाण पत्र नीति</p>
			<p>79. नॉन-कम्पीट क्लॉज (यदि लागू)</p>
			<p>80. नॉन-सॉलिसिटेशन क्लॉज</p>
        </div>
    </div>
	
	<div class="accordion-item blue">
        <div class="accordion-header">
            भाग – 8 : विविध एवं अंतिम प्रावधान
            <span class="icon"></span>
        </div>
        <div style="text-align:left;" class="accordion-body">
            <p>81. आंतरिक नीतियों की प्राथमिकता</p>
			<p>82. मौखिक निर्देश अमान्य होंगे</p>
			<p>83. नियम उल्लंघन पर दंड</p>
			<p>84. आपातकालीन अधिकार प्रावधान</p>
			<p>85. डिजिटल हस्ताक्षर की मान्यता</p>
			<p>86. कर्मचारी की सहमति की घोषणा</p>
			<p>87. नियमावली की बाध्यता</p>
			<p>88. भविष्य में संशोधन का अधिकार</p>
			<p>89. लागू तिथि एवं प्रभाव</p>
			<p>90. अंतिम घोषणा</p>
        </div>
    </div>
	
	
	<h2 style="text-align:center; margin-bottom:20px;">
        🎯 लक्ष्य प्राप्ति आधारित वेतन एवं लाभ नीति
		
    </h2>
	<p>Achieve Target Details (लक्ष्य प्राप्ति विवरण)<p>

    <!-- 100% -->
    <div class="accordion-item blue">
        <div class="accordion-header">
            100% लक्ष्य प्राप्ति (Excellent Performance)
            <span class="icon"></span>
        </div>
        <div class="accordion-body">
            ✔ पूर्ण वेतन<br>
            ✔ अतिरिक्त प्रोत्साहन राशि<br>
            ✔ सभी लाभ<br>
            ✔ विशेष पुरस्कार / मान्यता
        </div>
    </div>

    <!-- 80% -->
    <div class="accordion-item green">
        <div class="accordion-header">
            80% लक्ष्य प्राप्ति (Very Good Performance)
            <span class="icon"></span>
        </div>
        <div class="accordion-body">
            ✔ पूर्ण वेतन<br>
            ✔ प्रोत्साहन<br>
            ✔ सभी सामान्य लाभ
        </div>
    </div>

    <!-- 60% -->
    <div class="accordion-item info">
        <div class="accordion-header">
            60% लक्ष्य प्राप्ति (Satisfactory Performance)
            <span class="icon"></span>
        </div>
        <div class="accordion-body">
            ✔ केवल मूल वेतन<br>
            ✖ कोई अतिरिक्त लाभ नहीं
        </div>
    </div>

    <!-- 59% -->
    <div class="accordion-item orange">
        <div class="accordion-header">
            59% तक लक्ष्य प्राप्ति (Low Performance)
            <span class="icon"></span>
        </div>
        <div class="accordion-body">
            ✔ 50% वेतन<br>
            ✔ सीमित यात्रा भत्ता<br>
            ⚠ चेतावनी जारी
        </div>
    </div>

    <!-- 50% -->
    <div class="accordion-item red">
        <div class="accordion-header">
            50% से कम (Unsatisfactory Performance)
            <span class="icon"></span>
        </div>
        <div class="accordion-body">
            ⚠ लगातार कम प्रदर्शन पर सेवा समाप्त की जा सकती है।
        </div>
    </div>

    <!-- Terms -->
    <div class="accordion-item warning">
        <div class="accordion-header">
            📜 Terms & Conditions
            <span class="icon"></span>
        </div>
        <div class="accordion-body">
            <ul>
                <li>लक्ष्य का मूल्यांकन मासिक आधार पर होगा</li>
                <li>KPI के अनुसार प्रदर्शन मापा जाएगा</li>
                <li>प्रोत्साहन कंपनी नीति अनुसार बदल सकता है</li>
                <li>कम प्रदर्शन पर सुधार का अवसर दिया जाएगा</li>
                <li>कंपनी को नीति बदलने का अधिकार है</li>
            </ul>
        </div>
    </div>

</div>



						<div class="row m-b20 g-3">
							<div class="container">
							
								<div class="table-responsive">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th style="font-size:18px;">Sl.</th>
												<th style="font-size:18px;">Type</th>
												<th style="font-size:18px;">Title</th>
												<th style="font-size:18px;">Amount</th>
												<th style="font-size:18px;">Status/Remarks</th>
											</tr>
										</thead>
										 
										 
										<tbody>
											@php
												$total = 0;
											@endphp
											@foreach($employee_targets as $key => $value)
												<tr>
													<td style="vertical-align:middle;">{{ $key+1 }}</td>
													<td style="vertical-align:middle;">		
														@if($value->target_type=='yearly_target')
															<span class="badge bg-primary">Yearly Target</span>
														@elseif($value->target_type=='monthly_target')
															<span class="badge bg-primary">Monthly Target</span>
														@elseif($value->target_type=='10_days_target')
															<span class="badge bg-primary">10 Days Target</span>
														@elseif($value->target_type=='per_day_target')
															<span class="badge bg-primary">Per Day Target</span>
														@endif
													</td>
													<td style="vertical-align:middle;">{{ $value->target }}</td>
													<td style="vertical-align:middle;">₹&nbsp;{{ number_format($value->target_value, 2) }}</td>
													<td style="vertical-align:middle;">
													{{ $e_wallet_balance }}
													</td>
												</tr>
											 
											@endforeach
											 
										</tbody>
									 
									</table>
								</div>
								
								 
								
							</div>
						</div>
                    </div>
					<!-- Features End -->

					 

				</div>
			</div>
		</div>

    </div>
    <!-- Page Content End-->
	 <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
	 <script>
$(document).ready(function(){
    $('.accordion-header').click(function(){
        var parent = $(this).parent();

        // Close others (optional)
        $('.accordion-item').not(parent).removeClass('active');

        // Toggle current
        parent.toggleClass('active');
    });
});
</script>
	<script>
		/*$(function() {
			$('.aiz-date-range').daterangepicker({
				autoUpdateInput: false,
				locale: {
					cancelLabel: 'Clear'
				}
			});

			$('.aiz-date-range').on('apply.daterangepicker', function(ev, picker) {
				$(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
			});

			$('.aiz-date-range').on('cancel.daterangepicker', function(ev, picker) {
				$(this).val('');
			});
		});
		*/
		
		 
		$(document).ready(function () {

    // 🔁 Common AJAX loader
    function loadIncomeByDate(startDate, endDate) {
        $.ajax({
            url: "{{ route('member.income.filter') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                start_date: startDate,
                end_date: endDate
            },
            beforeSend: function () {
                $('#income-table-body').html(
                    '<tr><td colspan="5" class="text-center">Loading...</td></tr>'
                );
            },
            success: function (response) {
                $('#income-table-body').html(response.html);
            },
            error: function () {
                alert('AJAX error');
            }
        });
    }

    // 🔥 ON PAGE LOAD → current month
    let startMonth = moment().startOf('month').format('DD/MM/YYYY');
    let endMonth   = moment().endOf('month').format('DD/MM/YYYY');

    $('.aiz-date-range').val(startMonth + ' - ' + endMonth);
    loadIncomeByDate(startMonth, endMonth);

    // 🔥 ON DATE CHANGE
    $('.aiz-date-range').on('apply.daterangepicker', function (ev, picker) {

        let startDate = picker.startDate.format('DD/MM/YYYY');
        let endDate   = picker.endDate.format('DD/MM/YYYY');

        $(this).val(startDate + ' - ' + endDate);
        loadIncomeByDate(startDate, endDate);
    });

});
		
		$(document).ready(function () {

			$('.aiz-date-range').daterangepicker({
				autoUpdateInput: false,
				showDropdowns: true,
				startDate: moment().startOf('month'),
						endDate: moment().endOf('month'),
						autoUpdateInput: true,
				ranges: {
					'Today': [
						moment(),
						moment()
					],
					'Yesterday': [
						moment().subtract(1, 'days'),
						moment().subtract(1, 'days')
					],
					'Last 7 Days': [
						moment().subtract(6, 'days'),
						moment()
					],
					'This Month': [
						moment().startOf('month'),
						moment().endOf('month')
					],
					'Last Month': [
						moment().subtract(1, 'month').startOf('month'),
						moment().subtract(1, 'month').endOf('month')
					],
					
				},

				locale: {
					format: 'DD/MM/YYYY',
					cancelLabel: 'Clear'
				}
			});

			$('.aiz-date-range').on('apply.daterangepicker', function (ev, picker) {
				$(this).val(
					picker.startDate.format('DD/MM/YYYY') +
					' - ' +
					picker.endDate.format('DD/MM/YYYY')
				);
			});

			$('.aiz-date-range').on('cancel.daterangepicker', function () {
				$(this).val('');
			});

		});

	</script>

    @include('vivah_mitra.includes.home_footer_menu')

    @endsection
