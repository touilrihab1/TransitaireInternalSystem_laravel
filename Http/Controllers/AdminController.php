<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\CategorieController;

class AdminController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);

    }
}
