<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vehicles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($message = Session::get('alert'))
                <x-notification-message :alert="$message" />
            @endif
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Vehicles') }}
                            </h2>
                        </header>
                        <div class="mt-4">
                            <x-table :head="$head" id="vehiclesTable" />
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="additionalScripts">
        <script>
            $(document).ready(function() {
                $('#vehiclesTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('vehicles.index') }}",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'merk',
                            name: 'merk'
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
