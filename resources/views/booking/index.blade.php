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
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg mb-3">

                <div class="w-full px-4 ">
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Filter Period') }}
                    </h2>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-[1040px] px-3">
                            <select name="period" id="period"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="all">
                                    {{ __('All') }}
                                </option>
                                <option value="today">
                                    {{ __('Today') }}
                                </option>
                                <option value="one_week">
                                    {{ __('One Week') }}
                                </option>
                                <option value="one_month">
                                    {{ __('One Month') }}
                                </option>
                                <option value="three_month">
                                    {{ __('Three Month') }}
                                </option>
                                <option value="six_month">
                                    {{ __('Six Month') }}
                                </option>
                                <option value="one_year">
                                    {{ __('One Year') }}
                                </option>
                            </select>
                        </div>
                        <div class="max-w-sm px-3 text-right mt-1">
                            <button type="submit" id="filterButton"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                {{ __('Filter') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <section>
                    <header>
                        <div class="flex flex-wrap">
                            <div class="w-full px-4 lg:w-1/2">
                                <h2 class="text-lg font-medium text-gray-900">
                                    {{ __('Booking') }}
                                </h2>
                            </div>
                            @if (Auth::user()->role == 'admin')
                                <div class="w-full px-4 lg:w-1/2 text-right">
                                    <x-link-button-primary href="{{ route('booking.create') }}">
                                        {{ __('Create') }}
                                    </x-link-button-primary>
                                </div>
                            @endif
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
            const buttonFilter = document.querySelector('#filterButton');
            buttonFilter.addEventListener('click', function() {
                const selectedPeriod = document.querySelector('#period').value;
                let url = "{{ route('booking.index') }}" + "?period=" + selectedPeriod;
                $('#bookingTable').DataTable().ajax.url(url).load();
            });


            $(document).ready(function() {
                let role = `{{ Auth::user()->role }}`;
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
                            data: 'approved_by',
                            name: 'approved_by',
                            render: function(data, type, row) {
                                if (data == null) {
                                    return '<span class="text-red-500 font-medium">Pending</span>';
                                } else {
                                    return data.name;
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
                                        statusText = "Approved";
                                        break;
                                    case 3:
                                        statusText = "Rejected by Employee";
                                        break;
                                    case 4:
                                        statusText = "Rejected by Supervisor";
                                        break;
                                    default:
                                        statusText = "Unknown";
                                        break;
                                }
                                var statusClass = data == 2 ? "text-green-500" :
                                    "text-red-500";
                                if (`{{ Auth::user()->role }}` == 'employee' && data == 0 ||
                                    `{{ Auth::user()->role }}` == 'supervisor' && data == 1) {
                                    //action approve reject
                                    let action = `<div class="flex flex-wrap gap-2">
                                        <div class="w-full px-4 lg:w-14 bg-teal-500 hover:bg-teal-700 text-white font-bold py-2 px-2 rounded">
                                            <a href="{{ url('booking/${row.id}/approve') }}" class="">
                                                <span class="text-white font-medium">
                                                    <svg class="w-6 h-6 text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                                                    </svg>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="w-full px-4 lg:w-14 bg-rose-500 hover:bg-rose-700 text-white font-bold py-2 px-2 rounded">
                                            <a href="{{ url('booking/${row.id}/reject') }}" class="">
                                                <span class="text-white font-medium">
                                                    <svg class="w-6 h-6 text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                                    </svg>
                                                </span>
                                            </a>
                                        </div>
                                    </div>`;
                                    return action;
                                } else {
                                    return `<span class="${statusClass} font-medium">${statusText}</span>`;
                                }
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
