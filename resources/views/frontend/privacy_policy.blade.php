@extends('frontend.layouts.master')
@section('title') Privacy Policy @endsection

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
					<h2 class="bread_title">Privacy Policy</h2>
					<ul>
						<li><a href="{{ url('') }}">Home</a></li>
						<li>Privacy Policy</li>
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
							<h1>Privacy Policy</h1>

							<p>Welcome to <strong>V2F Baazar</strong> (“we”, “our”, “us”). Your privacy is important to us. This Privacy Policy explains how we collect, use, disclose, and protect your information when you visit or interact with <a href="http://v2fbaazar.com/">http://v2fbaazar.com/</a> (the “Website”).</p>

							<h2>1. Information We Collect</h2>
							<p>We may collect personal and non-personal information including, but not limited to:</p>
							<ul>
							  <li>Contact information (name, email address, phone number)</li>
							  <li>Account information (if you register or log in)</li>
							  <li>Usage data such as IP address, browser type, pages visited</li>
							  <li>Payment information (only if you use paid services)</li>
							</ul>

							<h2>2. How We Use Your Information</h2>
							<p>We use your information for the following purposes:</p>
							<ul>
							  <li>To provide, maintain, and improve the Website</li>
							  <li>To communicate with you (e.g., offer updates, respond to inquiries)</li>
							  <li>To process transactions and deliver services</li>
							  <li>To personalize user experience</li>
							  <li>To comply with legal obligations</li>
							</ul>

							<h2>3. Cookies and Tracking Technologies</h2>
							<p>We may use cookies, web beacons, and similar technologies to analyze trends, administer the Website, track users’ movements, and gather demographic information.</p>

							<h2>4. Data Sharing and Disclosure</h2>
							<p>We do not sell or rent your personal information. We only share information with:</p>
							<ul>
							  <li>Service providers who help operate the Website</li>
							  <li>Law enforcement if required by law</li>
							  <li>Affiliates with your consent</li>
							</ul>

							<h2>5. Security</h2>
							<p>We implement reasonable administrative, technical, and physical safeguards to protect your data. However, no method of transmission over the Internet is 100% secure.</p>

							<h2>6. Third-Party Links</h2>
							<p>The Website may contain links to third-party sites. We are not responsible for their privacy practices.</p>

							<h2>7. Changes to This Policy</h2>
							<p>We may update this Privacy Policy at any time. Updates will be posted on this page with the updated date.</p>
							
							<h2>8. Updates</h2>
							<ul>
							  <li>Your usernames, passwords, email addresses and other security-related information used by you in relation to our Services</li>
							  <li>Send confirmations either via SMS or Whatsapp or any other messaging service.</li>
							  <li>We send promotional messages to our customers</li>
							  <li>Send verification message(s) & Promotional messages or email(s)</li>
							</ul>

							<h2>9. Contact Us</h2>
							<p>If you have any questions about this Privacy Policy, please contact us at: <strong>support@v2fbaazar.com</strong></p>

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
