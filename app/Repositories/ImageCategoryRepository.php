<?php
namespace App\Repositories;
use App\Repositories\Interfaces\ImageCategoryRepositoryInterface;
use App\Models\ImageCategory;
use App\Models\Gallery;

class ImageCategoryRepository implements ImageCategoryRepositoryInterface
{
    public function allCategories()
    {
        return ImageCategory::where('parent_id', 0)->latest()->paginate(10);
    }

    public function storeCategory($data)
    {
        // return ImageCategory::create($data);
        $image_category = new ImageCategory();
        $image_category->title = $data['title'];
        $image_category->description = $data['description'];
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
        return ImageCategory::find($id);
    }

    public function updateCategory($data, $id)
    {
        $updated_by = session('LoggedUser')->id;
        $category = ImageCategory::where('id', $id)->first();
        $category->title = $data['title'];
        $category->status = $data['status'];
        $category->updated_by = $updated_by;
        $category->save();
    }

    public function destroyCategory($id)
    {
        $category = ImageCategory::find($id);
        $galleries_ids = Gallery::where('category_id', $id)->pluck('id');
        if(sizeof($galleries_ids)>0){
            $delete_gallery = Gallery::whereIn('id', $galleries_ids)->delete();
        }
        $category->delete();

    }
}
