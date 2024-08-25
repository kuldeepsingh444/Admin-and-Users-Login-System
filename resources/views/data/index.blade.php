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
    <title>Table Data</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
</head>
<body>
    <h2>Table data</h2>

        @if(session()->has('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
        @endif

        <div class="action-links">
            <div>
                <a href="{{ route('data.create') }}">Create Values</a>
            </div>
            
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Created By</th>
                    <th>Updated By</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $test)
                @if (auth()->id() == $test->createdBy->id)
                    <tr>
                        <td>{{ $test->id }}</td>
                        <td>{{ $test->title }}</td>
                        <td>{{ $test->description }}</td>
                        <td>
                            <img src="{{asset($test->image)}}" style="width: 70px; height:70px:" alt="image"/>
                        </td>
                        <td>{{ $test->createdBy->name ?? 'Unknown' }}</td>
                        <td>{{ $test->updatedBy->name ?? 'Unknown' }}</td>
                        <td>
                        <form class="edit-form" method="post" action="{{ route('data.edit', ['data' => $test]) }}">
                                            @csrf   
                                            @method('get')
                                            <input type="submit" value="edit"/>
                                        </form>
                        
                            <form class="delete-form" method="post" action="{{ route('data.destroy', ['data' => $test]) }}">
                                @csrf   
                                @method('delete')
                                <input type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this item?')"/>
                            </form>
                        </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
</div>
    </div>
</body>
</html>
</x-app-layout>