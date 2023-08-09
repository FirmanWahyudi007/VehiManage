<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vehicles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Vehicles') }}
                            </h2>
                        </header>
                        <div class="mt-4">
                            <table id="myDataTable" class="table-auto p-0">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2">#</th>
                                        <th class="px-4 py-2">Merk</th>
                                        <th class="px-4 py-2">Type</th>
                                        <th class="px-4 py-2">Year</th>
                                        <th class="px-4 py-2">License Plate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Your table rows -->
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="additionalScripts">
        <script>
            $(document).ready(function() {
                $('#myDataTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('vehicles.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'merk',
                            name: 'name'
                        },
                        {
                            data: 'type',
                            name: 'type'
                        },
                        {
                            data: 'year',
                            name: 'year'
                        },
                        {
                            data: 'license_plate',
                            name: 'license_plate',
                        },
                    ]
                });
            });
        </script>
    </x-slot>
</x-app-layout>
