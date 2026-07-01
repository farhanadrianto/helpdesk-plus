<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $employees = DB::table('users')
            ->where('role', 'user')
            ->count();

        $categories = DB::table('categories')
            ->count();

        $activeTickets = DB::table('tickets')
            ->where('is_archived', 0)
            ->count();

        $archivedTickets = DB::table('tickets')
            ->where('is_archived', 1)
            ->count();

        $openTickets = DB::table('tickets')
            ->where('status', 'Open')
            ->count();

        $progressTickets = DB::table('tickets')
            ->where('status', 'In Progress')
            ->count();

        $resolvedTickets = DB::table('tickets')
            ->where('status', 'Resolved')
            ->count();

        $closedTickets = DB::table('tickets')
            ->where('status', 'Closed')
            ->count();

        return view('admin.dashboard', compact(
            'employees',
            'categories',
            'activeTickets',
            'archivedTickets',
            'openTickets',
            'progressTickets',
            'resolvedTickets',
            'closedTickets'
        ));
    }
}