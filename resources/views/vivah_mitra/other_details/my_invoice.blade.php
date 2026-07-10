@extends('vivah_mitra.layouts.master')
@section('title') मेंबरशिप इनवॉइस @endsection

@section('meta_tags')

@endsection
@section('content')
 
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
                        <h5 class="mb-0"> मेंबरशिप इनवॉइस </h5>
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
							<section class="invoice-section">

<div class="invoice-container">

<h2 class="invoice-title">AAYUSHMATI MEMBERSHIP - SELL BILL</h2>

<div class="bill-row">
<div>Bill No: GAF100{{ $vivah_mitra_details->id }}</div>
<div>Date: {{ date('d M Y', strtotime($vivah_mitra_details->verify_date)) }}</div>
</div>

<div class="customer-details">
<p>Customer Name: <span class="line full">{{ $vivah_mitra_details->first_name }}</span></p>
<p>Mobile No.: <span class="line full">{{ $vivah_mitra_details->mobile }}</span></p>
<p>Address: <span class="line full">{{ $vivah_mitra_details->address }}</span></p>
</div>

<div class="table-wrapper">
<table class="invoice-table">

<thead>
<tr>
<th>Description</th>
<th>Qty</th>
<th>Amount</th>
</tr>
</thead>

<tbody>
<tr>
<td>Ausmati Membership</td>
<td>1</td>
<td class="price">₹999</td>
</tr>
</tbody>

</table>
</div>

<div class="total-box">
Total Amount: <span>₹999/-</span>
</div>

{{--<div class="payment-mode">
Payment Mode: Cash / UPI / Online
</div>--}}

<div class="signatures">

<div class="sign">
<div class="sign-box"></div>
Customer Signature
</div>

<div class="sign">
<div class="sign-box"></div>
Authorized Signature
</div>

</div>

<div class="note">
नोट: यह सदस्यता शुल्क नॉन-रिफंडेबल है।
</div>

</div>

</section>


<style>

.invoice-section{
padding:20px;
background:#f2f2f2;
font-family:Arial;
}

.invoice-container{
max-width:900px;
width:100%;
margin:auto;
background:white;
padding:25px;
border-radius:10px;
box-shadow:0 3px 10px rgba(0,0,0,0.1);
}

.invoice-title{
text-align:center;
color:#0d3b66;
margin-bottom:20px;
}

.bill-row{
display:flex;
justify-content:space-between;
flex-wrap:wrap;
border:2px solid #0d3b66;
padding:10px;
border-radius:8px;
margin-bottom:20px;
}

.customer-details p{
margin:10px 0;
}

.line{
border-bottom:2px solid #333;
display:inline-block;
width:120px;
}

.full{
width:70%;
}

.table-wrapper{
overflow-x:auto;
}

.invoice-table{
width:100%;
border-collapse:collapse;
margin-top:15px;
}

.invoice-table thead{
background:#1f5f8f;
color:white;
}

.invoice-table th,
.invoice-table td{
padding:12px;
border:1px solid #ddd;
text-align:left;
}

.invoice-table td:nth-child(2){
text-align:center;
}

.price{
color:#b30000;
font-weight:bold;
}

.total-box{
margin-top:25px;
font-size:24px;
font-weight:bold;
text-align:center;
}

.total-box span{
background:#0d3b66;
color:#ffb703;
padding:6px 20px;
border-radius:6px;
margin-left:10px;
}

.payment-mode{
margin-top:20px;
text-align:center;
font-size:18px;
}

.signatures{
display:flex;
justify-content:space-between;
flex-wrap:wrap;
margin-top:30px;
gap:20px;
}

.sign{
text-align:center;
flex:1;
}

.sign-box{
height:60px;
border:2px dashed #aaa;
border-radius:6px;
margin-bottom:8px;
}

.note{
margin-top:25px;
background:#fff3cd;
border:2px dashed #e0a800;
padding:10px;
text-align:center;
font-size:18px;
}

/* MOBILE FIX */

@media (max-width:600px){

.invoice-title{
font-size:20px;
}

.bill-row{
flex-direction:column;
gap:8px;
}

.invoice-table th,
.invoice-table td{
font-size:14px;
padding:8px;
}

.total-box{
font-size:18px;
}

.signatures{
flex-direction:column;
}

}

</style>
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
