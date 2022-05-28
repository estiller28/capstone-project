<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitorsController extends Controller
{
    public function index(){
        return view('visitors.index');
    }

    public function create(Request $request){
        $validator = \Validator::make($request->all(),[
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'phone' => 'required',

        ]);

        if(!$validator->passes()){
            return response()->json([
                'code' => 0, 'error' => $validator->errors()->toArray()
            ]);

        }else{
            $img =  $request->get('image');
            $folderPath = "visitors-image/";
            $image_parts = explode(";base64,", $img);

            foreach ($image_parts as $key => $image){
                $image_base64 = base64_decode($image);
            }

            $fileName = uniqid() . '.jpg';
            $file = $folderPath . $fileName;
            file_put_contents($file, $image_base64);

            Visitor::create([
                'first_name'    => $request->first_name,
                'last_name'     => $request->last_name,
                'address'       => $request->address,
                'phone'         => $request->phone,
                'image'         => $fileName,
                'barangay_id'   => Auth::user()->barangay_id,

            ]);

            return response()->json([
                'code' => 1, 'msg' => 'Login success'
            ]);
        }
    }

    public function visitorAll(){
        $visitors = Visitor::where('barangay_id', Auth::user()->barangay_id)->latest()->get();

        return view('admin.visitor.visitor_list', compact('visitors'));
    }

    public function visitorList(){

    }
}
