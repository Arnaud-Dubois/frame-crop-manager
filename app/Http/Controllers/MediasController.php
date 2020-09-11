<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Models\Media;
use App\Http\Resources\Media as MediaResource;
use Illuminate\Support\Facades\Storage;


class MediasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medias = DB::select('select * from `medias` order by `created_at` desc');
        return MediaResource::collection($medias);
    }

    public function show($id)
    {
        $media = Media::find($id);
        return $media;
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'path' => 'image|nullable'
        ]);

        $filenameWithExt = request('path')->getClientOriginalName();
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
        $extension = request('path')->getClientOriginalExtension();
        $filenameToStore = $filename . '_' . time() . '.' . $extension;
        $path = $request->file('path')->storeAs('public/images', $filenameToStore);

        $pathPublic = 'storage/images/' . $filenameToStore;

        $media = new Media;
        $media->path = $pathPublic;
        $media->name = $filename;
        $media->save();
    }

    public function destroy($id)
    {
        $media = Media::find($id);
        $media->delete();
    }
}