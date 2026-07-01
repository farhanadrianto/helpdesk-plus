<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        $user = DB::table('users')
            ->where('id', session('id'))
            ->first();

        return view('user.profile.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $data = [

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,

        ];

        // upload photo
        if($request->hasFile('profile_photo')){

            if($request->hasFile('profile_photo')){

                // ambil data user lama
                $oldUser = DB::table('users')
                    ->where('id', session('id'))
                    ->first();

                // hapus foto lama jika ada
                if($oldUser->profile_photo){

                    $oldPath = public_path('profile/'.$oldUser->profile_photo);

                    if(file_exists($oldPath)){
                        unlink($oldPath);
                    }

                }

                $file = $request->file('profile_photo');

                // extension file
                $ext = $file->getClientOriginalExtension();

                // bikin nama file
                $filename =
                    strtolower(str_replace(' ','_',session('name')))
                    .'_profile.'
                    .$ext;

                // upload
                $file->move(public_path('profile'), $filename);

                // save database
                $data['profile_photo'] = $filename;
            }
        }

        // password optional
        if($request->password){
            $data['password'] = $request->password;
        }

        DB::table('users')
            ->where('id', session('id'))
            ->update($data);

        return redirect()
            ->back()
            ->with('success', 'Profile updated successfully');
    }
}