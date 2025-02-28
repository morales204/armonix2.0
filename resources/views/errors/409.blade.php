<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ERROR 409</title>

    <style id="" media="all">
        /* vietnamese */
        @font-face {
            font-family: 'Josefin Sans';
            font-style: normal;
            font-weight: 400;
            src: url(/fonts.gstatic.com/s/josefinsans/v17/Qw3aZQNVED7rKGKxtqIqX5EUAnx4RHw.woff2) format('woff2');
            unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
        }

        /* latin-ext */
        @font-face {
            font-family: 'Josefin Sans';
            font-style: normal;
            font-weight: 400;
            src: url(/fonts.gstatic.com/s/josefinsans/v17/Qw3aZQNVED7rKGKxtqIqX5EUA3x4RHw.woff2) format('woff2');
            unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        /* latin */
        @font-face {
            font-family: 'Josefin Sans';
            font-style: normal;
            font-weight: 400;
            src: url(/fonts.gstatic.com/s/josefinsans/v17/Qw3aZQNVED7rKGKxtqIqX5EUDXx4.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        /* vietnamese */
        @font-face {
            font-family: 'Josefin Sans';
            font-style: normal;
            font-weight: 700;
            src: url(/fonts.gstatic.com/s/josefinsans/v17/Qw3aZQNVED7rKGKxtqIqX5EUAnx4RHw.woff2) format('woff2');
            unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
        }

        /* latin-ext */
        @font-face {
            font-family: 'Josefin Sans';
            font-style: normal;
            font-weight: 700;
            src: url(/fonts.gstatic.com/s/josefinsans/v17/Qw3aZQNVED7rKGKxtqIqX5EUA3x4RHw.woff2) format('woff2');
            unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        /* latin */
        @font-face {
            font-family: 'Josefin Sans';
            font-style: normal;
            font-weight: 700;
            src: url(/fonts.gstatic.com/s/josefinsans/v17/Qw3aZQNVED7rKGKxtqIqX5EUDXx4.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

    </style>

    <style>
        * {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        body {
            padding: 0;
            margin: 0;
        }

        #notfound {
            position: relative;
            height: 100vh;
            background-color: #222;
        }

        #notfound .notfound {
            position: absolute;
            left: 50%;
            top: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

        .notfound {
            max-width: 460px;
            width: 100%;
            text-align: center;
            line-height: 1.4;
        }

        .notfound .notfound-404 {
            height: 158px;
            line-height: 153px;
        }

        .notfound .notfound-404 h1 {
            font-family: josefin sans, sans-serif;
            color: #222;
            font-size: 220px;
            letter-spacing: 10px;
            margin: 0;
            font-weight: 700;
            text-shadow: 2px 2px 0 #c9c9c9, -2px -2px 0 #c9c9c9;
        }

        .notfound .notfound-404 h1>span {
            text-shadow: 2px 2px 0 #e08e7c, -2px -2px 0 #e08e7c, 0 0 8px #e08e7c;
        }

        .notfound p {
            font-family: josefin sans, sans-serif;
            color: #c9c9c9;
            font-size: 16px;
            font-weight: 400;
            margin-top: 0;
            margin-bottom: 15px;
        }

        .notfound a {
            font-family: josefin sans, sans-serif;
            font-size: 14px;
            text-decoration: none;
            text-transform: uppercase;
            background: 0 0;
            color: #c9c9c9;
            border: 2px solid #c9c9c9;
            display: inline-block;
            padding: 10px 25px;
            font-weight: 700;
            -webkit-transition: .2s all;
            transition: .2s all;
        }

        .notfound a:hover {
            color: #ffab00;
            border-color: #ffab00;
        }

        .notfound img {
            display: block;
            margin: 20px auto; /* Centrado horizontal */
            max-width: 250px; /* Limita el ancho máximo de la imagen */
            height: auto; /* Mantiene las proporciones originales */
            border-radius: 15px; /* Bordes redondeados */
        }

        @media only screen and (max-width:480px) {
            .notfound .notfound-404 {
                height: 122px;
                line-height: 122px;
            }

            .notfound .notfound-404 h1 {
                font-size: 122px;
            }
        }
    </style>

    <meta name="robots" content="noindex, follow">
</head>

<body>
    <div id="conflict">
        <div class="conflict">
            <div class="conflict-409">
                <h1>4<span>0</span>9</h1> <!-- Cambio de 404 409 -->
            </div>
            <br>
            <p>La petición no se pudo completar porque hubo un problema con ella..</p> <!-- Mensaje de error 409 -->
            <!--  <a href="#">home page</a> -->
            <img src="{{ asset('osin.webp')}}" alt="Error 409"> <!-- Imagen asociada -->
        </div>
    </div>
</body>

</html>
