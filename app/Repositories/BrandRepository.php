<?php
namespace App\Repositories;
use App\Repositories\Interfaces\BrandRepositoryInterface;
use App\Models\Brand;


class BrandRepository implements BrandRepositoryInterface
{
        /** CMS Page Repo Function Start */
        public function allBrand($request){
            $pages = Brand::select('*');
                if($request['search']){
                    $pages = $pages->where('name','LIKE',"%{$request['search']}%");
                }
                $pages = $pages->latest()->paginate(1000);
            return $pages;
        }

        public function storeBrand($request, $data){
            $brand = new Brand();
            $brand->name = $data['name'];
            $brand->status = $data['status'];
            $brand->logo = $data['logo'];
            $brand->save();
            return true;
        }

        public function findBrand($id){
            return Brand::find($id);
        }

        public function updateBrand($data, $id){
            // dd($data);
            $brand = Brand::where('id', $id)->first();
            $brand->name = $data['name'];
            $brand->status = $data['status'];
            $brand->slug = $data['slug'];
             if (isset($data['logo']) && $data['logo']!== null) {
                $brand->logo = $data['logo'];
            }
            $brand->save();
            return true;
        }
     
}
