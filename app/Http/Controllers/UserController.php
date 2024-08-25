<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\data;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $test = data::with('createdBy', 'updatedBy')->get();
        return view('data.index', ['data' => $test]);
    }

    public function create()
    {
        return view('data.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]*$/'],
            'description' => ['required', 'string', 'min:10'],
            'image' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048'
        ]);
        
        $data = $request->only(['title', 'description']);
        $data['created_by_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/data/';
            $file->move($path, $filename);
            $data['image'] = $path . $filename;
        }

        data::create($data);

        return redirect(route('data.index'))->with('success', 'Data created successfully');
    }

    public function edit(data $data)
    {
        return view('data.edit', ['data' => $data]);
    }

    public function update(data $data, Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]*$/'],
            'description' => ['required', 'string', 'min:10'],
            'image' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        $validatedData = $request->only(['title', 'description']);
        $validatedData['updated_by_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/data/';
            $file->move($path, $filename);

            if (File::exists($data->image)) {
                File::delete($data->image);
            }

            $validatedData['image'] = $path . $filename;
        }

        $data->update($validatedData);

        return redirect(route('data.index'))->with('success', 'Data updated successfully');
    }

    public function destroy(data $data)
    {
        if (File::exists($data->image)) {
            File::delete($data->image);
        }

        $data->delete();

        return redirect(route('data.index'))->with('success', 'Data deleted successfully');
    }
}


