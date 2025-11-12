<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $usertype = Auth::user()->usertype;

            if ($usertype == 'user') {
                return view('home.index');
            } 
            else if ($usertype == 'admin') {
                return view('admin.index');
            }
            else {
                return redirect()->back();
            }
        }
        
        return redirect('/login');
    }

    public function home()
    {
        return view('home.index');
    }

    public function create_room()
    {
        return view('admin.create_room');
    }
    public function add_room(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'type' => 'required|string',
            'wifi' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        // Handle file upload if an image is provided
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('rooms', 'public');
        }

        // Create a new room record in the database
        // Assuming you have a Room model set up
        \App\Models\Room::create([
            'room_title' => $request->input('title'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'room_type' => $request->input('type'),
            'wifi' => $request->input('wifi'),
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Room added successfully!');

    }
}
