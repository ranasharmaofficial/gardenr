<?php
namespace App\Repositories\WebRepo;
use App\Repositories\Interfaces\WebInterface\MemberRepositoryInterface;
use App\Models\User;
use App\Models\ImageCategory;
use App\Models\Gallery;
use App\Mail\SendEnquiry;
use Illuminate\Support\Facades\Mail;


class MemberRepository implements MemberRepositoryInterface
{


    public function getSpecialityDoctorList($speciality_id){
        return User::where('status', 1)->where('user_type_id', 3)->get();
    }

    public function getImageCategory(){
        return ImageCategory::select('id', 'title', 'slug', 'image', 'created_at', 'description')->where('status', 1)->get();
    }

    public function getGalleryDetails($slug){
        return ImageCategory::select('*')->where('slug', $slug)->where('status', 1)->first();
    }

    public function photoGalleryDetails($id){
        return Gallery::select('*')->where('category_id', $id)->where('status', 1)->get();
    }


    // getSpecialitySection





}
