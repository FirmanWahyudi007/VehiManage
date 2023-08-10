@props(['title' => ' ', 'value' => ' '])
<div class="w-full md:w-1/2 xl:w-1/6 p-3">
    <div class="bg-white border rounded-xl p-2">
        <div class="flex flex-row items-center">
            <div class="flex-1 text-right md:text-center">
                <h5 class="font-semibold uppercase text-gray-400">{{ $title }}</h5>
                <h3 class="font-medium text-3xl text-gray-600">{{ $value }}</h3>
            </div>
        </div>
    </div>
</div>
