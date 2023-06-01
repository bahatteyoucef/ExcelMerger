<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class ExcelController extends Controller
{

    public function merge(Request $request)
    {

        $files      = $request->file('files');
        $mergedData = collect();

        $header     =   [];

        foreach ($files as $file) {

            $data = Excel::toArray(new class implements ToModel, WithHeadingRow {

                public function model(array $row) {

                    // Modify the data as per your requirement
                    return $row;
                }
            }, $file);

            if($header  == []) {

                $header             = array_keys($data[0][0]);

                $mergedData[]       = $header;
            }

            $mergedData             = $mergedData->concat($data[0]);
        }

        return Excel::download(new class($mergedData) implements FromCollection, WithStrictNullComparison {

            use Exportable;

            private $data;

            public function __construct($data) {
                $this->data = $data;
            }

            public function collection() {
                return $this->data;
            }

        }, $request->input("merged_file_name").'.xlsx');
    }
}
