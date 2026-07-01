<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    // ================= USER =================

public function index()
{
    $tickets = DB::table('tickets')
        ->join('categories', 'tickets.category_id', '=', 'categories.id')
        ->select('tickets.*', 'categories.category_name as category')
        ->where('tickets.user_id', session('id'))
        ->orderBy('tickets.created_at', 'desc')
        ->get();

    return view('user.ticket.index', compact('tickets'));
}

    public function create()
    {
        $categories = DB::table('categories')
            ->orderBy('category_name')
            ->get();

        return view('user.ticket.create', compact('categories'));
    }

public function store(Request $request)
{
    $request->validate([
        'category_id' => 'required',
        'title' => 'required',
        'priority' => 'required',
        'description' => 'required',
        'attachment' => 'nullable|mimes:jpg,jpeg,png,pdf,doc,docx|max:2048'
    ]);

    $attachment = null;

    if ($request->hasFile('attachment')) {

        $file = $request->file('attachment');

        $attachment = time().'_'.$file->getClientOriginalName();

        $file->move(public_path('uploads'), $attachment);

    }

    // Generate Ticket Code
    $ticketCode = 'HD-' . date('YmdHis');

    DB::table('tickets')->insert([

        'ticket_code' => $ticketCode,

        'user_id' => session('id'),

        'category_id' => $request->category_id,

        'title' => $request->title,

        'priority' => $request->priority,

        'description' => $request->description,

        'attachment' => $attachment,

        'status' => 'Open',

        'created_at' => now(),

        'updated_at' => now()

    ]);

    return redirect()->route('ticket.index')
            ->with('success','Ticket berhasil dibuat.');
}

public function userShow($id)
{
    $ticket = DB::table('tickets')
        ->join('categories', 'tickets.category_id', '=', 'categories.id')
        ->select(
            'tickets.*',
            'categories.category_name as category'
        )
        ->where('tickets.id', $id)
        ->first();

    return view('user.ticket.show', compact('ticket'));
}

public function show($id)
{
    $ticket = DB::table('tickets')
        ->join('users', 'tickets.user_id', '=', 'users.id')
        ->join('categories', 'tickets.category_id', '=', 'categories.id')
        ->select(
            'tickets.*',
            'users.name',
            'categories.category_name as category'
        )
        ->where('tickets.id', $id)
        ->first();

    return view('admin.ticket.show', compact('ticket'));
}

    // ================= ADMIN =================

    public function adminIndex()
    {
        $tickets = DB::table('tickets')
            ->join('users', 'tickets.user_id', '=', 'users.id')
            ->join('categories', 'tickets.category_id', '=', 'categories.id')
            ->select(
                'tickets.*',
                'users.name as employee',
                'categories.category_name as category'
            )
            ->where('tickets.is_archived', 0)
            ->orderBy('tickets.created_at', 'desc')
            ->get();

        return view('admin.ticket.index', compact('tickets'));
    }

    public function adminShow($id)
    {
        $ticket = DB::table('tickets')
            ->join('users', 'tickets.user_id', '=', 'users.id')
            ->join('categories', 'tickets.category_id', '=', 'categories.id')
            ->select(
                'tickets.*',
                'users.name as user_name',
                'categories.name as category'
            )
            ->where('tickets.id', $id)
            ->first();

        return view('admin.ticket.show', compact('ticket'));
    }

    public function edit($id)
    {
        $ticket = DB::table('tickets')->find($id);

        return view('admin.ticket.edit', compact('ticket'));
    }

    public function update(Request $request, $id)
    {
        DB::table('tickets')
            ->where('id', $id)
            ->update([
                'status' => $request->status,
                'updated_at' => now(),
            ]);

        return redirect('/admin/ticket')->with('success', 'Status ticket berhasil diubah.');
    }

    public function updateStatus(Request $request, $id)
    {
        DB::table('tickets')
            ->where('id',$id)
            ->update([

                'status' => $request->status,
                'updated_at' => now()

            ]);

        // jika dari archive
        if($request->from_archive == 1){

            return redirect()
                ->route('admin.ticket.archive.index')
                ->with('success','Ticket status updated successfully.');

        }

        // jika dari active
        return redirect()
            ->route('admin.ticket.index')
            ->with('success','Ticket status updated successfully.');
    }

    public function archive($id)
    {
        DB::table('tickets')
            ->where('id', $id)
            ->update([
                'is_archived' => 1,
                'updated_at' => now()
            ]);

        return redirect()
            ->route('admin.ticket.archive.index')
            ->with('success','Ticket archived successfully.');
    }

    public function archiveIndex()
    {
        $tickets = DB::table('tickets')
            ->join('users','tickets.user_id','=','users.id')
            ->join('categories','tickets.category_id','=','categories.id')
            ->select(
                'tickets.*',
                'users.name as employee',
                'categories.category_name as category'
            )
            ->where('tickets.is_archived',1)
            ->orderBy('tickets.created_at','desc')
            ->get();

        return view('admin.ticket.archive', compact('tickets'));
    }

    public function destroy($id)
    {
        DB::table('tickets')
            ->where('id', $id)
            ->delete();

        return redirect()
            ->back()
            ->with('success', 'Ticket berhasil dihapus.');
    }

    public function activate($id)
    {
        DB::table('tickets')
            ->where('id',$id)
            ->update([

                'is_archived' => 0,
                'updated_at' => now()

            ]);

        return redirect()
            ->route('admin.ticket.index')
            ->with('success','Ticket activated successfully.');
    }
}