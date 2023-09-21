<x-moonshine::table>
    <x-slot:thead class="bgc-blue text-center">
        @foreach($dates as $date)
            <th colspan="1">{{$date}}</th>
        @endforeach

    </x-slot:thead>
    <x-slot:tbody>
        <tr>
            @foreach($positions as $position)
            <th class="bgc-pink">{{$position}}</th>
            @endforeach
        </tr>

    </x-slot:tbody>
</x-moonshine::table>
