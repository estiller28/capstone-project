<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Citizen;
use App\Models\Certificates;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use App\Exceptions;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\DB;


class
pdfController extends Controller
{
    protected $fpdf;

    public function __construct()
    {
        $this->fpdf = new Fpdf;
    }

    public function index()
    {
        $citizens = Citizen::select(DB::raw("CONCAT(last_name,', ', first_name) AS full_name, id"))
            ->where('barangay_id', auth()->user()->barangay_id)
            ->orderBy('last_name', 'asc')
            ->get();

        $certificates = Certificates::pluck('form_name', 'id');
        return view('admin.form.form', compact('citizens', 'certificates'));
    }

    public function generate(Request $request)
    {

        $citizen = Citizen::find($request->citizen);

        if ($citizen) {
            $certificates = Certificates::find($request->form_name);
            switch ($certificates->form_name) {
                case("Barangay Clearance"):
                    $form = "storage/forms/Barangay Clearance.jpg";
                    $this->fpdf->SetFont('Arial', 'B', '20');
                    $this->fpdf->AddPage('P', 'Letter');
                    $this->fpdf->SetMargins(1, 1, 1);
                    $this->fpdf->Image($form, '0', '0');
                    $this->fpdf->Text(90, 92, $citizen->first_name);
                    $this->fpdf->Text(20, 92, $citizen->last_name);
                    $this->fpdf->Text(150, 92, $citizen->middle_name);
                    $this->fpdf->Text(50, 12, $certificates->id);
                    $this->fpdf->Output();
                    exit;

                case ("2"):
                    echo "No form found";
                    break;
                default:
                    echo "No form found";
            }
        } else {
            return redirect()->back()->with('error', 'Citizen not found.');
        }
    }
}
