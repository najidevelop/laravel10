<?php

namespace App\Http\Controllers\Post;
use App\Models\Admin\Language;
use App\Models\Post\Category;
use App\Http\Controllers\Controller;
use App\Models\Post\CategoriesTrans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use App\Http\Requests\Admin\Category\StoreCategoryTransRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Model;
class CategoryController extends Controller
{
    public function index()
    {
        //

        $List = DB::table("categories")->get();

        return view("admin.category.show", ["categories" => $List]);
    }
    public function sort()
    {
        //
        $List = DB::table("categories")
            ->where("parent_id", 0)
            ->get();
        return view("admin.category.sort", ["categories" => $List]);
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
        $List = DB::table("categories")->where("status",1)
            ->select("id", "title", "parent_id", "sequence")
            ->orderBy("parent_id", "asc")
            ->orderBy("sequence", "asc")
            ->get();
        $categories = collect($List);
        $categoryTree = $this->buildCategoryTree($List, $itemid);
        //$list= $List=DB::table('categories')->where('parent_id',$itemid)->select('id','title','parent_id')->get();
        // return  $itemid;
        return response()->json($categoryTree);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $List = DB::table("categories")
            ->select("id", "title", "desc", "parent_id")
            ->get();

        $parents = $this->categorytree($List);
        // return view('admin.user.adduser');
        return view("admin.category.add", ["categories" => $parents]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        //try{
        //  try{
        // $x=5/0;
        // validate
        $formdata = $request->all();
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

            $object = new Category();
            $object->title = $formdata["title"];
            $object->desc = $formdata["desc"];
            $object->slug = Str::slug($tmpslug);
            $object->parent_id = $formdata["parent_id"];
            $object->sequence = 0;
            $object->status = isset($formdata["status"]) ? 1 : 0;
            $object->createuserid = Session::get("loguser")->id;
            $object->updateuserid = Session::get("loguser")->id;
            $object->save();
            //save photo

            //  $user->id;
            return redirect()
                ->back()
                ->with("success_message", "Category has been Added!");
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
        $item = DB::table("categories")->find($itemid);
        $List = DB::table("categories")
            ->select("id", "title", "desc", "parent_id")
            ->get();

        $parents = $this->categorytree($List);
        //
        return view("admin.category.edit", [
            "category" => $item,
            "categories" => $parents,
        ]);
    }
    public function trans($itemid,$lang)
    {
     //  $item = DB::table("categories")->find($itemid);
     
       $List =CategoriesTrans:: with("category") ->with("language")->where("main_id", $itemid)
      
    // ->whereHas('language',function($q)use ($lang){
    //     $q->where("code",$lang);
    //   })
          -> get();
        
       $item= $List->where("language.code",$lang)->first();
       if( $item=== null){
        $item = new CategoriesTrans();      
    $item->title="";
    $item->desc="";
    $item->id=0;
    $item->main_id=0;
    $item->lang_id=0;
   
}
       
      
       $rList = DB::table("categories")
       ->select("id", "title", "desc", "parent_id")
       ->get();

   $parents = $this->categorytree($rList);
      //  return   $List  ;
    //   return  $item;
        return view("admin.category.trans", [
            "category_trans" =>  $item,
            "categories" => $parents,
            "main_id" => $itemid,
            "lang" =>  $lang,
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, $itemid)
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
            $this->getsonsid($itemid);
            $status = isset($formdata["status"]) ? 1 : 0;
            Category::whereIn("id", $this->sonscollection)->update([
                "status" => $status,
            ]);

            Category::find($itemid)->update([
                "title" => $formdata["title"],
                "slug" => Str::slug($tmpslug),
                "desc" => $formdata["desc"],
                "parent_id" => $formdata["parent_id"],
                //'sequence' => $formdata['sequence'],
                "status" => isset($formdata["status"]) ? 1 : 0,
                "updateuserid" => Session::get("loguser")->id,
            ]);
            return redirect()
                ->back()
                ->with("success_message", "Category has been Updated!");
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($itemid)
    {
        $item = Category::find($itemid);
        //delete photo
        if (!($item === null)) {
            //$sons=$this->getsons($item->id);
            $this->updateParentofSons($item->id, $item->parent_id);
            Category::find($itemid)->delete();
        }
        return redirect()->route("cpanel.category.view");
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
    public function categorytree($List)
    {
        $firstrow = $List->first();

        $totalCollection = collect();

        foreach ($List as $category) {
            $this->parentcollection = new Collection();
            //add current category as first element
            $this->parentcollection->push($category);
            $this->getparents($category->parent_id, $List);

            $totalCollection->push(
                $this->parentcollection->reverse()->values()
            );
        }
        return $totalCollection;
    }

    public function getparents($categoryId, $List)
    {
        if ($categoryId != 0 && $categoryId != null) {
            $parentrow = $List->where("id", $categoryId)->first();
            $this->parentcollection->push($parentrow);
            $this->getparents($parentrow->parent_id, $List);
            //  return $this->getparents($parentrow->parent_id,$List, $newcollection);
            //  return  $newcollection;
        }
    }
    public function getsons($categoryId)
    {
        if ($categoryId != null) {
            $sons = DB::table("categories")
                ->select("id", "title", "parent_id")
                ->where("parent_id", $categoryId)
                ->get();
            return $sons;
        } else {
            return null;
        }
    }
    public function getsonstree($parentList)
    {
        $soncollection = new Collection();
        if ($parentList != null) {
            $this->parentcollection = new Collection();
            $this->parentcollection = collect($parentList);

            foreach ($parentList as $parent) {
                $soncollection = $this->getsons($parent->id);
                //update item in collection
                $this->parentcollection
                    ->where("id", $parent->id)
                    ->transform(function ($item) use ($soncollection) {
                        //   $item['children']->push($soncollection);
                        //$item->title="xx";
                        $item->children = $soncollection;
                        return $item;
                    });
            }

            return $this->parentcollection;
        } else {
            return null;
        }
    }

    public function updateParentofSons($categoryId, $newParentId)
    {
        if ($categoryId != null) {
            $sons = DB::table("categories")
                ->where("parent_id", $categoryId)
                ->update([
                    "parent_id" => $newParentId,
                ]);
            return true;
        } else {
            return false;
        }
    }

    function buildCategoryTree($categories, $parentId = 0)
    {
        $result = new Collection();

        foreach ($categories as $category) {
            if ($category->parent_id == $parentId) {
                $children = $this->buildCategoryTree(
                    $categories,
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

    function getCategorysons($categories, $parentId)
    {
        foreach ($categories as $category) {
            if ($category->parent_id == $parentId) {
                $this->sonscollection->push($category->id);
                $this->getCategorysons($categories, $category->id);
            }
        }
    }
    public function updatetreesequence($item, int $i, $parentid)
    {
        foreach ($item as $itemrow) {
            Category::find($itemrow["id"])->update([
                "parent_id" => $parentid,
                "sequence" => $i,
            ]);
            $i++;
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
        }
    }
    public function getsonsid($itemid)
    {
        $this->sonscollection = new Collection();
        $List = DB::table("categories")
            ->select("id", "parent_id")
            ->get();
        $categoriesAll = collect($List);
        $this->getCategorysons($categoriesAll, $itemid);
    }
    public function selectList()
    {
        $List = DB::table("categories")
            ->select("id", "title", "desc", "parent_id")
            ->get();

        $parents = $this->categorytree($List);
        // return view('admin.user.adduser');
        return  $parents;
    }

    public function storeupdatetrans(StoreCategoryTransRequest $request, $itemid,$langcode)
    {
        //try{
        //  try{
        // $x=5/0;
        // validate
        $formdata = $request->all();
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
            //find lang id by lang code
            $langobj=Language::where("code",$langcode)->first();
            //find trans
$dbobject=  CategoriesTrans::where("main_id",$itemid)->where("lang_id",$langobj->id)->first();
if($dbobject===null){
// new add
    $object = new CategoriesTrans();
    $object->title = $formdata["title"];
    $object->desc = $formdata["desc"];
    $object->main_id = $itemid;
    $object->lang_id = $langobj->id;
 //   $object->slug = Str::slug($tmpslug);
   // $object->parent_id = $formdata["parent_id"];
 //   $object->sequence = 0;
//    $object->status = isset($formdata["status"]) ? 1 : 0;
  
    $object->save();
}else{
    //update
    CategoriesTrans::find($dbobject->id)->update([
        "title" => $formdata["title"],
        
        "desc" => $formdata["desc"],
        "main_id" =>$itemid ,
        "lang_id" =>  $langobj->id,
    ]);
}
            //save photo

            //  $user->id;
            return redirect()
                ->back()
                ->with("success_message", "Category has been Added!");
        }
    }
}
