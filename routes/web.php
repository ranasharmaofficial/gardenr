<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Frontend\CommonController;
use App\Http\Controllers\Frontend\ServiceController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CountryStateCityController;
use App\Http\Controllers\Frontend\MemberController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Admin\LogoutController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Cache is cleared by @RanaSharma";
});

Route::get('/get-district-by-state/{state_id}', [CommonController::class, 'getDistrictByState']);

Route::get('/get-district-by-state/{state_id}',  [CommonController::class, 'getDistrictByState']);
Route::get('/get-blocks-by-district/{state_id}', [CommonController::class, 'getBlockByDistrict']);
Route::get('/get-panchayat-by-block/{state_id}', [CommonController::class, 'getPanchayatByBlock']);


Route::get('/about', function () {
    return view('frontend.pages.about');
});
Route::get('/vision-mission', function () {
    return view('frontend.pages.vision-mission');
});
Route::get('/founder-message', function () {
    return view('frontend.pages.founder-message');
});
Route::get('/center-head-desk', function () {
    return view('frontend.pages.center-head-desk');
});

Route::get('/aim-objective', function () {
    return view('frontend.pages.aim-objective');
});
Route::get('/our-goal', function () {
    return view('frontend.pages.our-goal');
});
Route::get('/online-registration', function () {
    return view('frontend.pages.online-registration');
});
Route::get('/student-verification', function () {
    return view('frontend.pages.student-verification');
});
// Route::get('/marksheet-verification', function () {
//     return view('frontend.pages.marksheet-verification');
// });
// Route::get('/certificate-verification', function () {
//     return view('frontend.pages.certificate-verification');
// });
Route::get('/download-admitcard', function () {
    return view('frontend.pages.download-admitcard');
});

Route::get('/affiliation', function () {
    return view('frontend.affiliation');
});





Route::get('/registration', function () {
    return view('frontend.pages.registration');
});
Route::get('/student-enquiry', function () {
    return view('frontend.pages.student-enquiry');
});

Route::post('get-cities-by-state', [CountryStateCityController::class, 'getCity']);

Route::post('/add-to-cart', [CartController::class,'addToCart']);
Route::get('/cart-header', [CartController::class,'cartHeader']);
Route::get('/cart', [CartController::class,'cartPage'])->name('cart.page');
Route::post('/cart/update-qty', [CartController::class,'updateQty']);
Route::post('/cart/remove-item', [CartController::class,'removeItem']);
Route::post('/cart/save-details', [CartController::class,'saveDetails']);
Route::get('/checkout', [CartController::class,'checkoutPage'])->name('checkout');
Route::post('/checkout/save', [CartController::class,'saveCheckout'])->name('checkout.save');
Route::get('/checkout/success/{order_code}', [CartController::class, 'checkoutSuccess'])->name('checkout.success');

