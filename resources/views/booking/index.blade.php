<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Booking') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($message = Session::get('alert'))
                <x-notification-message :alert="$message" />
            @endif
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header>
                        <div class="container">
                            <div class="flex flex-wrap">
                                <div class="w-full px-4 lg:w-1/2">
                                    <h2 class="text-lg font-medium text-gray-900">
                                        {{ __('Booking') }}
                                    </h2>
                                </div>
                                <div class="w-full px-4 lg:w-1/2 text-right">
                                    <x-link-button-primary href="{{ route('booking.create') }}">
                                        {{ __('Create') }}
                                    </x-link-button-primary>
                                </div>
                            </div>
                        </div>

                    </header>
                    <div class="mt-4 w-full">
                        <x-table :head="$head" id="bookingTable" />
                    </div>
                </section>
            </div>
        </div>
    </div>
    </div>
    <x-slot name="additionalScripts">
        <script>
            $(document).ready(function() {
                $('#bookingTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: " ",
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'user.name',
                            name: 'user.name'
                        },
                        {
                            data: 'pickup_location',
                            name: 'pickup_location'
                        },
                        {
                            data: 'destination',
                            name: 'destination'
                        },
                        {
                            data: 'pickup_date',
                            name: 'pickup_date',
                            render: function(data, type, row) {
                                return moment(data).format('D MMMM YYYY') + ' ' + row.pickup_time;
                            }
                        },
                        {
                            data: 'approval_by',
                            name: 'approval_by',
                            render: function(data, type, row) {
                                if (data == null) {
                                    return '<span class="text-red-500 font-medium">Pending</span>';
                                } else {
                                    return data.approved_by.name;
                                }
                            }
                        },
                        {
                            data: 'approval_level',
                            name: 'approval_level',
                            render: function(data, type, row) {
                                var statusText = "";

                                switch (data) {
                                    case 0:
                                        statusText = "Awaiting Employee Approval";
                                        break;
                                    case 1:
                                        statusText = "Awaiting Supervisor Approval";
                                        break;
                                    case 2:
                                        statusText = "Rejected by Employee";
                                        break;
                                    case 3:
                                        statusText = "Rejected by Supervisor";
                                        break;
                                    case 4:
                                        statusText = "Approved by Employee";
                                        break;
                                    case 5:
                                        statusText = "Approved by Supervisor";
                                        break;
                                    default:
                                        statusText = "Unknown";
                                        break;
                                }

                                var statusClass = data == 4 || data == 5 ? "text-green-500" :
                                    "text-red-500";

                                return `<span class="${statusClass} font-medium">${statusText}</span>`;
                            }

                        },
                        {
                            data: 'status',
                            name: 'status',
                            render: function(data, type, row) {
                                if (data == 1) {
                                    return '<span class="text-green-500 font-medium">Aproved</span>';
                                } else if (data == 2) {
                                    return '<span class="text-red-500 font-medium">Rejected</span>';
                                } else {
                                    return '<span class="text-red-500 font-medium">Pending</span>';
                                }
                            }
                        },
                    ],
                    dom: 'Bfrtip', // Menambahkan tombol ekspor
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf'
                    ],
                    responsive: true // Enable responsive behavior if needed
                });
            });
        </script>
    </x-slot>
</x-app-layout>
