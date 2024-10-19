<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>RescueFood - Collect and Redistribute Food</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />
</head>
<body class="homepage is-preload">
    <div id="page-wrapper">

        <section id="header" style="background-color:rgb(119, 163, 201); background-repeat: no-repeat; background-size: cover; min-height: 400px;">
            <div class="container pt-5 mt-5">
                <h2 class="display-1 ls-1">
                    <span class="fw-bold text-primary">Historique des dons </span> Dashboard
                </h2>

                <!-- Nav -->
                <nav id="nav">
                    <ul>
                        <li><a class="icon solid" href="{{ url('/') }}"><span>🏠 Home</span></a></li>
                        <li><a class="icon solid" href="{{ url('/about') }}"><span>ℹ️ About Us</span></a></li>
                        <li><a class="icon solid" href="{{ url('/services') }}"><span>📦 Services</span></a></li>
                        <li><a class="icon solid" href="{{ url('/contact') }}"><span>✉️ Contact</span></a></li>
                    </ul>
                </nav>
            </div>
        </section>

       

      <!-- Main -->
<section id="main">
    <div class="container">
        <h2 class="mt-4 text-primary font-weight-bold">Historique des dons pour le restaurant {{ auth()->user()->username }}</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Boucle à travers chaque groupe de dons classés par date -->
        @foreach($donsGroupedByDate as $date => $dons)
        <div class="card mt-4">
            <div class="card-header">
                <h6 class="mb-0 text-header" style="cursor: pointer;" onclick="toggleTable('{{ $date }}')">
                    Dons du {{ \Carbon\Carbon::parse($date)->format('d M Y') }}
                </h6>
            </div>
            <div class="collapse" id="table-{{ $date }}">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped align-items-center">
                            <thead>
                                <tr>
                                    <th scope="col">Catégorie</th>
                                    <th scope="col">Sous-catégorie</th>
                                    <th scope="col">Quantité</th>
                                    <th scope="col">Date d'ajout</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dons as $don)
                                    <tr>
                                        <td>{{ $don->category }}</td>
                                        <td>{{ $don->sub_category }}</td>
                                        <td>{{ $don->quantity }}</td>
                                        <td>{{ $don->created_at->format('d-m-Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>



                <!-- Bouton pour ajouter un nouveau don -->
                <a href="{{ route('dons.create', ['user_id' => auth()->user()->id]) }}" class="btn btn-primary mt-3">Ajouter un Don</a>
            </div>
        </section>

        <!-- Footer -->
        <section id="footer">
            <div class="container">
                <header>
                    <h2>Questions or comments? <strong style='color:#FFA500'>Get in touch:</strong></h2>
                </header>
                <div class="row">
                    <div class="col-6 col-12-medium">
                        <section>
                            <form method="post" action="#">
                                <div class="row gtr-50">
                                    <div class="col-6 col-12-small">
                                        <input name="name" placeholder="Name" type="text" required />
                                    </div>
                                    <div class="col-6 col-12-small">
                                        <input name="email" placeholder="Email" type="email" required />
                                    </div>
                                    <div class="col-12">
                                        <textarea name="message" placeholder="Message" required></textarea>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="form-button-submit button icon solid">✉️ Send Message</button>
                                    </div>
                                </div>
                            </form>
                        </section>
                    </div>
                    <div class="col-6 col-12-medium">
                        <section>
                            <p>Contact us to learn how you can get involved or support our mission. Together, we can make a significant impact in reducing food waste and helping our communities.</p>
                            <div class="row">
                                <div class="col-6 col-12-small">
                                    <ul class="icons">
                                        <li>
                                            🏠 1234 Rescue Road<br />
                                            Nashville, TN 00000<br />
                                            USA
                                        </li>
                                        <li>
                                            📞 (000) 000-0000
                                        </li>
                                        <li>
                                            ✉️ <a href="mailto:info@rescuefood.org">info@rescuefood.org</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-6 col-12-small">
                                    <ul class="icons">
                                        <li>
                                            🐦 <a href="#">@RescueFood</a>
                                        </li>
                                        <li>
                                            📘 <a href="#">facebook.com/rescuefood</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <div id="copyright" class="container">
                <ul class="links">
                    <li>&copy; RescueFood. All rights reserved.</li>
                    <li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
                </ul>
            </div>
        </section>

    </div>

    <!-- JavaScript pour afficher/masquer les tables -->
    <script>
        function toggleTable(date) {
            document.querySelectorAll('.dons-table').forEach(function(table) {
                table.style.display = 'none';
            });

            const selectedTable = document.getElementById('table-' + date);
            if (selectedTable.style.display === 'none') {
                selectedTable.style.display = 'table';
            } else {
                selectedTable.style.display = 'none';
            }
        }
    </script>
<!-- JavaScript pour afficher/masquer les tables -->
<script>
    function toggleTable(date) {
        const table = document.getElementById('table-' + date);
        if (table.classList.contains('show')) {
            table.classList.remove('show');
        } else {
            table.classList.add('show');
        }
    }
</script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.dropotron.min.js"></script>
    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
