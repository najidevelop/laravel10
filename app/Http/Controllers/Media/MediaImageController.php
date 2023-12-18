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
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Stringable;
use Illuminate\View\View;

class MediaImageController extends Controller
{
  public int $maxFiles=100;
     /**
     * Display a listing of the resource.
     */
    public function index() 
    {
      //test
       /*
      $now = Carbon::now();
      $now=  $now->format('d-m-Y');
      $path='media';
   
      $directories = Storage::allDirectories( $path);
    $c=  count($directories);
 
    $c= $this->foldersCount($path);
return dd(  File::directories($path)) ;
    ///  $now->format('H:i:s');
         */
      //end test
     
       $List = DB::table("media_images")->paginate(24);
 
        return view("admin.media.show", ["images" => $List]);
    }
    public function search(Request $text)
    {
       $searchtxt=$text['text'];
       if( $searchtxt==""){
  $List = DB::table("media_images")->get();
       }else{
        $List = DB::table("media_images")->where('title','like','%'.$searchtxt.'%')
        ->orWhere('caption','like','%'.$searchtxt.'%')
        ->orWhere('desc','like','%'.$searchtxt.'%')
        ->orWhere('name','like','%'.$searchtxt.'%')->get();
       }
  
        //$List = DB::table("media_images")->get();
        //return dd($List);
        return view("admin.media.search", ["images" => $List]);
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
     $path='media';
     $separator='/';
       // $user->photo ="image.jpg";   
    
        //save photo
        if($request->hasFile('photo')){
            $imagemodel->save();
            $image_tmp=$request->file('photo');
            if($image_tmp->isValid()){
               $dc= $this->foldersCount($path);
               $folderpath="";
               if($dc==0){
                $dirname=  $separator."1";
              $folderpath=$path.$dirname;
 File::makeDirectory($folderpath, 0777, true, true); 
               }
               else
               {
                //check files count in  last folder
$folderpath=$path.$separator.$dc;
// $folderpath=$path.'\\'.$dc;
$fc=$this->filesCount($folderpath);
if($fc>=$this->maxFiles){
  //create new folder
  $newFolder=$dc+1;
  $folderpath=$path.$separator.$newFolder;
  File::makeDirectory($folderpath, 0777, true, true); 

} 
               }

              //Get image Extension
              $extension=$image_tmp->getClientOriginalExtension();
              //Generate new Image Name
              //Hash::make($request->password),
              $now = Carbon::now();
              $imageName=rand(10000,99999).$imagemodel->id.'.'.$extension;
              
              if(!File::isDirectory($folderpath)){
                  File::makeDirectory( $folderpath, 0777, true, true); 
              }  
             $imagePath= $folderpath.$separator.$imageName;   
              //Upload the Image
              Image::make($image_tmp)->save($imagePath);
              $imagemodel->name = $imageName;
              $imagemodel->url=$imagePath;
              $imagemodel->extention=  $extension;
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
      $imagemodel= DB::table('media_images')->find($id);
      $imagemodel->url=url($imagemodel->url);
      return response()->json($imagemodel);
      //
 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMediaImageRequest $request,$id)
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
  $imagemodel =DB::table('media_images')->find($id);
      //  return $formdata['title'];
      //  $imagemodel->name = $formdata['name'];
        // $imagemodel->title = $formdata['title'];
        // $imagemodel->caption = $formdata['caption'];
        // $imagemodel->desc = $formdata['desc'];
        MediaImage::find($id)->update([
          "title" => $formdata["title"],
          "caption" => $formdata["caption"],
          "desc" => $formdata["desc"],         
      ]);
     
        //save photo
        if($request->hasFile('photo')){    
         // return 1;       
            $image_tmp=$request->file('photo');
            if($image_tmp->isValid())
            {           
             
                $imagePath= $imagemodel->url;
                $after = Str::afterLast($imagePath, '.');
                
 
                if(File::exists($imagePath)){
                  File::delete($imagePath);
                }
 
              //Get image Extension
              $extension=$image_tmp->getClientOriginalExtension();
              $newPath = Str::replaceLast($imagemodel->extention, $extension, $imagePath);
              $newname = Str::replaceLast($imagemodel->extention, $extension, $imagemodel->name);
              // $imagemodel->extention=  $extension;

              //Generate new Image Name
              //Hash::make($request->password),
           
         
              //Upload the Image
              Image::make($image_tmp)->save($newPath);
              // $imagemodel->name = $newname ;
              // $imagemodel->url= $newPath;
              MediaImage::find($id)->update([
                "extention" => $extension, 
                "name" =>$newname ,
                "url" => $newPath,
                      
            ]);
              
            }
            
          }

        //  $imagemodel->save();
       //  $user->id;
      //   return redirect()->back()->with('success_message','user has been Added!');
         return response()->json('Image has been updated!');
    } 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
      //return $id;
      $imagemodel= MediaImage::find($id);
      //delete photo
  
    if (!empty($imagemodel->url)){
      $imgpath= $imagemodel->url;
      if(File::exists($imgpath)){
        File::delete($imgpath);
      }
    }
      if (!($imagemodel === null)) {
        MediaImage::find($id)->delete();
      }
      return response()->json('Image has been deleted!');
    // return  $this->index();
     //   return redirect()->route('users.index');
    }
    public function filesCount(string $path)
    {
$files = File::files($path);

$countFiles = 0;  
if ($files !== false) {
    $countFiles = count($files);
}   
return $countFiles;
  
    }
    public function foldersCount(string $path)
    {
$files = File::directories($path);

$countFiles = 0;  
if ($files !== false) {
    $countFiles = count($files);
}   
return $countFiles;
  
    }
    
}
