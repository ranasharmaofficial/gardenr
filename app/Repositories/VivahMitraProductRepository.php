<?php
namespace App\Repositories;
use App\Repositories\Interfaces\VivahMitraProductRepositoryInterface;
use App\Models\VivahmitraProduct;

class VivahMitraProductRepository implements VivahMitraProductRepositoryInterface
{
    /** CMS Page Repo Function Start */
        public function allProducts($request){
            $products = VivahmitraProduct::select('vivahmitra_products.*');
            if($request['category_id']){
                $products = $products->where('category_id', $request['category_id']);
            }

            if($request['brand_id']){
                $products = $products->where('brand_id', $request['brand_id']);
            }

            if($request['search']){
                $products = $products->where('name','LIKE',"%{$request['search']}%");
            }
            $products = $products->latest()->paginate(25);
            return $products;
        }

        public function mainProduct(){
            $main_products = MasterProduct::where('parent_id', 0)->get();
            return $main_products;
        }

        public function storeProduct($request, $data){
            $product = new Product();
            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            $product->name = $request->name;
            $product->product_weight = $request->product_weight;
            $product->product_unit = $request->product_unit;
            $product->offer_price = $request->offer_price;
            $product->stock_quantity = $request->stock_quantity;
            $product->short_description = $request->short_description;
            $product->description = $request->description;
            $product->length = $request->length;
            $product->width = $request->width;
            $product->height = $request->height;
            $product->meta_title = $request->meta_title;
            $product->meta_keywords = $request->meta_keywords;
            $product->meta_description = $request->meta_description;
            $product->is_featured = $request->has('is_featured') ? 1 : 0;
            $product->is_new = $request->has('is_new') ? 1 : 0;
            $product->status = $request->status;
            $product->created_by = $data['created_by']; // or set manually

            $product->save();
        }

        public function findProduct($id){
            return Product::find($id);
        }

        public function updateProduct($data, $id){
            $page = MasterProduct::where('id', $id)->first();
            $page->parent_id = $data['parent_id'];
            $page->title = $data['title'];
            $page->slug = $data['slug'];
            $page->status = $data['status'];
            $page->meta_title = $data['meta_title'];
            $page->meta_tag = $data['meta_tag'];
            $page->meta_description = $data['meta_description'];
            $page->updated_by = $data['updated_by'];
            $page->other_icon = $data['other_icon'];
            $page->short_description = $data['short_description'];
            $page->order_no = $data['order_no'];
            if($data['table_fields'][0] != null){
                $page->table_fields = json_encode($data['table_fields']);
            }

            if($data['icon']){
                $page->icon = $data['icon'];
            }

            if($data['banner']){
                $page->banner = $data['banner'];
            }

            if($data['image']){
                $page->image = $data['image'];
            }
            $page->save();
        }

        public function deleteProduct($id){
            $delete_product = MasterProduct::find($id);
            $section_ids = ProductSection::where('page_id', $id)->pluck('id');
            if(sizeof($section_ids)>0){
                $delete_section = ProductSection::whereIn('id', $section_ids)->delete();
            }
            $section_data_ids = ProductSectionData::where('page_id', $id)->pluck('id');
            if(sizeof($section_data_ids)>0){
                $delete_section_data = ProductSectionData::whereIn('id', $section_data_ids)->delete();
            }
            $delete_product->delete();
        }

    /** CMS Page Repo Function End */

    /** Page Section Repo Function Start */
        public function allProductSectionList($request){
            $master_pages = ProductSection::select('product_sections.*', 'cp.title as page_title')
                ->leftJoin('master_products as cp', 'cp.id', '=', 'product_sections.page_id');
                if($request['page_id']){
                    $master_pages = $master_pages->where('product_sections.page_id',$request['page_id']);
                }
                if($request['section']){
                    $master_pages = $master_pages->where('product_sections.section_name','LIKE',"%{$request['section']}%");
                }
                if($request['search']){
                    $master_pages = $master_pages->where('product_sections.title','LIKE',"%{$request['search']}%");
                }
                $master_pages = $master_pages->latest()->paginate(25);
            return $master_pages;
        }

        public function findProductSection($id){
            return ProductSection::find($id);
        }

        public function storeProductSection($data, $type){
            if($type == "store"){
                $page = new ProductSection();
            }elseif($type == "update"){
                $page = ProductSection::find($data['id']);
            }
            $page->page_id = $data['page_id'];
            $page->section_name = $data['section_name'];
            $page->title = $data['title'];
            $page->description = $data['description'];
            if($data['image']){
                $page->image = $data['image'];
            }

            $page->status = $data['status'];
            $page->created_by = $data['created_by'];
            $page->save();

        }

        public function updateProductSection($data, $type){
            $page = ProductSection::find($data['id']);
            $page->page_id = $data['page_id'];
            $page->section_name = $data['section_name'];
            $page->title = $data['title'];
            $page->description = $data['description'];
            if($data['image']){
                $page->image = $data['image'];
            }

            $page->status = $data['status'];
            $page->created_by = $data['created_by'];
            $page->save();

        }

        public function deleteProductSection($id){
            $delete_section = ProductSection::find($id);

            $section_data_ids = ProductSectionData::where('page_id', $delete_section->page_id)->where('section_id', $id)->pluck('id');
            if(sizeof($section_data_ids)>0){
                $delete_section_data = ProductSectionData::whereIn('id', $section_data_ids)->delete();
            }
            $delete_section->delete();
        }
    /** Page Section Repo Function End */

    /** Section Data Repo Function Start */
        public function allProductSectionDataList($request){
            $data = ProductSectionData::select('product_section_datas.*', 'cp.title as page_title', 'ps.section_name')
                ->leftJoin('master_products as cp', 'cp.id', '=', 'product_section_datas.page_id')
                ->leftJoin('product_sections as ps', 'ps.id', '=', 'product_section_datas.section_id');
                if($request['page_id']){
                    $data = $data->where('product_section_datas.page_id', $request['page_id']);
                }
                if($request['section']){
                    $data = $data->where('product_section_datas.section_id',$request['section']);
                }
                if($request['search']){
                    $data = $data->where('product_section_datas.title','LIKE',"%{$request['search']}%");
                }
                $data = $data->latest()->paginate(25);
                return $data;
        }

        public function findProductSectionData($id){
            return ProductSectionData::find($id);
        }

        public function storeProductSectionData($data, $type){
            // dd($data);
            if($type == "store"){
                $page = new ProductSectionData();
                $page->created_by = $data['created_by'];
            }else{
                $page = ProductSectionData::find($data['id']);
                $page->updated_by = $data['updated_by'];
            }
            $page->page_id = $data['page_id'];
            $page->section_id = $data['section_id'];
            $page->title = $data['title'];
            $page->description = $data['description'];
            if($data['img']){
                $page->img = $data['img'];
            }
            if($data['other']){
                $page->other = $data['other'];
            }
            $page->order_number = $data['order_number'];
            // $page->other = $data['other'];
            $page->status = $data['status'];
            $page->save();

        }

        public function deleteProductSectionData($id){
            $delete_section_data = ProductSectionData::find($id);
            $delete_section_data->delete();
        }
    /** Section Data Repo Function End */

}
