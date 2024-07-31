<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - The Next Level</title>
    <link rel="stylesheet" href="/{{BASE_DIR}}/public/css/stylesLogin.css" />
</head>
<body>
    <div class="login-container">
        <div class="overlay">
            <h1>THE NEXT LEVEL</h1>
            <form class="login-form">
                <h2>Iniciar Sesión</h2>
                <div class="form-group">
                    <label for="username">Usuario:</label>
                    <input type="text" id="username" name="username" placeholder="Ingresa tu usuario" required>
                </div>
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <div class="password-container">
                        <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>
                        <span class="password-toggle" onclick="togglePasswordVisibility()">
                            <img src="https://cdn-icons-png.flaticon.com/128/709/709612.png" alt="Mostrar/Ocultar Contraseña">
                        </span>
                    </div>
                </div>
                <div class="form-buttons">
                    <button type="submit" class="btn">Iniciar Sesión</button>
                    <a href="register.html" class="btn register-btn">Registrarse</a>
                </div>
            </form>
        </div>
        <img src="https://media2.giphy.com/media/6i0Laybh66V5xPm9YF/giphy.webp?cid=790b7611ex5xnuvo1p3e3u29cid8etl77xakpv1l70a3pz7d&ep=v1_gifs_search&rid=giphy.webp&ct=g" alt="Suplementos de gym">
    </div>
    <script>
        function togglePasswordVisibility() {
            var passwordField = document.getElementById('password');
            var passwordToggle = document.querySelector('.password-toggle img');
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                passwordToggle.src = 'https://cdn-icons-png.flaticon.com/128/709/709724.png'; // Ojo abierto
            } else {
                passwordField.type = 'password';
                passwordToggle.src = 'https://cdn-icons-png.flaticon.com/128/709/709612.png'; // Ojo cerrado
            }
        }
    </script>
</body>
</html>








