<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class PostingController extends \App\Http\Controllers\Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $postings = \App\Posting::all();
        $response = [
            'postings' => $postings
        ];
        return response()->json($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        $response = [
            'postings' => $posting
        ];

        return response()->json($response, 200);
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
        //
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
        $response = [
            'postings' => $posting
        ];
        return response()->json($response, 200);
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
        if($posting->lastImage !== '') $this->deletePhoto($posting->lastImage);
        $posting->delete();
        $response = [
            'postings' => $posting
        ];
        return response()->json($response, 200);
    }
}
