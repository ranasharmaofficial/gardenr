<?php

namespace App\Http\Controllers\Admin;

use App\Models\Staff;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\TenderRepositoryInterface;

class TenderController extends Controller
{

    private $tenderRepository;

    public function __construct(TenderRepositoryInterface $tenderRepository)
    {
        $this->tenderRepository = $tenderRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $allTenders =  $this->tenderRepository->allTender($request);
        return view('admin.tenders.index', compact('allTenders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.tenders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request){
        $data = $request->validate([
            'title' => 'required',
            'details' => 'nullable',
            'uploaddate' => 'required',
            'file' => 'required',
        ]);

        if($request->has('file')){
            // $data['file'] = upload_asset($request->file, 'tender');
            $name = $request->file->getClientOriginalName();
            $imageName = time().rand(1,999).'.'.$name;
            $request->file->move(public_path('uploads/tender'), $imageName);
            $data['file'] = $imageName;
        }else{
            $data['file'] = NULL;
        }
        $data['created_by'] = session('LoggedUser')->id;
        $this->tenderRepository->storeTenders($data);
        return redirect()->route('admin.tenders.index')->with(session()->flash('alert-success', 'Added Successfully'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $tender = $this->tenderRepository->findTender($id);
        return view('admin.tenders.update', compact('tender'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $data = $request->validate([
            'title' => 'required',
            'details' => 'nullable',
        ]);

        if($request->has('file')){
            // $data['file'] = upload_asset($request->file, 'tender');
            $name = $request->file->getClientOriginalName();
            $imageName = time().rand(1,999).'.'.$name;
            $request->file->move(public_path('uploads/tender'), $imageName);
            $data['file'] = $imageName;
        }else{
            $data['file'] = NULL;
        }
        $this->tenderRepository->updateTenders($data, $id);
        return redirect()->route('admin.tenders.index')->with(session()->flash('alert-success', 'Updated Successfully'));
    }


}
