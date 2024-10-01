<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/img/favicon.png">
    <title>
        Argon Dashboard 2 by Creative Tim
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- CSS Files -->
    <link id="pagestyle" href="assets/css/argon-dashboard.css" rel="stylesheet" />
</head>

<body class="{{ $class ?? '' }}">

    @guest
        @yield('content')
    @endguest

    @auth
        @if (in_array(request()->route()->getName(), ['sign-in-static', 'sign-up-static', 'login', 'register', 'recover-password', 'rtl', 'virtual-reality']))
            @yield('content')
        @else
            @if (!in_array(request()->route()->getName(), ['profile', 'profile-static']))
                <div class="min-height-300 bg-primary position-absolute w-100"></div>
            @elseif (in_array(request()->route()->getName(), ['profile-static', 'profile']))
                <div class="position-absolute w-100 min-height-300 top-0" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/profile-layout-header.jpg'); background-position-y: 50%;">
                    <span class="mask bg-primary opacity-6"></span>
                </div>
            @endif
            @include('layouts.navbars.auth.sidenav')
                <main class="main-content border-radius-lg">
                    @yield('content')
                </main>
            @include('components.fixed-plugin')
        @endif
    @endauth

    <!--   Core JS Files   -->
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    <!-- Include jQuery from a CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="assets/js/argon-dashboard.js"></script>
    
    <script>
        function openEditModal(restaurant) {
            // Set the values in the modal fields based on the restaurant data
            document.getElementById('restaurantId').value = restaurant.id || '';
            document.getElementById('name').value = restaurant.name || '';
            document.getElementById('address').value = restaurant.address || '';
            document.getElementById('contact_person').value = restaurant.contact_person || '';
            document.getElementById('contact_number').value = restaurant.contact_number || '';
            
            // Show the modal
            var modal = new bootstrap.Modal(document.getElementById('createUpdateModal'));
            modal.show();
        }
    
        function submitForm() {
    const form = document.getElementById('createUpdateForm');
    
    // Créer un objet JSON à partir des champs du formulaire
    const restaurantId = document.getElementById('restaurantId').value;
    const formData = {
        id: restaurantId || null,
        name: document.getElementById('name').value,
        address: document.getElementById('address').value,
        contact_person: document.getElementById('contact_person').value,
        contact_number: document.getElementById('contact_number').value
    };

    // URL API basée sur la route (mise à jour ou création)
    const url = restaurantId ? `{{ route('restaurants.update', '') }}/${restaurantId}` : '{{ route('restaurants.store') }}';

    // Méthode HTTP (PUT si id existe, POST sinon)
    const method = restaurantId ? 'PUT' : 'POST';

    // Récupération du token CSRF
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Envoi de la requête via Fetch en format JSON
    fetch(url, {
        method: method,
        body: JSON.stringify(formData), // Convertir les données en JSON
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': csrfToken, // Inclure le token CSRF
            'Content-Type': 'application/json', // Définir l'en-tête Content-Type comme JSON
        },
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => {
                throw new Error(err.message || 'Erreur de validation');
            });
        }
        return response.json();
    })
    .then(data => {
        console.log('Success:', data);
        $('#createUpdateModal').modal('hide');
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error: ' + error.message); // Afficher l'erreur
    });
}

function loadRestaurants() {
    // Fetch the list of restaurants from the server
    fetch('{{ route('restaurants.index') }}') // Adjust the route according to your setup
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to load restaurants');
            }
            return response.json();
        })
        .then(data => {
            const restaurantList = document.getElementById('restaurantList'); // Replace with your actual element ID
            restaurantList.innerHTML = ''; // Clear existing data
            
            // Populate the restaurant list
            data.forEach(restaurant => {
                const listItem = document.createElement('li'); // Adjust according to your layout
                listItem.textContent = `${restaurant.name} - ${restaurant.address}`; // Adjust according to your data
                restaurantList.appendChild(listItem);
            });
        })
        .catch(error => {
            console.error('Error loading restaurants:', error);
            alert('Error loading restaurants: ' + error.message);
        });
}

    </script>
    
    
    
    @stack('js');

</body>
<!-- Include the modal component -->
@include('components.create-update-modal')

<!-- Trigger button (for testing or as needed) -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createUpdateModal">
    Create Record
</button>

</html>
