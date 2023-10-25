<?php

namespace App\Http\Controllers\Media;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use File;
use Image;
use App\Http\Requests\Admin\Media\StoreMediaImageRequest;
use App\Http\Requests\Admin\Media\UpdateMediaImageRequest;
use App\Models\Media\MediaImage;

class MediaImageController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $List = DB::table("media_images")->get();
 
        return view("admin.media.show", ["images" => $List]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMediaImageRequest $request) 
    {
    
 //try{
  //  try{
   // $x=5/0;
    // validate
   $formdata=$request->all();  
   $validator = Validator::make($formdata,
   $request->rules(),
   $request->messages()
);

if ($validator->fails()) {
  /*
    return redirect('/cpanel/users/add')
    ->withErrors($validator)
                ->withInput();
                */
                return  redirect()->back()->withErrors($validator)
                ->withInput();
               
}else{
      //  $this->validate($request,$rules,$customMessages);

        //email not repeated
        /*
        $userdb = DB::table('users')->where('email', $formdata['email'])
        ->orWhere('name', $formdata['name'])->first();
if(is_null($userdb)){
  */
        $imagemodel = new MediaImage;
      //  $imagemodel->name = $formdata['name'];
        $imagemodel->title = $formdata['title'];
        $imagemodel->caption = $formdata['caption'];
        $imagemodel->desc = $formdata['desc'];
     
       // $user->photo ="image.jpg";   
     
        //save photo
        if($request->hasFile('photo')){
            $imagemodel->save();
            $image_tmp=$request->file('photo');
            if($image_tmp->isValid()){
              //Get image Extension
              $extension=$image_tmp->getClientOriginalExtension();
              //Generate new Image Name
              //Hash::make($request->password),
              $imageName=rand(10000,99999).$imagemodel->id.'.'.$extension;
              $path='media';
              if(!File::isDirectory($path)){
                  File::makeDirectory($path, 0777, true, true); 
              }  
             $imagePath=$path.'\\'.$imageName;   
              //Upload the Image
              Image::make($image_tmp)->save($imagePath);
              $imagemodel->name = $imageName;
              $imagemodel->save();
            }
          }
       //  $user->id;
         return redirect()->back()->with('success_message','user has been Added!');
    } 
    /*
    } catch (\Exception  $e) {
         //laravel error
        return $e->getMessage();
        
     // return 'error';
    }

 } catch (\Error  $e) {
         //php error
        return $e->getMessage();
     // return 'error';
    }
*/
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
