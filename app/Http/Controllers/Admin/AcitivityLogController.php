<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity as ModelsActivity;

class AcitivityLogController extends Controller
{
    public function index() 
    {
        $allActivities = ModelsActivity::paginate(10);
        return view('admin.logs.index', compact('allActivities'));
    }
}
