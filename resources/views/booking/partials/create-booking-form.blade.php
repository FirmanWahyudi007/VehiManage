<form method="post" action="{{ route('booking.store') }}" class="mt-6 space-y-6">
    @csrf
    <div>
        <x-input-label for="user_id" :value="__('User')" />
        <select name="user_id" id="searchUser"
            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            <option value="">Select User</option>
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('user_id')" />
    </div>
    <div>
        <x-input-label for="driver_id" :value="__('Driver')" />
        <select name="driver_id" id="searchDriver"
            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            <option value="">Select User</option>
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('driver_id')" />
    </div>
    <div>
        <x-input-label for="vehicle_id" :value="__('Vehicles')" />
        <select name="vehicle_id" id="searchVehicles"
            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            <option value="">Select User</option>
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('vehicle_id')" />
    </div>
    <div>
        <x-input-label for="pickup_location" :value="__('Pickup Location')" />
        <x-text-input id="pickup_location" name="pickup_location" type="text" class="mt-1 block w-full"
            :value="old('pickup_location')" required autofocus autocomplete="pickup_location" />
        <x-input-error class="mt-2" :messages="$errors->get('pickup_location')" />
    </div>
    <div>
        <x-input-label for="destination" :value="__('Destination')" />
        <x-text-input id="destination" name="destination" type="text" class="mt-1 block w-full" :value="old('destination')"
            required autofocus autocomplete="destination" />
        <x-input-error class="mt-2" :messages="$errors->get('pickup_location')" />
    </div>
    <div class="w-full">
        <x-input-label for="pickup_date" :value="__('Date')" />
        <div class="flex flex-wrap justify-between">
            <div class="w-full lg:w-[425px]">
                <x-text-input id="pickup_date" name="pickup_date" type="date" class="mt-1 block w-full"
                    :value="old('pickup_date')" required autofocus autocomplete="pickup_date" />
                <x-input-error class="mt-2" :messages="$errors->get('pickup_date')" />
            </div>
            <div class="w-full lg:w-1/4 ">
                <x-text-input id="pickup_time" name="pickup_time" type="time" class="mt-1 block w-full"
                    :value="old('pickup_time')" required autofocus autocomplete="pickup_time" />
                <x-input-error class="mt-2" :messages="$errors->get('pickup_time')" />
            </div>
        </div>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>{{ __('Save') }}</x-primary-button>
    </div>
</form>
