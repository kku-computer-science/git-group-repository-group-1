<?php

namespace App\Http\Controllers;

use App\Exports\ExportPaper;
use App\Exports\ExportUser;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportPaperController extends Controller
{
    public function exportUsers(Request $request){
        $export = new ExportUser([
            [1, 2, 3],
            [4, 5, 6]
        ]);
        return Excel::download(new $export, 'new.csv');
    }
}
