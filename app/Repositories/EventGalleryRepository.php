<?php
namespace App\Repositories;
use App\Repositories\Interfaces\EventGalleryRepositoryInterface;
use App\Models\EventGallery;
use App\Models\EventCategory;
use App\Models\Country;
// use Illuminate\Http\Request;

class EventGalleryRepository implements EventGalleryRepositoryInterface
{
    public function allGallery($request){
        $galleries = EventGallery::select('event_galleries.*', 'cat.title as parent_name')
            ->leftJoin('image_categories as cat', 'cat.id', '=', 'event_galleries.category_id');
            if($request->category_id){
                $galleries = $galleries->where('event_galleries.category_id', $request['category_id']);
            }
            if($request->search){
                $galleries = $galleries->where('event_galleries.description','LIKE',"%{$request['search']}%");
            }
            $galleries = $galleries->latest()->paginate(30);
        return $galleries;
    }

    public function getCategoryList(){
        return EventCategory::select('id', 'title')->where('parent_id', '0')->where('status', 1)->get();
    }

    public function storeGallery($request, $data){
        // $gallery = new Gallery();
        // $gallery->category_id = $data['category_id'];
        // $gallery->description = $data['description'];

        // if($data['image']){
        //     $gallery->image = $data['image'];
        // }else{
        //     $gallery->image = NULL;
        // }

        // if($data['icon']){
        //     $gallery->icon = $data['icon'];
        // }else{
        //     $gallery->icon = NULL;
        // }

        // $gallery->status = $data['status'];
        // $gallery->created_by = $data['created_by'];
        // $gallery->save();

        if($data['images'])
        {
           foreach($data['images'] as $key => $file)
           {
               $name = $file->getClientOriginalName();
               $imageName = time().rand(1,999).'.'.$name;
               $file->move(public_path('uploads/gallery'), $imageName);
               $insert[$key]['image'] = $imageName;
               $insert[$key]['category_id'] = $data['category_id'];
           }
        }
        EventGallery::insert($insert);

    }

    public function findGallery($id){
        return EventGallery::find($id);
    }

    public function updateGallery($data, $id){
        $gallery = EventGallery::where('id', $id)->first();
        $gallery->category_id = $data['category_id'];
        $gallery->description = $data['description'];

        if($data['image']){
            $gallery->image = $data['image'];
        }

        if($data['icon']){
            $gallery->icon = $data['icon'];
        }

        $gallery->status = $data['status'];
        $gallery->updated_by = $data['updated_by'];
        $gallery->save();
    }

    public function deleteGallery($id){
        $delete = EventGallery::find($id);
        $delete->delete();
    }

}
