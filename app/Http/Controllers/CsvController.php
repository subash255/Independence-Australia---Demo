<?php

namespace App\Http\Controllers;

use App\Imports\ProductImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CsvController extends Controller
{
    public function showForm()
    {
        return view('csv');
    }

    public function uploadCSV(Request $request)
    {
        // Validate that the uploaded file is a CSV
        $request->validate([
            'csv_file' => 'required|mimes:xlsx,csv,txt'
        ]);
        

        // Import the CSV file
        Excel::import(new ProductImport, $request->file('csv_file'));


        // Redirect back with a success message

        return back()->with('success', 'CSV file successfully uploaded and products imported!');
    }
}
