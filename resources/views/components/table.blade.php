{{-- create component blade table laravel 10 --}}
@props(['head' => [], 'id' => 'myDataTable'])
<table id="{{ $id }}" class="table-auto">
    <thead>
        <tr>
            @foreach ($head as $item)
                <th class="px-4 py-2">{{ $item }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        <!-- Your table rows -->
    </tbody>
</table>
