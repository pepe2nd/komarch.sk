<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class DocumentsController extends Controller
{
    public function index(Request $request)
    {
        $page = Page::findOrFail(24610); // legacy page "Právne normy a dokumenty"
        return view('documents', compact('page'));
    }
}
