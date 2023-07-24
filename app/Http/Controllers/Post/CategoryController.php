<?php

namespace App\Http\Controllers\Post;
use App\Models\Post\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;
use App\Http\Requests\Admin\Category\StoreCategoryRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
class CategoryController extends Controller
{
    public function index()
    {
        //

        $List=DB::table('categories') ->get();
  
   return view('admin.category.show',['categories' => $List]); 
    }
    public function sort()
    {
        //

        $List=DB::table('categories')->where('parent_id',0) ->get();
  
   return view('admin.category.sort',['categories' => $List]); 
    }

    public function updatesort(Request $request,$itemid)
    {
        //
      //  $data = json_decode($request->getContent(),true);
      $data= json_decode($request->getContent(), true);
    //  $data =   $request->json()->all();
      $collection=collect($data);
    //$res=  $collection->first()['id'];
    foreach($collection as $row){
     if(isset($row['children']))
     {
      $res=$row['id'];
      } 
    }
   
     
       //  $ss=collect($data)->implode(',');
       // $data=Str::of($data)->toHtmlString();
     //   $List=DB::table('categories') ->get();
  //$js= response()->json($data);
  return  $res;
  // return response()->json(['success' => true, 'message' => $js  ]);
    }

    public function getsortbyid($itemid)
    { 
//$categoryTree=new Collection();
//$list=$this->getsons($itemid);
//$this->getsonstree($list);
$List=DB::table('categories')->select('id','title','parent_id')->get();
$categories=collect($List);
$categoryTree = $this->buildCategoryTree($List,$itemid);
//$list= $List=DB::table('categories')->where('parent_id',$itemid)->select('id','title','parent_id')->get();
 // return  $itemid;
  return response()->json($categoryTree);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      
      $List=DB::table('categories') ->select('id','title','desc','parent_id')->get();
     
      $parents= $this->categorytree( $List);
       // return view('admin.user.adduser'); 
          return view('admin.category.add',['categories' => $parents]); 
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
if(  $formdata['slug']=="" ||empty($formdata['slug'])){
$tmpslug=$formdata['title'];
}else{
  $tmpslug=$formdata['slug'];
}

        $object = new Category;
        $object->title = $formdata['title'];
        $object->desc = $formdata['desc'];
        $object->slug =Str::slug($tmpslug);
        $object->parent_id = $formdata['parent_id'];
        $object->sequence =0;   
        $object->save();
        //save photo
      
       //  $user->id;
         return redirect()->back()->with('success_message','Category has been Added!');
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
        $item= DB::table('categories')->find($itemid);
        $List=DB::table('categories') ->select('id','title','desc','parent_id')->get();
     
        $parents= $this->categorytree( $List);
        //
 return view('admin.category.edit',['category' => $item,'categories' => $parents]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request,$itemid)
    {
        $formdata=$request->all();
        //validate
        
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

 
//update photo
if(  $formdata['slug']=="" ||empty($formdata['slug'])){
  $tmpslug=$formdata['title'];
  }else{
    $tmpslug=$formdata['slug'];
  }
      Category::find($itemid)->update( [
'title'=>$formdata['title'],
'slug'=>Str::slug($tmpslug),
'desc' => $formdata['desc'],
'parent_id' => $formdata['parent_id'],
//'sequence' => $formdata['sequence'], 
]);
     
      return redirect()->back()->with('success_message','Category has been Updated!');
    }
  }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($itemid)
    {
      $item= Category::find($itemid);
      //delete photo   
      if (!( $item === null)) {
        //$sons=$this->getsons($item->id);
       $this->updateParentofSons($item->id,$item->parent_id);        
        Category::find($itemid)->delete();
      }
       return redirect()->route('cpanel.category.view');
    // return  $this->index();
     //   return redirect()->route('users.index');
    }
    
    public function __construct()
      
    {$this->parentcollection=new Collection();}
 
 
protected $parentcollection ;
 
    public function categorytree( $List) 
    {
      $firstrow=  $List->first();
      
      $totalCollection = collect();   
    
      foreach( $List as $category){  
        $this-> parentcollection=new Collection(); 
        //add current category as first element
        $this-> parentcollection->push($category);
        $this-> getparents($category->parent_id,$List); 
        
        $totalCollection->push($this->parentcollection->reverse()->values());

      }
      return $totalCollection;
    }

    public function getparents( $categoryId,$List) {    
      if($categoryId!=0 && $categoryId!=null )
      {
        $parentrow=  $List ->where('id', $categoryId)->first();
        $this-> parentcollection->push($parentrow);
        $this->getparents($parentrow->parent_id,$List );
    //  return $this->getparents($parentrow->parent_id,$List, $newcollection);
      //  return  $newcollection;
      }
 
    }
    public function getsons( $categoryId) {    
      if($categoryId!=null )
      {
        $sons=  DB::table('categories')->select('id','title','parent_id')->where('parent_id', $categoryId)->get();
        return $sons;
      } else 
      {return null;}
    }
    public function getsonstree($parentList) {    
      $soncollection=new Collection();
      if($parentList!=null )
      {
        $this->parentcollection=new Collection();
        $this->parentcollection=collect($parentList);
       
      foreach($parentList as $parent){
        $soncollection= $this->getsons($parent->id);
        $this->parentcollection->where('id',$parent->id)->transform(function ($item) use ($soncollection) {
       //   $item['children']->push($soncollection);  
       //$item->title="xx";
       $item->children=$soncollection;
          return $item;
      });  
        }
        
        return $this->parentcollection;
      } else 
      {return null;}
    }
    public function getsonstreeTmp($parentId) {
      $sonList  = $this->getsons($parentId);
  
      $soncollection=new Collection();
      if($sonList!=null )
      {
        $this->parentcollection=new Collection();
        $this->parentcollection=collect($sonList);
       
      foreach($sonList as $parent){
        $soncollection= $this->getsons($parent->id);
        $this->parentcollection->where('id',$parent->id)->transform(function ($item) use ($soncollection) {
       //   $item['children']->push($soncollection);  
       //$item->title="xx";
       $item->children=$soncollection;
          return $item;
      });  
        }
        
        return $this->parentcollection;
      } else 
      {return null;}
    }
    public function loopofSons($parentList) {  
      foreach($parentList as $parent){
        $soncollection= $this->getsons($parent->id);
        $this->parentcollection->where('id',$parent->id)->transform(function ($item) use ($soncollection) {
       //   $item['children']->push($soncollection);  
       //$item->title="xx";
       $item->children=$soncollection;
          return $item;
      });  
        }
    }
    public function updateParentofSons($categoryId,$newParentId) {    
      if($categoryId!=null )
      {
        $sons=DB::table('categories')->where('parent_id', $categoryId)->update([       
          'parent_id' => $newParentId,       
          ]);
        return true;
      } else 
      {return false;}
    }
    
function buildCategoryTree($categories, $parentId = 0)
{
    $result = new Collection;

    foreach ($categories as $category) {
        if ($category->parent_id == $parentId) {
            $children = $this->buildCategoryTree($categories, $category->id);

            if ($children->isNotEmpty()) {
                $category->children = $children;
            }

            $result->push($category);
        }
    }

    return $result;
}
}
