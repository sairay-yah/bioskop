<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role','pelanggan')->latest()->get();
        return view('admin.users.index', compact('users'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required',
        ]);

        $user->update($data);

        return back()->with('success','Data pengguna diupdate');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success','Pengguna dihapus');
    }
}
