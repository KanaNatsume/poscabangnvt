<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'User';
        $user = User::orderBy('id', 'desc')->where('role', 'kasir')->get();
        return view('user.index', compact('title', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users,email'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make('password');
        $user->role = 'kasir';
        $user->save();
        return redirect('/user')->with('success', 'Data user berhasil tersimpan');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = $request->editName;
        $user->email = $request->editEmail;
        $user->save();
        return redirect('/user')->with('success', 'Data user berhasil terupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user->photo != 'user.png') {
            File::delete('photo/' . $user->photo);
        }
        $user->delete();
        return redirect('/user')->with('success', 'Data user berhasil terhapus');
    }

    public function profile()
    {
        $title = 'My Profile';
        $user = User::where('id', Auth::user()->id)->first();
        return view('user.profile', compact('title', 'user'));
    }

    public function update_profile(Request $request)
    {
        $request->validate([
            'photo' => 'mimes:png,jpeg,jpg,svg'
        ]);

        $id_user = Auth::user()->id;
        $user = User::find($id_user);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $ubah_nama_photo = time() . '_' . $photo->getClientOriginalName();
            $photo->move('photo', $ubah_nama_photo);

            if ($user->photo != 'user.png') {
                File::delete('photo/' . $user->photo);
            }

            $user->photo = $ubah_nama_photo;
            $user->save();
        }

        $user->name = $request->name == '' ? Auth::user()->name : $request->name;
        $user->email = $request->email == '' ? Auth::user()->email : $request->email;
        $user->save();
        return redirect('/profile')->with('success', 'Profile berhasil terupdate!');
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'password' => 'required|min:3|confirmed'
        ], [
            'password.min' => 'password minimal 3 karakter',
            'password.confirmed' => 'konfirmasi password tidak sama',
        ]);
        $id_user = Auth::user()->id;
        $user = User::find($id_user);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('/profile')->with('success', 'Password berhasil terupdate');
    }
}
