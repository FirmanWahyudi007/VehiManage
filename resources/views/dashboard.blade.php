<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-wrap">
                @if (auth()->user()->role == 'admin')
                    <x-card title="Vehicles" :value="$vehicles ?? 1" />
                    <x-card title="Drivers" :value="$drivers ?? 2" />
                    <x-card title="Users" :value="$users ?? 1" />
                @endif
                <x-card title="Orders" :value="$bookings ?? 1" />
                <x-card title="Pending" :value="$pending ?? 1" />
                <x-card title="Approve" :value="$approved ?? 1" />
                <x-card title="Reject" :value="$rejected ?? 1" />
            </div>
            <div class="bg-white w-full overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
            @if (auth()->user()->role == 'admin')
                <div class="bg-white w-full overflow-hidden shadow-sm sm:rounded-lg mt-10">
                    <div class="p-6 text-gray-900">
                        <canvas id="vehicleUsageChart"></canvas>
                    </div>
                </div>
            @endif
        </div>
        @if (auth()->user()->role == 'admin')
            <x-slot name="additionalScripts">
                <script>
                    const usageData = @json($usageData);
                    console.log(usageData);
                    const monthLabels = [
                        "January", "February", "March", "April", "May", "June",
                        "July", "August", "September", "October", "November", "December"
                    ];

                    // Membuat objek data yang berisi informasi per kendaraan
                    const vehicleData = {};
                    usageData.forEach(item => {
                        if (!vehicleData[item.license_plate]) {
                            vehicleData[item.license_plate] = {
                                label: item.merk + " " + item.license_plate,
                                data: Array(12).fill(0), // Data untuk setiap bulan
                                backgroundColor: `rgba(${Math.random() * 255},${Math.random() * 255},${Math.random() * 255},0.2)`,
                                borderColor: `rgba(${Math.random() * 255},${Math.random() * 255},${Math.random() * 255},1)`,
                                borderWidth: 1,
                            };
                        }
                        vehicleData[item.license_plate].data[item.month - 1] = item.total;
                    });

                    const data = {
                        labels: monthLabels,
                        datasets: Object.values(vehicleData),
                    };

                    const ctx = document.getElementById("vehicleUsageChart").getContext("2d");
                    const vehicleUsageChart = new Chart(ctx, {
                        type: "bar",
                        data: data,
                        options: {
                            scales: {
                                x: {
                                    grid: {
                                        display: false // Menonaktifkan garis sumbu X
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    stepSize: 1,
                                    grid: {
                                        display: false // Menonaktifkan garis sumbu Y
                                    }
                                },
                            },
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top',
                                    labels: {
                                        font: {
                                            size: 16,
                                        }
                                    }
                                },
                                title: {
                                    display: true,
                                    text: 'Vehicle Usage Chart',
                                    font: {
                                        size: 20,
                                    }
                                }
                            }
                        },
                    });
                </script>
            </x-slot>
        @endif
</x-app-layout>
