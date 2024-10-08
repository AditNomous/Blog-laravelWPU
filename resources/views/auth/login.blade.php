<!doctype html>
<html lang="en">

<head>
    @vite('resources/css/app.css', 'resources/js/app.js')

    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        #rippleCanvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .form-container {
            position: relative;
            z-index: 1;
        }

        .fade-in {
            animation: fadeIn 1s ease-in-out forwards;
        }

        .fade-out {
            animation: fadeOut 1s ease-in-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
                transform: translateY(0);
            }

            to {
                opacity: 0;
                transform: translateY(20px);
            }
        }

        /* Animasi tulisan bergerak/melompat */
        .jump {
            animation: jump 1.5s ease-in-out infinite;
        }

        @keyframes jump {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }
    </style>
</head>

<body class="bg-gradient-to-r from-blue-500 to-purple-600 min-h-screen flex items-center justify-center">

    <!-- Canvas untuk efek ripple -->
    <canvas id="rippleCanvas"></canvas>

    <!-- Form -->
    <div class="form-container w-full max-w-md bg-white bg-opacity-80 p-6 rounded-lg shadow-md backdrop-blur-md">
        <!-- Toggle Button -->
        <div class="text-center mb-4">
            <button id="toggleFormButton" class="text-blue-700 hover:text-blue-900 focus:outline-none transition-colors">
                <span class="jump">Belum punya akun? Yuk daftar</span>
            </button>
        </div>

        <!-- Login Form -->
        <form id="loginForm" action="{{ route('login.store') }}" method="POST" class="space-y-4 fade-in">
            @csrf
            <h2 class="text-xl font-semibold text-center text-gray-800">Login</h2>
            <div class="mb-5">
                <label for="email" class="block text-sm font-medium text-gray-900">Email</label>
                <input name="email" type="email" id="email"
                    class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-500"
                    placeholder="name@flowbite.com" required />
            </div>
            <div class="mb-5">
                <label for="password" class="block text-sm font-medium text-gray-900">Password</label>
                <input name="password" type="password" id="password"
                    class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-500" required />
            </div>
            <div class="mb-5">
                <button type="submit"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 transition-transform transform hover:scale-105 duration-200">Login</button>
            </div>
            <div href="/" class="mb-5">
                <a href="/"
                    class="w-full inline-block text-center text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 transition-transform transform hover:scale-105 duration-200">Login
                    as guest</a>
            </div>
            <div class="text-center mb-4">
                <button id="forgotPasswordButton" type="button"
                    class="text-blue-700 hover:text-blue-900 focus:outline-none transition-colors">
                    Lupa Kata Sandi?
                </button>
            </div>
        </form>

        <!-- Register Form -->
        <form id="registerForm" action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data"
            class="space-y-4 hidden">
            @csrf
            <h2 class="text-xl font-semibold text-center text-gray-800">Register</h2>
            <div class="mb-3">
                <label for="name" class="block text-sm font-medium text-gray-900">Name</label>
                <input type="text" id="name" name="name"
                    class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Your name"
                    value="{{ old('name') }}">
            </div>
            <div class="mb-3">
                <label for="username" class="block text-sm font-medium text-gray-900">Username</label>
                <input type="text" id="username" name="username"
                    class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Your username"
                    value="{{ old('username') }}">
            </div>
            <div class="mb-3">
                <!-- Custom File Input -->
                <label class="block text-sm font-medium text-gray-900 mb-1">Profile Picture</label>
                <label for="profile_picture"
                    class="flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg cursor-pointer hover:bg-blue-700">
                    <span id="fileName" class="mr-2">Choose File</span>
                    <input type="file" id="profile_picture" name="profile_picture" class="hidden" accept="image/*">
                </label>
                <img id="preview" class="mt-3 max-w-xs rounded-lg hidden" alt="Profile Preview">
            </div>
            <div class="mb-3">
                <label for="email" class="block text-sm font-medium text-gray-900">Email address</label>
                <input type="email" id="email" name="email"
                    class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-500"
                    placeholder="name@example.com" value="{{ old('email') }}">
            </div>
            <div class="mb-3">
                <label for="password" class="block text-sm font-medium text-gray-900">Password</label>
                <input type="password" id="password" name="password"
                    class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="password">
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-900">Password
                    Confirmation</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="w-full p-2.5 border rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="password">
            </div>
            <button type="submit"
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 transition-transform transform hover:scale-105 duration-200">Register</button>
        </form>
    </div>

    <!-- Tombol untuk toggle CSS -->


    <script>
        const toggleFormButton = document.getElementById('toggleFormButton');
        const loginForm = document.getElementById('loginForm');
        const registerForm = document.getElementById('registerForm');
        const profilePictureInput = document.getElementById('profile_picture');
        const previewImage = document.getElementById('preview');
        const fileNameDisplay = document.getElementById('fileName');
    

        toggleFormButton.addEventListener('click', () => {
            if (loginForm.classList.contains('fade-in')) {
                loginForm.classList.replace('fade-in', 'fade-out');
                setTimeout(() => {
                    loginForm.classList.add('hidden');
                    registerForm.classList.remove('hidden');
                    registerForm.classList.replace('fade-out', 'fade-in');
                }, 500);
                toggleFormButton.innerHTML = '<span class="jump">Sudah punya akun? Yuk masuk</span>';
            } else {
                registerForm.classList.replace('fade-in', 'fade-out');
                setTimeout(() => {
                    registerForm.classList.add('hidden');
                    loginForm.classList.remove('hidden');
                    loginForm.classList.replace('fade-out', 'fade-in');
                }, 500);
                toggleFormButton.innerHTML = '<span class="jump">Belum punya akun? Yuk daftar</span>';
            }
        });

        profilePictureInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file) {
                previewImage.src = URL.createObjectURL(file);
                previewImage.classList.remove('hidden');
                fileNameDisplay.textContent = file.name;
            }
        });

    
    </script>
</body>

</html>
