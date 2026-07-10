<?php
namespace App\Repositories;
use App\Repositories\Interfaces\NavigationRepositoryInterface;
use App\Models\Menu;


class NavigationRepository implements NavigationRepositoryInterface
{
        /** CMS Page Repo Function Start */
        public function allNavigations($request){

            $menus = Menu::where('parent_id', 0)
                        ->orderBy('sort_order')
                        ->with([
                            'children' => function($q){
                                $q->orderBy('sort_order')
                                ->with('children'); // for submenus
                            }
                        ])
                        ->get();

            return $menus;
            // $pages = Menu::select('*');
            //     if($request['search']){
            //         $pages = $pages->where('name','LIKE',"%{$request['search']}%");
            //     }
            //     $pages = $pages->latest()->paginate(1000);
            // return $pages;
        }

        public function getAllNavigationList(){

            $menus = Menu::where('parent_id', 0)
                        ->orderBy('sort_order')
                        ->with([
                            'children' => function($q){
                                $q->orderBy('sort_order')
                                ->with('children'); // for submenus
                            }
                        ])
                        ->get();

            return $menus;
        }

        public function getNavigationHead($nav_head = 0)
        {
            // dd($nav_head);
            return Menu::where('id', $nav_head)
                        ->orderBy('sort_order', 'ASC')
                        ->get();
        }

        // public function get_navigation_head($nav_head = 0)
        // {
        //     $this->db->order_by('nav_order', 'ASC');
        //     $this->db->where('parent_id', $nav_head);
        //     return
        //     $this->db->get('master_navigation_tbl')->result();
        // }

        public function storeNavigation($request, $data){
            $brand = new Menu();
            $brand->name = $data['name'];
            $brand->icon = $data['icon'];
            $brand->sort_order = $data['sort_order'];
            $brand->status = $data['status'];
            $brand->route = $data['route'];
            $brand->parent_id = $data['parent_id'];
            $brand->save();
            return true;
        }

        public function updateNavigation($request, $data){
            $navigation = Menu::where('id', $request->id)->first();
            $navigation->name = $data['name'];
            $navigation->icon = $data['icon'];
            $navigation->sort_order = $data['sort_order'];
            $navigation->status = $data['status'];
            $navigation->route = $data['route'];
            $navigation->parent_id = $data['parent_id'];
            $navigation->save();
            return true;
        }

        public function findNavigation($id){
            return Menu::find($id);
        }



}
