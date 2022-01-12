<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Landing Page With Light/Dark Mode</title>
    <link rel="stylesheet" href="asset/style.css"/>
</head>
<body>
<main>
    <div class="big-wrapper light">
        <img src="./img/shape.png" alt="" class="shape"/>

        <header>
            <div class="container">
                <div class="logo">
                    <img src="asset/img/jg.png" alt="Logo"/>
                    <h3>Aplikasi Kelola Wilayah RT</h3>
                </div>

                <div class="links">
                    <ul>
                        <li><a href="{{ route('login') }}">Features</a></li>
                        <li><a href="{{ route('login') }}" class="btn">Sign In</a></li>
                    </ul>
                </div>

                <div class="overlay"></div>

                <div class="hamburger-menu">
                    <div class="bar"></div>
                </div>
            </div>
        </header>

        <div class="showcase-area">
            <div class="container">
                <div class="left">
                    <div class="big-title">
                        <h1>Future is here,</h1>
                        <h1>Start Exploring now.</h1>
                    </div>
                    <p class="text">
                        Aplikasi yang dapat mendokumentasikan Data Wilayah Anda dengan Akses Penuh yang dapat diakses
                        Realtime dalam 24 Jam.
                    </p>
                    <div class="cta">
                        <a href="{{ route('login') }}" class="btn">Get started</a>
                    </div>
                </div>

                <div class="right">
                    <img src="asset/img/person.svg" alt="Person Image" class="person"/>
                </div>
            </div>
        </div>

        <div class="bottom-area">
            <div class="container">
                <button class="toggle-btn">
                    <i class="far fa-moon"></i>
                    <i class="far fa-sun"></i>
                </button>
            </div>
        </div>
    </div>
</main>

<!-- JavaScript Files -->

<script src="https://kit.fontawesome.com/a81368914c.js"></script>
<script src="asset/app.js"></script>
</body>
</html>
