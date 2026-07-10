<?php

use App\Http\Controllers\Admin\TermsAndConditionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AttendanceController;
use App\Http\Controllers\Admin\LogoutController;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ImageCategoryController;
use App\Http\Controllers\Admin\GalleryController;

use App\Http\Controllers\Admin\EventCategoryController;
use App\Http\Controllers\Admin\EventGalleryController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\BrandController;


use App\Http\Controllers\Admin\CmsPageController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BusinessController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\TenderController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SessionController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\ExpenseManagementController;
use App\Http\Controllers\Admin\FranchiseController;
use App\Http\Controllers\Admin\UserTypeController;
use App\Http\Controllers\Admin\MasterDesignationController;
use App\Http\Controllers\Admin\MasterFundController;
use App\Http\Controllers\Admin\MasterAgreementController;
use App\Http\Controllers\Admin\MasterTargetController;
use App\Http\Controllers\Admin\MasterVideoController;
use App\Http\Controllers\Admin\MasterBonusController;
use App\Http\Controllers\Admin\NavigationController;

use App\Http\Controllers\Admin\MasterMembershipController;
use App\Http\Controllers\Admin\MasterNoticeController;
use App\Http\Controllers\Admin\MasterInvestorController;
use App\Http\Controllers\Admin\MasterVendorController;
use App\Http\Controllers\Admin\WalletController;

use App\Http\Controllers\Admin\VivahMitraCategoryController;
use App\Http\Controllers\Admin\VivahMitraProductController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Admin\SmsController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\CardController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\MasterOfferController;
use App\Http\Controllers\Admin\MasterTnCVoideoController;
use App\Http\Controllers\Admin\TrainingVideoCategoryController;
use App\Http\Controllers\Admin\MasterKitController;
use App\Http\Controllers\Admin\EmployeeTargetController;
use App\Http\Controllers\Admin\KitController;
use App\Http\Controllers\Admin\ShopController;

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

/** Route for clear cache */
Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Cache is cleared by @RanaSharma";
})->name('clear-cache');

Route::post('/check-membership', [MasterMembershipController::class, 'checkMembership'])->name('membership.checkMembership');

Route::get('admin/auth/login', [LoginController::class, 'login'])->name('admin.auth.login')->middleware('AlreadyLoggedIn');
Route::get('admin', [LoginController::class, 'login'])->name('admin')->middleware('AlreadyLoggedIn');
Route::post('adminAuthLogin', [LoginController::class, 'adminAuthLogin'])->name('adminAuthLogin')->middleware('AlreadyLoggedIn');

