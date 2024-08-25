<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Table Data</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
</head>
<body>
    <div class="container">
        <h2>Edit Table Data</h2>
        <form method="post" action="{{ route('data.update', ['data' => $data]) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div>
                    <x-input-label for="title" :value="__('title')" />
                    <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ $data->title }}"  autofocus autocomplete="title" />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" style="color:red"/>   
            </div>
    
            <div>
                    <x-input-label for="description" :value="__('description')" />
                    <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" value="{{ $data->description}}"  autofocus autocomplete="description" />
                    <x-input-error :messages="$errors->get('description')" class="mt-2" style="color:red"   />
            </div>  
            
            <div>
                <input type="file" name="image" placeholder="image" >
            </div>

            <div>
                  <input type="submit" value="Update">
            </div>
        </form>
    </div>
</body>
</html> 
</x-app-layout>