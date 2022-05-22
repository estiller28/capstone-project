<?php

namespace App\Http\Controllers\Admin;
use App\Exports\CitizenImportTemplate;
use App\Http\Controllers\Controller;
use App\Models\Events;
use App\Models\Purok;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Citizen;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CitizensImport;
use App\Exports\CitizensExport;
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

        $events = Events::select('id', 'start_date', 'event_name')
            ->where('barangay_id', $this->barangay())
            ->where('start_date', '>=', now())->count();

        return view('admin.dashboard', compact( 'citizens', 'events'));
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

        $citizens = Citizen::findorfail($id);
        $puroks= Purok::where('barangay_id', $this->barangay())->get();

        return view('admin.citizens.citizens_edit', compact('citizens', 'puroks'));

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
        $notification = array(
            'message' => 'Citizen archived successfully',
            'alert-type' => 'warning',
        );
        return redirect()->back()->with($notification);
    }

    public function view($id){

        $citizen = Citizen::findOrfail($id);
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

