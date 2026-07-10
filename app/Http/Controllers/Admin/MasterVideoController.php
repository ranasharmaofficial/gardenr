<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\MasterVideo;
use App\Models\UserType;
use App\Models\MasterDesignation;
use App\Models\MVideoCategory;
use DB;

class MasterVideoController extends Controller
{

    public function videoCategoryList(Request $request){

    }
    public function index(Request $request){
        $user_type =  UserType::where('status', 1)->where('id', '!=', 1)->get();
        $m_video_category =  MVideoCategory::where('status', 1)->where('parent_id', null)->get();
        // dd($user_type);
            $query = MasterVideo::select([
                'master_videos.*',
                'user_types.name as userType',
                'master_designations.name as userDesignation',
            ])->join('user_types', 'user_types.id', '=', 'master_videos.user_type')
              ->leftJoin('master_designations', 'master_designations.id', '=', 'master_videos.user_designation');

            if ($request->type) {
                $query->where('master_videos.user_type', $request->type);
            }

            if ($request->user_designation) {
                $query->where('master_videos.user_designation', $request->user_designation);
            }

            if ($request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('master_videos.video_title', 'like', "%$search%")
                    ->orWhere('master_videos.video_url', 'like', "%$search%");
                });
            }

            $video_list = $query->orderBy('id', 'DESC')->paginate(10);

        $datas = [
            'video_list' => $video_list,
            'user_type' => $user_type,
            'm_video_category' => $m_video_category,
            'request' => $request,
            'page_title' => 'Master Video List',
        ];
        return view('admin.master.master_video.index', $datas);
    }

    public function fetchMasterVideoData(Request $request)
    {
         $query = MasterVideo::select([
                'master_videos.*',
                'user_types.name as userType',
                'master_designations.name as userDesignation',
            ])->join('user_types', 'user_types.id', '=', 'master_videos.user_type')
              ->leftJoin('master_designations', 'master_designations.id', '=', 'master_videos.user_designation');

            if ($request->type) {
                $query->where('master_videos.user_type', $request->type);
            }

            if ($request->user_designation) {
                $query->where('master_videos.user_designation', $request->user_designation);
            }

            if ($request->search) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('master_videos.video_title', 'like', "%$search%")
                    ->orWhere('master_videos.video_url', 'like', "%$search%");
                });
            }

            $video_list = $query->orderBy('id', 'DESC')->paginate(10);

            if ($request->ajax()) {
                return view('admin.master.master_video.target_table_ajax', compact('video_list'))->render();
            }
    }

    /* Store New Session */
   public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'video_type' => 'required',
            'video_title' => 'required',
            'video_url' => 'required',
            'type' => 'required',
            'user_designation_id' => 'required',
            'status' => 'required',

        ]);

        // if ($request->hasFile('file')) {
        //     $ext = $request->file->getClientOriginalExtension();
        //     $fileName = time() . rand(1, 999) . '.' . $ext;
        //     $request->file->move(public_path('uploads/agreement'), $fileName);
        //     $data['file'] = 'uploads/agreement/' . $fileName;
        // } else {
        //     $data['file'] = NULL;
        // }

        $target = new MasterVideo();
        $target->category_id = $request->category_id;
        $target->sub_category_id = $request->sub_category_id;
        $target->video_type = $request->video_type;
        $target->video_title = $request->video_title;
        $target->video_url = $request->video_url;
        $target->status = $request->status;
        $target->user_type = $request->type;
        $target->user_designation = $request->user_designation_id;
        $target->created_by = session('LoggedUser')->id;
        $target->save();

        return response()->json(['status' => true, 'message' => 'Video Added successfully!']);
    }


    public function edit($id)
    {
        $video = MasterVideo::find($id);
        $user_type =  UserType::where('status', 1)->where('id', '!=', 1)->get();
        $user_designation_details =  MasterDesignation::where('id', $video->user_designation)->first();
        $m_video_category =  MVideoCategory::where('status', 1)->where('parent_id', null)->get();
        $page_title = 'Video';
        return view('admin.master.master_video.edit_target', compact('video', 'page_title', 'user_type', 'user_designation_details', 'm_video_category'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'video_type' => 'required',
            'video_title' => 'required',
            'video_url' => 'required',
            'type' => 'required',
            'user_designation_id' => 'required',
            'status' => 'required',
        ]);

        $target = MasterVideo::findOrFail($id);
        $target->category_id = $request->category_id;
        $target->sub_category_id = $request->sub_category_id;
        $target->video_type = $request->video_type;
        $target->video_title = $request->video_title;
        $target->video_url = $request->video_url;
        $target->status = $request->status;
        $target->user_type = $request->type;
        $target->user_designation = $request->user_designation_id;
        $target->created_by = session('LoggedUser')->id;
        $target->save();
        return response()->json(['status' => true, 'message' => 'Video Updated successfully!']);
    }

    public function getSubCategory($id)
    {
        $subCategories = DB::table('m_video_categories')
            ->where('parent_id', $id)
            ->get();

        return response()->json($subCategories);
    }

    public function deleteMasterVideo($id)
    {
        $video = MasterVideo::find($id);
        if ($video) {
            $video->delete();
            // return response()->json(['status' => true, 'message' => 'Video deleted successfully!']);
            return redirect()->back()->with('alert-danger', 'Video deleted successfully');
        } else {
            return redirect()->back()->with('alert-danger', 'Something went wrong');
        }
    }

}
