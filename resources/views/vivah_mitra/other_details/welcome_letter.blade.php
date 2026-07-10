@extends('vivah_mitra.layouts.master')
@section('title') स्वागत पत्र @endsection

@section('meta_tags')

@endsection
@section('content')
<style>
.letter-box{
    width:800px;
    margin:30px auto;
    background:#fff;
    padding:40px;
    border:3px solid #b30000;
    border-radius:8px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}

.header{
    text-align:center;
    border-bottom:2px solid #b30000;
    padding-bottom:10px;
    margin-bottom:20px;
}

.header h1{
    margin:0;
    font-size:30px;
    color:#b30000;
}

.header h3{
    margin:5px 0 0;
    font-size:18px;
    font-weight:600;
}

.date{
    text-align:right;
    margin-bottom:20px;
}

.content{
    font-size:18px;
    line-height:1.8;
}

.content ul{
    margin-top:10px;
}

.content li{
    margin-bottom:6px;
}

.signature{
    margin-top:60px;
    text-align:right;
}

.signature .sign-line{
    margin-top:40px;
    border-top:1px solid #000;
    display:inline-block;
    padding-top:5px;
}

.footer{
    margin-top:40px;
    text-align:center;
    font-size:14px;
    color:#777;
}


</style>
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
                        <h5 class="mb-0"> स्वागत पत्र </h5>
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
                <!-- Search -->
                 

                <!-- Dashboard Area -->
                <div class="dashboard-area m-b30">

					 

					<!-- Features -->
                     

					<div class="features-box  mt-3 mb-3">
						
                        <div class="row m-b20 g-3">

							<div class="letter-box">

							<div class="header">
								<h1>GHAR AANGAN FOUNDATION</h1>
								<h3>(विवाह मित्र सामाजिक योजना)</h3>
							</div>

							<div class="date">
								दिनांक: {{ date('d M Y', strtotime($vivah_mitra_details->created_at)) }}
							</div>

							<div class="content">

								<p>प्रिय <strong>{{ $vivah_mitra_details->first_name}} जी</strong>,</p>

								<p>
									हमें यह बताते हुए अत्यंत हर्ष हो रहा है कि आपने घर आंगन फाउंडेशन की
									<strong>“विवाह मित्र सामाजिक योजना”</strong> से जुड़कर समाज सेवा और रोजगार के इस मिशन का हिस्सा बनने का निर्णय लिया है।
								</p>

								<p>
									आपका हमारे <strong>विवाह मित्र परिवार</strong> में हार्दिक स्वागत है।
								</p>

								<p>
									हमारा उद्देश्य समाज में ऐसी व्यवस्था बनाना है जिससे हर बेटी की शादी सम्मानपूर्वक और आसानी से हो सके तथा गांव-गांव में रोजगार के अवसर भी उत्पन्न हों।
								</p>

								<p>
									हमें विश्वास है कि आप अपने क्षेत्र में इस योजना का प्रचार-प्रसार कर समाज के लोगों तक इस पहल को पहुँचाने में महत्वपूर्ण भूमिका निभाएंगे।
								</p>

								<p><strong>आपकी जिम्मेदारियाँ मुख्य रूप से निम्नलिखित होंगी:</strong></p>

								<ul>
									<li>अपने क्षेत्र में विवाह मित्र योजना की जानकारी देना।</li>
									<li>लोगों को सदस्यता और विवाह पैकेज के बारे में जागरूक करना।</li>
									<li>जरूरतमंद परिवारों को इस योजना से जोड़ना।</li>
								</ul>

								<p>
									आपकी मेहनत और समर्पण के आधार पर संस्था द्वारा निर्धारित प्रोत्साहन / कमीशन योजना के अनुसार आपको आय के अवसर भी प्राप्त होंगे।
								</p>

								<p>
									हम आशा करते हैं कि आप ईमानदारी, समर्पण और सकारात्मक सोच के साथ इस मिशन को आगे बढ़ाएंगे।
								</p>

								<p>
									एक बार फिर से घर आंगन फाउंडेशन परिवार में आपका स्वागत है।
								</p>

									<p><strong>सादर,</strong></p>

								</div>

								<div class="signature">

								<div class="sign-line">
									(अधिकृत हस्ताक्षर)
								</div>

								<p><strong>GHAR AANGAN FOUNDATION</strong></p>

								</div>

								<div class="footer">
									विवाह मित्र सामाजिक योजना • समाज सेवा एवं रोजगार का मिशन
								</div>

							</div> 
							
							 
							
							
							
							 
							 


							 
							</br>
						</div>
						 
                    </div>
					<!-- Features End -->
					 
				</div>
			</div>
		</div>

    </div>
    <!-- Page Content End-->

    @include('vivah_mitra.includes.home_footer_menu')

    @endsection
