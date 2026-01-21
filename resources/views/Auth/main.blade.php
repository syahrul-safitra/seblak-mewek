<!DOCTYPE html>
<html lang="id">

    <head>
        <meta charset="UTF-8">
        <title>@yield("title", "Registrasi Customer")</title>

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Poppins', sans-serif;
                background: linear-gradient(135deg, #ff6b6b, #ff9f43);
                min-height: 100vh;
            }

            .auth-card {
                border: none;
                border-radius: 18px;
            }

            .auth-card h4 {
                color: #e63946;
            }

            .btn-primary {
                background-color: #e63946;
                border: none;
            }

            .btn-primary:hover {
                background-color: #d62839;
            }

            .form-control:focus {
                border-color: #e63946;
                box-shadow: 0 0 0 .2rem rgba(230, 57, 70, .25);
            }

            .auth-left {
                background: linear-gradient(135deg,
                        rgba(230, 57, 70, 0.9),
                        rgba(255, 107, 107, 0.85)),
                    url('/assets/img/bg-seblak.jpg');
                background-size: cover;
                background-position: center;
            }

            .auth-card {
                border-radius: 20px;
            }
        </style>
    </head>

    <body>

        <div class="d-flex align-items-center justify-content-center min-vh-100 container">
            @yield("container")
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>

</html>
