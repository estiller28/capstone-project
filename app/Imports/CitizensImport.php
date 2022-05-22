<?php

namespace App\Imports;

use App\Models\Citizen;
use Maatwebsite\Excel\Helpers;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
//
//class CitizensImport implements ToModel
//{
//    public function model(array $row)
//    {
//
//        return new Citizen([
//            'first_name' => $row[],
//            'middle_name' => $row[1],
//            'last_name' => $row[2],
//            'date_of_birth' => $row[3]
//        ]);
//    }
//}

class CitizensImport implements ToCollection, WithHeadingRow, WithValidation
{
    /**

    * @param Collection $collection
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function Collection(Collection $collection)
    {
        foreach($collection as $row){
            $user = Auth::user();

            $data = [
                'first_name'    => $row['first_name'],
                'middle_name'   => $row['middle_name'],
                'last_name'     => $row['last_name'],
                'barangay_id'   => $user->barangay_id,
                'date_of_birth' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_of_birth']),
                'purok_id'      => $user->purok_name,
            ];
            Citizen::create($data);
        }
    }

    public function rules(): array
    {
        $validatedData = ([
            'first_name'    => 'required|unique:citizens|max:255',
            'last_name'     => 'required',
            'date_of_birth' => 'required',

        ]);

        return $validatedData;
    }
}
