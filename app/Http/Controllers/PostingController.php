<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Validator;
use Session;
use File;
use DB;

class PostingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = $request->get('query');
        $postings = \App\Posting::where('plat_nomor', 'LIKE', '%'.$query.'%') -> orWhere('pelanggaran', 'LIKE', '%'.$query.'%') -> orderBy('id') -> paginate(5);
        return view('posting.index', compact('postings'));
    }

    public function getTrash(){
        $postings = \App\Posting::withTrashed()->whereNotNull('deleted_at')->get();
        return view('posting.trash', compact('postings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $rules = [
            'pelanggaran' => 'required',
            'jenis_kendaraan' => 'required',
            'plat_nomor' => 'required',
            'lastImage' => 'mimes:jpeg,jpg,bmp,png|max:10240',
        ];

        $messages = [
            'required' => 'Field harus di isi alias tidak boleh kosong',
            'max' => 'Ukuran photo maksimal 10 MB ',
            'mimes' => 'Photo harus berekstensi JPG, JPEG, BMP, atau PNG'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect() -> route('postings.create')->withErrors($validator)->withInput();
        }

        $data = $request->only('pelanggaran','jenis_kendaraan', 'plat_nomor');

        if ($request->hasFile('lastImage')){
            $data['lastImage'] = $this->savePhoto($request->file('lastImage'));
        } 
 
        $posting = \App\Posting::create($data);

        Session::flash('flash_notification', ["level"=>"success", "message"=>"Berhasil menambahkan daftar pelanggaran kedalam database"]);
        return redirect()->route('postings.index');
    }

    public function savePhoto(UploadedFile $photo) {
        $fileName = str_random(40) . '.' . $photo->guessClientExtension();
        $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
        $photo -> move($destinationPath, $fileName);
        return $fileName;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posting = \App\Posting::find($id);
        return view('posting.edit', compact('posting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $olddata = \App\Posting::find($id);
        $posting = \App\Posting::findOrFail($id);

        $rules = [
            'pelanggaran' => 'required',
            'jenis_kendaraan' => 'required',
            'plat_nomor' => 'required',
            'lastImage' => 'mimes:jpeg,jpg,bmp,png|max:10240',
        ];

        $messages = [
            'required' => 'Field harus di isi alias tidak boleh kosong',
            'max' => 'Ukuran photo maksimal 10 MB ',
            'mimes' => 'Photo harus berekstensi JPG, JPEG, BMP, atau PNG'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect() -> route('postings.create')->withErrors($validator)->withInput();
        }

        $data = $request->only('pelanggaran','jenis_kendaraan', 'plat_nomor');

        if ($request->hasFile('lastImage')){
            $data['lastImage'] = $this->savePhoto($request->file('lastImage'));
            if($posting->lastImage !== '') $this->deletePhoto($posting->lastImage);
        }

        $posting->update($data);
        Session::flash('flash_notification', ["level"=>"success", "message"=>"Berhasil mengubah pelanggaran kedalam database"]);
        return redirect()->route('postings.index');
    }

    public function deletePhoto($filename){
        $path = public_path() . DIRECTORY_SEPARATOR . 'img/'.$filename;
        return File::delete($path);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posting = \App\Posting::find($id);
        $posting->delete();
        Session::flash('flash_notification', ["level"=>"success", "message"=>"Berhasil meenghapus pelanggaran dari database"]);
        return redirect()->route('postings.index');
    }

    public function forceDelete($id)
    {
        $posting = \App\Posting::withTrashed()->find($id);
        if($posting->lastImage !== '') $this->deletePhoto($posting->lastImage);
        $posting->forceDelete();
        Session::flash('flash_notification', ["level"=>"success", "message"=>"Berhasil meenghapus permanan pelanggaran dari database"]);
        return redirect()->route('postings.index');
    }

    public function getRestore($id)
    {
        $posting = \App\Posting::withTrashed()->find($id);
        $posting->restore();
        Session::flash('flash_notification', ["level"=>"success", "message"=>"Berhasil mengembalikan daftar pelanggaran dari database"]);
        return redirect()->route('postings.index');
    }

    public function getid(Request $request){
        return $request->all();
    }
}
