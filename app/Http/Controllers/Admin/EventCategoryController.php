<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Repositories\Interfaces\EventCategoryRepositoryInterface;

class EventCategoryController extends Controller
{

    private $eventCategoryRepository;

    public function __construct(EventCategoryRepositoryInterface $eventCategoryRepository)
    {
        $this->eventCategoryRepository = $eventCategoryRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories =  $this->eventCategoryRepository->allCategories();
        return view('admin.event_galleries.image_category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.event_galleries.image_category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required',
            'image' => 'required',
            'english_title' => 'required',
        ]);
        if($request->has('image')){
            $data['image'] = upload_asset($request->image);
        }else{
            $data['image'] = NULL;
        }
        $data['created_by'] = session('LoggedUser')->id;
        $this->eventCategoryRepository->storeCategory($data);

        return redirect()->route('admin.event_categories.index')->with(session()->flash('alert-success', 'Event Category Created Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->eventCategoryRepository->findCategory($id);
        return view('admin.event_galleries.image_category.update', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required'
        ]);
        $this->eventCategoryRepository->updateCategory($request->all(), $id);
        return redirect()->route('admin.event_categories.index')->with(session()->flash('alert-success', 'Image Category Updated Successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
    */
    public function delete($id){
        $this->eventCategoryRepository->destroyCategory($id);
        return redirect()->route('admin.event_categories.index')->with(session()->flash('alert-danger', 'Data Deleted Successfully'));
    }
}
