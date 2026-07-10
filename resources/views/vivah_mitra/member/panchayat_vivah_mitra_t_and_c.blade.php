@extends('vivah_mitra.layouts.master')
@section('title') पंचायत विवाह मित्र आवेदन @endsection

@section('meta_tags')

@endsection
@section('content')
	<style >
	 .card{
        background:#ffffff;
        border-radius:14px;
        padding:16px;
        box-shadow:0 8px 20px rgba(0,0,0,0.08);
        margin-bottom:16px;
    }

    .title{
        text-align:center;
        font-size:18px;
        font-weight:700;
        color:#d35400;
        margin-bottom:10px;
    }

    .subtitle{
        font-size:14px;
        font-weight:600;
        margin-bottom:10px;
    }

    .text{
        font-size:14px;
        margin-bottom:12px;
		text-align:justify;
		font-weight:bold;
    }

    .rules-title{
        background:linear-gradient(135deg,#ff7a18,#ffb347);
        color:#fff;
        padding:10px;
        border-radius:10px;
        font-weight:700;
        font-size:15px;
        text-align:center;
        margin-bottom:10px;
    }

    .rules{
		padding-left:22px;
		font-size:14px;
		list-style-type: decimal;
		font-weight:bold;	
	}

	.rules li{
		margin-bottom:8px;
		list-style-position: outside;
		font-weight:bold;
	}

    .note{
        background:#fff7e6;
        border-left:4px solid #ff9800;
        padding:10px;
        border-radius:8px;
        font-size:13px;
        margin-top:12px;
    }

    .declaration{
        margin-top:16px;
        font-size:14px;
    }

    .line{
        border-bottom:1px dashed #999;
        display:inline-block;
        min-width:120px;
    }

    .footer-space{
        height:40px;
    }
	
	
.rules-section{
 
padding:40px 15px;
font-family:"Noto Sans Devanagari", Arial;
}

.rules-container{
max-width:900px;
margin:auto;
background:white;
padding:35px;
border-radius:8px;
 
}

.rules-container h2{
text-align:center;
color:#8b0000;
margin-bottom:5px;
}

.rules-container h3{
text-align:center;
margin-bottom:25px;
}

.intro{
font-size:17px;
margin-bottom:25px;
line-height:1.6;
}

.rule-block{
margin-bottom:20px;
}

.rule-block h4{
color:#0d3b66;
margin-bottom:8px;
}

.rule-block ul{
padding-left:20px;
line-height:1.7;
}

.agreement{
margin-top:30px;
padding-top:20px;
border-top:2px dashed #ccc;
}

.signature{
display:flex;
justify-content:space-between;
margin-top:25px;
flex-wrap:wrap;
gap:20px;
}

@media (max-width:600px){

.rules-container{
padding:20px;
}

.signature{
flex-direction:column;
}

}
 /* video css */

.shorts-container {
    display: flex;
    justify-content: center;
    padding: 10px;
}

.shorts-card {
    width: 100%;
    max-width: 360px;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    background: #000;
}

/* Perfect Shorts Ratio (9:16) */
.shorts-card iframe {
    width: 100%;
    height: 640px;
    border: none;
}

/* Mobile Optimization */
@media (max-width: 480px) {
    .shorts-card iframe {
        height: 500px;
    }
}
	 
	</style >
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
                        <h5 class="mb-0"> पंचायत विवाह मित्र नियम और निर्देश </h5>
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
			@php
					
					
					function convertShortsToEmbed($url) {
						preg_match('/shorts\/([^\?]+)/', $url, $matches);
						return isset($matches[1]) 
							? 'https://www.youtube.com/embed/' . $matches[1] 
							: $url;
					}

					

					 
					$master_tnc_videos = \App\Models\MasterTncVideo::where('user_type', $vivah_mitra_details->user_type_id)->where('user_designation', $vivah_mitra_details->user_designation_id)->where('status', 1)->orderBy('id', 'DESC')->first();
				@endphp
                 
                <div class="dashboard-area m-b30">
					<!-- Features -->
                    
						<div class="row m-b20 g-3">
							 
							<div class="container">

								<div class="card">
									<div class="title">पंचायत विवाह मित्र आवेदन</div>
									
									@if(!empty($master_tnc_videos))
										<div class="shorts-container">
											<div class="shorts-card">
											@php
												// Usage
												$video_url = $master_tnc_videos->video_url;
												$embed_url = convertShortsToEmbed($video_url);
											@endphp
												<iframe 
													src="{{ $embed_url }}?autoplay=1" 
													title="YouTube Shorts Video"
													frameborder="0"
													allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
													allowfullscreen>
												</iframe>
											</div>
										</div>
									@endif

									<p class="text">
										प्रिय पंचायत विवाह मित्र,<br><br>
										हमें यह बताते हुए हर्ष हो रहा है कि आपने अपने ही पंचायत / गाँव / मोहल्ला / शहर में
										पंचायत विवाह मित्र के रूप में कार्य करने हेतु आवेदन किया है।
									</p>

									<p class="text">
										कृपया इस पद से संबंधित सभी नियम एवं निर्देशों को ध्यानपूर्वक पढ़ें, समझें एवं
										पूर्ण सहमति देने के पश्चात ही आवेदन प्रक्रिया आगे बढ़ाएँ।
									</p>
									
									<div class="rules-title">नियमावली एवं इकरारनामा</div>
									
									<section class="rules-section">

										<div class="rules-container">

										<h2>पंचायत विवाह मित्र सामाजिक योजना</h2>
										<h3>नियमावली</h3>

										<p class="intro">
										यह नियमावली घर आंगन फाउंडेशन द्वारा संचालित 
										<strong>“पंचायत विवाह मित्र सामाजिक योजना”</strong> के अंतर्गत कार्य करने वाले 
										सभी विवाह मित्र / सदस्यों पर लागू होगी।
										</p>

										<div class="rule-block">
										<h4>1. सदस्यता</h4>
										<ul>
										<li>विवाह मित्र बनने के लिए संस्था में पंजीकरण आवश्यक होगा।</li>
										<li>सदस्यता शुल्क / पंजीकरण शुल्क संस्था द्वारा निर्धारित किया जाएगा।</li>
										<li>यह शुल्क नॉन-रिफंडेबल होगा।</li>
										</ul>
										</div>

										<div class="rule-block">
										<h4>2. कार्य की प्रकृति</h4>
										<ul>
										<li>विवाह मित्र संस्था का स्वतंत्र सहयोगी (Associate) होगा।</li>
										<li>विवाह मित्र का कार्य अपने क्षेत्र में योजना का प्रचार-प्रसार करना होगा।</li>
										<li>ग्राहकों को विवाह पैकेज एवं सेवाओं की जानकारी देना और सदस्य बनाना उसकी जिम्मेदारी होगी।</li>
										</ul>
										</div>

										<div class="rule-block">
										<h4>3. आय / प्रोत्साहन</h4>
										<ul>
										<li>विवाह मित्र की आय कमीशन / प्रोत्साहन योजना के अनुसार होगी।</li>
										<li>संस्था समय-समय पर प्रोत्साहन योजना में परिवर्तन कर सकती है।</li>
										<li>आय का भुगतान संस्था के नियमों के अनुसार किया जाएगा।</li>
										</ul>
										</div>

										<div class="rule-block">
										<h4>4. आचार संहिता</h4>
										<ul>
										<li>विवाह मित्र संस्था की प्रतिष्ठा और नियमों का सम्मान करेगा।</li>
										<li>किसी भी प्रकार की गलत जानकारी या धोखाधड़ी करना पूर्णतः प्रतिबंधित होगा।</li>
										<li>ग्राहकों के साथ शिष्ट और सम्मानजनक व्यवहार करना अनिवार्य होगा।</li>
										</ul>
										</div>

										<div class="rule-block">
										<h4>5. पहचान पत्र</h4>
										<ul>
										<li>प्रत्येक विवाह मित्र को संस्था द्वारा आईडी कार्ड / पहचान पत्र प्रदान किया जाएगा।</li>
										<li>कार्य के दौरान आईडी कार्ड साथ रखना आवश्यक होगा।</li>
										</ul>
										</div>

										<div class="rule-block">
										<h4>6. गोपनीयता</h4>
										<ul>
										<li>संस्था की जानकारी, योजना या दस्तावेज़ बिना अनुमति के साझा नहीं किए जाएंगे।</li>
										<li>संस्था के व्यापारिक हितों की रक्षा करना सदस्य की जिम्मेदारी होगी।</li>
										</ul>
										</div>

										<div class="rule-block">
										<h4>7. अनुशासन</h4>
										<ul>
										<li>नियमों का उल्लंघन करने पर सदस्यता समाप्त की जा सकती है।</li>
										<li>संस्था बिना पूर्व सूचना के भी सदस्यता समाप्त करने का अधिकार रखती है।</li>
										</ul>
										</div>

										<div class="rule-block">
										<h4>8. क्षेत्रीय कार्य</h4>
										<ul>
										<li>विवाह मित्र को एक निर्धारित क्षेत्र (गांव / पंचायत / वार्ड) दिया जा सकता है।</li>
										<li>उसी क्षेत्र में प्रचार-प्रसार करना प्राथमिक जिम्मेदारी होगी।</li>
										</ul>
										</div>

										<div class="rule-block">
										<h4>9. दायित्व</h4>
										<ul>
										<li>विवाह मित्र संस्था के प्रतिनिधि के रूप में कार्य करेगा।</li>
										<li>संस्था की छवि और विश्वास को बनाए रखना उसकी जिम्मेदारी होगी।</li>
										</ul>
										</div>

										<div class="agreement">

										<h4>10. सहमति</h4>

										<p>
										मैं __________________ यह घोषित करता / करती हूँ कि मैंने उपरोक्त सभी नियमों को पढ़ लिया है 
										और उन्हें मानने के लिए सहमत हूँ।
										</p>

										<div class="signature">

										<div>
										<p>नाम: __________________</p>
										<p>हस्ताक्षर: __________________</p>
										</div>

										<div>
										<p>दिनांक: ____ / ____ / 20__</p>
										</div>

										</div>

										</div>

										</div>

										</section>

								 
									<div class="rules-title">नियम एवं निर्देश</div>

									<ol class="rules">
										<li>1. संस्थागत निवेश राशि ₹41,000/- (इकतालीस हजार रुपये मात्र) है।</li>
										<li>2. मार्च 2026 तक सुविधा निःशुल्क रहेगी। केवल किट शुल्क ₹4,100/- समायोजित किया जाएगा।</li>
										<li>3. एक परिवार / एक घर से केवल एक सदस्यता कार्ड।</li>
										<li>4. गलत अथवा भ्रामक जानकारी देना सख्त वर्जित है।</li>
										<li>5. एक माह में न्यूनतम 10 विवाह मित्र तैयार करना अनिवार्य।</li>
										<li>6. कम से कम 1,000 भौतिक सदस्यता कार्ड बनवाना अनिवार्य।</li>
										<li>7. प्रत्येक माह की 30 तारीख को आयोजित कार्यक्रमों में उपस्थिति अनिवार्य।</li>
										<li>8. आवेदन के 10 दिनों के भीतर 2 प्रशिक्षण अनिवार्य।</li>
										<li>9. प्रथम प्रशिक्षण में अनुपस्थित रहने पर आवेदन निरस्त।</li>
										<li>10. निरस्त आवेदन पर पुनः आवेदन की अनुमति नहीं।</li>
										<li>11. प्रत्येक प्रशिक्षण अवधि 4–5 घंटे।</li>
										<li>12. प्रत्येक प्रशिक्षण शुल्क ₹150/-।</li>
										<li>13. शुल्क न देने पर सभी कार्यक्रमों में प्रवेश वर्जित।</li>
										<li>14. 12 महीनों में ₹2,100/- प्रशिक्षण खर्च हेतु सहमति आवश्यक।</li>
										<li>15. भौतिक कार्ड ₹499/- में, प्रति कार्ड ₹30/- प्रोत्साहन।</li>
										<li>16. 10,000 आयुष्मति कार्ड खरीद पर 2% प्रोत्साहन।</li>
										<li>17. प्रोत्साहन एवं उपहार प्रत्येक माह की 30 तारीख को।</li>
										<li>18. उपहार अधिकतम कार्ड बिक्री पर ही मान्य।</li>
										<li>19. 6 माह बाद ऐप सेवा शुल्क ₹500/- प्रति माह।</li>
										<li>20. ₹500/- से अधिक प्रोत्साहन पर ही चेक जारी।</li>
										<li>21. प्रत्येक लेन-देन पर 5% प्रशासनिक एवं टीडीएस कटौती।</li>
									</ol>
								 
									<div class="rules-title">घोषणा / प्रमाणन</div>

									<p style="font-weight:bold;" class="declaration">
										मैं <span class="line"></span><br>
										(प्रखण्ड विवाह मित्र)
									</p>

									<p style="font-weight:bold;text-align:justify;"  class="text">
										यह प्रमाणित करता / करती हूँ कि मैंने उपरोक्त सभी नियम एवं निर्देश विवाह मित्र को
										पूर्णतः स्पष्ट रूप से समझा दिए हैं। उन्होंने इन्हें पढ़कर, समझकर एवं स्वीकार कर लिया है।
										इसके पश्चात ही आवेदन प्रक्रिया आगे बढ़ाई जा रही है।
									</p>
									
									<section class="oath-section">

<div class="oath-container">

<div class="oath-header">
<h1>GHAR AANGAN FOUNDATION</h1>
<h3>(पंचायत विवाह मित्र सामाजिक योजना)</h3>
<h2>पंचायत विवाह मित्र शपथ ग्रहण</h2>
</div>

<div class="oath-content">

<p class="name-line">
मैं <span class="line"></span>
</p>

<p>
ईश्वर को साक्षी मानकर यह शपथ लेता / लेती हूँ कि—
</p>

<ul class="oath-points">

<li>
मैं घर आंगन फाउंडेशन की विवाह मित्र सामाजिक योजना के उद्देश्य और सिद्धांतों का 
पूरी ईमानदारी और निष्ठा के साथ पालन करूंगा / करूंगी।
</li>

<li>
मैं समाज में जरूरतमंद परिवारों की सहायता करने और बेटियों की शादी को 
सम्मानपूर्वक और सरल बनाने के इस मिशन को आगे बढ़ाने का संकल्प लेता / लेती हूँ।
</li>

<li>
मैं अपने कार्य क्षेत्र में इस योजना का सही और सकारात्मक प्रचार-प्रसार करूंगा / करूंगी।
</li>

<li>
मैं किसी भी प्रकार की गलत जानकारी, धोखाधड़ी या अनुचित व्यवहार से दूर रहूंगा / रहूंगी।
</li>

<li>
मैं संस्था की प्रतिष्ठा, नियमों और अनुशासन का हमेशा सम्मान करूंगा / करूंगी।
</li>

<li>
मैं यह प्रयास करूंगा / करूंगी कि मेरे कार्य से समाज में विश्वास, सहयोग और सकारात्मक परिवर्तन आए।
</li>

<li>
मैं यह शपथ पूरे सच्चे मन और पूर्ण जिम्मेदारी के साथ लेता / लेती हूँ।
</li>

</ul>

</div>

<div class="oath-footer">

<div class="date">
दिनांक: {{ date('d M Y') }}
</div>

<div class="signatures">

<div class="sign-box">
<div class="line"></div>
<p>नाम</p>
</div>

<div class="sign-box">
<div class="line"></div>
<p>हस्ताक्षर</p>
</div>

</div>

</div>

</div>

</section>



<style>

.oath-section{
background:#f4f6f8;
padding:40px 15px;
font-family:"Noto Sans Devanagari", Arial;
}

.oath-container{
max-width:900px;
margin:auto;
background:white;
padding:40px;
border-radius:10px;
border:3px solid #8b0000;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.oath-header{
text-align:center;
margin-bottom:25px;
}

.oath-header h1{
color:#8b0000;
margin-bottom:5px;
}

.oath-header h2{
margin-top:10px;
color:#0d3b66;
}

.oath-content{
font-size:18px;
line-height:1.8;
}

.name-line{
font-size:20px;
margin-bottom:10px;
}

.line{
display:inline-block;
border-bottom:2px solid #000;
width:200px;
}

.oath-points{
margin-top:15px;
padding-left:20px;
}

.oath-points li{
margin-bottom:10px;
}

.oath-footer{
margin-top:35px;
}

.date{
margin-bottom:25px;
font-size:18px;
}

.signatures{
display:flex;
justify-content:space-between;
flex-wrap:wrap;
gap:20px;
}

.sign-box{
text-align:center;
flex:1;
}

.sign-box .line{
width:180px;
margin-bottom:5px;
}

@media (max-width:600px){

.oath-container{
padding:25px;
}

.oath-content{
font-size:16px;
}

.signatures{
flex-direction:column;
}

}

</style>
									
									
									<div class="rules-title">
										<a style="color:#000;" href="{{ url('member/apply-panchayat-vivah-mitra') }}"> PROCEED</a>
									</div>
									
								</div>

								<div class="footer-space"></div>

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

	 

</script>

    @include('vivah_mitra.includes.home_footer_menu')

    @endsection
