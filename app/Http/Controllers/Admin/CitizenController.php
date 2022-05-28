<?php

namespace App\Http\Controllers\Admin;
use App\Exports\CitizenImportTemplate;
use App\Http\Controllers\Controller;
use App\Models\Events;
use App\Models\Purok;
use App\Models\Visitor;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Citizen;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CitizensImport;
use App\Exports\CitizensExport;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CitizenController extends Controller
{
    public $notification;

    public function Auth(){
        $user = Auth::user()->id;
        return $user;
    }
    public function barangay(){
        $barangay = Auth::user()->barangay_id;
        return $barangay;
    }

    public function dashboard(){

        $citizens = Citizen::where('barangay_id',$this->barangay())->with('barangay')->count();
        $events = Events::where('barangay_id', $this->barangay())->count();
        $visitor = Visitor::where('barangay_id',$this->barangay())->pluck('id')->count();

        return view('admin.dashboard', compact( 'citizens', 'events', 'visitor'));
    }
    public function index(){
        $citizens = Citizen::where('barangay_id', $this->barangay())
               ->with('barangay', 'purok')->get();
        $deleted_citizens = Citizen::onlyTrashed()->latest()->paginate(5);

        return view('admin.citizens.citizens_list', compact('citizens','deleted_citizens'));
    }



    public function addCitizenView(){

        $purok = Purok::where('barangay_id', $this->barangay())->pluck('purok_name', 'id' );
        return view('admin.citizens.citizens_create', compact('purok'));
    }

    public function addCitizen(Request $request){
        $request->validate([
            'first_name' => 'required|unique:citizens|max:255',
            'middle_name' => 'max:255|nullable',
            'last_name' => 'required|max:255',
        ]);

        $citizen_data = ([
            'first_name'    => $request->first_name,
            'middle_name'   => $request->middle_name,
            'last_name'     => $request->last_name,
            'barangay_id'   => $this->barangay(),
            'purok_id'      => $request->purok,
            'created_at'    => Carbon::now(),
        ]);

        Citizen::create($citizen_data);

        $notification = ([
            'message' => 'Citizen inserted successfully',
            'alert-type' => 'success',
        ]);

        return redirect()->route('citizens')->with($notification);
    }

    public function edit($id){

        $citizen = Citizen::findOrFail($id);

        $puroks= Purok::where('barangay_id', $this->barangay())->get();
        $permissions = Permission::all();

        $user = User::with('permissions')->where('id', $citizen->user_id)->first();
        if($user){
            $userPermissions =  $user->getAllPermissions();
            return view('admin.citizens.citizens_edit', compact('citizen', 'userPermissions', 'permissions', 'user', 'puroks'));
        }


        $puroks= Purok::where('barangay_id', $this->barangay())->get();
        return view('admin.citizens.citizens_edit', compact('citizen',  'user', 'puroks', 'permissions'));

    }
    public function createAdmin(Request $request, $id){
//        $request->validate([
//            'email'         => ['required', 'string', 'email', 'max:255',],
//            'password' => 'required|min:8|confirmed',
//            'password_confirmation' => 'required|min:8'
//
//        ]);
//        $user = User::find($id);
//
//        if($user->hasAnyPermission(Permission::all())){
//            $user
//        }else{
//            User::create([
//                'email' => $user
//            ]);
//        }






    }

    public function update(Request $request, $id){

        Citizen::findOrfail($id)->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'purok_id' => $request->purok,
            'updated_at' => Carbon::now(),
        ]);
        $this->notification = ([
            'message' => 'Citizen updated successfully',
            'alert-type' => 'info',
        ]);

        return redirect()->route ('citizens')->with($this->notification);
    }

    public function delete($id){
        Citizen::findorfail($id)->delete();

        $notification = [
            'message' => 'Citizen archived successfully',
            'alert-type' => 'warning',
        ];
        return redirect()->back()->with($notification);
    }

    public function view($id){

        $citizen = Citizen::findOrfail($id);



        return $role;

        return view('admin.citizens.citizens_view', compact('citizen'));
    }

    public function restore($id){
        Citizen::withTrashed()->find($id)->restore();

        $notification = ([
            'message' => 'Citizen restored successfully',
            'alert-type' => 'success',
        ]);
        return redirect()->back()->with($notification);
    }
    public function forceDelete($id){
        Citizen::withTrashed()->findOrfail($id)->forceDelete();

        $notification = ([
            'message' => 'Citizen permanently deleted',
            'alert-type' => 'error',
        ]);

        return redirect()->back()->with($notification);

    }
    public function CitizensImport(Request $request)
    {
        $request->validate([
            'template' => 'required|mimes:xls,csv,xlsx',
        ]);
        Excel::import(new CitizensImport(), $request->file('template'));
        $notification = ([
            'message' => 'Citizen inserted successfully',
            'alert-type' => 'success',
        ]);

        return redirect()->back()->with($notification);
    }

    public function CitizensExport()
    {
        return Excel::download(new CitizensExport(), 'All-Citizens.xlsx');
    }

    public function CitizensExportTemplate(){
        return Excel::download(new CitizenImportTemplate(), 'Citizen-Import-Template.xlsx');
    }
}

