<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequests\UpdateUserRequest;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::query()->withoutMe()->filter(request(['search', 'sort', 'direction']))
            ->paginate()
            ->withQueryString();

        return view('users.index', [
            "pretitle" => "Users",
            "title" => "Data Users",
            "users" => $users
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', [
            "pretitle" => "User",
            "title" => "Edit Data User",
            "user" => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());
        if (auth()->user()->isSuperadmin()) {
            return redirect()->route("dashboard.users.index")->with('success', 'Data user berhasil diubah.');
        }
        return redirect()->route("dashboard.index")->with('success', 'Data user berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        // untuk menghapus user_id di data guru
        Teacher::query()->where('user_id', $user->id)->update(['user_id' => null]);
        return redirect()->route('dashboard.users.index')->with('success', 'Data user berhasil dihapus.');
    }
}
