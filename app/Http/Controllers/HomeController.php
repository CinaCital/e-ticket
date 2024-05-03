<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function home()
    {
        return view('welcome');
    }
    public function show()
    {
        $user = User::all();
        return view('auth.index', compact('user'));
    }
    public function edit($id)
    {
        $user = User::find($id);
        //show data penerbangan per id
        return view('auth.edit', compact('user'));
    }
    public function update(Request $request, $id)
    {
        // Validate request
    $request->validate([
        'name' => 'required',
        'email'=> 'required',
        'role'=> 'required',
    ]);

    // Find the Penerbangan
    $user = User::find($id);

    // Update other fields
    $user->name = $request->name;
    $user->email = $request->email;
    $user->role = $request->role;

    // Save the updated Penerbangan
    $user->save();

    // Redirect with success message
    return redirect()->route('user.index')->with('success', 'user updated successfully');
    }
    public function destroy($id)
    {
        //mendelete data penerbangan per id
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'user deleted successfully');
    }
}
