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

      <section id="header" style="background-image: url('img/banner-1.jpg'); background-repeat: no-repeat; background-size: cover; min-height: 400px;">
    <div class="container pt-5 mt-5">
        <h2 class="display-1 ls-1">
            <span class="fw-bold text-primary">Rescue</span> Food
        </h2>
        <p class="fs-4">"قَالَ رَسُولُ اللهِ ﷺ: "خَيْرُ النَّاسِ أَنْفَعُهُمْ لِلنَّاسِ</p>

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


        <!-- Banner -->
        <section id="banner">
            <div class="container">
                <header>
                    <h2 style='color:#FFA500' >Welcome to <strong>RescueFood</strong>!</h2>
                </header>
                <p>Join us in the mission to collect excess food from restaurants and redistribute it to those in need. Together, we can make a difference and reduce food waste.</p>
                <ul class="actions">
                <li><a href="{{ url('/login') }}" class="button icon solid">Login</a></li>
                </ul>
                <ul class="actions">
                <li><a href="{{ url('/login') }}" class="button icon solid">Register as Restaurant</a></li>
                </ul>
            </div>
        </section>

        <!-- Main -->
        <section id="main">
            <div class="container">
                <div class="row">

                    <!-- Content -->
                    <div id="content" class="col-8 col-12-medium">

                        <!-- Post -->
                        <article class="box post">
                            <header>
                                <h2 style='color:#FFA500' ><a href="#">Our Mission to Combat Food Waste</a></h2>
                            </header>
                            <a href="#" class="image featured"><img src="{{ asset('img/front6.jpg') }}" alt="Food Recovery" /></a>
                            <h3 style='color:#FFA500' >Join us in making a change!</h3>
                            <p>At RescueFood, we are dedicated to creating a sustainable food ecosystem where excess food is transformed into opportunities for those in need.</p>
                            <ul class="actions">
                                <li><a href="{{ url('/about') }}" class="button icon solid ">📄 Continue Reading</a></li>
                            </ul>
                        </article>

                        <!-- Post -->
                        <article class="box post">
                            <header>
                                <h2 style='color:#FFA500' ><a href="#">How You Can Help</a></h2>
                            </header>
                            <a href="#" class="image featured"><img src="{{ asset('img/front2.png') }}" alt="Community Support" /></a>
                            <h3 style='color:#FFA500' >Your contribution matters</h3>
                            <p>Whether you are a restaurant owner or a concerned citizen, find out how you can contribute to our efforts in food recovery and redistribution.</p>
                            <ul class="actions">
                                <li><a href="{{ url('/services') }}" class="button icon solid">📄 Continue Reading</a></li>
                            </ul>
                        </article>

                    </div>

                    <!-- Sidebar -->
                    <div id="sidebar" class="col-4 col-12-medium">

                        <!-- Excerpts -->
                        <section>
                            <header>
                                <h3 style='color:#FFA500' >Recent News</h3>
                            </header>
                            <ul class="divided">
                                <li>
                                    <article class="box excerpt">
                                        <header>
                                            <span class="date">September 25</span>
                                            <h3><a href="#">Successful Food Drive</a></h3>
                                        </header>
                                        <p>Our recent food drive collected over 2 tons of food, providing meals for hundreds of families in need.</p>
                                    </article>
                                </li>
                                <li>
                                    <article class="box excerpt">
                                        <header>
                                            <span class="date">September 20</span>
                                            <h3><a href="#">Join Our Volunteer Team!</a></h3>
                                        </header>
                                        <p>We are looking for passionate volunteers to help with food collection and distribution.</p>
                                    </article>
                                </li>
                                <li>
                                    <article class="box excerpt">
                                        <header>
                                            <span class="date">September 15</span>
                                            <h3><a href="#">Tips to Reduce Food Waste</a></h3>
                                        </header>
                                        <p>Learn effective strategies to minimize food waste in your home and community.</p>
                                    </article>
                                </li>
                            </ul>
                        </section>

                        <!-- About -->
                        <section>
                            <header>
                                <h3 style='color:#FFA500' >About Us</h3>
                            </header>
                            <p>We are a non-profit organization focused on addressing food waste while aiding communities in need. Our vision is a world where no food goes to waste.</p>
                        </section>

                    </div>

                </div>
            </div>
        </section>

        <!-- Footer -->
        <section id="footer">
            <div class="container">
                <header>
                    <h2 >Questions or comments? <strong style='color:#FFA500'>Get in touch:</strong></h2>
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
                                        <button type="submit" class="form-button-submit button icon solid ">✉️ Send Message</button>
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
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.dropotron.min.js"></script>
    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>

</body>
</html>
