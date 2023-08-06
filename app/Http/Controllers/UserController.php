<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:Admin')->only('index', 'show', 'edit', 'update', 'destroy', 'create', 'store');
    }

    public function index()
    {
        $user = User::with('role')->paginate(10);
        return view('pages.user.index', [
            'user' => $user
        ]);
    }

    public function create()
    {
        $role = Role::all();
        return view('pages.user.create', [
            'role' => $role
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'unique:users,email'],
        ]);

        if ($validator->fails()) {
            return redirect(route('user.create'))->with([
                'message' => 'Gagal menambah data user. Silakan ulangi!',
                'color' => 'danger',
            ]);
        } else {
            $user = User::create([
                'name' => ucwords(strtolower($request->name)),
                'email' => $request->email,
                'password' => Hash::make('12345678'),
                'role_id' => $request->role,
            ]);
            if ($user) {
                return redirect(route('user.index'))->with([
                    'message' => 'Berhasil menambah data user. Kata sandi yang digunakan ialah 12345678. Silakan diatur pada profil user!',
                    'color' => 'success',
                ]);
            } else {
                return redirect(route('user.create'))->with([
                    'message' => 'Gagal menambah data user. Silakan ulangi!',
                    'color' => 'danger',
                ]);
            }
        }
    }

    public function show(User $user)
    {
        return view('pages.user.show', [
            'user' => $user
        ]);
    }

    public function edit(User $user)
    {
        $role = Role::all();
        return view('pages.user.edit', [
            'user' => $user,
            'role' => $role,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validasi = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', Rule::unique('users')->ignore($user->id)],
            'role' => ['required'],
        ]);
        if ($validasi->fails()) {
            return redirect(route('user.edit', ['user' => $user->id]))->with([
                'message' => 'Gagal mengubah data user. Silakan ulangi!',
                'color' => 'danger',
            ]);
        } else {
            if ($request->password == null) {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'role_id' => $request->role,
                ]);
            } else {
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'role_id' => $request->role,
                    'password' => Hash::make($request->password),
                ]);
            }
            return redirect(route('user.edit', ['user' => $user->id]))->with([
                'message' => 'Berhasil mengubah data user!',
                'color' => 'success',
            ]);
        }
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('user.index'))->with([
            'message' => 'Berhasil menghapus data user : ' . $user->name . '!',
            'color' => 'success',
        ]);
    }
}
