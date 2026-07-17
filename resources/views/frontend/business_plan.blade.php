@extends('frontend.layouts.master')
@section('title') Business Plan - Rich Money @endsection

@section('content')
{{-- Hero --}}
<div class="rm-page-hero" style="background: linear-gradient(135deg, #1b5e20 0%, #2e7d32 60%, #43a047 100%); padding: 70px 0; text-align:center;">
    <div class="container">
        <h1 style="color:#fff; font-size:3.5rem; font-weight:800; margin-bottom:10px;">Business Plan</h1>
        <p style="color:rgba(255,255,255,0.85); font-size:1.6rem;">Grow with Rich Money — Join India's leading plant & green business network</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center" style="background:transparent; padding:0; margin-top:14px;">
                <li class="breadcrumb-item"><a href="{{ url('/') }}" style="color:#a5d6a7;">Home</a></li>
                <li class="breadcrumb-item active" style="color:#fff;">Business Plan</li>
            </ol>
        </nav>
    </div>
</div>

{{-- Why Join Section --}}
<section style="background: #f8fdf8; padding: 60px 0;">
    <div class="container">
        <div class="text-center mb-5">
            <span style="background:#e8f5e9; color:#2e7d32; padding:6px 20px; border-radius:20px; font-size:1.3rem; font-weight:600; letter-spacing:1px;">WHY RICH MONEY</span>
            <h2 style="font-size:3rem; font-weight:800; color:#1b5e20; margin-top:16px;">Why Partner With Us?</h2>
            <p style="font-size:1.5rem; color:#666; max-width:650px; margin:0 auto;">Join our growing network and build a sustainable, profitable business in the booming plant & green products industry.</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="rm-why-card">
                    <div class="rm-why-icon"><i class="fa fa-seedling"></i></div>
                    <h4>Premium Products</h4>
                    <p>Access to 500+ varieties of premium plants, seeds, tools, and gardening essentials at competitive prices.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="rm-why-card">
                    <div class="rm-why-icon"><i class="fa fa-rupee-sign"></i></div>
                    <h4>High Earnings</h4>
                    <p>Earn attractive commissions on every sale. Our partners earn ₹15,000–₹1,50,000+ per month consistently.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="rm-why-card">
                    <div class="rm-why-icon"><i class="fa fa-users"></i></div>
                    <h4>Team Support</h4>
                    <p>Dedicated mentor and team support to help you grow your business from day one with training & guidance.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="rm-why-card">
                    <div class="rm-why-icon"><i class="fa fa-chart-line"></i></div>
                    <h4>Growth Unlimited</h4>
                    <p>No ceiling on your earnings. The more you grow your network, the more you earn with our multi-level plan.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Income Plans --}}
<section style="background: #fff; padding: 60px 0;">
    <div class="container">
        <div class="text-center mb-5">
            <span style="background:#e8f5e9; color:#2e7d32; padding:6px 20px; border-radius:20px; font-size:1.3rem; font-weight:600;">OUR PLANS</span>
            <h2 style="font-size:3rem; font-weight:800; color:#1b5e20; margin-top:16px;">Choose Your Plan</h2>
        </div>
        <div class="row g-4 justify-content-center">
            {{-- Starter --}}
            <div class="col-lg-4 col-md-6">
                <div class="rm-plan-card">
                    <div class="rm-plan-badge">Starter</div>
                    <div class="rm-plan-icon"><i class="fa fa-leaf"></i></div>
                    <h3 class="rm-plan-name">Basic Member</h3>
                    <div class="rm-plan-price">₹999<span>/joining</span></div>
                    <ul class="rm-plan-features">
                        <li><i class="fa fa-check-circle"></i> Access to product catalog</li>
                        <li><i class="fa fa-check-circle"></i> 10% direct referral bonus</li>
                        <li><i class="fa fa-check-circle"></i> Welcome kit worth ₹500</li>
                        <li><i class="fa fa-check-circle"></i> Online training access</li>
                        <li><i class="fa fa-check-circle"></i> Monthly payout</li>
                        <li style="opacity:0.4;"><i class="fa fa-times-circle"></i> Team bonus</li>
                        <li style="opacity:0.4;"><i class="fa fa-times-circle"></i> Leadership rewards</li>
                    </ul>
                    <a href="{{ route('register') }}" class="rm-plan-btn rm-plan-btn-outline">Join Now</a>
                </div>
            </div>

            {{-- Professional --}}
            <div class="col-lg-4 col-md-6">
                <div class="rm-plan-card rm-plan-card-featured">
                    <div class="rm-plan-badge rm-plan-badge-featured">Most Popular</div>
                    <div class="rm-plan-icon"><i class="fa fa-tree"></i></div>
                    <h3 class="rm-plan-name">Pro Member</h3>
                    <div class="rm-plan-price">₹4,999<span>/joining</span></div>
                    <ul class="rm-plan-features">
                        <li><i class="fa fa-check-circle"></i> Everything in Basic</li>
                        <li><i class="fa fa-check-circle"></i> 15% direct referral bonus</li>
                        <li><i class="fa fa-check-circle"></i> Kit worth ₹2,000</li>
                        <li><i class="fa fa-check-circle"></i> 5-level team bonus</li>
                        <li><i class="fa fa-check-circle"></i> Weekly payout</li>
                        <li><i class="fa fa-check-circle"></i> Sales target rewards</li>
                        <li style="opacity:0.5;"><i class="fa fa-times-circle"></i> Leadership rewards</li>
                    </ul>
                    <a href="{{ route('register') }}" class="rm-plan-btn">Join Now</a>
                </div>
            </div>

            {{-- Leader --}}
            <div class="col-lg-4 col-md-6">
                <div class="rm-plan-card">
                    <div class="rm-plan-badge" style="background:#f59e0b; color:#fff;">Leader</div>
                    <div class="rm-plan-icon"><i class="fa fa-crown"></i></div>
                    <h3 class="rm-plan-name">Leader Member</h3>
                    <div class="rm-plan-price">₹14,999<span>/joining</span></div>
                    <ul class="rm-plan-features">
                        <li><i class="fa fa-check-circle"></i> Everything in Pro</li>
                        <li><i class="fa fa-check-circle"></i> 20% direct referral bonus</li>
                        <li><i class="fa fa-check-circle"></i> Kit worth ₹6,000</li>
                        <li><i class="fa fa-check-circle"></i> 10-level team bonus</li>
                        <li><i class="fa fa-check-circle"></i> Daily payout</li>
                        <li><i class="fa fa-check-circle"></i> Leadership rewards</li>
                        <li><i class="fa fa-check-circle"></i> Car & travel fund</li>
                    </ul>
                    <a href="{{ route('register') }}" class="rm-plan-btn rm-plan-btn-outline">Join Now</a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Income Streams --}}
