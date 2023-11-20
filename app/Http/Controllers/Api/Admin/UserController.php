<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\User;

 use Illuminate\Support\Facades\DB;
 use App\Models\Admin\ProgramDetails;
//use Image;
 
 //use File;
 use Carbon\Carbon;
class UserController extends Controller
{
    //
    public function index()
    {
        //
        $users=DB::table('users')->count();

        return $users;
    }
    public function create()
    {
        //
        $users=DB::table('users')->get();
        return response()->json($users);
       // return json_encode($);
    }
    public function activatebyserial(Request $request){

        $programdetails = $request->programdetails; 
        //
      //  $rawJson = "{ post: { text: 'my text' } }";
        $decodedObject = json_decode($programdetails, true);
       // $innerPost = $decodedAsArray['post'];
        $progDetail = new ProgramDetails();
$progDetail->forceFill($decodedObject);
$progDetail['serial']="ascascefw22222";
$now=Carbon::now();
$progDetail['activateDate']=$now->toDateTimeString();
//$progDetail['expireDate']=$now;
$progDetail['expireDate']=$now->addYears(2);


        //
        return response()->json($progDetail);
   
    }
}
