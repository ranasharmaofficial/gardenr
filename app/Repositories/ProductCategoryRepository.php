<?php
namespace App\Repositories;
use App\Repositories\Interfaces\ProductCategoryRepositoryInterface;
use App\Models\ProductCategory;


class ProductCategoryRepository implements ProductCategoryRepositoryInterface
{
    public function getCmsPageList(){
        return ProductCategory::select('*')->where('status', 1)->get();
    }



    /** CMS Page Repo Function Start */
        public function allCategories($request){
            $pages = ProductCategory::select('*');
                if($request['search']){
                    $pages = $pages->where('name','LIKE',"%{$request['search']}%");
                }
                $pages = $pages->latest()->paginate(1000);
            return $pages;
        }

        public function storeCategory($request, $data){
            $product_category = new ProductCategory();
            $product_category->name = $data['name'];
            $product_category->parent_id = $data['parent_id'];
            $product_category->status = $data['status'];
            $product_category->image = $data['image'];
            $product_category->description = $data['description'];
            $product_category->save();
            return true;
        }

        public function findCategory($id){
            return ProductCategory::find($id);
        }

        public function updateCategory($data, $id){
            // dd($data);
            $product_category = ProductCategory::where('id', $id)->first();
            $product_category->name = $data['name'];
            $product_category->parent_id = $data['parent_id'];
            $product_category->status = $data['status'];
            $product_category->description = $data['description'];
            $product_category->slug = $data['slug'];
             if (isset($data['image']) && $data['image']!== null) {
                $product_category->image = $data['image'];
            }
            $product_category->save();
            return true;
        }
    /** CMS Page Repo Function End */






}
