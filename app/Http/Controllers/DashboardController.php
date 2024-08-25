<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\data;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DashboardRequest;
use App\services\DataService;

class DashboardController extends Controller
{
    
    public function __construct(DataService $dataService)
    {
        $this->dataService = $dataService;
    }

    public function index()
    {
        $test = $this->dataService->getAllData();
        return view('data.index', ['data' => $test]);
    }

    public function create()
    {
        return view('data.create');
    }

    public function store(DashboardRequest $request)
    {   
        $this->dataService->storeData($request);
        return redirect(route('data.index'))->with('success', 'Data created successfully');
    }
    

    public function edit(data $data)
    {
        return view('data.edit', ['data' => $data]);
        
    }

    public function update(data $data, DashboardRequest $request)
    {
        
        $this->dataService->updateData($data, $request);
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