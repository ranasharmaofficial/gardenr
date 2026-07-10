<?php
namespace App\Repositories;
use App\Repositories\Interfaces\TrainingVideoCategoryRepositoryInterface;
use App\Models\MVideoCategory;

class TrainingVideoCategoryRepository implements TrainingVideoCategoryRepositoryInterface
{
    public function getCmsPageList(){
        return MVideoCategory::select('*')->where('status', 1)->get();
    }

        /** CMS Page Repo Function Start */
        public function allCategories($request){
            $pages = MVideoCategory::select('*');
                if($request['search']){
                    $pages = $pages->where('name','LIKE',"%{$request['search']}%");
                }
                $pages = $pages->latest()->paginate(1000);
            return $pages;
        }

        public function storeCategory($request, $data){
            $product_category = new MVideoCategory();
            $product_category->name = $data['name'];
            $product_category->parent_id = $data['parent_id'];
            $product_category->status = $data['status'];
            // $product_category->image = $data['image'] ?? null;
            // $product_category->description = $data['description'] ?? null;
            $product_category->save();
            return true;
        }

        public function findCategory($id){
            return MVideoCategory::find($id);
        }

        public function updateCategory($data, $id){
            // dd($data);
            $product_category = MVideoCategory::where('id', $id)->first();
            $product_category->name = $data['name'];
            $product_category->parent_id = $data['parent_id'];
            $product_category->status = $data['status'];
            // $product_category->description = $data['description'];
            $product_category->slug = $data['slug'];
            //  if (isset($data['image']) && $data['image']!== null) {
            //     $product_category->image = $data['image'];
            // }
            $product_category->save();
            return true;
        }
    /** CMS Page Repo Function End */






}
