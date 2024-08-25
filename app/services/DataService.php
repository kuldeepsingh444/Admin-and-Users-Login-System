<?php
namespace App\Services;
 
use Illuminate\Http\Request;
use App\Models\data;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;    

class DataService {
 
    public function getAllData()
    {
        return data::with('createdBy', 'updatedBy')->get();
    }

    public function storeData(Request $request)
    {
        $data = $request->only(['title', 'description', 'image']);
        $data['created_by_id'] = Auth::id();
            
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/data/';
            $file->move($path, $filename);
            $data['image'] = $path . $filename;
        }

        return data::create($data);
    }

    public function updateData(data $data, Request $request)
    {
        $validatedData = $request->only(['title', 'description', 'image']);
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

        return $data->update($validatedData);
    }

    public function deleteData(data $data)
    {
        if (File::exists($data->image)) {
            File::delete($data->image);
        }

        return $data->delete();
    }
 
 }
 
   