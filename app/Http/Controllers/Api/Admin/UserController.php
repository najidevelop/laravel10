<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\User;

 use Illuminate\Support\Facades\DB;
use Image;
 
 use File;
class UserController extends Controller
{
    //
    public function index()
    {
        //
        $users=DB::table('users')->count();
        return $users;
    }
}
