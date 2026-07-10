<?php
namespace App\Repositories;
use App\Repositories\Interfaces\GalleryRepositoryInterface;
use App\Models\Gallery;
use App\Models\ImageCategory;
use App\Models\Country;
// use Illuminate\Http\Request;
use Image;
class GalleryRepository implements GalleryRepositoryInterface
{
    public function allGallery($request){
        $galleries = Gallery::select('galleries.*', 'cat.title as parent_name','cat.description as cat_description')
            ->leftJoin('image_categories as cat', 'cat.id', '=', 'galleries.category_id');
            if($request->category_id){
                $galleries = $galleries->where('galleries.category_id', $request['category_id']);
            }
            if($request->search){
                $galleries = $galleries->where('galleries.description','LIKE',"%{$request['search']}%");
            }
            $galleries = $galleries->latest()->paginate(30);
        return $galleries;
    }

    public function getCategoryList(){
        return ImageCategory::select('id', 'title', 'description')->where('parent_id', '0')->where('status', 1)->get();
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

        /*if($data['images'])
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
        Gallery::insert($insert);
        */



        $insert = [];

        if (!empty($data['images'])) {

            foreach ($data['images'] as $key => $file) {

                $img = Image::make($file);

                $width  = $img->width();
                $height = $img->height();

                // Resize logic
                if ($width > $height && $width > 1200) {
                    $img->resize(1200, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                } elseif ($height > 800) {
                    $img->resize(null, 800, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                }

                // Sharpen for better quality
                $img->sharpen(10);

                // Convert to webp
                $filename = time() . rand(1,999) . '.webp';
                $path = public_path('uploads/gallery/' . $filename);

                $img->encode('webp', 90)->save($path);

                $insert[$key]['image'] = $filename;
                $insert[$key]['category_id'] = $data['category_id'];
            }
        }

        Gallery::insert($insert);

    }

    public function findGallery($id){
        return Gallery::find($id);
    }

    public function updateGallery($data, $id){
        $gallery = Gallery::where('id', $id)->first();
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
        $delete = Gallery::find($id);
        $delete->delete();
    }

}
