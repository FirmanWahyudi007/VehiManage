<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Drivers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Drivers') }}
                            </h2>
                        </header>
                        <div class="mt-4">
                            <x-table :head="$head" id="driversTable" />
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="additionalScripts">
        <script>
            $(document).ready(function() {
                $('#driversTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: " ",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'phone_number',
                            name: 'phone_number'
                        },
                        {
                            data: 'status',
                            name: 'status',
                            render: function(data, type, row) {
                                if (data == 1) {
                                    return '<span class="text-green-500 font-semibold">Active</span>';
                                } else {
                                    return '<span class="text-red-500 font-semibold">Inactive</span>';
                                }
                            }
                        },
                    ]
                });
            });
        </script>
    </x-slot>
</x-app-layout>
