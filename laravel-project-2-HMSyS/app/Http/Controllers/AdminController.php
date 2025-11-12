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

   $image=$request->image;
        $imageName=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('public/rooms',$imageName);


        // Create a new room record in the database
        // Assuming you have a Room model set up
        \App\Models\Room::create([
            'room_title' => $request->input('title'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'room_type' => $request->input('type'),
            'wifi' => $request->input('wifi'),
            'image' => $imageName,
        ]);

        return redirect()->back()->with('success', 'Room added successfully!');

    }
    public function view_room()
    {
        $rooms = \App\Models\Room::all();
        return view('admin.view_rooms', compact('rooms'));
    }

    public function get_room($id)
    {
        $room = \App\Models\Room::findOrFail($id);
        return response()->json($room);
    }

    public function update_room(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'type' => 'required|string',
            'wifi' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        $room = \App\Models\Room::findOrFail($id);

        // Handle file upload if an image is provided
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if (file_exists(public_path('rooms/' . $room->image))) {
                unlink(public_path('rooms/' . $room->image));
            }

            $image = $request->image;
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('public/rooms', $imageName);
            $room->image = $imageName;
        }

        $room->room_title = $request->input('title');
        $room->price = $request->input('price');
        $room->description = $request->input('description');
        $room->room_type = $request->input('type');
        $room->wifi = $request->input('wifi');
        $room->save();

        return redirect()->route('view_room')->with('success', 'Room updated successfully!');
    }

    public function delete_room($id)
    {
        $room = \App\Models\Room::findOrFail($id);

        // Delete image file if exists
        if (file_exists(public_path('rooms/' . $room->image))) {
            unlink(public_path('rooms/' . $room->image));
        }

        $room->delete();

        return redirect()->route('view_room')->with('success', 'Room deleted successfully!');
    }
}