Route::group(['prefix' => 'admin', 'middleware' => ['AdminAuthCheck'], 'as' => 'admin.'], function () {
    Route::get('/dashboard', [AdminController::class, 'adminDashboard'])->name('dashboard');
    Route::get('/reset-password', [AdminController::class, 'resetPassword'])->name('resetPassword');
    Route::post('/updateAdminPassword', [AdminController::class, 'updateAdminPassword'])->name('updateAdminPassword');
    Route::get('/notification', [AdminController::class, 'notificationList'])->name('notificationList');
    Route::get('/add-notification', [AdminController::class, 'addNotification'])->name('addNotification');
    Route::get('/edit-notification/{id}', [AdminController::class, 'editNotification'])->name('editNotification');
    Route::get('/deleteNotification/{id}', [AdminController::class, 'deleteNotification'])->name('deleteNotification');
    Route::post('/storeNotification', [AdminController::class, 'storeNotification'])->name('storeNotification');
    Route::post('/updateNotification', [AdminController::class, 'updateNotification'])->name('updateNotification');

    Route::get('/users', [AttendanceController::class, 'users']);
    Route::get('/attendance/{id}', [AttendanceController::class, 'attendancePage'])->name('attendancePage');
    Route::post('/attendance/checkin', [AttendanceController::class, 'checkIn'])->name('attendance.checkIn');
    Route::post('/attendance/checkout', [AttendanceController::class, 'checkOut'])->name('attendance.checkOut');
    Route::get('/attendance-list', [AttendanceController::class, 'attendanceList'])->name('attendanceList');
    Route::get('/reverse-geocode', [AttendanceController::class, 'reverseGeocode']);
    Route::get('/attendance-report', [AttendanceController::class, 'attendanceReport']);
    Route::get('/attendance-calendar', [AttendanceController::class, 'calendar']);

    Route::resource('/designation', DesignationController::class);


    Route::get('/get-designation-by-user/{state_id}', [MasterDesignationController::class, 'getDesignationByUserType']);

    /** Route for Category and Sub Category */
    Route::resource('/categories', CategoryController::class);
    Route::get('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    Route::resource('/sub_categories', SubCategoryController::class);

    /** Route for Locations */
    Route::resource('/countries', CountryController::class);

    /** Route for Blog */
    Route::resource('/blogs', BlogController::class);
    Route::get('/blog/delete/{id}', [BlogController::class, 'delete'])->name('blog.delete');
    // Route::post('/blogs/fetch_subcategory', [BlogController::class, 'fetchSubCategory'])->name('blogs.fetch_subcategory');
    Route::post('/blogs/fetch_category', [BlogController::class, 'fetchCategory'])->name('blogs.fetch_category');
    Route::get('/blogs/show_comments/{blog_id}', [BlogController::class, 'showComments'])->name('blogs.show_comments');
    Route::get('/blogs/show_likes/{blog_id}', [BlogController::class, 'showLikes'])->name('blogs.show_likes');
    Route::get('/blogs/show_views/{blog_id}', [BlogController::class, 'showViews'])->name('blogs.show_views');
    Route::get('/blog/change_comment_status', [BlogController::class, 'changeCommentStatus'])->name('blog.change_comment_status');

    /** videos of assembly */
    Route::get('/videos-of-assembly', [BlogController::class, 'videosOfAssembly'])->name('videosOfAssembly');
    Route::get('/videos-of-assembly/create', [BlogController::class, 'videosOfAssemblyAdd'])->name('videosOfAssemblyAdd');
    Route::post('/videosOfAssemblyStore', [BlogController::class, 'videosOfAssemblyStore'])->name('videosOfAssemblyStore');
    Route::get('/videos-of-assembly/delete/{id}', [BlogController::class, 'videosOfAssemblyDelete'])->name('videosOfAssemblyDelete.delete');

    Route::get('/videos-category', [BlogController::class, 'videosCategory'])->name('videosOfAssembly');
    Route::post('/video-category/store', [BlogController::class, 'storeVideosCategory'])->name('storeVideosCategory');
    Route::post('/video-category/update/{id}', [BlogController::class, 'updateVideosCategory'])->name('updateVideoCategory');
    Route::get('/video-category/edit/{id}', [BlogController::class, 'editVideoCategory'])->name('editVideoCategory');

    /** common videos  */
    Route::get('/common-videos', [BlogController::class, 'commonVideos'])->name('commonVideos');
    Route::get('/common-videos/create', [BlogController::class, 'commonVideosAdd'])->name('commonVideosAdd');
    Route::post('/commonVideosStore', [BlogController::class, 'commonVideosStore'])->name('commonVideosStore');
    Route::get('/common-videos/delete/{id}', [BlogController::class, 'commonVideosDelete'])->name('commonVideosDelete.delete');


    /** Route For Gallery */
    Route::resource('/image_categories', ImageCategoryController::class);
    Route::get('/image_categories/delete/{id}', [ImageCategoryController::class, 'delete'])->name('image_categories.delete');
    Route::resource('/galleries', GalleryController::class);
    Route::get('/galleries/delete/{id}', [GalleryController::class, 'delete'])->name('galleries.delete');
    Route::get('/gallery/category/delete/{id}', [ImageCategoryController::class, 'delete'])->name('gallery.gallery_category_delete');

    /** Route For latest events */
    Route::resource('/event_categories', EventCategoryController::class);
    Route::get('/event_categories/delete/{id}', [EventCategoryController::class, 'delete'])->name('event_categories.delete');
    Route::resource('/event_galleries', EventGalleryController::class);
    // Route::get('/event_galleries/delete/{id}', [EventGalleryController::class, 'delete'])->name('galleries.delete');
    // Route::get('/event_galleries/category/delete/{id}', [EventCategoryController::class, 'delete'])->name('gallery.gallery_category_delete');

    /** Route For CMS Page */
    Route::resource('/pages', CmsPageController::class);

    /** Route For Page Section */
    Route::get('/page_sections', [CmsPageController::class, 'pageSectionIndex'])->name('page_sections.index');
    Route::get('/page_sections/create', [CmsPageController::class, 'pageSectionCreate'])->name('page_sections.create');
    Route::post('/page_sections/store', [CmsPageController::class, 'pageSectionStore'])->name('page_sections.store');
    Route::get('/page_sections/{id}/edit', [CmsPageController::class, 'pageSectionEdit'])->name('page_sections.edit');
    Route::put('/page_sections/update/{id}', [CmsPageController::class, 'pageSectionUpdate'])->name('page_sections.update');

    Route::get('/sms-lists', [SmsController::class, 'SmsList'])->name('sms.list');
    Route::get('/member-list', [StaffController::class, 'memberList'])->name('member.list');
    Route::get('/call-member-list', [StaffController::class, 'CallMemberList'])->name('call.member.list');
    Route::get('/probably-aayushmati-data', [StaffController::class, 'probablyAayushmatiData'])->name('probably.aayushmati.data');

    Route::get('/upcoming-aayushmati-marriage/{offset}', [StaffController::class, 'upcomingAayushmatiDataByMonth'])->name('upcomingaayushmati.month');

    /** Route For Section Data */
    Route::get('/section_data', [CmsPageController::class, 'sectionDataIndex'])->name('section_data.index');
    Route::get('/section_data/create', [CmsPageController::class, 'sectionDataCreate'])->name('section_data.create');
    Route::post('/section_data/fetch_section', [CmsPageController::class, 'fetchSection'])->name('section_data.fetch_section');
    Route::post('/section_data/store', [CmsPageController::class, 'sectionDataStore'])->name('section_data.store');
    Route::get('/section_datas/{id}/edit', [CmsPageController::class, 'sectionDataEdit'])->name('section_data.edit');
    Route::put('/section_datas/update/{id}', [CmsPageController::class, 'sectionDataUpdate'])->name('section_data.update');
    Route::get('/cms_section_datas/delete/{id}', [CmsPageController::class, 'deleteCmsSectionData'])->name('cmssection_data.delete');

    /** Route For Product Page */
    // Route::resource('/product', ProductController::class);
    // Route::get('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

    Route::get('/price/enquiry', [CmsPageController::class, 'priceEnquiryList'])->name('price.enquiry');
    Route::get('/customer/leads', [CmsPageController::class, 'customerLeadList'])->name('customer.leads');
    Route::get('/home-page-enquiry', [CmsPageController::class, 'onlineEnquiry'])->name('customer.onlineEnquiry');
    Route::get('/complain-list', [CmsPageController::class, 'complainEnquiry'])->name('customer.complainEnquiry');
    Route::get('/contact-enquiry', [CmsPageController::class, 'contactEnquiry'])->name('customer.contactEnquiry');
    Route::get('/career/enquiry', [CmsPageController::class, 'careerEnquiryList'])->name('career.enquiry');
    Route::get('/hire_team/enquiry', [CmsPageController::class, 'hireTeamEnquiryList'])->name('hire_team.enquiry');
    Route::get('/quotation-list', [CmsPageController::class, 'quotationList'])->name('career.quotationList');
    Route::get('/schedule-meeting-list', [CmsPageController::class, 'scheduleMeetingList'])->name('career.scheduleMeetingList');
    Route::get('/subscribers', [CmsPageController::class, 'subscriberList'])->name('subscribers');
    Route::get('/certificates', [CmsPageController::class, 'certificateList'])->name('certificateList');
    Route::get('/certificate/add-certificate', [CmsPageController::class, 'addCertificate'])->name('addCertificate');
    Route::post('storeCertificate', [CmsPageController::class, 'storeCertificate'])->name('storeCertificate');

    Route::get('/sms-list', [CmsPageController::class, 'smsList'])->name('sms.list');

    /** Route For Testimonial Page */
    Route::resource('/testimonials', TestimonialController::class);
    Route::get('/testimonials/delete/{id}', [TestimonialController::class, 'delete'])->name('testimonials.delete');

    Route::get('/testimonial/videos', [TestimonialController::class, 'videoIndex'])->name('testimonial.videos');
    Route::get('/testimonial/videos/create', [TestimonialController::class, 'videoCreate'])->name('testimonial.videos.create');
    Route::post('/testimonial/videos/store', [TestimonialController::class, 'videoStore'])->name('testimonial.videos.store');
    Route::get('/testimonial/videos/{id}/edit', [TestimonialController::class, 'videoEdit'])->name('testimonial.videos.edit');
    Route::put('/testimonial/videos/update/{id}', [TestimonialController::class, 'videoUpdate'])->name('testimonial.videos.update');
    Route::get('/testimonial/videos/delete/{id}', [TestimonialController::class, 'deleteVideo'])->name('testimonial.videos.delete');

    /** Route For user/customer Page */
    Route::get('/users/index', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/change_status', [UserController::class, 'changeStatus'])->name('users.change_status');

    /** Route For Customer/E-commerce Orders Page */
    Route::get('/customer-list', [\App\Http\Controllers\Admin\CustomerOrderController::class, 'userList'])->name('customer.index');
    Route::get('/customer-addresses/{userId}', [\App\Http\Controllers\Admin\CustomerOrderController::class, 'userAddresses'])->name('customer.addresses');
    Route::get('/customer-orders', [\App\Http\Controllers\Admin\CustomerOrderController::class, 'orderList'])->name('customer.orders');
    Route::get('/customer-order-details/{orderId}', [\App\Http\Controllers\Admin\CustomerOrderController::class, 'orderDetails'])->name('customer.order_details');
    Route::post('/customer-order-status-update', [\App\Http\Controllers\Admin\CustomerOrderController::class, 'updateOrderStatus'])->name('customer.order_status_update');

    /** Route For Bussiness Setting page */
    Route::get('/website/social_media', [BusinessController::class, 'socialMedia'])->name('website.social_media');
    Route::get('/website/header', [BusinessController::class, 'websiteHeader'])->name('website.header');
    Route::get('/website/footer', [BusinessController::class, 'websiteFooter'])->name('website.footer');
    Route::post('/website/update', [BusinessController::class, 'websiteSetupUpdate'])->name('website.update');
    Route::post('/website/footerupdate', [BusinessController::class, 'websiteFooterSetupUpdate'])->name('websitefooter.update');
    Route::post('/website/update_widget', [BusinessController::class, 'websiteSetupUpdateWidget'])->name('website.update_widget');
    Route::get('/website/office_setup', [BusinessController::class, 'officeSetup'])->name('website.office_setup');
    Route::post('/website/update_office_setup', [BusinessController::class, 'updateOfficeSetup'])->name('website.update_office_setup');

    Route::get('/website/home-banner', [BusinessController::class, 'homeBanner'])->name('website.homeBanner');
    Route::post('/updateHomeBanner', [BusinessController::class, 'updateHomeBanner'])->name('updateHomeBanner');
    Route::get('/website/edit-home-banner/{id}', [BusinessController::class, 'editHomeBanner'])->name('editHomeBanner');
    Route::post('/storeHomeBanner', [BusinessController::class, 'storeHomeBanner'])->name('storeHomeBanner');

    Route::get('/website/vivah-mitra-app-sliders', [BusinessController::class, 'vivahMitraAppSliders'])->name('website.vivahMitraAppSliders');
    Route::post('/updatevivahMitraAppSliders', [BusinessController::class, 'updatevivahMitraAppSliders'])->name('updatevivahMitraAppSliders');
    Route::get('/website/edit-vivah-mitra-app-sliders/{id}', [BusinessController::class, 'editVivahMitraAppBanner'])->name('editVivahMitraAppBanner');
    Route::get('/website/delete-vivah-mitra-app-sliders/{id}', [BusinessController::class, 'deleteVivahMitraAppBanner'])->name('deleteVivahMitraAppBanner');
    Route::post('/storeVivahMitraAppSliders', [BusinessController::class, 'storeVivahMitraAppSliders'])->name('storeVivahMitraAppSliders');

    Route::resource('/faqs', FaqController::class);
    Route::get('faq-category', [FaqController::class, 'faqCategory'])->name('faq.faqCategory');
    Route::get('faq-category-list', [FaqController::class, 'faqCategoryList'])->name('faqCategoryList');
    Route::get('faq-category-edit/{id}', [FaqController::class, 'faqCategoryEdit'])->name('faqCategoryEdit');
    Route::post('storeFaqCategory', [FaqController::class, 'storeFaqCategory'])->name('storeFaqCategory');
    Route::post('FaqCategoryUpdate', [FaqController::class, 'FaqCategoryUpdate'])->name('FaqCategoryUpdate');
    Route::post('fetch_faq_category', [FaqController::class, 'fetch_faq_category'])->name('fetch_faq_category');
    Route::get('/faqs/delete/{id}', [FaqController::class, 'delete'])->name('faqs.delete');

    Route::resource('/staffs', StaffController::class);
    Route::get('/staffs/change_status', [StaffController::class, 'changeStatus'])->name('staffs.change_status');
    Route::get('/users/fetch', [StaffController::class, 'fetch'])->name('users.fetch');
    Route::get('/emp/verify-employee/{id}', [StaffController::class, 'verifyEmployee'])->name('verifyEmployee');
    Route::get('/emp/update-employee-details/{id}', [StaffController::class, 'viewEmployeeDetails'])->name('viewEmployeeDetails');
    Route::get('/emp/view-team-details/{id}', [StaffController::class, 'viewTeam'])->name('viewTeam');

    Route::post('/updateVMBox', [StaffController::class, 'updateVMBox'])->name('updateVMBox');

    Route::get('/emp/team-children/{id}', [StaffController::class, 'getChildren']);
    Route::get('/emp/team-search', [StaffController::class, 'searchTeam']);

    Route::get('/emp/employee/print-full/{id}', [StaffController::class, 'printEmployeeFullProfile'])->name('employee.printFull');
    Route::get('/vivah-mitra-agreement-print/{id}', [StaffController::class, 'printVivahMitraAgreement'])->name('employee.printVivahMitraAgreement');
    Route::match(['get', 'post'], '/vivah-mitra-incentive', [StaffController::class, 'vivahMitraIncentive'])->name('vivahMitraIncentive');
    Route::match(['get', 'post'], '/panchayat-vivah-mitra-incentive', [StaffController::class, 'panchayatVivahMitraIncentive'])->name('panchayatVivahMitraIncentive');
    Route::match(['get', 'post'], '/prakhand-vivah-mitra-incentive', [StaffController::class, 'prakhandVivahMitraIncentive'])->name('prakhandVivahMitraIncentive');
    Route::match(['get', 'post'], '/jila-vivah-mitra-incentive', [StaffController::class, 'jilaVivahMitraIncentive'])->name('jilaVivahMitraIncentive');

    Route::get('/incentive/wallet-transaction/details/{wallet_id}',  [StaffController::class, 'walletTransactionDetails'])->name('vivahMitraIncentive.details');
    Route::get('/print-user-payment-statement/{id}', [StaffController::class, 'printUserPaymentStatement'])->name('printUserPaymentStatement');


    Route::get('/member/{id}/call-remark', [StaffController::class, 'showCallRemarkForm'])->name('call.remark');

    Route::post('/member/call-remark-store', [StaffController::class, 'storeCallRemark'])
        ->name('call.remark.store');

    Route::get('/member/{id}/call-details', [StaffController::class, 'showCallDetails'])
        ->name('call.details');


    Route::get('/user-bank-details/{id}', [TransactionController::class, 'getUserBank']);
    Route::post('/transactions/store', [TransactionController::class, 'store'])->name('transactions.store');


    Route::get('/generate-vivah-mitra-code', [StaffController::class, 'generateVivahMitraCode'])->name('staffs.generateVivahMitraCode');

    Route::get('/codes/fetchVivahMitraCodes', [StaffController::class, 'fetchVivahMitraCodes'])->name('staffs.fetchVivahMitraCodes');


    Route::post('/post/saveVivahMitraCode', [StaffController::class, 'saveVivahMitraCode'])->name('staffs.saveVivahMitraCode');
    Route::get('/staffs/add-vivah-mitra/{code}', [StaffController::class, 'addVivahMitra'])->name('staffs.addVivahMitra');
    Route::post('/post/storeVivahMitraData', [StaffController::class, 'storeVivahMitraData'])->name('staffs.storeVivahMitraData');

    Route::get('/vivah-mitra-list', [StaffController::class, 'vivahMitraList'])->name('staffs.vivahMitraList');
    Route::get('/emp/fetchVivahMitra', [StaffController::class, 'fetchVivahMitra'])->name('emp.fetchVivahMitra');
    Route::get('/emp/deleteVmVox/{id}', [StaffController::class, 'deleteVmVox'])->name('emp.deleteVmVox');

    Route::get('/vivah-mitra-in-app', [StaffController::class, 'vivahMitraListInApp'])->name('staffs.vivahMitraListInApp');
    Route::get('/emp/fetchVivahMitraInApp', [StaffController::class, 'fetchVivahMitraInApp'])->name('emp.fetchVivahMitraInApp');
    Route::get('/add-vivah-mitra-team', [StaffController::class, 'addVivahMitraTeam'])->name('emp.addVivahMitraTeam');

    Route::get('/vivah-mitra-payout-list', [StaffController::class, 'vivahMitraPayoutList'])->name('staffs.vivahMitraPayoutList');
    Route::get('/emp/fetchVivahMitraPayout', [StaffController::class, 'fetchVivahMitraPayout'])->name('emp.fetchVivahMitraPayout');

    Route::get('/vivah-mitra-payment-sent-list', [StaffController::class, 'vivahMitraPaymentSentList'])->name('staffs.vivahMitraPaymentSentList');


    Route::get('/emp/promoteVivahMitra/{id}', [StaffController::class, 'promoteVivahMitra'])->name('emp.promoteVivahMitra');

    Route::post('/emp/updateVivahMitraPromotion', [StaffController::class, 'updateVivahMitraPromotion'])->name('emp.updateVivahMitraPromotion');
    Route::post('/emp/adminVivahMitraLoginPost', [StaffController::class, 'adminVivahMitraLoginPost'])->name('emp.adminVivahMitraLoginPost');

    Route::get('/membership/view-vivahmitra-memberships/{id}', [MasterMembershipController::class, 'viewVivahMitraMemberships'])->name('membership.viewVivahMitraMemberships');
    Route::get('/membership/fetchVivahMitraMemberships', [MasterMembershipController::class, 'fetchVivahMitraMemberships'])->name('membership.fetchVivahMitraMemberships');

    Route::get('/membership/export-vivahmitra-memberships/{id}', [MasterMembershipController::class, 'exportVivahMitraMemberships'])->name('membership.exportVivahMitraMemberships');

    Route::get('/membership/export-memberships', [MasterMembershipController::class, 'exportMemberships'])->name('membership.exportMemberships');
    Route::get('/add-membership-old', [MasterMembershipController::class, 'addOldMemberships'])->name('membership.addOldMemberships');

    // vivah-mitra-list
    // funds.transferFundtoBranch

    Route::post('/emp/get-employee-details/', [StaffController::class, 'getEmployeeDetails'])->name('getEmployeeDetails');
    Route::post('/post/SaveEmployeePhoto/', [StaffController::class, 'SaveEmployeePhoto'])->name('emp.SaveEmployeePhoto');
    Route::post('/post/SaveEmployeeDetails/', [StaffController::class, 'SaveEmployeeDetails'])->name('emp.SaveEmployeeDetails');
    Route::post('/post/updateEmployeeDetails/', [StaffController::class, 'updateEmployeeDetails'])->name('emp.updateEmployeeDetails');
    Route::post('/post/updateBlockStatus/', [StaffController::class, 'updateBlockStatus'])->name('emp.updateBlockStatus');
    Route::post('/post/updateUnBlockDateStatus/', [StaffController::class, 'updateUnBlockDateStatus'])->name('emp.updateUnBlockDateStatus');



    Route::get('/bdm-list', [StaffController::class, 'bdmList'])->name('users.bdmList');
    Route::get('/bdm/fetch', [StaffController::class, 'fetchBdmData'])->name('bdm.fetch');

    /** Route For doctor vist Page */
    Route::resource('/visits', VisitController::class);

    /** Route For doctor vist Page */
    Route::resource('/tenders', TenderController::class);

    /** Route for course */

    Route::get('/add-course', [AdminController::class, 'addCourse'])->name('addCourse');
    Route::get('/course-list', [AdminController::class, 'courseList'])->name('courseList');
    Route::get('/edit-course/{id}', [AdminController::class, 'editCourse'])->name('editCourse');
    Route::post('/updateCourseDetails', [AdminController::class, 'updateCourseDetails'])->name('updateCourseDetails');
    Route::post('/courseStore', [AdminController::class, 'uploadCourseDetails'])->name('courseStore');

    /** Route for sub course */

    Route::get('/add-subcourse', [AdminController::class, 'addSubCourse'])->name('addSubCourse');
    Route::get('/subcourse-list', [AdminController::class, 'SubcourseList'])->name('SubcourseList');
    Route::get('/edit-subcourse/{id}', [AdminController::class, 'editSubCourse'])->name('editSubCourse');
    Route::post('/updateSubCourseDetails', [AdminController::class, 'updateSubCourseDetails'])->name('updateSubCourseDetails');
    Route::post('/SubcourseStore', [AdminController::class, 'uploadSubCourseDetails'])->name('uploadSubCourseDetails');

    /** Route for subjects */
    Route::get('/subject-list', [AdminController::class, 'subjectList'])->name('subjectList');
    Route::get('/add-subject', [AdminController::class, 'addSubject'])->name('addSubject');
    Route::post('saveSubjects', [AdminController::class, 'saveSubjects'])->name('saveSubjects');

    Route::get('admin/get-subject/{id}', [AdminController::class, 'getSubject']);
    Route::post('admin/update-subject/{id}', [AdminController::class, 'updateSubject']);

    /** Route for franchise */
    Route::get('/pending-franchise', [AdminController::class, 'pendingFranchise'])->name('pendingFranchise');
    Route::get('/edit-franchise/{id}', [AdminController::class, 'editFranchise'])->name('editFranchise');
    Route::get('/approved-franchise', [AdminController::class, 'approvedFranchise'])->name('approvedFranchise');
    Route::post('/updateFranchiseStatus', [AdminController::class, 'updateFranchiseStatus'])->name('updateFranchiseStatus');
    Route::post('/updateFranchiseDetails', [AdminController::class, 'updateFranchiseDetails'])->name('updateFranchiseDetails');

    /** Route for franchise */
    Route::get('/add-fund', [AdminController::class, 'addFund'])->name('addFund');
    Route::get('/fund-list', [AdminController::class, 'fundList'])->name('fundList');
    Route::post('/storeFund', [AdminController::class, 'storeFund'])->name('storeFund');


    /** Route for students */
    Route::get('/pending-student', [AdminController::class, 'pendingStudent'])->name('pendingStudent');
    Route::get('/approved-student', [AdminController::class, 'approvedStudent'])->name('approvedStudent');
    Route::post('/updateStudentStatus', [AdminController::class, 'updateStudentStatus'])->name('updateStudentStatus');
    Route::post('/updateStudentDetails', [AdminController::class, 'updateStudentDetails'])->name('updateStudentDetails');
    Route::get('/view-student/{id}', [AdminController::class, 'viewStudent'])->name('viewStudent');
    Route::get('/edit-student-details/{id}', [AdminController::class, 'editStudentDetails'])->name('editStudentDetails');
    Route::get('/add-student-manual-result/{id}', [AdminController::class, 'addManualResult'])->name('addManualResult');
    Route::get('/view-student-manual-result/{id}', [AdminController::class, 'viewStudentManualResult'])->name('viewStudentManualResult');
    Route::post('/saveManualStudentResult', [AdminController::class, 'saveManualStudentResult'])->name('saveManualStudentResult');

    /** Route for generate documents like certificate and marksheet */
    // Route::get('/generate-certificate', [AdminController::class, 'generateCertificate'])->name('generateCertificate');
    Route::get('generate-certificate', [AdminController::class, 'generateCertificate'])->name('generateCertificate');
    Route::get('view-certificate-template', [AdminController::class, 'viewCertificateTemplate'])->name('viewCertificateTemplate');
    Route::post('saveSubCourseCertificate', [AdminController::class, 'saveSubCourseCertificate'])->name('saveSubCourseCertificate');

    Route::get('/add-result', [AdminController::class, 'addResult'])->name('addResult');
    Route::post('/saveStudentResult', [AdminController::class, 'saveStudentResult'])->name('saveStudentResult');
    Route::get('/view-result', [AdminController::class, 'viewResult'])->name('viewResult');
    Route::get('/view-certificate', [AdminController::class, 'viewCertificate'])->name('viewCertificate');

    // Route::get('/e-admit-card', [AdminController::class, 'eAdmitCard'])->name('eAdmitCard');
    Route::get('/e-admit-card', [AdminController::class, 'eAdmitCard'])->name('eAdmitCard');
    Route::post('saveAdmitCardDetails', [AdminController::class, 'saveAdmitCardDetails'])->name('saveAdmitCardDetails');
    // e-admit-card

    Route::get('/view-student-result/{id}', [AdminController::class, 'viewStudentResultDetails'])->name('viewStudentResultDetails');

    Route::get('/result/download/{id}', [AdminController::class, 'downloadStudentResultPDF'])->name('admin.result.download');
    Route::get('/result/delete/{id}', [AdminController::class, 'deleteStudentResultPDF'])->name('deleteStudentResultPDF');
    Route::get('/certficate/download_certificate/{id}', [AdminController::class, 'downloadStudentCertificatePDF'])->name('admin.certificate.download');
    Route::get('/certficate/download_typing_certificate/{id}', [AdminController::class, 'downloadStudentTypingCertificatePDF'])->name('admin.downloadStudentTypingCertificatePDF');

    /** session list */

    Route::get('/session', [SessionController::class, 'index'])->name('session');
    Route::post('/session/store', [SessionController::class, 'store'])->name('session.store');
    Route::get('/session/edit/{id}', [SessionController::class, 'edit'])->name('session.edit');
    Route::post('/session/update/{id}', [SessionController::class, 'update'])->name('session.update');

    /** branch route here */
    Route::get('/branch', [BranchController::class, 'index'])->name('branch');
    Route::post('/branch/store', [BranchController::class, 'store'])->name('branch.store');
    Route::get('/branch/edit/{id}', [BranchController::class, 'edit'])->name('branch.edit');
    Route::post('/branch/update/{id}', [BranchController::class, 'update'])->name('branch.update');

    /** user type route here */
    Route::get('/user-type', [UserTypeController::class, 'index'])->name('user_type');
    Route::post('/user-type/store', [UserTypeController::class, 'store'])->name('user_type.store');
    Route::get('/user-type/edit/{id}', [UserTypeController::class, 'edit'])->name('user_type.edit');
    Route::post('/user-type/update/{id}', [UserTypeController::class, 'update'])->name('user_type.update');

    /** user designation route here */

    Route::get('/designations', [MasterDesignationController::class, 'index'])->name('designations');
    Route::post('/designations/store', [MasterDesignationController::class, 'store'])->name('designations.store');
    Route::get('/designations/edit/{id}', [MasterDesignationController::class, 'edit'])->name('designations.edit');
    Route::post('/designations/update/{id}', [MasterDesignationController::class, 'update'])->name('designations.update');
    Route::get('/designations/fetch', [MasterDesignationController::class, 'fetchDesignationData'])->name('designation.fetch');

    /** fund route here */
    Route::get('/master-fund', [MasterFundController::class, 'index'])->name('funds');
    // fetchAgreementData
    Route::post('/funds/store', [MasterFundController::class, 'store'])->name('funds.store');
    Route::get('/funds/edit/{id}', [MasterFundController::class, 'edit'])->name('funds.edit');
    Route::post('/funds/update/{id}', [MasterFundController::class, 'update'])->name('funds.update');

    Route::get('fund-transfer-to-branch', [MasterFundController::class, 'fundTransferToBranch'])->name('funds.fundTransferToBranch');
    Route::post('/funds/store', [MasterFundController::class, 'store'])->name('funds.store');
    Route::post('/funds/transfertobranch', [MasterFundController::class, 'transferFundtoBranch'])->name('funds.transferFundtoBranch');

    Route::get('fund-transfer-to-employee', [MasterFundController::class, 'fundTransferToEmployee'])->name('funds.fundTransferToEmployee');
    Route::get('fund-transferred-list', [MasterFundController::class, 'fundTransferredList'])->name('funds.fundTransferredList');
    Route::get('/funds/fetch-fund-transferred', [MasterFundController::class, 'fetchFundTransferred'])->name('funds.fetchFundTransferred');

    Route::post('/funds/transferFundtoEmployee', [MasterFundController::class, 'transferFundtoEmployee'])->name('funds.transferFundtoEmployee');
    Route::post('/funds/transferAdminFundtoEmployee', [MasterFundController::class, 'transferAdminFundtoEmployee'])->name('funds.admintransferFundtoEmployee');

    Route::post('/get-employees', [StaffController::class, 'getEmployeesList'])->name('get.employees');
    Route::post('/get-all-employees', [StaffController::class, 'getAllEmployeesList'])->name('get.allemployees');
    Route::post('/get-branchmanagers', [StaffController::class, 'getBranchManagerList'])->name('get.branchmanagers');

    /** agreement list */
    Route::get('/agreement-list', [MasterAgreementController::class, 'index'])->name('agreement');
    Route::post('/agreementList/store', [MasterAgreementController::class, 'store'])->name('agreement.store');
    Route::get('/agreementList/edit/{id}', [MasterAgreementController::class, 'edit'])->name('agreement.edit');
    Route::post('/agreementList/update/{id}', [MasterAgreementController::class, 'update'])->name('agreement.update');
    Route::get('/agreement/fetch', [MasterAgreementController::class, 'fetchAgreementData'])->name('agreement.fetch');

    /** offer list */
    Route::get('/offer-list', [MasterOfferController::class, 'index'])->name('offer');
    Route::post('/offerList/store', [MasterOfferController::class, 'store'])->name('offer.store');
    Route::get('/offerList/edit/{id}', [MasterOfferController::class, 'edit'])->name('offer.edit');
    Route::post('/offerList/update/{id}', [MasterOfferController::class, 'update'])->name('offer.update');
    Route::get('/offer/fetch', [MasterOfferController::class, 'fetchOfferData'])->name('offer.fetch');
    Route::get('/offer/delete/{id}', [MasterOfferController::class, 'deleteOfferData'])->name('offer.delete');

    /** offer list */
    Route::get('/tndc-video-list', [MasterTnCVoideoController::class, 'index'])->name('tndcVid');
    Route::post('/tndcVidList/store', [MasterTnCVoideoController::class, 'store'])->name('tndcVid.store');
    Route::get('/tndcVid/edit/{id}', [MasterTnCVoideoController::class, 'edit'])->name('tndcVid.edit');
    Route::post('/tndcVid/update/{id}', [MasterTnCVoideoController::class, 'update'])->name('tndcVid.update');
    Route::get('/tndcVid/fetch', [MasterTnCVoideoController::class, 'fetchtndcVidData'])->name('tndcVid.fetch');
    Route::get('/tndcVid/delete/{id}', [MasterTnCVoideoController::class, 'deletetndcVidData'])->name('tndcVid.delete');

    /** notice list */
    Route::get('/notice-list', [MasterNoticeController::class, 'index'])->name('notice');
    Route::post('/noticeList/store', [MasterNoticeController::class, 'store'])->name('notice.store');
    Route::get('/noticeList/edit/{id}', [MasterNoticeController::class, 'edit'])->name('notice.edit');
    Route::post('/noticeList/update/{id}', [MasterNoticeController::class, 'update'])->name('notice.update');
    Route::get('/notice/fetch', [MasterNoticeController::class, 'fetchNoticeData'])->name('notice.fetch');
    Route::get('/delete-notice-list/{id}', [MasterNoticeController::class, 'deleteNoticeData'])->name('notice.delete');

    Route::resource('vendors', MasterVendorController::class);

    Route::get('get-district-by-state/{state_id}', [MasterVendorController::class, 'getDistrictByState'])
        ->name('district.by.state');

    Route::get('expense-groups', [ExpenseManagementController::class, 'groupIndex'])->name('expense.groups');
    Route::post('expense-groups/store', [ExpenseManagementController::class, 'groupStore'])->name('expense.groups.store');
    Route::get('expense-groups/edit/{id}', [ExpenseManagementController::class, 'groupEdit']);
    Route::post('expense-groups/update/{id}', [ExpenseManagementController::class, 'groupUpdate']);
    Route::get('expense-groups/delete/{id}', [ExpenseManagementController::class, 'groupDelete']);

    Route::get('expense-subgroups', [ExpenseManagementController::class, 'subGroupIndex'])->name('expense.subgroups');
    Route::post('expense-subgroups/store', [ExpenseManagementController::class, 'subGroupStore'])->name('expense.subgroups.store');
    Route::get('expense-subgroups/delete/{id}', [ExpenseManagementController::class, 'subGroupDelete']);
    Route::get('expense-subgroups/edit/{id}', [ExpenseManagementController::class, 'subGroupEdit']);
    Route::post('expense-subgroups/update/{id}', [ExpenseManagementController::class, 'subGroupUpdate']);

    Route::get('expense/get-subgroup/{group_id}', [ExpenseManagementController::class, 'getSubGroupByGroup']);

    Route::get('expense-list', [ExpenseManagementController::class, 'expenseIndex'])->name('expense.list');
    Route::get('expense-create', [ExpenseManagementController::class, 'expenseCreate'])->name('expense.create');
    Route::post('expense-store', [ExpenseManagementController::class, 'expenseStore'])->name('expense.store');
    Route::get('expense-delete/{id}', [ExpenseManagementController::class, 'expenseDelete'])->name('expense.delete');


    Route::get('/terms', [TermsAndConditionController::class, 'index'])->name('terms.index');
    Route::get('/terms/create', [TermsAndConditionController::class, 'create'])->name('terms.create');
    Route::post('/terms/store', [TermsAndConditionController::class, 'store'])->name('terms.store');

    Route::get('/terms/edit/{id}', [TermsAndConditionController::class, 'edit'])->name('terms.edit');
    Route::post('/terms/update/{id}', [TermsAndConditionController::class, 'update'])->name('terms.update');

    Route::delete('/terms/delete/{id}', [TermsAndConditionController::class, 'destroy'])->name('terms.delete');


    /** target list */
    Route::get('/target-list', [MasterTargetController::class, 'index'])->name('target');
    Route::post('/targetList/store', [MasterTargetController::class, 'store'])->name('target.store');
    Route::get('/targetList/edit/{id}', [MasterTargetController::class, 'edit'])->name('target.edit');
    Route::post('/targetList/update/{id}', [MasterTargetController::class, 'update'])->name('target.update');
    Route::get('/target/fetch', [MasterTargetController::class, 'fetchTargetData'])->name('target.fetch');

    /** employee target  */

    /** target list */
    Route::get('/employee-target-list', [EmployeeTargetController::class, 'index'])->name('emp_target');
    Route::post('/employeetargetList/store', [EmployeeTargetController::class, 'store'])->name('emp_target.store');
    Route::get('/employeetargetList/edit/{id}', [EmployeeTargetController::class, 'edit'])->name('emp_target.edit');
    Route::post('/employeetargetList/update/{id}', [EmployeeTargetController::class, 'update'])->name('emp_target.update');
    Route::get('/employeetargetList/delete/{id}', [EmployeeTargetController::class, 'destroy'])->name('emp_target.destroy');
    Route::get('/employee-target/fetch', [EmployeeTargetController::class, 'fetchTargetData'])->name('emp_target.fetch');

    /** master video list */
    Route::get('/master-video-list', [MasterVideoController::class, 'index'])->name('mvideo');
    Route::get('/delete-master-video-list/{id}', [MasterVideoController::class, 'deleteMasterVideo'])->name('mvideo.deleteMasterVideo');
    Route::post('/videoList/store', [MasterVideoController::class, 'store'])->name('mvideo.store');
    Route::get('/videoList/edit/{id}', [MasterVideoController::class, 'edit'])->name('mvideo.edit');
    Route::post('/videoList/update/{id}', [MasterVideoController::class, 'update'])->name('mvideo.update');
    Route::get('/master-video/fetch', [MasterVideoController::class, 'fetchMasterVideoData'])->name('mvideo.fetch');

    /**  */
    Route::get('/video-category-list', [MasterVideoController::class, 'videoCategoryList'])->name('videoCategoryList');
    Route::get('/get-sub-category/{id}', [MasterVideoController::class, 'getSubCategory'])->name('getSubCategory');

    /** yearly bonus list */
    Route::get('/master-yearly-bonus-list', [MasterBonusController::class, 'index'])->name('yearlyBonus');
    Route::post('/yearlyBonus/store', [MasterBonusController::class, 'store'])->name('yearlyBonus.store');
    Route::get('/yearlyBonus/edit/{id}', [MasterBonusController::class, 'edit'])->name('yearlyBonus.edit');
    Route::post('/yearlyBonus/update/{id}', [MasterBonusController::class, 'update'])->name('yearlyBonus.update');
    Route::get('/target/fetch', [MasterBonusController::class, 'fetchTargetData'])->name('target.fetch');

    /** master investor investment list */
    Route::get('/master-investor-investment-list', [MasterInvestorController::class, 'index'])->name('investorInvestment');
    Route::post('/investorInvestment/store', [MasterInvestorController::class, 'store'])->name('investorInvestment.store');
    Route::get('/investorInvestment/edit/{id}', [MasterInvestorController::class, 'edit'])->name('investorInvestment.edit');
    Route::post('/investorInvestment/update/{id}', [MasterInvestorController::class, 'update'])->name('investorInvestment.update');
    Route::get('/investorInvestment/fetch', [MasterInvestorController::class, 'fetchInvestorInvestmentData'])->name('investorInvestment.fetch');

    Route::get('/generate-membership-number', [MasterMembershipController::class, 'index'])->name('membership.generateMembershipNumber');
    Route::post('/membership/store', [MasterMembershipController::class, 'store'])->name('membership.store');
    Route::post('/membership/store-old', [MasterMembershipController::class, 'storeOldMembership'])->name('membership.storeOldMembership');
    Route::get('/membership/edit/{id}', [MasterMembershipController::class, 'edit'])->name('membership.edit');
    Route::get('/membership/fetch', [MasterMembershipController::class, 'fetchMembershipData'])->name('membership.fetch');
    Route::get('/view-membership-number/{date}', [MasterMembershipController::class, 'viewMembershipNumberDateWise'])->name('membership.viewMembershipNumberDateWise');
    Route::get('/export-membership-date-wise/{date}', [MasterMembershipController::class, 'exportMembershipDateWise'])->name('membership.exportMembershipDateWise');

    Route::get('/generate-kit-number', [MasterKitController::class, 'index'])->name('kit.generateKitNumber');
    Route::get('/kit/fetch', [MasterKitController::class, 'fetchKitData'])->name('kit.fetch');
    Route::get('/kit-transfer-history', [MasterKitController::class, 'kitTransferHistory'])->name('kitTransferHistory');
    Route::get('/kit-transfer-history-delete/{id}', [KitController::class, 'kitTransferHistoryDelete'])->name('kitTransferHistoryDelete');
    Route::post('/kit/store', [MasterKitController::class, 'store'])->name('kit.store');

    // kit-transfer-history

    Route::get('/kits', [KitController::class, 'index']);
    Route::post('/kits/issue', [KitController::class, 'issue'])->name('emp.saveKitGiven');;
    Route::post('/kits/transfer', [KitController::class, 'transfer']);
    Route::get('/kits/history/{user}', [KitController::class, 'history'])->name('kits.history');


    Route::get('/membership/add-physical-card-member', [MasterMembershipController::class, 'addMember'])->name('membership.addMember');
    // Route::post('/check-membership', [MasterMembershipController::class, 'checkMembership'])->name('membership.chseckMemberships');

    Route::post('/member/store', [MasterMembershipController::class, 'storeMemberData'])->name('members.store');

    Route::get('/membership/add-digital-card-member', [MasterMembershipController::class, 'addDigitalCardMember'])->name('membership.addDigitalCardMember');

    Route::post('/member/store_digital_card_member', [MasterMembershipController::class, 'storeDigitalCardMemberData'])->name('members.storeDigitalCardMemberData');

    /** Route for Product Categories */
    Route::resource('/product_categories', ProductCategoryController::class);

    /** Route for Brands */
    Route::resource('/brand', BrandController::class);

    /** Route For Product Page */
    Route::resource('/products', ProductController::class);
    Route::get('/product/product-transfer-to-branch', [ProductController::class, 'productTransferToBranch'])->name('product.productTransferToBranch');
    Route::post('/get-product-details', [ProductController::class, 'getProductDetails'])->name('get.product.details');

    Route::get('/product-profit-list', [ProductController::class, 'productProfitList'])->name('product.productProfitList');

    //
        // fetchProducts
    Route::get('/product/fetchProducts', [ProductController::class, 'fetchProducts'])->name('product.fetchProducts');
    Route::post('/get-product-type', [ProductController::class, 'getProductListTypeWise'])->name('getProductListTypeWise');
    Route::post('/product/transferProductsToBranch', [ProductController::class, 'transferProductsToBranch'])->name('products.transferProductsToBranch');

    Route::get('/product/branch-product-list', [ProductController::class, 'branchProductList'])->name('product.branchProductList');
    Route::get('/product/fetchBranchProductsHere', [ProductController::class, 'fetchBranchProductsHere'])->name('product.fetchBranchProductsHere');
    Route::post('/product/update-branch-stock', [ProductController::class, 'updateBranchProductStock'])->name('product.updateBranchStock');

    /** Route for Vivah Mitra Categories */
    Route::resource('/vivahmitra_categories', VivahMitraCategoryController::class);
    Route::resource('/training_video_category_list', TrainingVideoCategoryController::class);

    /** Route For Product Page */
    Route::resource('/vivahmitra_products', VivahMitraProductController::class);

    /** Route for Navigation */
    Route::resource('/navigations', NavigationController::class);
    Route::get('/navigation/add-navigation', [NavigationController::class, 'addNavigation'])->name('navigation.addNavigation');
    Route::post('/updateNavigationDetails', [NavigationController::class, 'updateNavigationDetails'])->name('navigation.updateNavigationDetails');

    Route::get('/navigation/user-roles', [StaffController::class, 'userRoles'])->name('navigation.userRoles');
    Route::get('/users/fetchforroles', [StaffController::class, 'fetchUserRoles'])->name('navigation.fetchUserList');
    Route::get('/navigation/assign-roles/{id}', [NavigationController::class, 'assignUserRoles'])->name('navigation.assignUserRoles');

    Route::post('/admin/user/menu/toggle', [NavigationController::class, 'toggleNavigationAddRemove'])->name('user.menu.toggle');

    Route::get('/assign-district-to-user', [StaffController::class, 'employeelists'])->name('staff.employeelists');
    Route::get('/assign-district-to-user/{id}', [NavigationController::class, 'assignEmployeeDistrict'])->name('navigation.assignEmployeeDistrict');
    Route::get('/users/assign-district-to-user', [StaffController::class, 'fetchEmployeeStaff'])->name('staff.fetchEmployeeStaff');
    Route::post('admin/assign-district', [NavigationController::class, 'storeAssignDistrict'])->name('assign.district.store');


    /** assign shop */
    Route::get('/assign-shop-to-user', [StaffController::class, 'employeelists2'])->name('staff.employeelists2');
    Route::get('/assign-shop-to-user/{id}', [NavigationController::class, 'assignEmployeeShop'])->name('navigation.assignEmployeeShop');
    Route::get('/users/assign-shop-to-user', [StaffController::class, 'fetchEmployeeStaff2'])->name('staff.fetchEmployeeStaff2');
    Route::post('admin/assign-shop', [NavigationController::class, 'storeAssignShop'])->name('assign.shop.store');

    /** monthly routines */
    Route::get('/check-routine-work', [StaffController::class, 'checkMonthlyRoutines'])->name('staff.checkMonthlyRoutines');
    Route::get('/fetch-monthly-routines', [StaffController::class, 'fetchMonthlyRoutines'])->name('staff.fetchMonthlyRoutines');
    Route::get('/delete-monthly-routine/{id}', [StaffController::class, 'deleteMonthlyRoutines'])->name('monthly_routine.delete');

    /** monthly routines */
    Route::get('/cash-payment-report', [StaffController::class, 'cashPaymentReport'])->name('staff.cashPaymentReport');
    Route::get('/fetch-cash-payment-report', [StaffController::class, 'fetchCashPaymentReport'])->name('staff.fetchCashPaymentReport');
    Route::get('/delete-cash-payment-report/{id}', [StaffController::class, 'deleteCashPaymentReport'])->name('cashPayment.delete');

    /** monthly routines */
    Route::get('/emp-online-payment-report', [StaffController::class, 'empOnlinePaymentReport'])->name('staff.empOnlinePaymentReport');
    Route::get('/fetch-emp-online-payment-report', [StaffController::class, 'fetchOnlinePaymentReport'])->name('staff.fetchOnlinePaymentReport');
    Route::post('/online-payment-status-update',[StaffController::class, 'onlinePaymentStatusUpdate'])->name('online.payment.status.update');
    Route::get('/delete-emp-online-payment-list/{id}', [StaffController::class, 'deleteOnlinePayment'])->name('onlinePayment.delete');

    // assign.district.store


    Route::get('e-wallet', [WalletController::class, 'eWallet'])->name('wallet.eWallet');
    Route::get('fund-wallet', [WalletController::class, 'fundWallet'])->name('wallet.fundWallet');

    // sale routes starts here
    Route::get('/sale/incentive-sale', [SaleController::class, 'incentiveSale'])->name('sale.incentiveSale');
    Route::get('/sale/cash-sale', [SaleController::class, 'cashSale'])->name('sale.cashSale');
    Route::post('/check-employee', [SaleController::class, 'checkEmployee'])->name('check.employee');
    Route::post('/check-membership', [SaleController::class, 'checkMembership'])->name('check.membership');

    Route::post('/get-product-type-branch-wise', [SaleController::class, 'getProductListTypeBranchWise'])->name('getProductListTypeBranchWise');
    Route::post('/get-branch-product-details', [SaleController::class, 'getBranchProductDetails'])->name('get.getBranchProductDetails');

    Route::post('/sale/postIncentiveSale', [SaleController::class, 'postIncentiveSale'])->name('sale.postIncentiveSale');
    Route::get('/sale/incentive-sale-list', [SaleController::class, 'incentiveSaleList'])->name('sale.incentiveSaleList');
    Route::get('/sale/fetchincentiveSaleList', [SaleController::class, 'fetchincentiveSaleList'])->name('sale.fetchincentiveSaleList');
    Route::get('/sale/view-sale/{id}', [SaleController::class, 'viewSaleDetails'])->name('sale.viewSaleDetails');
    Route::get('/sale/view-invoice/{id}', [SaleController::class, 'viewSaleInvoice'])->name('sale.viewSaleInvoice');
    Route::post('/get-memberList', [SaleController::class, 'getMemberList'])->name('sale.getMemberList');

    Route::get('/cards', [CardController::class, 'index']);
    Route::post('/cards/issue', [CardController::class, 'issue'])->name('emp.saveCardGiven');;
    Route::post('/cards/transfer', [CardController::class, 'transfer']);
    Route::get('/cards/history/{user}', [CardController::class, 'history'])->name('cards.history');


    /** location */
    /** Location  */
    Route::get('/location/country', [LocationController::class, 'country'])->name('location.country');
    Route::get('/location/states', [LocationController::class, 'states'])->name('location.states');
    Route::get('/states/ajax', [LocationController::class, 'getStates'])->name('states.ajax');
    Route::post('/states/toggle-status', [LocationController::class, 'toggleStateStatus'])->name('states.toggle-status');
    Route::post('/states/update', [LocationController::class, 'updateState'])->name('states.update');

    Route::get('/location/city', [LocationController::class, 'cities'])->name('location.cities');
    Route::get('/cities/ajax', [LocationController::class, 'getCities'])->name('cities.ajax');
    Route::post('/cities/update', [LocationController::class, 'updateCity'])->name('cities.update');
    Route::post('/cities/store', [LocationController::class, 'storeCity'])->name('cities.store');
    Route::post('/cities/toggle-status', [LocationController::class, 'toggleCityStatus'])->name('cities.toggle-status');

     Route::get('/location/blocks', [LocationController::class, 'blocks'])->name('location.blocks');
    Route::get('/blocks/ajax', [LocationController::class, 'getBlocks'])->name('block.ajax');
    Route::post('/blocks/update', [LocationController::class, 'updateBlock'])->name('block.update');
    Route::post('/blocks/store', [LocationController::class, 'storeBlock'])->name('block.store');
    Route::post('/blocks/toggle-status', [LocationController::class, 'toggleBlockStatus'])->name('block.toggle-status');

    Route::get('/location/panchayat', [LocationController::class, 'panchayat'])->name('location.panchayat');
    Route::get('/panchayat/ajax', [LocationController::class, 'getPanchayat'])->name('panchayat.ajax');
    Route::post('/panchayat/update', [LocationController::class, 'updatePanchayat'])->name('panchayat.update');
    Route::post('/panchayat/store', [LocationController::class, 'storePanchayat'])->name('panchayat.store');
    Route::post('/panchayat/toggle-status', [LocationController::class, 'togglePanchayatStatus'])->name('panchayat.toggle-status');

    Route::get('/location/ward', [LocationController::class, 'ward'])->name('location.ward');
    Route::get('/ward/ajax', [LocationController::class, 'getWard'])->name('ward.ajax');
    Route::post('/ward/update', [LocationController::class, 'updateWard'])->name('ward.update');
    Route::post('/ward/store', [LocationController::class, 'storeWard'])->name('ward.store');
    Route::post('/ward/toggle-status', [LocationController::class, 'toggleWardStatus'])->name('ward.toggle-status');

    Route::get('/location/posts', [LocationController::class, 'posts'])->name('location.posts');
    Route::get('/posts/ajax', [LocationController::class, 'getPost'])->name('posts.ajax');
    Route::post('/posts/update', [LocationController::class, 'updatePost'])->name('posts.update');
    Route::post('/posts/store', [LocationController::class, 'storePost'])->name('posts.store');
    Route::post('/posts/toggle-status', [LocationController::class, 'togglePostStatus'])->name('posts.toggle-status');

    Route::get('/get-cities-by-state/{state_id}', [LocationController::class, 'getCitiesByState']);
    Route::get('/get-district-by-states/{state_id}', [LocationController::class, 'getDistrictByState']);
    Route::get('/get-blocks-by-district/{state_id}', [LocationController::class, 'getBlockByDistrict']);
    Route::get('/get-panchayat-by-blocks/{state_id}', [LocationController::class, 'getPanchayatByBlock']);
    Route::get('/admin/get-districts', [LocationController::class, 'getDistricts'])->name('get.districts');
    Route::get('/admin/get-blocks', [LocationController::class, 'getOnlyBlocks'])->name('get.blocks');

    /** meeting list */

    Route::match(['get', 'post'], '/home-meeting-list', [StaffController::class, 'homeMeetingList'])->name('homeMeetingList');
    Route::get('/meeting-details/{id}', [StaffController::class, 'homeMeetingDetails'])->name('homeMeetingDetails');
    Route::post('home-meeting/status-update', [StaffController::class, 'updateHomeMeetingStatus'])->name('home.meeting.status.update');

    Route::match(['get', 'post'], '/trainer-meeting-list', [StaffController::class, 'trainerMeetingList'])->name('trainerMeetingList');
    Route::get('/trainer-meeting-details/{id}', [StaffController::class, 'trainerMeetingDetails'])->name('trainerMeetingDetails');
    Route::post('trainer-meeting/status-update', [StaffController::class, 'updateTrainerMeetingStatus'])->name('trainer.meeting.status.update');

    Route::match(['get', 'post'], '/seminar-guest-meeting-list', [StaffController::class, 'seminarGuestMeetingList'])->name('seminarGuestMeetingList');
    Route::get('/seminar-guest-meeting-details/{id}', [StaffController::class, 'seminarGuestMeetingDetails'])->name('seminarGuestMeetingDetails');
    Route::post('seminar-guest-meeting/status-update', [StaffController::class, 'updateSeminarGuestMeetingStatus'])->name('seminar.guest.meeting.status.update');

        /** offer list */
    Route::get('/shop-list', [ShopController::class, 'index'])->name('shop.list');
    Route::post('/shop-list/store', [ShopController::class, 'store'])->name('shop.store');
    Route::get('/shop/edit/{id}', [ShopController::class, 'edit'])->name('shop.edit');
    Route::post('/shop-list/update/{id}', [ShopController::class, 'update'])->name('shop.update');
    Route::get('/shop-list/fetch', [ShopController::class, 'fetchShopData'])->name('shop.fetch');
    Route::get('/shop-list/delete/{id}', [ShopController::class, 'deleteShopData'])->name('shop.delete');

    Route::get('/view-shop-report', [ShopController::class, 'viewShop'])->name('shop.viewShop');
    Route::get('/show-products-shop-wise/{shop_id}', [ShopController::class, 'viewShopProducts'])->name('shop.viewShopProducts');
    Route::get('/view-shop-products-profit/{shop_id}', [ShopController::class, 'viewSoldProductsProfit'])->name('shop.viewSoldProductsProfit');

    /** logout */ // verifyEmployee
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
});


/** Franchise Panel Routes here */
Route::post('get-subcourse', [FranchiseController::class, 'getSubCourse']);
Route::group(['prefix' => 'franchise', 'middleware' => ['FranchiseAuthCheck'], 'as' => 'franchise.'], function () {
    Route::get('/dashboard', [FranchiseController::class, 'franchiseDashboard'])->name('dashboard');
    Route::get('/add-student', [FranchiseController::class, 'addStudent'])->name('addStudent');
    Route::get('/pending-student-list', [FranchiseController::class, 'pendingStudentList'])->name('pendingStudentList');
    Route::get('/approved-student-list', [FranchiseController::class, 'approvedStudentList'])->name('approvedStudentList');
    Route::get('/view-student/{id}', [FranchiseController::class, 'viewStudent'])->name('viewStudent');
    Route::post('/saveStudentDetails', [FranchiseController::class, 'saveStudentDetails'])->name('saveStudentDetails');





    Route::get('/fund-received', [FranchiseController::class, 'fundReceived'])->name('fundReceived');



    Route::get('/franchise-logout', [LogoutController::class, 'franchiseLogout'])->name('franchiselogout');
});


/** Student Panel Routes here */
Route::group(['prefix' => 'student', 'middleware' => ['StudentAuthCheck'], 'as' => 'student.'], function () {
    Route::get('/dashboard', [StudentController::class, 'studentDashboard'])->name('dashboard');
    Route::get('/study-material', [StudentController::class, 'studyMaterial'])->name('studyMaterial');
    Route::get('/my-profile', [StudentController::class, 'myProfile'])->name('myProfile');
    Route::get('/view-manual-result', [StudentController::class, 'viewManualResult'])->name('viewManualResult');
    Route::get('/view-manual-result-details', [StudentController::class, 'viewManualResultDetails'])->name('viewManualResultDetails');

    Route::get('/id-card', [StudentController::class, 'viewIdCard'])->name('viewManualResult');
    Route::get('/admit-card', [StudentController::class, 'admitCard'])->name('admitCard');
    Route::post('/admitcard/generateStudentAdmitCard', [StudentController::class, 'generateStudentAdmitCard'])->name('generateStudentAdmitCard');
    Route::post('/result/generateStudentResult', [StudentController::class, 'generateStudentResult'])->name('generateStudentResult');

    Route::get('/stresult/result_download/{id}', [StudentController::class, 'downloadStudentResult'])->name('result_download');
    Route::get('/stresult/certificate_download/{id}', [StudentController::class, 'downloadStudentCertificate'])->name('certificate_download');
    Route::get('/stresult/typing_certificate_download/{id}', [StudentController::class, 'downloadStudentTypingCertificate'])->name('downloadStudentTypingCertificate');

    Route::get('/view-result', [StudentController::class, 'viewResult'])->name('viewResult');

    // Route::get('/fund-received', [FranchiseController::class, 'fundReceived'])->name('fundReceived');



    Route::get('/student-logout', [LogoutController::class, 'studentLogout'])->name('studentlogout');
});
