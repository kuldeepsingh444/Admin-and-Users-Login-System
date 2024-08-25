

@if(!empty($details))

@foreach($details as $detail)

         <tr class="warning" >
         <td >{{ $detail->id}}</td>
            <td >{{ $detail->name}}</td>
            <td >{{ $detail->email}}</td>
            <td >{{ $detail->password}}</td>
            <td ></td>
             .............
        </tr>

        @endforeach

@endif
