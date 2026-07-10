@extends('vivah_mitra.layouts.master')
@section('title') Important Work @endsection

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
.dashboard-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(320px,1fr));
    gap:20px;
    margin-top:20px;
}

.modern-card{
    position:relative;
    overflow:hidden;
    border-radius:22px;
    padding:25px;
    display:flex;
    align-items:center;
    justify-content:space-between;
    text-decoration:none;
    transition:0.35s ease;
    min-height:120px;
    box-shadow:0 10px 25px rgba(0,0,0,0.08);
}

.modern-card:hover{
    transform:translateY(-6px);
    box-shadow:0 15px 35px rgba(0,0,0,0.15);
}

.modern-card .icon-box{
    width:75px;
    height:75px;
    border-radius:20px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:30px;
    background:rgba(255,255,255,0.18);
    color:#fff;
    flex-shrink:0;
}

.modern-card .content{
    flex:1;
    padding-left:20px;
}

.modern-card .content h4{
    margin:0;
    font-size:24px;
    font-weight:700;
    color:#fff;
    line-height:1.4;
}

.modern-card .content p{
    margin:6px 0 0;
    color:rgba(255,255,255,0.9);
    font-size:15px;
}

.modern-card .arrow{
    font-size:28px;
    color:#fff;
    opacity:0.8;
}

/* Different Colors */

.bg1{
    background:linear-gradient(135deg,#667eea,#764ba2);
}

.bg2{
    background:linear-gradient(135deg,#ff758c,#ff7eb3);
}

.bg3{
    background:linear-gradient(135deg,#43cea2,#185a9d);
}

.bg4{
    background:linear-gradient(135deg,#f7971e,#ffd200);
}

.bg5{
    background:linear-gradient(135deg,#11998e,#38ef7d);
}

.bg6{
    background:linear-gradient(135deg,#fc466b,#3f5efb);
}

@media(max-width:768px){

    .modern-card{
        padding:18px;
        min-height:100px;
    }

    .modern-card .content h4{
        font-size:18px;
    }

    .modern-card .content p{
        font-size:13px;
    }

    .modern-card .icon-box{
        width:60px;
        height:60px;
        font-size:24px;
    }
}
	 
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
                        <h5 class="mb-0">Important Work </h5>
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
						<div class="row m-b20 g-3">
							<div class="dashboard-grid">

    <!-- Card 1 -->
    <a href="{{ url('member/send-online-payment') }}" class="modern-card bg1">
        <div class="icon-box">
            <i class="fa fa-wallet"></i>
        </div>

        <div class="content">
            <h4>ऑनलाइन भुगतान भेजें</h4>
            <p>Send Online Payment Report</p>
        </div>

        <div class="arrow">
            <i class="fa fa-arrow-right"></i>
        </div>
    </a>

    <!-- Card 2 -->
    <a href="{{ url('member/online-payment-sent-report') }}" class="modern-card bg2">
        <div class="icon-box">
            <i class="fa fa-file-invoice"></i>
        </div>

        <div class="content">
            <h4>ऑनलाइन पेमेंट रिपोर्ट</h4>
            <p>Online Payment Sent Report</p>
        </div>

        <div class="arrow">
            <i class="fa fa-arrow-right"></i>
        </div>
    </a>

    <!-- Card 3 -->
    <a href="{{ url('member/cash-payment-send-details') }}" class="modern-card bg3">
        <div class="icon-box">
            <i class="fa fa-money-bill-wave"></i>
        </div>

        <div class="content">
            <h4>नकद भुगतान भेजें</h4>
            <p>Send Cash Payment</p>
        </div>

        <div class="arrow">
            <i class="fa fa-arrow-right"></i>
        </div>
    </a>

    <!-- Card 4 -->
    <a href="{{ url('member/cash-payment-list') }}" class="modern-card bg4">
        <div class="icon-box">
            <i class="fa fa-list"></i>
        </div>

        <div class="content">
            <h4>नकद भुगतान लिस्ट</h4>
            <p>Cash Payment List</p>
        </div>

        <div class="arrow">
            <i class="fa fa-arrow-right"></i>
        </div>
    </a>

    <!-- Card 5 -->
    <a href="{{ url('member/send-monthly-routine-work') }}" class="modern-card bg5">
        <div class="icon-box">
            <i class="fa fa-calendar-plus"></i>
        </div>

        <div class="content">
            <h4>मासिक कार्य विवरण जोड़ें</h4>
            <p>Add Monthly Routine Work Details</p>
        </div>

        <div class="arrow">
            <i class="fa fa-arrow-right"></i>
        </div>
    </a>

    <!-- Card 6 -->
    <a href="{{ url('member/monthly-routine-work-list') }}" class="modern-card bg6">
        <div class="icon-box">
            <i class="fa fa-clipboard-list"></i>
        </div>

        <div class="content">
            <h4>मासिक कार्य विवरण</h4>
            <p>Monthly Routine Work List</p>
        </div>

        <div class="arrow">
            <i class="fa fa-arrow-right"></i>
        </div>
    </a>

</div>
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
