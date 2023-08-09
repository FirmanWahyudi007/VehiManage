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
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Create Booking') }}
                            </h2>
                        </header>
                        @include('booking.partials.create-booking-form')
                    </section>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="additionalScripts">
        <script>
            $(document).ready(function() {

                $('#searchUser').select2({
                    placeholder: 'Select an user',
                    ajax: {
                        url: "{{ route('autocomplete.users') }}",
                        dataType: 'json',
                        delay: 250,
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: item.name + ' - ' + item.phone_number,
                                        id: item.id
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });
                $('#searchDriver').select2({
                    placeholder: 'Select an driver',
                    ajax: {
                        url: "{{ route('autocomplete.drivers') }}",
                        dataType: 'json',
                        delay: 250,
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: item.name + ' - ' + item.phone_number,
                                        id: item.id
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });
                $('#searchVehicles').select2({
                    placeholder: 'Select an user',
                    ajax: {
                        url: "{{ route('autocomplete.vehicles') }}",
                        dataType: 'json',
                        delay: 250,
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: item.merk + ' - ' + item.type + '-' + item
                                            .license_plate,
                                        id: item.id
                                    }
                                })
                            };
                        },
                        cache: true
                    }
                });
            });
        </script>
    </x-slot>
</x-app-layout>