// emergency
Route::get('franchise-login', [AuthController::class, 'login'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('franchise-registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post');
Route::get('student-login', [AuthController::class, 'studentLogin'])->name('student.login');
Route::post('post-student-login', [AuthController::class, 'poststudentLogin'])->name('studentlogin.post');



// Route::get('dashboard', [AuthController::class, 'dashboard']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', [CommonController::class, 'index'])->name('index');
Route::get('index', [CommonController::class, 'index'])->name('index');

Route::get('product/{slug}', [CommonController::class, 'productDetails'])->name('productDetails');
Route::get('shop', [CommonController::class, 'shopPage'])->name('shop');
Route::get('category', [CommonController::class, 'shopPage'])->name('category');
Route::get('category/{slug}', [CommonController::class, 'shopByCategory'])->name('category.slug');

Route::get('our-franchise', [CommonController::class, 'ourFranchise'])->name('ourFranchise');
Route::get('marksheet-verification', [CommonController::class, 'marksheetVerification'])->name('marksheetVerification');
Route::get('certificate-verification', [CommonController::class, 'certificateVerification'])->name('certificateVerification');
Route::post('checkStudentMarksheet', [CommonController::class, 'checkStudentMarksheet'])->name('checkStudentMarksheet');
Route::get('our-team', [CommonController::class, 'ourTeam'])->name('ourTeam');
Route::get('video-assembly', [CommonController::class, 'videoAssembly'])->name('videoAssembly');
Route::get('video', [CommonController::class, 'videoList'])->name('videoList');

Route::get('media-coverage', [CommonController::class, 'mediaCoverage'])->name('mediaCoverage');
Route::get('speeches', [CommonController::class, 'speechList'])->name('speechList');
Route::get('latest-photos', [CommonController::class, 'latestPhotos'])->name('latestPhotos');
Route::get('event', [CommonController::class, 'latestEvents'])->name('latestEvents');
Route::get('courses', [CommonController::class, 'course'])->name('courses');
Route::get('course/{slug}', [CommonController::class, 'courseDetails'])->name('courseDetails');
Route::get('sub-course/{slug}', [CommonController::class, 'SubcourseDetails'])->name('SubcourseDetails');
Route::get('students/{id}', [CommonController::class, 'checkResult'])->name('checkResult');


Route::get('about-us', function () {
    return view('frontend.about');
})->name('about');
Route::get('about', function () {
    return view('frontend.about');
});
Route::get('wishlist', function () {
    return view('frontend.wishlist');
})->name('wishlist');

// RichMoney - New Pages
Route::get('legal', function () {
    return view('frontend.legal');
})->name('legal');
Route::get('business-plan', function () {
    return view('frontend.business_plan');
})->name('businessPlan');
Route::get('why-choose-us', [CommonController::class, 'whyChooseUs'])->name('whyChooseUs');
// Route::get('quality-policy', [CommonController::class, 'qualityPolicy'])->name('qualityPolicy');
Route::get('manufacturing-marketing', [CommonController::class, 'manufacturingMarketing'])->name('manufacturingMarketing');
Route::get('certificate', [CommonController::class, 'certificate'])->name('certificate');
Route::get('enquiry', [CommonController::class, 'enquiry'])->name('enquiry');
Route::get('career', [CommonController::class, 'career'])->name('career');
Route::post('storeCareerData', [CommonController::class, 'storeCareerData'])->name('home.storeCareerData');
Route::get('contact', [CommonController::class, 'contact_us'])->name('contact');
Route::get('complain', [CommonController::class, 'complain'])->name('complain');
Route::get('tender', [CommonController::class, 'tender'])->name('tender');
// Route::get('event', [CommonController::class, 'event'])->name('event');
Route::post('contact/enquiry', [CommonController::class, 'postContactEnquiry'])->name('contact.enquiry');
Route::post('postOnlineEnquiry', [CommonController::class, 'postOnlineEnquiry'])->name('enq.postOnlineEnquiry');
Route::post('homePageEnquiry', [CommonController::class, 'homePageEnquiry'])->name('enq.homePageEnquiry');
Route::post('poststoreComplain', [CommonController::class, 'storeComplain'])->name('enq.poststoreComplain');
Route::post('studentOnlineEnquiry', [CommonController::class, 'studentOnlineEnquiry'])->name('enq.studentOnlineEnquiry');
Route::get('therapies', [CommonController::class, 'therapies'])->name('therapies');
Route::get('photo-gallery', [CommonController::class, 'photoGallery'])->name('photoGallery');
// Route::get('video-gallery', [CommonController::class, 'videoGallery'])->name('videoGallery');
Route::get('gallery/{slug}', [CommonController::class, 'photoGalleryDetails'])->name('photoGalleryDetails');


Route::get('mission-vission', [CommonController::class, 'mission'])->name('mission-vission');
Route::get('partners', [CommonController::class, 'partner'])->name('partners');
// Route::get('awards', [CommonController::class, 'awards'])->name('awards');
Route::get('clients', [CommonController::class, 'clients'])->name('clients');
Route::get('straitegic-alliances', [CommonController::class, 'straitegicAlliances'])->name('straitegic-alliances');

Route::get('industry/{slug}', [CommonController::class, 'industry'])->name('industry.slug');

Route::get('news', [CommonController::class, 'newsListing'])->name('news');
Route::get('news/{slug}', [CommonController::class, 'newsSlugListing'])->name('news.slug');
Route::get('news_detail/{slug}', [CommonController::class, 'newsDetail'])->name('news.detail');

Route::get('events', [CommonController::class, 'eventListing'])->name('events');
Route::get('events/{slug}', [CommonController::class, 'eventSlugListing'])->name('events.slug');
Route::get('event_detail/{slug}', [CommonController::class, 'eventDetail'])->name('events.detail');

Route::get('blogs', [CommonController::class, 'blogListing'])->name('blogs');
Route::get('blogs/{slug}', [CommonController::class, 'blogSlugListing'])->name('blogs.slug');
// Route::get('blog_detail/{slug}', [CommonController::class, 'blogDetail'])->name('blog.detail');
Route::get('blog/blog-detail/{slug}', [CommonController::class, 'blogDetail'])->name('blog.detail');
Route::post('blog/store_comment', [CommonController::class, 'storeBlogComment'])->name('blog.store_comment');
Route::get('blog/show_comments', [CommonController::class, 'showBlogComments'])->name('blog.show_comments');

// Route::get('service/{slug}', [ServiceController::class, 'index'])->name('service.slug');

Route::get('case-study', [CommonController::class, 'caseStudyListing'])->name('case-study');
Route::get('case-study-detail/{slug}', [CommonController::class, 'caseStudyDetail'])->name('case-study.detail');
Route::get('csr', [CommonController::class, 'csr'])->name('csr');

Route::get('career-details', [CommonController::class, 'careerDetails'])->name('career-details');
// Route::post('career/enquiry', [CommonController::class, 'storeCareerData'])->name('career.enquiry');
Route::get('faqs', [CommonController::class, 'faqs'])->name('faqs');
Route::get('videos', [CommonController::class, 'videos'])->name('videos');
// Route::get('projects', [CommonController::class, 'projects'])->name('projects');
Route::get('gallery', [CommonController::class, 'galleries'])->name('gallery');
Route::get('testimonial', [CommonController::class, 'testimonial'])->name('testimonial');
Route::get('team-details/{id}', [CommonController::class, 'teamDetails'])->name('teamDetails');
Route::get('clients', [CommonController::class, 'ourClients'])->name('ourClients');
// Route::get('awards', [CommonController::class, 'awards'])->name('awards');
Route::get('profile', [CommonController::class, 'profile'])->name('profile');


Route::post('store/subscriber', [CommonController::class, 'postNewsletter'])->name('store.subscriber');

// Route::get('product/{slug}', [ProductController::class, 'productDetails'])->name('productDetail.slug');

Route::post('showPricingDetails', [ProductController::class, 'showPricingDetails'])->name('home.showPricingDetails');
Route::post('showFaqList', [ServiceController::class, 'showFaqList'])->name('home.showFaqList');


Route::get('service/{slug}', [ServiceController::class, 'serviceDetails'])->name('serviceDetails.slug');

Route::get('privacy-policy', [CommonController::class, 'privacyPolicy'])->name('privacyPolicy');
Route::get('terms-condition', [CommonController::class, 'termsCondition'])->name('termsCondition');
Route::get('disclaimer', [CommonController::class, 'disclaimer'])->name('disclaimer');
Route::get('refund-policy', [CommonController::class, 'refundPolicy'])->name('refundPolicy');
Route::get('get-quote', [CommonController::class, 'getQuote'])->name('getQuote');
Route::get('schedule-meeting', [CommonController::class, 'scheduleMeeting'])->name('scheduleMeeting');
Route::post('postQuoteData', [CommonController::class, 'postQuoteData'])->name('postQuoteData');
Route::post('storeScheduleMeetings', [CommonController::class, 'storeScheduleMeetings'])->name('storeScheduleMeetings');
Route::post('storePricingEnquiry', [CommonController::class, 'storePricingEnquiry'])->name('storePricingEnquiry');

Route::get('partner/{slug}', [CommonController::class, 'partnerDetails'])->name('partnerDetails.slug');

Route::get('industry/{slug}', [CommonController::class, 'industryDetails'])->name('industry.slug');
Route::get('solution/{slug}', [CommonController::class, 'solutionDetails'])->name('solution.slug');

Route::post('showCommonFaqList', [CommonController::class, 'showCommonFaqList'])->name('home.showCommonFaqList');

Route::get('prices', [ProductController::class, 'priceListPage'])->name('prices');
Route::get('price-details/{id}', [ProductController::class, 'productPriceDetails'])->name('productPriceDetails');

Route::post('stripeCheckout', [ProductController::class, 'stripeCheckout'])->name('stripe.checkout');
Route::get('pricing-order-review', [ProductController::class, 'CheckoutSuccess'])->name('stripe.checkout.success');

Route::get('hire-team', [CommonController::class, 'hireTeam'])->name('hire-team');
Route::post('storeHireTeam', [CommonController::class, 'storeHireTeam'])->name('home.storeHireTeam');

// Route::get('stripe/checkout','stripeCheckout')->name('stripe.checkout');
// Route::get('stripe/checkout/success','stripeCheckoutSuccess')->name('stripe.checkout.success');

/** vivah mitra routes starts here */
Route::get('vivah-mitra-login', [AuthController::class, 'vivahMitralogin'])->name('vivahmitra.login');
Route::post('vivahMitraLoginPost', [AuthController::class, 'vivahMitraLoginPost'])->name('login.vivahMitraLoginPost');


Route::group(['prefix' => 'member', 'middleware' => ['VivahMitraAuthCheck'], 'as' => 'member.'], function () {
    Route::get('/dashboard', [MemberController::class, 'customerDashboard'])->name('dashboard');
    Route::get('/category-view/{slug}', [MemberController::class, 'vivahMitraSubCategory'])->name('vivahMitraSubCategory');
    Route::get('/subcategory/{slug}', [MemberController::class, 'vivahMitraProducts'])->name('vivahMitraProducts');

    Route::get('category/{category_slug}', [MemberController::class, 'listingByCategory'])->name('products.category');
    // Route::get('product/{slug}', [MemberController::class, 'productDetails'])->name('products.productDetails');
    // Route::get('/get_filtered_products', [MemberController::class, 'get_filtered_products'])->name('get_filtered_products');
    Route::get('/get_notice', [MemberController::class, 'getNotice'])->name('get_notice');
    Route::get('/get-notification', [MemberController::class, 'getNotification'])->name('getNotification');
    Route::get('/rules_and_guidelines', [MemberController::class, 'getRulesAndGuidelines'])->name('rules_and_guidelines');

    Route::get('/product-list', [MemberController::class, 'productList'])->name('product.list');
    Route::get('/dashboard-three', [MemberController::class, 'customerDashboard3'])->name('dashboard3');

    Route::get('/apply-digital-membership', [MemberController::class, 'applyDigitalMembership'])->name('applyDigitalMembership');
    Route::get('/digital-member-applied/{id}', [MemberController::class, 'digitalMemberApplied'])->name('digitalMemberApplied');
    Route::post('/store_digital_card_member', [MemberController::class, 'storeDigitalCardMemberData'])->name('storeDigitalCardMemberData');
    Route::post('/store_physical_card_member', [MemberController::class, 'storePhysicalCardMemberData'])->name('storePhysicalCardMemberData');

    Route::get('/apply-physical-membership', [MemberController::class, 'applyPhysicalMembership'])->name('applyPhysicalMembership');
    Route::post('/check-vivahmitra-membership', [MemberController::class, 'checkVivahMitraMembership'])->name('check.vivahmitra.membership');
    Route::get('/physical-member-applied/{id}', [MemberController::class, 'physicalMemberApplied'])->name('physicalMemberApplied');

    Route::get('/today-income', [MemberController::class, 'todayIncome'])->name('todayIncome');
    Route::get('/my-income', [MemberController::class, 'myIncome'])->name('myIncome');
    Route::get('/received-income', [MemberController::class, 'receivedIncome'])->name('receivedIncome');
    Route::get('/fund-wallet', [MemberController::class, 'fundWallet'])->name('fundWallet');
    Route::get('/fund-transfer', [MemberController::class, 'fundTransfer'])->name('fundTransfer');
    Route::post('/storeFundTransfer', [MemberController::class, 'storeFundTransfer'])->name('storeFundTransfer');

    Route::get('/get-vivahmitra-by-district/{district_id}', [MemberController::class, 'getVivahMitraByDistrict'])->name('getVivahMitraByDistrict');

    Route::get('/fund-transfer-history', [MemberController::class, 'fundTransferHistory'])->name('fundTransferHistory');

    Route::get('/income-statement', [MemberController::class, 'incomeStatement'])->name('incomeStatement');
    Route::post('/vivah-mitra/income-statement/filter', [MemberController::class, 'incomeStatementFilter'])->name('income.filter');

    // Route::get('/digital-member-applied/{id}', [MemberController::class, 'digitalMemberApplied'])->name('digitalMemberApplied');
    // Route::post('/store_digital_card_member', [MemberController::class, 'storeDigitalCardMemberData'])->name('storeDigitalCardMemberData');

    Route::get('/training-video', [MemberController::class, 'trainingVideo'])->name('trainingVideo');
    Route::get('/training-video-subcategory/{id}', [MemberController::class, 'trainingVideoSubcategory'])->name('trainingVideoSubcategory');
    Route::get('/view-training-video', [MemberController::class, 'viewTrainingVideo'])->name('viewTrainingVideo');

    Route::get('/physical-card-members', [MemberController::class, 'physicalCardMembers'])->name('physicalCardMembers');
    Route::get('/digital-card-members', [MemberController::class, 'digitalCardMembers'])->name('digitalCardMembers');
    Route::get('/vivah-mitra-card', [MemberController::class, 'vivahMitraCard'])->name('vivahMitraCard');
    Route::get('/digital-i-card', [MemberController::class, 'digitalICard'])->name('digitalICard');


    Route::get('/update-kyc', [MemberController::class, 'updateKyc'])->name('updateKyc');
    Route::get('/case-details', [MemberController::class, 'caseDetails'])->name('caseDetails');
    Route::get('/add-case-details', [MemberController::class, 'addCaseDetails'])->name('addCaseDetails');
    Route::post('/saveCaseDetailForm', [MemberController::class, 'saveCaseDetailForm'])->name('saveCaseDetailForm');
    Route::get('/case-list', [MemberController::class, 'caseList'])->name('caseList');
    Route::get('/certificate', [MemberController::class, 'getCertificate'])->name('getCertificate');
    Route::get('/id-card', [MemberController::class, 'getIdCard'])->name('getIdCard');
    Route::get('/my-profile', [MemberController::class, 'myProfile'])->name('myProfile');

    Route::get('/edit-profile', [MemberController::class, 'editProfile'])->name('editProfile');

    /** jila vivah mitra */
    Route::get('/jila-vivah-mitra-aavedan', [MemberController::class, 'jilaVivahMitraAavedan'])->name('jilaVivahMitraAavedan');
    Route::get('/jila-vivah-mitra-t-and-c', [MemberController::class, 'panchayatVivahMitraTandC'])->name('panchayatVivahMitraTandC');
    Route::get('/apply-jila-vivah-mitra', [MemberController::class, 'applyJilaVivahMitra'])->name('applyJilaVivahMitra');
    Route::post('/jila/select-box', [MemberController::class, 'jilaSelectBox'])->name('jila.jilaSelectBox');
    Route::post('/saveJilaVivahMitra', [MemberController::class, 'saveJilaVivahMitra'])->name('saveJilaVivahMitra');
    // jila-vivah-mitra-list
    Route::get('/jila-vivah-mitra-list', [MemberController::class, 'jilaVivahMitraList'])->name('jilaVivahMitraList');

    Route::get('/panchayat-vivah-mitra-aavedan', [MemberController::class, 'panchayatVivahMitraAavedan'])->name('panchayatVivahMitraAavedan');
    Route::get('/panchyat-vivah-mitra-t-and-c', [MemberController::class, 'panchayatVivahMitraTandC'])->name('panchayatVivahMitraTandC');
    Route::get('/apply-panchayat-vivah-mitra', [MemberController::class, 'applyPanchayatVivahMitra'])->name('applyPanchayatVivahMitra');

    Route::post('/vivah-mitra/update-profile', [MemberController::class, 'updateProfilePicture'])->name('vivahMitra.updateProfile');
    Route::post('/savePanchayatVivahMitra', [MemberController::class, 'savePanchayatVivahMitra'])->name('savePanchayatVivahMitra');

    Route::post('/vm/select-box', [MemberController::class, 'selectBox'])->name('vm.box.select');

    Route::get('/panchayat-vivah-mitra-list', [MemberController::class, 'panchayatVivahMitraList'])->name('panchayatVivahMitraList');

    /** जिला कॉर्डिनटोर विवाह मित्र  */

    Route::get('/prakhand-vivah-mitra-se-income', [MemberController::class, 'prakhandVivahMitraSeIncome'])->name('prakhandVivahMitraSeIncome');

    Route::get('/prakhand-vivah-mitra-aavedan', [MemberController::class, 'prakhandVivahMitraAavedan'])->name('prakhandVivahMitraAavedan');
    Route::get('/prakhand-vivah-mitra-t-and-c', [MemberController::class, 'prakhandVivahMitraTandC'])->name('prakhandVivahMitraTandC');
    Route::get('/jila-vivah-mitra-t-and-c', [MemberController::class, 'jilaVivahMitraTandC'])->name('jilaVivahMitraTandC');
    Route::get('/apply-prakhand-vivah-mitra', [MemberController::class, 'applyPrakhandVivahMitra'])->name('applyPrakhandVivahMitra');

    Route::post('/check-membership-number', [MemberController::class, 'checkMembershipNumber'])->name('check.membershipnumber');

    Route::post('/j/select-box', [MemberController::class, 'jilaSBox'])->name('jila.jilaSBox');
    // jilaVivahMitraTandC
    Route::post('/savePrakhandVivahMitra', [MemberController::class, 'savePrakhandVivahMitra'])->name('savePrakhandVivahMitra');
    Route::get('/prakhand-vivah-mitra-list', [MemberController::class, 'prakhandVivahMitraList'])->name('prakhandVivahMitraList');

    Route::get('/physical-card-received', [MemberController::class, 'physicalCardReceived'])->name('physicalCardReceived');
    Route::get('/physical-card-transfer-history', [MemberController::class, 'physicalCardTransferHistory'])->name('physicalCardTransferHistory');
    Route::get('/physical-card-transfer', [MemberController::class, 'physicalCardTransfer'])->name('physicalCardTransfer');
    Route::post('/transferCard', [MemberController::class, 'transferCard'])->name('transferCard');

    /** kit transfer */

    Route::get('/kit-transfer-history', [MemberController::class, 'kitTransferHistory'])->name('kitTransferHistory');
    Route::get('/pending-kit-received', [MemberController::class, 'pendingKitReceived'])->name('pendingKitReceived');
    Route::get('/kit-transfer', [MemberController::class, 'kitTransfer'])->name('kitTransfer');
    Route::get('/accept-kit-here/{id}', [MemberController::class, 'acceptKitHere'])->name('acceptKitHere');
    Route::post('/transferKits', [MemberController::class, 'transferKits'])->name('transferKits');
    Route::post('/acceptTransfer', [MemberController::class, 'acceptTransfer'])->name('acceptTransfer');

    // pending-card-received

    Route::get('/pending-card-received', [MemberController::class, 'pendingCardReceived'])->name('pendingCardReceived');
    Route::get('/accept-physical-card-here/{id}', [MemberController::class, 'acceptPhysicalCardHere'])->name('acceptPhysicalCardHere');
    Route::post('/acceptPhysicalCardTransfer', [MemberController::class, 'acceptPhysicalCardTransfer'])->name('acceptPhysicalCardTransfer');

    /** vivah mitra aavedan */

    Route::get('/vivah-mitra-aavedan', [MemberController::class, 'vivahMitraAavedan'])->name('vivahMitraAavedan');


    Route::get('/fund-recharge', [MemberController::class, 'fundRecharge'])->name('fundRecharge');
    Route::get('/vivah-mitra-t-and-c', [MemberController::class, 'vivahMitraTandC'])->name('vivahMitraTandC');
    Route::get('/apply-vivah-mitra', [MemberController::class, 'applyVivahMitra'])->name('applyVivahMitra');

    Route::post('/vivahmitra/select-box', [MemberController::class, 'vivahmitraSelectBox'])->name('vivahmitra.vivahmitraSelectBox');
    Route::post('/saveVivahMitra', [MemberController::class, 'saveVivahMitra'])->name('saveVivahMitra');
    Route::get('/vivah-mitra-list', [MemberController::class, 'vivahMitraList'])->name('vivahMitraList');

    Route::get('/appointment-letter-download/{id}', [MemberController::class, 'downloadAppointmentLetter'])->name('downloadAppointmentLetter');
    Route::get('/certificate-download/{id}', [MemberController::class, 'downloadCertificate'])->name('downloadCertificate');


    Route::get('/income-sources', [MemberController::class, 'incomeSources'])->name('incomeSources');
    Route::get('/all-application-apply', [MemberController::class, 'allApplicationApply'])->name('allApplicationApply');
    Route::get('/work-details', [MemberController::class, 'workDetails'])->name('workDetails');
    Route::get('/all-types-of-transfer', [MemberController::class, 'allTypesOfTransfer'])->name('allTypesOfTransfer');
    Route::get('/other-details', [MemberController::class, 'otherDetails'])->name('otherDetails');
    Route::get('/welcome-letter', [MemberController::class, 'welcomeLetter'])->name('welcomeLetter');
    Route::get('/joining-letter', [MemberController::class, 'joiningLetter'])->name('joiningLetter');
    Route::get('/my-invoice', [MemberController::class, 'myInvoice'])->name('myInvoice');
    Route::get('/prakhand-list', [MemberController::class, 'prakhandList'])->name('prakhandList');

    Route::get('/apply-home-meeting', [MemberController::class, 'applyHomeMeeting'])->name('applyHomeMeeting');
    Route::post('/storeHomeMeeting', [MemberController::class, 'storeHomeMeeting'])->name('storeHomeMeeting');


    Route::get('/apply-trainer-meet', [MemberController::class, 'applyTrainerMeet'])->name('applyTrainerMeet');
    Route::post('/storeTrainerMeet', [MemberController::class, 'storeTrainerMeet'])->name('storeTrainerMeet');

    Route::get('/seminar-guest-meet', [MemberController::class, 'seminarGuestMeet'])->name('seminarGuestMeet');
    Route::post('/storeSeminarGuestMeet', [MemberController::class, 'storeSeminarGuestMeet'])->name('storeSeminarGuestMeet');

    Route::get('/company-bank-details', [MemberController::class, 'companyBankDetails'])->name('companyBankDetails');
    Route::get('/applied-trainer-meet-list', [MemberController::class, 'appliedTrainerMeetingList'])->name('appliedTrainerMeetingList');
    Route::get('/applied-seminar-meet-list', [MemberController::class, 'appliedSeminarMeetingList'])->name('appliedSeminarMeetingList');
    Route::get('/applied-home-meet-list', [MemberController::class, 'appliedHomeMeetingList'])->name('appliedHomeMeetingList');

    Route::get('/kit-training-charge', [MemberController::class, 'kitTrainingCharge'])->name('kitTrainingCharge');

    Route::get('/photo-gallery', [MemberController::class, 'photoGallery'])->name('photoGallery');
    Route::get('/gallery-details/{slug}', [MemberController::class, 'photoGalleryDetails'])->name('photoGalleryDetails');

    Route::get('/show-data-for-employee/{id}', [MemberController::class, 'showDataForEmployee'])->name('showDataForEmployee');
    Route::get('/incentive-district-wise', [MemberController::class, 'incentiveDistrictWise'])->name('incentiveDistrictWise');
    Route::get('/show-incentive-district-wise/{id}', [MemberController::class, 'showIncentiveDistrictWise'])->name('showIncentiveDistrictWise');

    Route::get('/employee-target', [MemberController::class, 'employeeTarget'])->name('employeeTarget');
    Route::get('/send-online-payment', [MemberController::class, 'sendOnlinePayment'])->name('sendOnlinePayment');
    Route::post('/online-payment-preview', [MemberController::class, 'sendOnlinePaymentPreview'])->name('sendOnlinePaymentPreview');
    Route::post('/online-payment-store', [MemberController::class, 'onlinePaymentStore'])->name('onlinePaymentStore');
    Route::get('/payment-list', [MemberController::class, 'paymentList'])->name('payment.list');

    Route::get('/cash-payment-send-details', [MemberController::class, 'cashPaymentSendDetails'])->name('cashPaymentSendDetails');
    Route::post('/saveTempCashPaymentDetails', [MemberController::class, 'saveTempCashPaymentDetails'])->name('saveTempCashPaymentDetails');
    Route::post('/finalSave', [MemberController::class, 'finalCashPaymentSave'])->name('cash.final.save');
    Route::get('/cash-payment-send-details-preview/{id}', [MemberController::class, 'cashPaymentSendDetailsPreview'])->name('cashPaymentSendDetailsPreview');

    Route::get('/cash-payment-list', [MemberController::class, 'cashPaymentHistory'])->name('cashPaymentHistory');

    Route::get('/online-payment-sent-report', [MemberController::class, 'onlinePaymentSentReport'])->name('onlinePaymentSentReport');
    Route::get('/monthly-routine-work-list', [MemberController::class, 'monthlyRoutineWorkList'])->name('monthlyRoutineWorkList');

    // send-monthly-routine-work

    Route::get('/send-monthly-routine-work', [MemberController::class, 'sendMonthlyRoutineWork'])->name('sendMonthlyRoutineWork');
    Route::post('/monthlyRoutineWorkSave', [MemberController::class, 'monthlyRoutineWorkSave'])->name('monthlyRoutineWorkSave');


    Route::get('/important-work', [MemberController::class, 'importantWork'])->name('importantWork');




    Route::get('/member-logout', [LogoutController::class, 'memberLogout'])->name('memberlogout');
});
