<?php
    use App\Models\BusinessSetting;
    use App\Models\Certificate;
    use App\Models\MasterProduct;
    use App\Models\Gallery;
    use App\Models\Testimonial;
    use App\Models\Pricing;
    use App\Models\PricingType;
    use App\Models\Blog;
    use App\Models\MasterService;
    use App\Models\FaqCategory;
    use App\Models\Staff;
    use App\Models\Video;
    use App\Models\MasterPartner;
    use App\Models\IndustryCmsPage;
    use App\Models\MasterSolution;
    use App\Models\MasterSemester;
    use App\Models\Session;
    use App\Models\Wallet;
    use App\Models\WalletTransaction;
    use App\Models\EWallet;
    use App\Models\EWalletTransaction;
    use App\Models\Menu;
    use App\Models\UserNavigation;
    use App\Models\User;

    // use Intervention\Image\Facades\Image;
    // use BenMajor\ImageResize;
    // use NumberFormatter;

    /** Change DateTime format to any date/datetime format */
    if (!function_exists('convert_datetime_to_date_format')) {
        function convert_datetime_to_date_format($date, $format){
            return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format($format);
        }
    }

    /** highlights the selected navigation on admin panel */
    if (!function_exists('areActiveRoutes')) {
        function areActiveRoutes(array $routes, $output = "active")
        {
            foreach ($routes as $route) {
                if (Route::currentRouteName() == $route) return $output;
            }
        }
    }

   /** return file uploaded via uploader */
    if (!function_exists('upload_asset')) {
        function upload_asset($file_name, $folder_name="all", $type="webp_conversion"){
            if ($type == "webp_conversion") {
               $img = \Image::make($file_name);

                $height = $img->height();
                $width  = $img->width();

                if ($width > $height && $width > 1200) {
                    $img->resize(1200, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                } elseif ($height > 500) {
                    $img->resize(null, 500, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                }

                // Sharpen image
                $img->sharpen(10);

                // Encode after resize
                $img->encode('webp', 95);

                $filename = $folder_name . '-' . date('YmdHis') . '-' . rand(1,10000) . '.webp';
                $file_path = 'uploads/' . $folder_name . '/' . $filename;

                $img->save(public_path($file_path));
                return $file_path;
            }

            if ($type == "local") {
                $extenstion = $file_name->getClientOriginalExtension();
                $filename = $folder_name. '-' . date('YmdHis') . '-' .rand(1,10000). '.' . $extenstion;
                $file_name->move(public_path('uploads/'.$folder_name), $filename);
                $file_path = 'uploads/'.$folder_name.'/'. $filename;
                return $file_path;
            }

            if($type == "cloudinary"){
                $uploadedFileUrl = cloudinary()->upload($file_name->getRealPath())->getSecurePath();
                return $uploadedFileUrl;
            }
        }
    }

     /** Generate an asset path for the application */
    if (!function_exists('static_asset')) {
        function static_asset($path, $secure = null)
        {
            // return app('url')->asset('public/' . $path, $secure);
            return app('url')->asset($path, $secure);
        }
    }

    /** Fetch value by type and field_name from business setting */
    if (!function_exists('fetch_business_setting_value')) {
        function fetch_business_setting_value($type, $field_name)
        {
            return BusinessSetting::where('type', $type)->where('field_name', $field_name)->pluck('value')->first();
        }
    }

    if (!function_exists('fetch_business_setting_data')) {
        function fetch_business_setting_data($type)
        {
            return BusinessSetting::select('field_name', 'value')->where('type', $type)->first();
        }
    }


    if (!function_exists('get_business_single_cache_value')) {
        function get_business_single_cache_value($var_name, $type, $field_name = null){
            return Cache::rememberForever($var_name, function () use ($type, $field_name) {
                $output = DB::table('business_settings')
                    ->where('type', $type);
                    if($field_name != null){
                        $output = $output->where('field_name', $field_name)
                        ->select('value')->first();

                        return $output->value;
                    }else{
                        $output = $output->select('field_name', 'value')->first();

                        return $output;
                    }
                });
        }
    }

    if (!function_exists('get_business_multiple_cache_value')) {
        function get_business_multiple_cache_value($var_name, $type){
            return Cache::rememberForever($var_name, function () use ($type) {
                return DB::table('business_settings')->select('field_name', 'value')
                    ->where('type', $type)
                    ->get();
                });
        }
    }

    if (!function_exists('get_section_wise_data')) {
        function get_section_wise_data($page_id, $section_id, $limit_start=0, $limit_end=0){
            //return Cache::rememberForever($var_name, function () use ($section_id, $limit_start, $limit_end) {
                $output = DB::table('section_datas')->select('id', 'section_id', 'title', 'description', 'img', 'order_number', 'other')
                    ->where('page_id', $page_id)
                    ->where('section_id', $section_id)
                    ->where('status', 1)
                    ->where('deleted_at', NULL)
                    ->orderBy('order_number', 'ASC');
                    if($limit_start >= 0 && $limit_end > 0){
                        $output->skip($limit_start)->take($limit_end);
                    }
                    if($limit_start > 0 && $limit_end = 0){
                        $output->limit($limit_start);
                    }
                    $output = $output->get();
                    return $output;
            }
        // );
        // }
    }

    if (!function_exists('get_product_section_wise_data')) {
        function get_product_section_wise_data($page_id, $section_id, $limit_start=0, $limit_end=0){
            //return Cache::rememberForever($var_name, function () use ($section_id, $limit_start, $limit_end) {
                $output = DB::table('product_section_datas')->select('id', 'section_id', 'title', 'description', 'img', 'order_number', 'other')
                    ->where('page_id', $page_id)
                    ->where('section_id', $section_id)
                    ->where('status', 1)
                    ->where('deleted_at', NULL)
                    ->orderBy('order_number', 'ASC');
                    if($limit_start >= 0 && $limit_end > 0){
                        $output->skip($limit_start)->take($limit_end);
                    }
                    if($limit_start > 0 && $limit_end = 0){
                        $output->limit($limit_start);
                    }
                    $output = $output->get();
                    return $output;
            }
        // );
        // }
    }

    if (!function_exists('get_service_section_wise_data')) {
        function get_service_section_wise_data($page_id, $section_id, $limit_start=0, $limit_end=0){
            $output = DB::table('service_section_datas')
                ->select('page_id', 'section_id', 'title', 'description', 'img', 'order_number')
                ->where('page_id', $page_id)
                ->where('section_id', $section_id)
                ->where('status', 1)
                ->where('deleted_at', NULL)
                ->orderBy('order_number', 'ASC');
                if($limit_start >= 0 && $limit_end > 0){
                    $output->skip($limit_start)->take($limit_end);
                }
                if($limit_start > 0 && $limit_end = 0){
                    $output->limit($limit_start);
                }
                $output = $output->get();
            return $output;
        }
    }

    if (!function_exists('get_industry_section_wise_data')) {
        function get_industry_section_wise_data($section_id, $limit_start=0, $limit_end=0){
            $output = DB::table('industry_section_datas')->select('section_id', 'title', 'description', 'img', 'order_number', 'other')
                ->where('section_id', $section_id)
                ->where('status', 1)
                ->where('deleted_at', NULL)
                ->orderBy('order_number', 'ASC');
                if($limit_start >= 0 && $limit_end > 0){
                    $output->skip($limit_start)->take($limit_end);
                }
                if($limit_start > 0 && $limit_end = 0){
                    $output->limit($limit_start);
                }
                $output = $output->get();

            return $output;
        }
    }

    // certificate list
if (!function_exists('certificate_list')){
    function certificate_list()
    {
        return Certificate::get();
    }
}

    // master_product_list list
    if (!function_exists('master_product_list')){
        function master_product_list()
        {
            return MasterProduct::orderBy('order_no', 'ASC')->where('parent_id', 0)->where('status', 1)->get();
        }
    }

     // get_img_client_list list
    if (!function_exists('get_img_affiliations_list')){
        function get_img_affiliations_list()
        {
            return Gallery::where('category_id', 5)->where('status', 1)->get();
        }
    }

     // get_img_partner__list list
     if (!function_exists('get_img_partner__list')){
        function get_img_partner__list()
        {
            return Gallery::where('category_id', 4)->where('status', 1)->get();
        }
    }

    // get_img_client_list list
    if (!function_exists('get_img_client_list')){
        function get_img_client_list()
        {
            return Gallery::where('category_id', 3)->where('status', 1)->get();
        }
    }

    // Testimonial list
    if (!function_exists('testimonialList')){
        function testimonialList(){
            return Testimonial::latest()->where('status', 1)->get();
        }
    }

    // Video Testimonial list
    if (!function_exists('videoTestimonialList')){
        function videoTestimonialList(){
            return Video::latest()->where('status', 1)->get();
        }
    }

    //pricing list for all
    if(!function_exists('pricingList')){
        function pricingList($product_id){
            return Pricing::where('product_id', $product_id)->where('status', 1)->latest()->get();
        }
    }

     //pricing list for all
     if(!function_exists('pricingType')){
        function pricingType($product_id){
            return Pricing::select('master_products.id','master_products.title')
                        ->leftJoin('master_products','pricings.type_id', '=', 'master_products.id')
                        ->where('pricings.product_id', $product_id)
                        ->where('master_products.status', 1)
                        ->distinct()
                        ->get();
        }
    }

    // latestPostList list
    if (!function_exists('latestPostList')){
        function latestPostList(){
            return Blog::latest()->where('blogs.type', 'blog')->where('blogs.status', 1)
            ->leftJoin('categories', 'categories.id', '=', 'blogs.category_id')
            ->select(['categories.title as categoryTitle', 'blogs.*'])
            ->paginate(10);
         }
    }

  // master_product_list list
  if (!function_exists('master_service_list')){
    function master_service_list()
    {
        return MasterService::where('parent_id', 0)->where('status', 1)->get();
    }
}

     //pricing list for all
     if(!function_exists('FaqCategory')){
        function FaqCategory(){
            return FaqCategory::where('type',1 )
                    ->get();
        }
    }

    if(!function_exists('commonFaqCategory')){
        function commonFaqCategory(){
            return FaqCategory::where('type', 0)->where('status', 1)->get();
        }
    }

       // Team list
       if (!function_exists('ourTeamList')){
        function ourTeamList(){
           $staff_list = Staff::latest()->where('status', 1)->where('type', 'Main Staff')
            ->get();
            return $staff_list;
        }
    }

     // get table field list
    if (!function_exists('get_table_field_lists')){
        function get_table_field_lists($product_id)
        {
            return MasterProduct::select('table_fields')->where('id', $product_id)->where('status', 1)->first();
        }
    }

    // footer master service list
    if (!function_exists('footer_master_service')){
        function footer_master_service()
        {
            return MasterService::where('parent_id', 0)->where('status', 1)->limit(8)->get();
        }
    }

    // footer master service list
    if (!function_exists('footer_master_products')){
        function footer_master_products()
        {
            return MasterProduct::orderBy('order_no', 'ASC')->where('parent_id', 0)->where('status', 1)->limit(10)->get();
        }
    }

        // master_partner_list list
        if (!function_exists('master_partner_list')){
            function master_partner_list()
            {
                return MasterPartner::where('parent_id', 0)->where('status', 1)->get();
            }
        }

        if (!function_exists('get_partner_section_wise_data')) {
            function get_partner_section_wise_data($page_id, $section_id, $limit_start=0, $limit_end=0){
                //return Cache::rememberForever($var_name, function () use ($section_id, $limit_start, $limit_end) {
                    $output = DB::table('partner_section_datas')->select('id', 'section_id', 'title', 'description', 'img', 'order_number', 'other')
                        ->where('page_id', $page_id)
                        ->where('section_id', $section_id)
                        ->where('status', 1)
                        ->where('deleted_at', NULL)
                        ->orderBy('order_number', 'ASC');
                        if($limit_start >= 0 && $limit_end > 0){
                            $output->skip($limit_start)->take($limit_end);
                        }
                        if($limit_start > 0 && $limit_end = 0){
                            $output->limit($limit_start);
                        }
                        $output = $output->get();
                        return $output;
                }
            // );
            // }
        }

        // master_industry_page list
        if (!function_exists('master_industry_page')){
            function master_industry_page()
            {
                return IndustryCmsPage::where('parent_id', 0)->where('status', 1)->get();
            }
        }

        if (!function_exists('get_indusry_section_wise_data')) {
            function get_indusry_section_wise_data($page_id, $section_id, $limit_start=0, $limit_end=0){
                //return Cache::rememberForever($var_name, function () use ($section_id, $limit_start, $limit_end) {
                    $output = DB::table('industry_section_datas')->select('id', 'section_id', 'title', 'description', 'img', 'order_number', 'other')
                        ->where('page_id', $page_id)
                        ->where('section_id', $section_id)
                        ->where('status', 1)
                        ->where('deleted_at', NULL)
                        ->orderBy('order_number', 'ASC');
                        if($limit_start >= 0 && $limit_end > 0){
                            $output->skip($limit_start)->take($limit_end);
                        }
                        if($limit_start > 0 && $limit_end = 0){
                            $output->limit($limit_start);
                        }
                        $output = $output->get();
                        return $output;
                }
            // );
            // }
        }

        // master_industry_page list
        if (!function_exists('master_solution_list')){
            function master_solution_list()
            {
                return MasterSolution::where('parent_id', 0)->where('status', 1)->get();
            }
        }

        if (!function_exists('get_solution_section_wise_data')) {
            function get_solution_section_wise_data($page_id, $section_id, $limit_start=0, $limit_end=0){
                //return Cache::rememberForever($var_name, function () use ($section_id, $limit_start, $limit_end) {
                    $output = DB::table('solution_section_datas')->select('id', 'section_id', 'title', 'description', 'img', 'order_number', 'other')
                        ->where('page_id', $page_id)
                        ->where('section_id', $section_id)
                        ->where('status', 1)
                        ->where('deleted_at', NULL)
                        ->orderBy('order_number', 'ASC');
                        if($limit_start >= 0 && $limit_end > 0){
                            $output->skip($limit_start)->take($limit_end);
                        }
                        if($limit_start > 0 && $limit_end = 0){
                            $output->limit($limit_start);
                        }
                        $output = $output->get();
                        return $output;
                }
            // );
            // }
        }


         // master_industry_page list
         if (!function_exists('master_semester_list')){
            function master_semester_list()
            {
                return MasterSemester::orderBy('id', 'asc')->get();
            }
        }

        if (!function_exists('master_session_list')){
            function master_session_list()
            {
                return Session::orderBy('id', 'asc')->get();
            }
        }

        function numberToWords($number)
        {
            // Check if intl extension is installed
            if (!class_exists('NumberFormatter')) {
                throw new \Exception('PHP intl extension is not enabled.');
            }

            $formatter = new NumberFormatter('en', NumberFormatter::SPELLOUT);
            $words = $formatter->format($number);

            // Capitalize first letter of each word
            return ucwords($words);
        }

        if (!function_exists('getFooterWidget')) {
            /**
             * Get footer widget data by widget number.
             *
             * @param int $widgetNumber (1, 2, 3 etc.)
             * @return array
             */
            function getFooterWidget($widgetNumber)
            {
                // dd("footer_widget_{$widgetNumber}_links");
                // Get widget label
                $label = DB::table('business_settings')
                    ->where('type', "footer_widget_{$widgetNumber}_lable")
                    ->value('value');

                // Get widget links (names)
                $field_name = DB::table('business_settings')
                    ->where('type', "footer_widget_{$widgetNumber}_links")
                    ->value('field_name');

                // Get widget URLs (stored in same row or another if applicable)
                $linkUrls = DB::table('business_settings')
                    ->where('type', "footer_widget_{$widgetNumber}_links")
                    ->value('value');

                return [
                    'label' => $label,
                    'field_name' => json_decode($field_name, true) ?? [],
                    'urls'  => json_decode($linkUrls, true) ?? [],
                ];
            }
        }

        function uploadFile($file, $prefix, $uploadPath) {
            if ($file) {
                $name = $prefix . '_' . time() . '.' . $file->getClientOriginalExtension();
                $file->move($uploadPath, $name);
                return 'uploads/user_documents/' . $name;
            }
            return null;
        }

        function uploadOrKeep($file, $prefix, $uploadPath, $oldFile = null)
        {
            // If new file not selected → return old file path
            if (!$file) {
                return $oldFile;
            }

            // Delete old file if exists
            if (!empty($oldFile) && file_exists(public_path($oldFile))) {
                unlink(public_path($oldFile));
            }

            // Upload new file
            $name = $prefix . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $name);

            return 'uploads/user_documents/' . $name;
        }

        /**
         * Get or create wallet
         */
        function getWallet($ownerType, $ownerId)
        {
            return Wallet::firstOrCreate(
                [
                    'owner_type' => $ownerType,
                    'owner_id'   => $ownerId,
                ],
                [
                    'balance' => 0
                ]
            );
        }

        /**
         * Credit wallet
         */
        function creditWallet($wallet, $amount, $remarks = null)
        {
            $wallet->balance += $amount;
            $wallet->save();

            WalletTransaction::create([
                'wallet_id'      => $wallet->id,
                'type'           => 'credit',
                'amount'         => $amount,
                'balance_after'  => $wallet->balance,
                'remarks'        => $remarks,
            ]);
        }

        /**
         * Debit wallet
         */
        function debitWallet($wallet, $amount, $remarks = null, $debit_type = null)
        {
            if ($wallet->balance < $amount) {
                return false; // insufficient balance
            }

            $wallet->balance -= $amount;
            $wallet->save();

            WalletTransaction::create([
                'wallet_id'      => $wallet->id,
                'type'           => 'debit',
                'amount'         => $amount,
                'balance_after'  => $wallet->balance,
                'remarks'        => $remarks,
                'debit_type'        => $debit_type,
            ]);

            return true;
        }

        if (!function_exists('user_menus')) {

            function user_menus()
            {
                //  Check session user
                if (!session()->has('LoggedUser') || !session('LoggedUser')->user_id) {
                    return collect();
                }

                $userId = session('LoggedUser')->user_id;

                // Get assigned menu IDs
                $navIds = UserNavigation::where('user_id', $userId)
                    ->where('status', 1)
                    ->pluck('nav_id');

                // dd($userId);

                if ($navIds->isEmpty()) {
                    return collect();
                }

                // Build menu tree
                return Menu::whereIn('id', $navIds)
                    ->where('parent_id', 0)
                    ->with(['children' => function ($q) use ($navIds) {
                        $q->whereIn('id', $navIds)
                        ->with(['children' => function ($q2) use ($navIds) {
                            $q2->whereIn('id', $navIds);
                        }]);
                    }])
                    ->orderBy('sort_order')
                    ->get();
            }
        }

        /** Electronic Wallet eWallet starts here */
        /**
         * Get or create wallet
         */
        function getEWallet($ownerType, $ownerId)
        {
            return EWallet::firstOrCreate(
                [
                    'owner_type' => $ownerType,
                    'owner_id'   => $ownerId,
                ],
                [
                    'balance' => 0
                ]
            );
        }

        /**
         * Credit wallet
         */
        function creditEWallet($wallet, $amount, $credit_type=null, $remarks = null, $district = null)
        {
            $wallet->balance += $amount;
            $wallet->save();

            EWalletTransaction::create([
                'wallet_id'      => $wallet->id,
                'type'           => 'credit',
                'credit_type'    => $credit_type,
                'amount'         => $amount,
                'balance_after'  => $wallet->balance,
                'remarks'        => $remarks,
                'district'        => $district,
            ]);
        }

        /**
         * Debit wallet
         */
        function debitEWallet($wallet, $amount, $credit_type=null, $remarks = null)
        {
            if ($wallet->balance < $amount) {
                return false; // insufficient balance
            }

            $wallet->balance -= $amount;
            $wallet->save();

            EWalletTransaction::create([
                'wallet_id'      => $wallet->id,
                'type'           => 'debit',
                'credit_type'    => $credit_type,
                'amount'         => $amount,
                'balance_after'  => $wallet->balance,
                'remarks'        => $remarks,
            ]);

            return true;
        }
        /** Electronic Wallet eWallet ends here */

        /** storing branch in helpers */

        if (!function_exists('current_branch')) {
            function current_branch()
            {
                return session('LoggedUser')->branch ?? null;
            }
        }

        if (!function_exists('loggedCompany')) {
            function loggedCompany()
            {
                return session('LoggedUser')->user_id ?? null;
            }
        }

        if (!function_exists('currentUserType')) {
            function currentUserType()
            {
                return session('LoggedUser')->user_type_id ?? null;
            }
        }

        if (!function_exists('LoggedVivahMitra')) {
            function loggedVivahMitra()
            {
                return session('LoggedVivahMitra')->id ?? null;
            }
        }

        if (!function_exists('loggedVivahMitraBranch')) {
            function loggedVivahMitraBranch()
            {
                return session('LoggedVivahMitra')->branch ?? null;
            }
        }

        if (!function_exists('vivahMitraDetails')) {
            function vivahMitraDetails()
            {
                $vivahMitra = session('LoggedVivahMitra');

                if (!$vivahMitra || !isset($vivahMitra->id)) {
                    return null;
                }

                return \App\Models\User::select(
                        'users.*',
                        'user_types.name as user_type_name',
                        'master_designations.name as designation_name'
                    )
                    ->leftJoin('user_types', 'user_types.id', '=', 'users.user_type_id')
                    ->leftJoin('master_designations', 'master_designations.id', '=', 'users.user_designation_id')
                    ->where('users.id', $vivahMitra->id)
                    ->first();
            }
        }

        if (!function_exists('timeGreeting')) {
            function timeGreeting()
            {
                $hour = now()->setTimezone('Asia/Kolkata')->format('H'); // 24-hour format

                if ($hour >= 5 && $hour < 12) {
                    return 'Good Morning';
                } elseif ($hour >= 12 && $hour < 17) {
                    return 'Good Afternoon';
                } elseif ($hour >= 17 && $hour < 21) {
                    return 'Good Evening';
                } else {
                    return 'Good Night';
                }
            }
        }

        if (!function_exists('creditUplineIncentive')) {
            function creditUplineIncentive($userId, $amount, $membershipNumber, $memberName, $fatherHusband, $address, $post, $mobile)
            {
                $levels = [
                    1 => 3.02,
                    2 => 1.06,
                    3 => 1.01,
                ];

                $currentUser = User::find($userId);

                foreach ($levels as $level => $percentage) {

                    if (!$currentUser || !$currentUser->parent_id) {
                        break; // stop if no parent
                    }

                    $parent = User::find($currentUser->parent_id);

                    if (!$parent) {
                        break;
                    }

                    $commission = round(($amount * $percentage) / 100, 2);

                    if ($commission > 0) {
                        $parentEwallet = getEWallet('employee', $parent->id);

                        creditEWallet(
                            $parentEwallet,
                            $commission,
                            "{$percentage}% Level {$level} Incentive | Membership: {$membershipNumber} | Name: {$memberName} | Father/Husband: {$fatherHusband} | Mobile: {$mobile}"
                        );
                    }

                    $currentUser = $parent; // move up
                }
            }
        }

        if (!function_exists('creditUplineIncentiveforDigitalCard')) {
        function creditUplineIncentiveforDigitalCard($userId, $amount, $membershipNumber, $memberName, $fatherHusband, $address, $post, $mobile)
        {
            $levels = [
                1 => 14.3,
                2 => 8.2,
                3 => 4.1,
            ];

            $currentUser = User::find($userId);

            foreach ($levels as $level => $percentage) {

                if (!$currentUser || !$currentUser->parent_id) {
                    break; // stop if no parent
                }

                $parent = User::find($currentUser->parent_id);

                if (!$parent) {
                    break;
                }

                $commission = round(($amount * $percentage) / 100, 2);

                if ($commission > 0) {
                    $parentEwallet = getEWallet('employee', $parent->id);

                    creditEWallet(
                        $parentEwallet,
                        $commission,
                        "{$percentage}% Level {$level} Incentive | Membership: {$membershipNumber} | Name: {$memberName} | Father/Husband: {$fatherHusband} | Mobile: {$mobile}"
                    );
                }

                $currentUser = $parent; // move up
            }
        }
    }

    if(!function_exists('convertOfferShortsToEmbed1')){
        function convertOfferShortsToEmbed1($url) {
            preg_match('/shorts\/([^\?]+)/', $url, $matches);
            return isset($matches[1])
                ? 'https://www.youtube.com/embed/' . $matches[1]
                : $url;
        }
    }



?>
