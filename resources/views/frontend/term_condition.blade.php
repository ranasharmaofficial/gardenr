@extends('frontend.layouts.master')
@section('title') Terms & Conditions @endsection

@section('meta_tags')
@endsection

@section('content')
	<style>
		
		/* Terms & Conditions Page Styling */
.terms-page {
    background: #ffffff;
    padding: 35px 30px;
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    max-width: 1100px;
    margin: 0 auto;
}

/* Main Heading */
.terms-page h1 {
    font-size: 32px;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 20px;
    border-bottom: 3px solid #2563eb;
    padding-bottom: 10px;
}

/* Section Headings */
.terms-page h2 {
    font-size: 20px;
    font-weight: 600;
    color: #111827;
    margin-top: 30px;
    margin-bottom: 10px;
    position: relative;
    padding-left: 14px;
}

.terms-page h2::before {
    content: "";
    position: absolute;
    left: 0;
    top: 6px;
    width: 5px;
    height: 70%;
    background-color: #2563eb;
    border-radius: 3px;
}

/* Paragraphs */
.terms-page p {
    font-size: 15.5px;
    line-height: 1.75;
    color: #4b5563;
    margin-bottom: 14px;
}

/* Links */
.terms-page a {
    color: #2563eb;
    text-decoration: none;
    font-weight: 500;
}

.terms-page a:hover {
    text-decoration: underline;
}

/* Strong text */
.terms-page strong {
    color: #111827;
}

/* Footer / Last updated */
.terms-page em {
    display: block;
    margin-top: 30px;
    font-size: 14px;
    color: #6b7280;
    text-align: right;
}

/* Responsive */
@media (max-width: 768px) {
    .terms-page {
        padding: 25px 20px;
    }

    .terms-page h1 {
        font-size: 26px;
    }

    .terms-page h2 {
        font-size: 18px;
    }

    .terms-page p {
        font-size: 14.5px;
    }
}
	</style>
	
	<section id="ed-breadcrumb" class="ed-breadcrumb-sec" data-background="{{static_asset('assets/assets_web/images/header-about5.jpg')}}">
		<div class="container">
			<div class="ed-breadcrumb-content">
				<div class="ed-breadcrumb-text text-center headline ul-li">
					<h2 class="bread_title">Terms & Conditions</h2>
					<ul>
						<li><a href="{{ url('') }}">Home</a></li>
						<li>Terms & Conditions</li>
					</ul>
				</div>
			</div>
		</div>
	</section>

<!-- Start of Feature section
  ============================================= -->
	<section id="ed-cp-cta" class="ed-cp-cta-sec pt-130 pb-100">
		<div class="container">
			<div class="ed-cp-cta-content">
				<div class="row justify-content-center">
					<div class="col-lg-12 col-md-12">
						<div class="terms-page">
							<h1>Terms & Conditions</h1>

							<p>Welcome to <strong>V2F Baazar</strong> (“we”, “our”, “us”). By accessing our website <a href="http://v2fbaazar.com/">http://v2fbaazar.com/</a> (the “Website”), you agree to follow and be bound by these Terms & Conditions (“Terms”). If you do not agree with any part of these Terms, please do not use the Website.</p>

							<h2>1. Use of the Website</h2>
							<p>You agree to use the Website only for lawful purposes and in a way that does not infringe the rights of others or restrict their use and enjoyment.</p>

							<h2>2. Account Registration</h2>
							<p>If you create an account on the Website, you are responsible for maintaining the security of your account credentials and for all activities that occur under your account.</p>

							<h2>3. Content</h2>
							<p>All content on this Website is the property of V2F Baazar unless otherwise stated. You may not copy, reproduce, or distribute content without prior written permission.</p>

							<h2>4. Payments and Fees</h2>
							<p>If the Website offers paid services or products, you agree to pay all fees and taxes associated with them. All payments must be made through authorized payment channels.</p>

							<h2>5. Intellectual Property</h2>
							<p>V2F Baazar and its licensors retain all rights, titles, and interests in all intellectual property associated with the Website, including trademarks, logos, and content.</p>

							<h2>6. Disclaimers</h2>
							<p>We provide the Website “as is” and make no warranties regarding its accuracy, reliability, or availability. V2F Baazar is not responsible for any losses or damages arising from your use of the Website.</p>

							<h2>7. Limitation of Liability</h2>
							<p>To the extent permitted by law, V2F Baazar and its affiliates shall not be liable for any indirect, incidental, special, or consequential damages.</p>

							<h2>8. Changes to Terms</h2>
							<p>We may modify these Terms at any time. Updated Terms will be posted on this page with the effective date.</p>

							<h2>9. Governing Law</h2>
							<p>These Terms are governed by the laws of India. Any disputes will be resolved in the appropriate courts in India.</p>

							<h2>10. Contact Us</h2>
							<p>If you have questions regarding these Terms, contact us at: <strong>support@v2fbaazar.com</strong></p>

							<p><em>Last updated: January 04, 2026</em></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
<!-- End of Contact Cta section
	============================================= -->
	
	
	 

@endsection
