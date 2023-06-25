<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Routing\Router;
use App\Http\Controllers\Controller;
use App\Models\Admin\User;
use Illuminate\Http\Request;
 use Illuminate\Support\Facades\DB;
use Image;
 
 use File;
 use Illuminate\Http\RedirectResponse;
 use Illuminate\Support\Facades\Validator;
 use Illuminate\Routing\Redirector;
use App\Http\Requests\Admin\UpdateUserRequest;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $users=DB::table('users')->get();
        return view('admin.user.showusers',['users' => $users]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.user.adduser'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) 
    {
 //try{
  //  try{
   // $x=5/0;
    // validate
   $formdata=$request->all();  
   $validator = Validator::make($formdata,
   $this->addRules(),
   $this->addMessages()
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
        $user = new User;
        $user->name = $formdata['name'];
        $user->first_name = $formdata['first_name'];
        $user->last_name = $formdata['last_name'];
        $user->email = $formdata['email'];
        $user->password =bcrypt($formdata['password']);
        $user->address = $formdata['address'];
        $user->country = $formdata['country'];
        $user->city = $formdata['city'];
        $user->mobile = $formdata['mobile'];
        $user->phone = $formdata['phone'];
        $user->role = $formdata['role'];
       // $user->photo ="image.jpg";   
        $user->save();
        //save photo
        if($request->hasFile('photo')){
            $image_tmp=$request->file('photo');
            if($image_tmp->isValid()){
              //Get image Extension
              $extension=$image_tmp->getClientOriginalExtension();
              //Generate new Image Name
              //Hash::make($request->password),
              $imageName=rand(10000,99999).$user->id.'.'.$extension;
              $path='admin\images\users';
              if(!File::isDirectory($path)){
                  File::makeDirectory($path, 0777, true, true); 
              }  
             $imagePath=$path.'\\'.$imageName;   
              //Upload the Image
              Image::make($image_tmp)->save($imagePath);
              $user->photo = $imageName;
              $user->save();
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
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($userid)
    {
        $user= DB::table('users')->find($userid);

        //
 return view('admin.user.edituser',['user' => $user]); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request,$userid)
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

        $current_photo=DB::table('users')->find($userid)->photo;
//update photo
        if($request->hasFile('photo')){
            $image_tmp=$request->file('photo');
            if($image_tmp->isValid()){
              //Get image Extension
              $extension=$image_tmp->getClientOriginalExtension();
              //Generate new Image Name
              //Hash::make($request->password),
              if (empty($current_photo)){
                //first time
              $imageName=rand(10000,99999).$user->id.'.'.$extension;
              }else{
                //same old name
                $imageName= $current_photo;
              }

              $path='admin\images\users';
              if(!File::isDirectory($path)){
                  File::makeDirectory($path, 0777, true, true); 
              }  
             $imagePath=$path.'\\'.$imageName;   
              //Upload the Image
              Image::make($image_tmp)->save($imagePath);
             
            }          
            }else{
              $imageName="";
            }

      User::find($userid)->update( [
'name'=>$formdata['name'],
'first_name' => $formdata['first_name'],
'last_name' => $formdata['last_name'],
'email' => $formdata['email'],
'address' => $formdata['address'],
'country' => $formdata['country'],
'city' => $formdata['city'],
'mobile' => $formdata['mobile'],
'phone' => $formdata['phone'],
'role' => $formdata['role'],
'photo' => $imageName,
]);
      //  return    $formdata;
      return redirect()->back()->with('success_message','user has been Updated!');
    }
  }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($userid)
    {
      $user= User::find($userid);
      //delete photo
  
    if (!empty($user->photo)){
      $imgpath= 'admin\images\users\\'.$user->photo;
      if(File::exists($imgpath)){
        File::delete($imgpath);
      }
    }
      if (!($user === null)) {
    User::find($userid)->delete();
      }
       return redirect()->route('cpanel.users.view');
    // return  $this->index();
     //   return redirect()->route('users.index');
    }

    public function addRules()
    {
      $maxlength=500;
      $minMobileLength=10;
      $maxMobileLength=15;
      return[
        'name'=>'required|alpha_num:ascii|unique:users,name',
      
        'email'=>'required|email|unique:users,email',
        'first_name'=>'nullable|alpha',    
        'last_name'=>'nullable|alpha',
        'password'=>'required',
        'inputPasswordConfirm' => 'same:password',
        'address'=>'nullable|between:0,'.$maxlength,
        'country'=>'required',
        'city'=>'required|alpha_num',
        'mobile'=>'nullable|numeric|digits_between:'. $minMobileLength.','.$maxMobileLength,
        
        'phone'=>'nullable|numeric|digits_between:'. $minMobileLength.','.$maxMobileLength,
        'role'=>'required',         
   
      ];   
    
    }
    public function addMessages()
    {
      $maxlength=500;
      $minMobileLength=10;
      $maxMobileLength=15;
      return[
        'name.required'=>'The name is required',
        'name.alpha_num'=>'The name format must be alphabet',
        'name.unique'=>'The name is already exist',
        'email.required'=>'Email is required',
        'email.email'=>'Valid Email  is required',
        'email.unique'=>'The Email is already exist',
        'inputPasswordConfirm' => 'confirm must match passowrd',
        'first_name.alpha'=>'first name format must be alphabet',
        'last_name.alpha'=>'last name format must be alphabet',
        'password.required'=>'password is required',
     
        'address.between'=>'address charachters must be les than '.$maxlength,
        'country.required'=>'country is required',
        'city.required'=>'city is required',
        'mobile.numeric'=>'mobile must contain only numbers',
        'mobile.digits_between'=>'mobile number must be between '. $minMobileLength.' and '.$maxMobileLength,
      
        'phone.numeric'=>'phone must contain only numbers',
        'phone.digits_between'=>'phone  number must be between '. $minMobileLength.' and '.$maxMobileLength,
        'role.required'=>'role is required',
       ];
       
    }
}
