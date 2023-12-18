<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
 

use App\Models\Admin\Language;
 
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Admin\Language\UpdateLanguageRequest;
use App\Http\Requests\Admin\Language\StoreLanguageRequest;
 
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
class LanguageController extends Controller
{
    public function index()
    {
        //

        //$List = Language::table("posts")->with('user')->get();
        $List=  $this->selectList();
      
        /*
foreach($List as $row){
$t=$row->category->title;
}
*/
        return view("admin.language.show", ["languages" => $List]);
    }
    public   function langshowlist()
    {
        $List = DB::table("languages")
        ->select("id", "code", "name", "notes","sequence","status","image","htmlcode")
        ->orderBy("sequence", "asc")
        ->get();
 
    return $List;
       
    }
    public function search(Request $text)
    {
       $searchtxt=$text['text'];
     
       if( $searchtxt==""){
        $List=DB::table('languages')->get();
       }else{
        $List=DB::table('languages')->where('code','like','%'.$searchtxt.'%')
       // ->orWhere('caption','like','%'.$searchtxt.'%')
      //  ->orWhere('desc','like','%'.$searchtxt.'%')
        ->orWhere('name','like','%'.$searchtxt.'%')->get();
       }

  
        //$List = DB::table("media_images")->get();
        //return dd($List);
        return view("admin.language.search", ["languages" => $List]);
    }
    public function sort()
    {
        //
         
        $List =  $this->selectList();
        return view("admin.language.sort", ["languages" => $List ]);
    }
    public function getsort()
    {
        $List = DB::table("languages")->where("status",1)        
            ->select("id", "code", "name", "sequence")          
            ->orderBy("sequence", "asc")
            ->get();
        $languages = collect($List);   
        return response()->json($languages);
    }
    public function selectList()
    {
        $List = DB::table("languages")
            ->select("id", "code", "name", "notes","sequence","status","image","htmlcode")
            ->orderBy("sequence", "asc")
            ->get();
     
        return $List;
    }
    public function updatesort(Request $request)
    {
        //  $data = json_decode($request->getContent(),true);
        $data = json_decode($request->getContent(), true);
        //  $data =   $request->json()->all();
        $collection = collect($data);
        //$res=  $collection->first()['id'];
        /*
   $res="";
    foreach($collection as $itemrow){ 
      $res.=$itemrow['id']."-";
    
    }
   // return $res;
   */
        $this->updatetreesequence($collection, 0);
        return "Saved";
        // return response()->json(['success' => true, 'message' => $js  ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    { 
        return view("admin.language.add" );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLanguageRequest $request)
    {
        //try{
        //  try{
        // $x=5/0;
        // validate
        $formdata = $request->all();
     
        $validator = Validator::make(
            $formdata,
            $request->rules(),
            $request->messages()
        );

        if ($validator->fails()) {
            /*
    return redirect('/cpanel/users/add')
    ->withErrors($validator)
                ->withInput();
                */
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
          

            $object = new Language();
            $object->code = $formdata["code"];
            $object->name = $formdata["name"];
           
            $object->notes = $formdata["notes"];
            $object->sequence = 0;
            $object->status = isset($formdata["status"]) ? 1 : 0;
            $object->image = $formdata["image"];
            $object->htmlcode = $formdata["htmlcode"];
            
            $object->save();
            //save photo

            //  $user->id;
            return redirect()
                ->back()
                ->with("success_message", "Language has been Added!");
        }
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($itemid)
    {
        $item = DB::table("languages")->find($itemid);
    
if($item->image== null){
    $item->image="";
}
        //
        return view("admin.language.edit", ["language" => $item]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLanguageRequest $request, $itemid)
    {
        $formdata = $request->all();
        //validate

        //  return  dd($this->sonscollection);
        $validator = Validator::make(
            $formdata,
            $request->rules(),
            $request->messages()
        );
        if ($validator->fails()) {
         
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        } else {
            Language::find($itemid)->update([
                "code" => $formdata["code"],
         
                "name" => $formdata["name"],
                "notes" => $formdata["notes"],
                //'sequence' => $formdata['sequence'],
                "status" => isset($formdata["status"]) ? 1 : 0,
                 "image" => $formdata["image"],
                 "htmlcode" => $formdata["htmlcode"],
            ]);
            return redirect()
                ->back()
                ->with("success_message", "Language has been Updated!");
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($itemid)
    {
        $item = Language::find($itemid);
        //delete photo
        if (!($item === null)) {
            Language::find($itemid)->delete();
        }
        return redirect()->route("cpanel.language.view");
        // return  $this->index();
        //   return redirect()->route('users.index');
    }

    public function __construct()
    {
        $this->parentcollection = new Collection();
        $this->sonscollection = new Collection();
    }

    protected $parentcollection;
    protected $sonscollection; 
    public function updatetreesequence($item, int $i)
    {

        foreach ($item as $itemrow) {
            Language::find($itemrow["id"])->update([
              //  "parent_id" => $parentid,
                "sequence" => $i,
            ]);
            $i++;
            
        }
    }
   
}
