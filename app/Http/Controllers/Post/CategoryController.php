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
class CategoryController extends Controller
{
    public function index()
    {
        //

        $List=DB::table('categories') ->get();
  
   return view('admin.category.show',['categories' => $List]); 
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


        $object = new Category;
        $object->title = $formdata['title'];
        $object->desc = $formdata['desc'];
       
        $object->parent_id = $formdata['parent_id'];
        $object->sequence =0;   
        $object->save();
        //save photo
      
       //  $user->id;
         return redirect()->back()->with('success_message','user has been Added!');
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

        //
 return view('admin.category.edit',['category' => $item]); 
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
        
      Category::find($itemid)->update( [
'name'=>$formdata['title'],
'desc' => $formdata['desc'],
'parent_id' => $formdata['parent_id'],
'sequence' => $formdata['sequence'], 
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
      if($categoryId!=0 && $categoryId!=null )
      {
        $sons=  DB::table('categories')->where('parent_id', $categoryId)->get();
        return $sons;
      } else 
      {return null;}
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
}
