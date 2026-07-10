<?php

namespace App\Http\Controllers\Admin;

use App\Models\EventGallery;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\EventGalleryRepositoryInterface;
use JD\Cloudder\Facades\Cloudder;

class EventGalleryController extends Controller
{

    private $eventgalleryRepostory;

    public function __construct(EventGalleryRepositoryInterface $eventgalleryRepostory)
    {
        $this->eventgalleryRepostory = $eventgalleryRepostory;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $categories =  $this->eventgalleryRepostory->getCategoryList();
        $galleries =  $this->eventgalleryRepostory->allGallery($request);
        return view('admin.event_galleries.gallery.index', compact('galleries', 'categories', 'request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories =  $this->eventgalleryRepostory->getCategoryList();
        return view('admin.event_galleries.gallery.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'category_id' => 'required',
            // 'description' => 'required',
            // 'images' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'images' => 'required',
            // 'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'status' => 'required',
        ]);

        // if($request->has('images')){
        //     $data['images'] = upload_asset($request->image);
        // }else{
        //     $data['images'] = NULL;
        // }

        // if($request->has('icon')){
        //     $data['icon'] = upload_asset($request->icon);
        // }else{
        //     $data['icon'] = NULL;
        // }

        $data['created_by'] = session('LoggedUser')->id;
        $this->eventgalleryRepostory->storeGallery($request, $data);

        return redirect()->route('admin.event_galleries.index')->with(session()->flash('alert-success', 'Gallery Created Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $gallery = $this->eventgalleryRepostory->findGallery($id);
        if($gallery){
            $categories =  $this->eventgalleryRepostory->getCategoryList();
            return view('admin.event_galleries.gallery.update', compact('gallery', 'categories'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'category_id' => 'required|not_in:0',
            'description' => 'required',
            // 'blog_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
        ]);

        if($request->has('image')){
            $data['image'] = upload_asset($request->image);
        }else{
            $data['image'] = NULL;
        }

        if($request->has('icon')){
            $data['icon'] = upload_asset($request->icon);
        }else{
            $data['icon'] = NULL;
        }

        $data['updated_by'] = session('LoggedUser')->id;

        $this->eventgalleryRepostory->updateGallery($data, $id);
        return redirect()->route('admin.event_galleries.index')->with(session()->flash('alert-success', 'Gallery Updated Successfully'));
    }

    public function delete($id){
        $this->eventgalleryRepostory->deleteGallery($id);
        return redirect()->route('admin.event_galleries.index')->with(session()->flash('alert-danger', 'Data Deleted Successfully'));
    }

}
