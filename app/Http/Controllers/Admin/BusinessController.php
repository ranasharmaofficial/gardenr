<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\BusinessRepositoryInterface;
use App\Models\VivahAppSlider;
class BusinessController extends Controller
{
    private $businessRepository;
    public function __construct(BusinessRepositoryInterface $businessRepository)
    {
        $this->businessRepository = $businessRepository;
    }

    public function socialMedia(){
        $social_meadia_values = $this->businessRepository->getBusinessSetupList('social_media');
        return view('admin.business_setting.social_media', compact('social_meadia_values'));
    }

    public function websiteHeader(){
        $datas = $this->businessRepository->getBusinessSetupList('header_setup');
        return view('admin.business_setting.header', compact('datas'));
    }

    public function homeBanner(){
       $home_banner =  $this->businessRepository->getHomeBannerList();
       return view('admin.business_setting.home_banner', compact('home_banner'));
    }

    public function editHomeBanner($id)
    {
        $home_banner =  $this->businessRepository->editHomeBanner($id);
        return view('admin.business_setting.edit_home_banner', compact('home_banner'));
    }

    public function storeHomeBanner(Request $request){
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1055',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $ext = $request->image->getClientOriginalExtension();
            $imageName = time() . rand(1, 999) . '.' . $ext;
            $request->image->move(public_path('uploads/all'), $imageName);
            $data['image'] = 'uploads/all/' . $imageName;
        } else {
            $data['image'] = NULL;
        }
         $data['created_by'] = session('LoggedUser')->id;
        $this->businessRepository->storeHomeBanner($data, $request);
        return redirect()->back()->with(session()->flash('alert-success', 'Home Banner Saved Successfully'));
    }

    public function updateHomeBanner(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1055',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $ext = $request->image->getClientOriginalExtension();
            $imageName = time() . rand(1, 999) . '.' . $ext;
            $request->image->move(public_path('uploads/all'), $imageName);
            $data['image'] = 'uploads/all/' . $imageName;
        } else {
            $data['image'] = NULL;
        }

        $data['id'] = $request->id;
        $data['created_by'] = session('LoggedUser')->id;
        $this->businessRepository->updateHomeBanner($request, $data);
        return redirect()->back()->with(session()->flash('alert-success', 'Updated Successfully'));
    }

    public function websiteFooter(){
        $widget_one_data = $this->businessRepository->getBusinessSetupList('footer_widget_one_links');
        $widget_two_data = $this->businessRepository->getBusinessSetupList('footer_widget_two_links');
        $widget_three_data = $this->businessRepository->getBusinessSetupList('footer_widget_three_links');
        return view('admin.business_setting.footer', compact('widget_one_data', 'widget_two_data', 'widget_three_data'));
    }



    /** Store or Update Business Setting for website setup */
    public function websiteSetupUpdate(Request $request){
        // dd($request->all());
        $data = $request->validate([
            'type' => 'required|string|max:50',
            'field_names' => 'required|array',
            'values' => 'array',
        ]);

        if($request->has('header_logo')){
            $data['header_logo'] = upload_asset($request->header_logo, 'logo');
        }else{
            $data['header_logo'] = NULL;
        }

        if($request->has('footer_logo')){
            $data['footer_logo'] = upload_asset($request->footer_logo, 'logo');
        }else{
            $data['footer_logo'] = NULL;
        }

        $social_update = $this->businessRepository->updateWebsiteData($data);
        if (!$social_update) {
            return response()->json([
                "status" => false,
                "message" => 'Something went wrong',
            ]);
        } else {
            return response()->json([
                "status" => true,
                "message" => 'Successfully Updated.',
            ]);

        }
        // return redirect()->back()->with(session()->flash('alert-success', 'Website Setup Updated Successfully'));
    }

    /** Store or Update Business Setting for website setup */
    public function websiteFooterSetupUpdate(Request $request){
        // dd($request->all());
        $data = $request->validate([
            'type' => 'required|string|max:50',
            'field_names' => 'required|array',
            'values' => 'array',
        ]);

        if($request->has('header_logo')){
            $data['header_logo'] = upload_asset($request->header_logo, 'logo');
        }else{
            $data['header_logo'] = NULL;
        }

        if($request->has('footer_logo')){
            $data['footer_logo'] = upload_asset($request->footer_logo, 'logo');
        }else{
            $data['footer_logo'] = NULL;
        }

        $this->businessRepository->updateWebsiteData($data);
        // if (!$social_update) {
        //     return response()->json([
        //         "status" => false,
        //         "message" => 'Something went wrong',
        //     ]);
        // } else {
        //     return response()->json([
        //         "status" => true,
        //         "message" => 'Successfully Updated.',
        //     ]);

        // }
        return redirect()->back()->with(session()->flash('alert-success', 'Updated Successfully'));
    }

    /** Store or Update Business Setting for website Widgets Setup */
    public function websiteSetupUpdateWidget(Request $request){
        $data = $request->validate([
            'widget_type1' => 'required',
            'widget_lable' => 'required',
            'widget_name' => 'required',
            'widget_type2' => 'required',
            'widget_lables' => 'required|array',
            'widget_lables.*' => 'required|string',
            'widget_links' => 'required|array',
            'widget_links.*' => 'required|string',
        ]);

        $this->businessRepository->updateWebsiteWidgetData($data);
        return redirect()->back()->with(session()->flash('alert-success', 'Website Setup Updated Successfully'));
    }


    public function officeSetup(){
        return view('admin.business_setting.office_setup');
    }

    public function updateOfficeSetup(Request $request){
        $data = $request->validate([
            'email' => 'required|array',
            'contact' => 'required|array',
            'address' => 'required|array',
            'timing' => 'required|array',
            'office_type' => 'required',
            'address_type' => 'required',
        ]);

        $this->businessRepository->updateOfficeSetuptData($data);
        return redirect()->back()->with(session()->flash('alert-success', 'Office Address Setup Updated Successfully'));
    }

    /** vivah mitra app sliders */

    public function vivahMitraAppSliders(){
       $home_banner =  $this->businessRepository->getvivahMitraAppSliders();
       return view('admin.business_setting.vivah_mitra_home_banner', compact('home_banner'));
    }

    public function editVivahMitraAppBanner($id)
    {
        $home_banner =  $this->businessRepository->editVivahMitraAppBanner($id);
        return view('admin.business_setting.edit_vivah_mitra_home_banner', compact('home_banner'));
    }

    public function storeVivahMitraAppSliders(Request $request){
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1055',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $ext = $request->image->getClientOriginalExtension();
            $imageName = time() . rand(1, 999) . '.' . $ext;
            $request->image->move(public_path('uploads/all'), $imageName);
            $data['image'] = 'uploads/all/' . $imageName;
        } else {
            $data['image'] = NULL;
        }
         $data['created_by'] = session('LoggedUser')->id;
        $this->businessRepository->storeVivahMitraAppSliders($data, $request);
        return redirect()->back()->with(session()->flash('alert-success', 'Home Banner Saved Successfully'));
    }

    public function updatevivahMitraAppSliders(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:1055',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $ext = $request->image->getClientOriginalExtension();
            $imageName = time() . rand(1, 999) . '.' . $ext;
            $request->image->move(public_path('uploads/all'), $imageName);
            $data['image'] = 'uploads/all/' . $imageName;
        } else {
            $data['image'] = NULL;
        }

        $data['id'] = $request->id;
        $data['created_by'] = session('LoggedUser')->id;
        $this->businessRepository->updatevivahMitraAppSliders($request, $data);
        return redirect()->back()->with(session()->flash('alert-success', 'Updated Successfully'));
    }

    public function deleteVivahMitraAppBanner($id){
        $delete_app_banner = VivahAppSlider::find($id);
        $delete_app_banner->delete();
        return back()->with(session()->flash('alert-success', 'Vivah Mitra App Banner Deleted Successfully'));
    }

}
