<x-app-layout>
    @php
    // Hardcoded Services Data - Change these values
    $services = [
        [
            'id' => 1,
            'name' => 'Classic Haircut',
            'price' => 30,
            'description' => 'Traditional haircut with scissors and clipper',
            'is_active' => true,
            'duration_minutes' => 30
        ],
        [
            'id' => 2,
            'name' => 'Premium Haircut',
            'price' => 45,
            'description' => 'Premium haircut with consultation and styling',
            'is_active' => true,
            'duration_minutes' => 45
        ],
        [
            'id' => 3,
            'name' => 'Beard Trim',
            'price' => 20,
            'description' => 'Professional beard trimming and shaping',
            'is_active' => true,
            'duration_minutes' => 20
        ],
        [
            'id' => 4,
            'name' => 'Haircut & Beard Combo',
            'price' => 45,
            'description' => 'Complete haircut and beard grooming package',
            'is_active' => true,
            'duration_minutes' => 50
        ],
        [
            'id' => 5,
            'name' => 'Hot Towel Shave',
            'price' => 35,
            'description' => 'Traditional hot towel straight razor shave',
            'is_active' => true,
            'duration_minutes' => 40
        ],
        [
            'id' => 6,
            'name' => 'Kids Haircut',
            'price' => 25,
            'description' => 'Haircut for children under 12 years',
            'is_active' => true,
            'duration_minutes' => 25
        ],
        [
            'id' => 7,
            'name' => 'Fade & Line Up',
            'price' => 40,
            'description' => 'Modern fade haircut with sharp line up',
            'is_active' => true,
            'duration_minutes' => 35
        ],
        [
            'id' => 8,
            'name' => 'Hair Coloring',
            'price' => 60,
            'description' => 'Professional hair coloring service',
            'is_active' => false,
            'duration_minutes' => 60
        ],
    ];
@endphp

{{-- Main Content --}}
<div class="min-h-screen bg-base-200 p-6">
    <div class="mx-auto max-w-7xl space-y-6">
        
        {{-- Header --}}
        <div class="flex items-center justify-between">
            <div class="space-y-2">
                <h1 class="text-3xl font-bold">Upravljanje Uslugama</h1>
                <p class="text-base-content/60">Upravljaj uslugama i cenama svog salona</p>
            </div>
            <button class="btn btn-primary" onclick="openAddModal()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add New Service
            </button>
        </div>

        {{-- Stats Cards --}}
        <div class="grid gap-4 md:grid-cols-4">
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <h2 class="card-title text-sm font-medium">Total Services</h2>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold">{{ count($services) }}</div>
                    <p class="text-xs opacity-60">Available services</p>
                </div>
            </div>

            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <h2 class="card-title text-sm font-medium">Active Services</h2>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold">{{ collect($services)->where('is_active', true)->count() }}</div>
                    <p class="text-xs opacity-60">Currently active</p>
                </div>
            </div>

            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <h2 class="card-title text-sm font-medium">Avg. Price</h2>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold">${{ number_format(collect($services)->avg('price'), 2) }}</div>
                    <p class="text-xs opacity-60">Average service price</p>
                </div>
            </div>

            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <h2 class="card-title text-sm font-medium">Avg. Duration</h2>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 opacity-60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="text-2xl font-bold">{{ round(collect($services)->avg('duration_minutes')) }} min</div>
                    <p class="text-xs opacity-60">Average duration</p>
                </div>
            </div>
        </div>

        {{-- Services Table --}}
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h2 class="card-title mb-4">All Services</h2>
                
                <div class="overflow-x-auto">
                    <table class="table table-zebra ">
                        <thead>
                            <tr>
                                <th>Service Name</th>
                                <th>Price</th>
                                <th>Duration</th>
                                <th>Status</th>
                                <th>Description</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($services as $service)
                            <tr>
                                <td class="font-medium">{{ $service['name'] }}</td>
                                <td>${{ $service['price'] }}</td>
                                <td>{{ $service['duration_minutes'] }} min</td>
                                <td>
                                    @if($service['is_active'])
                                        <span class="badge badge-success gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            Active
                                        </span>
                                    @else
                                        <span class="badge badge-ghost gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            Inactive
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="max-w-xs truncate">{{ $service['description'] }}</div>
                                </td>
                                <td class="text-right">
                                    <div class="flex gap-2 justify-end">
                                        <button class="btn btn-sm btn-info" onclick="openEditModal({{ $service['id'] }})">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                            Edit
                                        </button>
                                        <button class="btn btn-sm btn-error" onclick="openDeleteModal({{ $service['id'] }}, '{{ $service['name'] }}')">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- <div class="grid grid-cols-1 gap-4 md:hidden">
                    @foreach($services as $service)
                    <div class="card bg-base-100 shadow-md p-4 border-l-4 border-primary">
                        <div class="flex justify-between items-start">
                            <h3 class="font-bold text-lg">{{ $service['name'] }}</h3>
                            <span class="badge badge-success text-xs">{{ $service['price'] }} din</span>
                        </div>
                        <p class="text-sm opacity-70 my-2">{{ $service['description'] }}</p>
                        <div class="flex justify-end gap-2 mt-2">
                            <button class="btn btn-sm btn-info">Edit</button>
                            <button class="btn btn-sm btn-error">Delete</button>
                        </div>
                    </div>
                    @endforeach
                </div> --}}
            </div>
        </div>

    </div>
