<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Location de Voitures</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="{{ asset('images/téléchargement.jpeg') }}">
    <style>
        body {
            background-image: url('{{ asset("images/login-bg.jpg") }}'); /* <-- replace with your image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            position: relative;
        }
        /* dark overlay */
        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(2px);
            z-index: 0;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen px-4 relative">

    <!-- Login card -->
    <div class="bg-white/90 backdrop-blur-md p-8 rounded-2xl shadow-2xl w-full max-w-md relative z-10">
        <h2 class="text-3xl font-bold mb-6 text-center text-gray-800">Connexion à votre compte</h2>

        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-4 border border-red-300">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}" class="space-y-5">
            @csrf 

            <!-- Email -->
            <div>
                <label for="email" class="block text-gray-700 font-medium mb-1">Email :</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" 
                    placeholder="exemple@gmail.com"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-150">
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-gray-700 font-medium mb-1">Mot de passe :</label>
                <div class="relative">
                    <input type="password" name="password" id="password"
                        placeholder="••••••••"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none pr-12 transition duration-150">
                    <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 px-4 flex items-center text-gray-600">
                        <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <svg id="eyeSlashIcon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hidden">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.243 4.243L6.228 6.228" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Forgot Password -->
            <div class="flex items-center justify-between">
                <a href="#" class="text-sm text-blue-600 hover:underline">Mot de passe oublié ?</a>
            </div>

            <!-- Submit -->
            <button type="submit" class="w-full bg-blue-600 text-white p-3 rounded-lg hover:bg-blue-700 active:scale-[.98] transition duration-200 shadow-md">
                Se connecter
            </button>

            <!-- Back -->
            <a href="{{ route('home') }}" class="block w-full bg-gray-600 text-white p-3 rounded-lg hover:bg-gray-700 text-center transition duration-200">
                ← Retour
            </a>
        </form>

        <!-- Register -->
        <p class="mt-6 text-center text-gray-700">
            Pas encore de compte ? 
            <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:underline">Créer un compte</a>
        </p>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        const eyeSlashIcon = document.getElementById('eyeSlashIcon');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            eyeIcon.classList.toggle('hidden');
            eyeSlashIcon.classList.toggle('hidden');
        });
    </script>

</body>
</html>