<section style="background: linear-gradient(135deg, #398d40, #acf5b0); padding: 60px 0;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 style="font-size:3rem; font-weight:800; color:#fff; margin-bottom:10px;">Multiple Income Streams</h2>
            <p style="color:rgba(255,255,255,0.8); font-size:1.5rem;">Earn from 6 different income sources with Rich Money</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-2 col-md-4 col-6 text-center">
                <div class="rm-income-box">
                    <i class="fa fa-hand-holding-usd"></i>
                    <h5>Direct Income</h5>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-6 text-center">
                <div class="rm-income-box">
                    <i class="fa fa-network-wired"></i>
                    <h5>Team Income</h5>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-6 text-center">
                <div class="rm-income-box">
                    <i class="fa fa-star"></i>
                    <h5>Leadership Bonus</h5>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-6 text-center">
                <div class="rm-income-box">
                    <i class="fa fa-gift"></i>
                    <h5>Reward Income</h5>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-6 text-center">
                <div class="rm-income-box">
                    <i class="fa fa-car"></i>
                    <h5>Car Fund</h5>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-6 text-center">
                <div class="rm-income-box">
                    <i class="fa fa-home"></i>
                    <h5>House Fund</h5>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section style="background: #f8fdf8; padding: 60px 0; text-align:center;">
    <div class="container">
        <h2 style="font-size:3rem; font-weight:800; color:#1b5e20; margin-bottom:12px;">Ready to Start Your Journey?</h2>
        <p style="font-size:1.6rem; color:#666; margin-bottom:30px;">Join thousands of successful partners growing with Rich Money today.</p>
        <div style="display:flex; justify-content:center; gap:16px; flex-wrap:wrap;">
            <a href="{{ route('register') }}" class="rm-cta-btn rm-cta-primary">
                <i class="fa fa-user-plus"></i> Register Now
            </a>
            <a href="tel:+919534737643" class="rm-cta-btn rm-cta-secondary">
                <i class="fa fa-phone-alt"></i> Call: +91 9534737643
            </a>
            <a href="mailto:info.richmoney1@gmail.com" class="rm-cta-btn rm-cta-outline">
                <i class="fa fa-envelope"></i> Email Us
            </a>
        </div>
    </div>
</section>

