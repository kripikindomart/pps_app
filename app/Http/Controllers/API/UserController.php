<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserCollection;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class UserController extends Controller
{
    public function userLists()
    {
        $user = User::where('role', '!=', 1)->get();
        return new UserCollection($user);
    }

    public function getUserLogin()
    {
        $user = request()->user(); //MENGAMBIL USER YANG SEDANG LOGIN
        $permissions = [];
        foreach (Permission::all() as $permission) {
            //JIKA USER YANG SEDANG LOGIN PUNYA PERMISSION TERKAIT
            if (request()->user()->can($permission->name)) {
                $permissions[] = $permission->name; //MAKA PERMISSION TERSEBUT DITAMBAHKAN
            }
        }
        $user['permission'] = $permissions; //PERMISSION YANG DIMILIKI DIMASUKKAN KE DALAM DATA USER.
        return response()->json(['status' => 'success', 'data' => $user]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:150',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|string',
            'photo' => 'required|image'
        ]);

        DB::beginTransaction();
        try {
            $name = NULL;
            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $name = $request->email . '-' . time() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('public/photo', $name);
            }
            $user = User::create([ //MODIFIKASI BAGIAN INI DENGAN MEMASUKKANYA KE DALAM VARIABLE $USER
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'role' => $request->role,
                'photo' => $name,
            ]);
            $user->assignRole('admin');
            DB::commit();
            return response()->json(['status' => 'success'], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['status' => 'error', 'data' => $e->getMessage()], 200);
        }
    }
}
