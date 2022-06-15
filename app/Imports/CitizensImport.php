<?php

namespace App\Imports;

use App\Models\Citizen;
use App\Models\Purok;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class CitizensImport implements ToCollection, WithHeadingRow, WithValidation
{
    /**
    * @param Collection $collection
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $purok;

    public function __construct(){
        $this->purok = Purok::select('id', 'purok_name')->get();
    }

    public function Collection(Collection $collection)
    {
        foreach($collection as $row){
            $user = Auth::user();
            $purok = Purok::where('id', $row['purok_id'])
               ->orWhere('purok_name', $row['purok_id'])->first();

            $data = [
                'first_name'    => $row['first_name'],
                'middle_name'   => $row['middle_name'],
                'last_name'     => $row['last_name'],
                'barangay_id'   => $user->barangay_id,
                'date_of_birth' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_of_birth']),
                'purok_id'      => $purok->id ?? NULL,
            ];

            $citizen  = Citizen::create($data);
        }
        return $citizen;
    }



    public function rules(): array
    {
//        $purok = Purok::where('barangay_id', auth()->user()->barangay_id)->get('id');

        $validatedData = ([
            'first_name'    => 'required|unique:citizens|max:255',
            'middle_name'   => 'required',
            'last_name'     => 'required',

        ]);

        return $validatedData;
    }
}