</div>

{{-- Add/Edit Service Modal --}}
<dialog id="serviceModal" class="modal">
    <div class="modal-box w-11/12 max-w-2xl">
        <h3 class="font-bold text-lg mb-4" id="modalTitle">Add New Service</h3>
        
        <form method="dialog">
            <div class="space-y-4">
                {{-- Service Name --}}
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Service Name</span>
                    </label>
                    <input type="text" placeholder="e.g., Premium Haircut" class="input input-bordered" id="serviceName" />
                </div>

                {{-- Price and Duration --}}
                <div class="grid grid-cols-2 gap-4">
                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Price ($)</span>
                        </label>
                        <input type="number" placeholder="30" step="0.01" class="input input-bordered" id="servicePrice" />
                    </div>

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text">Duration (minutes)</span>
                        </label>
                        <input type="number" placeholder="30" class="input input-bordered" id="serviceDuration" />
                    </div>
                </div>

                {{-- Description --}}
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Description</span>
                    </label>
                    <textarea class="textarea textarea-bordered h-24" placeholder="Describe the service..." id="serviceDescription"></textarea>
                </div>

                {{-- Is Active --}}
                <div class="form-control">
                    <label class="label cursor-pointer justify-start gap-4">
                        <input type="checkbox" class="toggle toggle-success" id="serviceActive" checked />
                        <span class="label-text">Service is Active</span>
                    </label>
                </div>
            </div>

            <div class="modal-action">
                <button type="button" class="btn btn-ghost" onclick="closeServiceModal()">Cancel</button>
                <button type="button" class="btn btn-primary" onclick="saveService()">Save Service</button>
            </div>
        </form>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

{{-- Delete Confirmation Modal --}}
<dialog id="deleteModal" class="modal">
    <div class="modal-box">
        <h3 class="font-bold text-lg">Confirm Delete</h3>
        <p class="py-4">Are you sure you want to delete the service "<span id="deleteServiceName" class="font-semibold"></span>"? This action cannot be undone.</p>
        <div class="modal-action">
            <form method="dialog">
                <button class="btn btn-ghost">Cancel</button>
                <button class="btn btn-error" onclick="confirmDelete()">Delete</button>
            </form>
        </div>
    </div>
    <form method="dialog" class="modal-backdrop">
        <button>close</button>
    </form>
</dialog>

<script>
    let currentServiceId = null;
    let deleteServiceId = null;

    // Open Add Modal
    function openAddModal() {
        document.getElementById('modalTitle').textContent = 'Add New Service';
        document.getElementById('serviceName').value = '';
        document.getElementById('servicePrice').value = '';
        document.getElementById('serviceDuration').value = '';
        document.getElementById('serviceDescription').value = '';
        document.getElementById('serviceActive').checked = true;
        currentServiceId = null;
        document.getElementById('serviceModal').showModal();
    }

    // Open Edit Modal
    function openEditModal(serviceId) {
        // In a real app, you would fetch the service data by ID
        document.getElementById('modalTitle').textContent = 'Edit Service';
        
        // Example data - replace with actual data fetch
        document.getElementById('serviceName').value = 'Classic Haircut';
        document.getElementById('servicePrice').value = '30';
        document.getElementById('serviceDuration').value = '30';
        document.getElementById('serviceDescription').value = 'Traditional haircut with scissors and clipper';
        document.getElementById('serviceActive').checked = true;
        
        currentServiceId = serviceId;
        document.getElementById('serviceModal').showModal();
    }

    // Close Service Modal
    function closeServiceModal() {
        document.getElementById('serviceModal').close();
    }

    // Save Service
    function saveService() {
        const name = document.getElementById('serviceName').value;
        const price = document.getElementById('servicePrice').value;
        const duration = document.getElementById('serviceDuration').value;
        const description = document.getElementById('serviceDescription').value;
        const isActive = document.getElementById('serviceActive').checked;

        // Validation
        if (!name || !price || !duration) {
            alert('Please fill in all required fields');
            return;
        }

        // In a real app, you would submit this data to your Laravel backend
        console.log('Saving service:', {
            id: currentServiceId,
            name,
            price,
            duration,
            description,
            is_active: isActive
        });

        // Show success message
        alert(currentServiceId ? 'Service updated successfully!' : 'Service added successfully!');
        
        // Close modal
        closeServiceModal();
        
        // In a real app, you would reload the page or update the table
        // location.reload();
    }

    // Open Delete Modal
    function openDeleteModal(serviceId, serviceName) {
        deleteServiceId = serviceId;
        document.getElementById('deleteServiceName').textContent = serviceName;
        document.getElementById('deleteModal').showModal();
    }

    // Confirm Delete
    function confirmDelete() {
        // In a real app, you would send a delete request to your Laravel backend
        console.log('Deleting service:', deleteServiceId);
        
        // Show success message
        alert('Service deleted successfully!');
        
        // Close modal
        document.getElementById('deleteModal').close();
        
        // In a real app, you would reload the page or update the table
        // location.reload();
    }
</script>
</x-app-layout>