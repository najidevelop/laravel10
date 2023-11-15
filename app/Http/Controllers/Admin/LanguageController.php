<?php

namespace App\Http\Controllers\Language;

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
       
        $List=DB::table('languages')->get();
        /*
foreach($List as $row){
$t=$row->category->title;
}
*/
        return view("admin.language.show", ["languages" => $List]);
    }

    public function search(Request $text)
    {
       $searchtxt=$text['text'];
     
       if( $searchtxt==""){
        $List=DB::table('languages')->get();
       }else{
        $List=DB::table('languages')->where('title','like','%'.$searchtxt.'%')
       // ->orWhere('caption','like','%'.$searchtxt.'%')
      //  ->orWhere('desc','like','%'.$searchtxt.'%')
        ->orWhere('content','like','%'.$searchtxt.'%')->get();
       }

  
        //$List = DB::table("media_images")->get();
        //return dd($List);
        return view("admin.language.search", ["posts" => $List]);
    }
    public function sort()
    {
        //
        $catCont=new CategoryController();
        $parents =  $catCont->selectList();
        return view("admin.post.sort", ["categories" => $parents ]);
    }

    public function updatesort(Request $request, $itemid)
    {
        //
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
        $this->updatetreesequence($collection, 0, (int) $itemid);
        return "Saved";
        // return response()->json(['success' => true, 'message' => $js  ]);
    }
    public function getsortbyid($itemid)
    {
        $List = DB::table("posts")->where("status",1)
        ->where("category_id",$itemid)
            ->select("id", "title", "category_id", "sequence")
            ->orderBy("category_id", "asc")
            ->orderBy("sequence", "asc")
            ->get();
        $posts = collect($List);
     //   $categoryTree = $this->buildCategoryTree($List, $itemid);
        //$list= $List=DB::table('posts')->where('parent_id',$itemid)->select('id','title','parent_id')->get();
        // return  $itemid;
        return response()->json($posts);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
$catCont=new CategoryController();
        $parents =  $catCont->selectList();

        // return view('admin.user.adduser');
        return view("admin.post.add", ["categories" => $parents]);
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
        if ($formdata["slug"] == "" || empty($formdata["slug"])) {
            $tmpslug = $formdata["title"];
        } else {
            $tmpslug = $formdata["slug"];
        }
        $formdata["slug"]=$tmpslug;
        // return dd($formdata);
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
            if ($formdata["slug"] == "" || empty($formdata["slug"])) {
                $tmpslug = $formdata["title"];
            } else {
                $tmpslug = $formdata["slug"];
            }

            $object = new Language();
            $object->title = $formdata["title"];
            $object->content = $formdata["content"];
            $object->slug = Str::slug($tmpslug);
            $object->category_id = $formdata["parent_id"];
            $object->sequence = 0;
            $object->status = isset($formdata["status"]) ? 1 : 0;
            $object->createuserid = Session::get("loguser")->id;
            $object->updateuserid = Session::get("loguser")->id;
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
        $item = DB::table("posts")->find($itemid);
        $catCont=new CategoryController();
        $parents =  $catCont->selectList();
        //
        return view("admin.post.edit", [
            "post" => $item,
            "categories" => $parents,
        ]);
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
            //update photo
            if ($formdata["slug"] == "" || empty($formdata["slug"])) {
                $tmpslug = $formdata["title"];
            } else {
                $tmpslug = $formdata["slug"];
            }
          
            Language::find($itemid)->update([
                "title" => $formdata["title"],
                "slug" => Str::slug($tmpslug),
                "content" => $formdata["content"],
                "category_id" => $formdata["parent_id"],
                //'sequence' => $formdata['sequence'],
                "status" => isset($formdata["status"]) ? 1 : 0,
                "updateuserid" => Session::get("loguser")->id,
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
        return redirect()->route("cpanel.post.view");
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
   

 
  
  
    public function updateParentofSons($categoryId, $newParentId)
    {
        if ($categoryId != null) {
            $sons = DB::table("posts")
                ->where("parent_id", $categoryId)
                ->update([
                    "parent_id" => $newParentId,
                ]);
            return true;
        } else {
            return false;
        }
    }

    function buildCategoryTree($posts, $parentId = 0)
    {
        $result = new Collection();

        foreach ($posts as $category) {
            if ($category->parent_id == $parentId) {
                $children = $this->buildCategoryTree(
                    $posts,
                    $category->id
                );

                if ($children->isNotEmpty()) {
                    $category->children = $children;
                }

                $result->push($category);
            }
        }

        return $result;
    }

    function getCategorysons($posts, $parentId)
    {
        foreach ($posts as $category) {
            if ($category->parent_id == $parentId) {
                $this->sonscollection->push($category->id);
                $this->getCategorysons($posts, $category->id);
            }
        }
    }
    public function updatetreesequence($item, int $i, $parentid)
    {

        foreach ($item as $itemrow) {
            Language::find($itemrow["id"])->update([
                "parent_id" => $parentid,
                "sequence" => $i,
            ]);
            $i++;
            /*
            if (
                isset($itemrow["children"]) &&
                count($itemrow["children"]) > 0
            ) {
                $this->updatetreesequence(
                    $itemrow["children"],
                    $i,
                    $itemrow["id"]
                );
            }
            */
        }
    }
    public function getsonsid($itemid)
    {
        $this->sonscollection = new Collection();
        $List = DB::table("posts")
            ->select("id", "parent_id")
            ->get();
        $categoriesAll = collect($List);
        $this->getCategorysons($categoriesAll, $itemid);
    }
}
