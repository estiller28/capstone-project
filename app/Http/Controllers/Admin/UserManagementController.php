<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserManagementController extends Controller
{
    public function index (){
        $users = User::with('roles')
            ->select('id', 'name', 'email')
            ->where('barangay_id', auth()->user()->barangay_id)
            ->orderBy('id', 'asc')->get();

        return view('admin.user.users_list', compact('users'));
    }
}
