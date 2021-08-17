<?php

namespace App\Http\Controllers;

use App\Imports\DepartmentsImport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class ImportController extends Controller
{
    public function show()
    {
        return view('imports');
    }

    public function store(Request $request)
    {
        $file = $request->file('data')->store('import');

        if ($request->type === "users") {
            (new UsersImport())->import($file);
        } else {
            (new DepartmentsImport())->import($file);
        }
        return back()->withStatus('Excel file imported successfully!!');
    }
}
