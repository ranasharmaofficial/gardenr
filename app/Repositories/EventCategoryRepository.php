<?php
namespace App\Repositories;
use App\Repositories\Interfaces\EventCategoryRepositoryInterface;
use App\Models\EventCategory;
use App\Models\EventGallery;

class EventCategoryRepository implements EventCategoryRepositoryInterface
{
    public function allCategories()
    {
        return EventCategory::where('parent_id', 0)->latest()->paginate(10);
    }

    public function storeCategory($data)
    {
        // return EventCategory::create($data);
        $image_category = new EventCategory();
        $image_category->title = $data['title'];
        $image_category->english_title = $data['english_title'];
        if($data['image']){
            $image_category->image = $data['image'];
        }else{
            $image_category->image = NULL;
        }
        $image_category->status = $data['status'];
        $image_category->created_by = $data['created_by'];
        $image_category->save();
    }

    public function findCategory($id)
    {
        return EventCategory::find($id);
    }

    public function updateCategory($data, $id)
    {
        $updated_by = session('LoggedUser')->id;
        $category = EventCategory::where('id', $id)->first();
        $category->title = $data['title'];
        $category->status = $data['status'];
        $category->updated_by = $updated_by;
        $category->save();
    }

    public function destroyCategory($id)
    {
        $category = EventCategory::find($id);
        $galleries_ids = EventGallery::where('category_id', $id)->pluck('id');
        if(sizeof($galleries_ids)>0){
            $delete_EventGallery = EventGallery::whereIn('id', $galleries_ids)->delete();
        }
        $category->delete();

    }
}
