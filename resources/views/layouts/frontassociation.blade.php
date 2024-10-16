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
            <span class="fw-bold text-primary">Welcome to your </span> Dashboard
        </h2>
        <p class="fs-4">"خَيْرُ الصَّدَقَةِ مَا أَنْفِقَتْ فِي السِّرِّ، وَخَيْرُ الْمَعُونَةِ مَا وَصَلَ إِلَى الْمُحْتَاجِينَ."</p>

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
                    <h2 style='color:#FFA500' ><strong>RescueFood</strong></h2>
                </header>
                <p>Access food donations for your beneficiaries by joining RescueFood. Help us fight hunger and improve the lives of the most vulnerable</p>
                <ul class="actions">
                <li><a href="{{ url('/login') }}" class="button icon solid">Start</a></li>
                </ul>
            </div>
        </section>

        <!-- Main -->
        <section id="main">
            <div class="container">
                <div class="row">

                    <!-- Content -->
                    <div id="content" >

                        <!-- Post -->
                        <article class="box post">
                            <header>
                                <h2 style='color:#FFA500' ><a href="#">How It Works?</a></h2>
                            </header>
                            <a href="#" class="image featured"><img src="{{ asset('img/front6.jpg') }}" alt="Food Recovery" /></a>
                            <h3>
                                1.Register your charitable organization..</h3>
<h3>2.Browse available food donations in your area.</h3>
<h3>3.Request donations based on the needs of your beneficiaries.</h3>
<h3>4.Schedule a pickup or delivery via our logistics network.</h3>
<h2 style='color:#FFA500'>"مَنْ كَانَ فِي حَاجَةِ أَخِيهِ كَانَ اللَّهُ فِي حَاجَتِهِ."
</h2>
                            <ul class="actions">
                                <li><a href="{{ url('/about') }}" class="button icon solid ">Start</a></li>
                            </ul>
                        </article>

                       
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
