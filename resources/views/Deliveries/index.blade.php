@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Delivery Management'])

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6>Deliveries</h6>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDeliveryModal">
                            Add Delivery
                        </button>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Start Address</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Delivery Address</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Recipient Name</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($deliveries as $delivery)
                                    <tr>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $delivery->start_address }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $delivery->delivery_address }}</p>
                                        </td>
                                        <td>
                                            <p class="text-sm font-weight-bold mb-0">{{ $delivery->recipient_name }}</p>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="badge badge-sm 
                                                @if($delivery->status == 'Pending') bg-gradient-warning 
                                                @elseif($delivery->status == 'Delivered') bg-gradient-success 
                                                @endif">
                                                {{ $delivery->status }}
                                            </span>
                                        </td>
                                        <td class="align-middle text-end">
    <div class="d-flex px-3 py-1 justify-content-center align-items-center">
        <a href="#" data-bs-toggle="modal" data-bs-target="#editDeliveryModal{{ $delivery->id }}" class="text-warning me-3" style="font-size: 1.5rem; margin: 0 10px;">
            ✏️
        </a>
        <form action="{{ route('deliveries.destroy', $delivery->id) }}" method="POST" class="d-inline-block">
            @csrf
            @method('DELETE')
            <a href="#" class="text-danger" onclick="event.preventDefault(); this.closest('form').submit();" style="font-size: 1.5rem; margin: 0 10px;" onclick="return confirm('Are you sure you want to delete this delivery?')">
                🗑️
            </a>
            <a href="#" data-bs-toggle="modal" data-bs-target="#mapModal{{ $delivery->id }}" 
   onclick="setTimeout(() => initMap({{ $delivery->id }}, '{{ $delivery->start_address }}', '{{ $delivery->delivery_address }}'), 500)" 
   class="text-info" style="font-size: 1.5rem; margin: 0 10px;">
   📍
</a>

        </form>
    </div>
</td>

                                    </tr>

                       <!-- Modal for editing delivery -->
<div class="modal fade" id="editDeliveryModal{{ $delivery->id }}" tabindex="-1" aria-labelledby="editDeliveryModalLabel{{ $delivery->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDeliveryModalLabel{{ $delivery->id }}">Edit Delivery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('deliveries.update', $delivery->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="start_address" class="form-label">Start Address</label>
                        <input type="text" class="form-control" id="start_address" name="start_address" value="{{ $delivery->start_address }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="delivery_address" class="form-label">Delivery Address</label>
                        <input type="text" class="form-control" id="delivery_address" name="delivery_address" value="{{ $delivery->delivery_address }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="recipient_name" class="form-label">Recipient Name</label>
                        <input type="text" class="form-control" id="recipient_name" name="recipient_name" value="{{ $delivery->recipient_name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="Pending" {{ $delivery->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Delivered" {{ $delivery->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                        </select>
                    </div>

                    <div class="mb-3">
    <label for="transport_id" class="form-label">Select Driver</label>
    <select class="form-select" id="transport_id" name="transport_id">
        <option value="" {{ !$delivery->transport_id ? 'selected' : '' }}>Select a driver (optional)</option>
        @foreach($availableTransports as $transport)
            <option value="{{ $transport->id }}" {{ $delivery->transport_id == $transport->id ? 'selected' : '' }}>
                {{ $transport->driver_name }} - {{ $transport->vehicle_type }}
            </option>
        @endforeach
    </select>
    @if (count($availableTransports) == 0)
        <small class="text-muted">No drivers available.</small>
    @endif
</div>



                    <button type="submit" class="btn btn-primary">Update Delivery</button>
                </form>
            </div>
        </div>
    </div>
</div>


                                    <!-- Modal for displaying the map -->
                                    <div class="modal fade" id="mapModal{{ $delivery->id }}" tabindex="-1" aria-labelledby="mapModalLabel{{ $delivery->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="mapModalLabel{{ $delivery->id }}">Map for Delivery</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div id="map{{ $delivery->id }}" style="height: 400px; width: 100%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

       <!-- Modal for adding delivery -->
<!-- Modal for adding delivery -->
<div class="modal fade" id="addDeliveryModal" tabindex="-1" aria-labelledby="addDeliveryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDeliveryModalLabel">Add Delivery</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('deliveries.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="start_address" class="form-label">Start Address</label>
                        <input type="text" class="form-control" id="start_address" name="start_address" required>
                    </div>
                    <div class="mb-3">
                        <label for="delivery_address" class="form-label">Delivery Address</label>
                        <input type="text" class="form-control" id="delivery_address" name="delivery_address" required>
                    </div>
                    <div class="mb-3">
                        <label for="recipient_name" class="form-label">Recipient Name</label>
                        <input type="text" class="form-control" id="recipient_name" name="recipient_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="Pending">Pending</option>
                            <option value="Delivered">Delivered</option>
                        </select>
                    </div>

                    <!-- Liste des transporteurs disponibles -->
                    <div class="mb-3">
                        <label for="transport_id" class="form-label">Select Driver</label>
                        <select class="form-select" id="transport_id" name="transport_id" required>
                            <option value="" selected disabled>Select a driver</option>
                            @foreach($availableTransports as $transport)
                                <option value="{{ $transport->id }}">{{ $transport->driver_name }} - {{ $transport->vehicle_type }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Delivery</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Load Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

<!-- Load Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<!-- Load Leaflet Routing Machine CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.css" />

<!-- Load Leaflet Routing Machine JS -->
<script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

<script>
    window.initMap = function(deliveryId, startAddress, deliveryAddress) {
        const map = L.map('map' + deliveryId).setView([48.865, 2.321], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 17,
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        let startCoords, deliveryCoords;
        let isStartCoordsReady = false;
        let isDeliveryCoordsReady = false;

        function geocodeAddress(address, callback) {
            fetch(`https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(address)}&format=json&addressdetails=1`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        const coords = [parseFloat(data[0].lat), parseFloat(data[0].lon)];
                        callback(coords);
                    } else {
                        console.error('Address not found:', address);
                    }
                })
                .catch(error => console.error('Error fetching coordinates:', error));
        }

        geocodeAddress(startAddress, (coords) => {
            startCoords = coords;
            isStartCoordsReady = true;
            checkAndAddMarkers();
        });

        geocodeAddress(deliveryAddress, (coords) => {
            deliveryCoords = coords;
            isDeliveryCoordsReady = true;
            checkAndAddMarkers();
        });

        function checkAndAddMarkers() {
            if (isStartCoordsReady && isDeliveryCoordsReady) {
                // Add markers
                L.marker(startCoords).addTo(map).bindPopup('Start: ' + startAddress);
                L.marker(deliveryCoords).addTo(map).bindPopup('Delivery: ' + deliveryAddress);

                updateMapBounds();
                addRouting(startCoords, deliveryCoords);
            }
        }

        function updateMapBounds() {
            const group = L.featureGroup([L.marker(startCoords), L.marker(deliveryCoords)]);
            map.fitBounds(group.getBounds());
        }

        function addRouting(startCoords, deliveryCoords) {
            L.Routing.control({
                waypoints: [
                    L.latLng(startCoords[0], startCoords[1]),
                    L.latLng(deliveryCoords[0], deliveryCoords[1])
                ],
                router: L.Routing.osrmv1({
                    serviceUrl: 'https://router.project-osrm.org/route/v1', // URL du service OSRM
                }),
                routeWhileDragging: true,
            }).addTo(map);
        }
    }
</script>




    </div>
@endsection
