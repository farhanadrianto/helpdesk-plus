<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    // ===========================
    // DASHBOARD USER
    // ===========================

    public function dashboard()
    {
        $userId = session('id');

        $totalTickets = DB::table('tickets')
            ->where('user_id', $userId)
            ->count();

        $openTickets = DB::table('tickets')
            ->where('user_id', $userId)
            ->where('status', 'Open')
            ->count();

        $progressTickets = DB::table('tickets')
            ->where('user_id', $userId)
            ->where('status', 'In Progress')
            ->count();

        $resolvedTickets = DB::table('tickets')
            ->where('user_id', $userId)
            ->where('status', 'Resolved')
            ->count();

        $closedTickets = DB::table('tickets')
            ->where('user_id', $userId)
            ->where('status', 'Closed')
            ->count();

        return view('user.dashboard', compact(
            'totalTickets',
            'openTickets',
            'progressTickets',
            'resolvedTickets',
            'closedTickets'
        ));
    }

    // ===========================
    // ADMIN - LIST USER
    // ===========================

    public function index()
    {
        $users = DB::table('users')
                    ->where('role','user')
                    ->orderBy('id','DESC')
                    ->get();

        return view('admin.user.index', compact('users'));
    }

    // ===========================
    // CREATE
    // ===========================

    public function create()
    {
        return view('admin.user.create');
    }

    // ===========================
    // STORE
    // ===========================

    public function store(Request $request)
    {
        $request->validate([
            'employee_id'=>'required|unique:users',
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'department'=>'required',
            'phone'=>'required',
            'password'=>'required'
        ]);

        DB::table('users')->insert([
            'employee_id'=>$request->employee_id,
            'name'=>$request->name,
            'email'=>$request->email,
            'department'=>$request->department,
            'phone'=>$request->phone,
            'password'=>$request->password,
            'role'=>'user',
            'created_at'=>now(),
            'updated_at'=>now()
        ]);

        return redirect()->route('user.index')
                ->with('success','User berhasil ditambahkan.');
    }

    // ===========================
    // EDIT
    // ===========================

    public function edit($id)
    {
        $user = DB::table('users')->find($id);

        return view('admin.user.edit', compact('user'));
    }

    // ===========================
    // UPDATE
    // ===========================

    public function update(Request $request,$id)
    {

        DB::table('users')
            ->where('id',$id)
            ->update([

                'employee_id'=>$request->employee_id,
                'name'=>$request->name,
                'email'=>$request->email,
                'department'=>$request->department,
                'phone'=>$request->phone,
                
                'updated_at'=>now()

            ]);

        return redirect()->route('user.index')
                ->with('success','User berhasil diupdate.');

    }

    // ===========================
    // DELETE
    // ===========================

    public function destroy($id)
    {

        DB::table('users')
            ->where('id',$id)
            ->delete();

        return redirect()->route('user.index')
                ->with('success','User berhasil dihapus.');

    }

}