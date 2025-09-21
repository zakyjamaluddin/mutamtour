<?php

namespace App\Http\Controllers;

use App\Exports\JamaahTemplateExport;
use Maatwebsite\Excel\Facades\Excel;

class JamaahTemplateController extends Controller
{
    public function download()
    {
        return Excel::download(new JamaahTemplateExport, 'template_import_jamaah.xlsx');
    }
}

