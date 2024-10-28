<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request): Response
    {
        // Get the users from the database
        $users = User::all();

        // Return a response with the users data and a view
        return response(view('admin.users', ['users' => $users]));
    }

    public function edit($id)
{
    $user = User::findOrFail($id);

    return view('admin.edit_user', compact('user'));
}

public function update(Request $request, User $user)
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'username' => 'required|string|email|max:255|unique:users,username,'.$user->id,
        'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
        'phoneNumber' =>'required|string|max:10',
        'role' =>'required|string',
        'password' => 'sometimes|nullable|string|min:8|confirmed',
    ]);

    $user->name = $validatedData['name'];
    $user->username = $validatedData['username'];
    $user->email = $validatedData['email'];
    $user->phoneNumber = $validatedData['phoneNumber'];
    $user->role = $validatedData['role'];
    if ($validatedData['password']) {
        $user->password = Hash::make($validatedData['password']);
    }
    $user->save();
    return redirect()->route('admin.users.index')->with([
        'success' => 'User updated successfully',
        'toast' => true, // add a toast flag
    ]);
}

public function destroy(User $user)
{
  
    try {
        $user->delete();
    } catch (\Exception $e) {
        return redirect()->route('admin.users.index')->with([
            'error' => 'An error occurred while deleting the user',
            'toast' => true, // add a toast flag
        ]);
    }

    return redirect()->route('admin.users.index')->with([
        'success' => 'User deleted successfully',
        'toast' => true, // add a toast flag
    ]); 
}
public function student()
{
    $children = Child::all();

return view('admin.students', compact('children'));

}
public function teacher()
{
    $teachers = User::where('role', 'Teacher')->orderBy('name')->get();
return view('admin.teachers', compact('teachers'));

}

 public function course()
    {
        $teachers = User::where('role', 'Teacher')->orWhere('role', 'Admin')->get();
        $courses = Course::all();
        return view('', compact('courses','teachers'));
    }

}  