<style>
.rm-why-card {
    background: #fff;
    border-radius: 14px;
    padding: 35px 25px;
    text-align: center;
    box-shadow: 0 4px 20px rgba(0,0,0,0.07);
    border-bottom: 4px solid #4caf50;
    transition: transform 0.3s, box-shadow 0.3s;
    height: 100%;
}
.rm-why-card:hover { transform: translateY(-6px); box-shadow: 0 12px 35px rgba(46,125,50,0.15); }
.rm-why-icon {
    width: 65px; height: 65px;
    background: linear-gradient(135deg, #1b5e20, #4caf50);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 2.2rem;
    margin: 0 auto 18px;
}
.rm-why-card h4 { font-size: 1.8rem; font-weight: 700; color: #1b5e20; margin-bottom: 10px; }
.rm-why-card p { font-size: 1.35rem; color: #666; line-height: 1.65; }

/* Plan Cards */
.rm-plan-card {
    background: #fff;
    border-radius: 18px;
    padding: 40px 30px;
    box-shadow: 0 6px 25px rgba(0,0,0,0.08);
    border: 2px solid #eee;
    position: relative;
    overflow: hidden;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    transition: transform 0.3s;
}
.rm-plan-card:hover { transform: translateY(-5px); }
.rm-plan-card-featured {
    border-color: #4caf50;
    background: linear-gradient(180deg, #f0fdf4, #fff);
    box-shadow: 0 12px 40px rgba(76,175,80,0.2);
}
.rm-plan-badge {
    position: absolute; top: 18px; right: 18px;
    background: #e8f5e9; color: #2e7d32;
    padding: 4px 14px; border-radius: 20px;
    font-size: 1.15rem; font-weight: 700;
}
.rm-plan-badge-featured { background: #2e7d32; color: #fff; }
.rm-plan-icon {
    width: 70px; height: 70px;
    background: linear-gradient(135deg, #1b5e20, #4caf50);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    color: #fff; font-size: 2.5rem;
    margin: 10px auto 18px;
    box-shadow: 0 4px 15px rgba(46,125,50,0.3);
}
.rm-plan-name { font-size: 2rem; font-weight: 800; color: #1b5e20; margin-bottom: 10px; }
.rm-plan-price { font-size: 2.8rem; font-weight: 900; color: #2e7d32; margin-bottom: 24px; }
.rm-plan-price span { font-size: 1.3rem; color: #999; font-weight: 400; }
.rm-plan-features { list-style: none; padding: 0; margin: 0 0 28px; text-align: left; width: 100%; }
.rm-plan-features li { padding: 8px 0; font-size: 1.35rem; color: #555; display: flex; align-items: center; gap: 10px; border-bottom: 1px dashed #f0f0f0; }
.rm-plan-features li i.fa-check-circle { color: #4caf50; font-size: 1.5rem; }
.rm-plan-features li i.fa-times-circle { color: #ddd; font-size: 1.5rem; }
.rm-plan-btn {
    display: inline-block; padding: 12px 36px;
    background: linear-gradient(135deg, #1b5e20, #4caf50);
    color: #fff !important; border-radius: 30px;
    font-size: 1.5rem; font-weight: 700;
    text-decoration: none !important;
    transition: all 0.3s; width: 100%; text-align: center;
    box-shadow: 0 4px 15px rgba(46,125,50,0.3);
    margin-top: auto;
}
.rm-plan-btn:hover { background: linear-gradient(135deg, #0a3d12, #2e7d32); transform: translateY(-2px); }
.rm-plan-btn-outline {
    background: transparent;
    border: 2px solid #2e7d32ff;
    color: #43a348ff !important;
    box-shadow: none;
}
.rm-plan-btn-outline:hover { background: #2e7d32; color: #fff !important; }

/* Income Boxes */
.rm-income-box {
    background: rgba(255,255,255,0.12);
    border: 1.5px solid rgba(255,255,255,0.25);
    border-radius: 14px;
    padding: 28px 16px;
    color: #fff;
    transition: all 0.25s;
    cursor: default;
}
.rm-income-box:hover { background: rgba(255,255,255,0.22); transform: translateY(-4px); }
.rm-income-box i { font-size: 2.8rem; margin-bottom: 12px; display: block; color: #a5d6a7; }
.rm-income-box h5 { font-size: 1.35rem; font-weight: 700; margin: 0; }

/* CTA Buttons */
.rm-cta-btn {
    display: inline-flex; align-items: center; gap: 10px;
    padding: 14px 32px; border-radius: 35px;
    font-size: 1.5rem; font-weight: 700;
    text-decoration: none !important;
    transition: all 0.3s;
}
.rm-cta-primary { background: linear-gradient(135deg, #1b5e20, #4caf50); color: #fff !important; box-shadow: 0 4px 18px rgba(46,125,50,0.35); }
.rm-cta-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(46,125,50,0.45); }
.rm-cta-secondary { background: #fff; color: #2e7d32 !important; border: 2px solid #4caf50; box-shadow: 0 4px 15px rgba(0,0,0,0.08); }
.rm-cta-secondary:hover { background: #f0fdf4; transform: translateY(-2px); }
.rm-cta-outline { background: transparent; color: #555 !important; border: 2px solid #ddd; }
.rm-cta-outline:hover { border-color: #4caf50; color: #2e7d32 !important; }
</style>
@endsection
