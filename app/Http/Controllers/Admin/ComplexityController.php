<?php

namespace App\Http\Controllers\Admin;

use App\Models\Complexity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComplexityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $complexities = Complexity::all();
        return view('admin.settings.complexity.index', compact('complexities'));
    }
}
