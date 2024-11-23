<x-guest-layout>
    <div class="bg-gradient-to-r from-gray-900 via-purple-900 to-violet-900 text-white shadow-lg flex items-center justify-center p-6">
        <div class="max-w-lg w-full bg-white rounded-3xl shadow-2xl overflow-hidden">
            <div class="relative">
                <div class="relative p-10"> <!-- Increased padding for a spacious layout -->
                    <div class="flex items-center justify-center mb-6 group">
                        <div class="relative">
                            <!-- Logo -->
                            <img class="w-20 h-20 z-10 relative" src="{{ asset('img/Logo.png') }}" alt="logo">
                            <!-- Spinning colorful background -->
                            <div class="absolute -inset-0.5 bg-gradient-to-r from-pink-600 to-purple-600 rounded-lg blur opacity-0 group-hover:opacity-100 transition duration-5000 group-hover:duration-100 animate-spin">
                                <div class="w-full h-full bg-gradient-to-r from-pink-600 via-purple-600 to-blue-500 clip-path-abstract"></div>
                            </div>
                        </div>
                    </div>
                    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-6">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-2 focus:ring-purple-600 block w-full p-4 transition duration-300 hover:border-purple-500 focus:outline-none transform transition-transform duration-200 ease-in-out hover:scale-105 focus:scale-105"
                                placeholder="name@company.com" required>
                        </div>
                        <div class="mb-6">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-700">Password</label>
                            <input type="password" name="password" id="password"
                                class="bg-gray-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-2 focus:ring-purple-600 block w-full p-4 transition duration-300 hover:border-purple-500 focus:outline-none transform transition-transform duration-200 ease-in-out hover:scale-105 focus:scale-105"
                                placeholder="••••••••" required>
                        </div>
                        <div class="flex items-center justify-between mb-6">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="remember" type="checkbox"
                                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-purple-300 transition duration-300">
                                </div>
                                <label for="remember" class="ml-2 text-sm text-gray-600">Remember me</label>
                            </div>
                            <a href="{{ route('password.request') }}"
                                class="text-sm text-purple-600 hover:underline transition duration-300">Forgot password?</a>
                        </div>
                        <div class="flex justify-center">
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white font-semibold py-3 rounded-lg shadow-lg transition duration-300 transform hover:scale-105">
                                Login
                            </button>
                        </div>
                    </form>
                    <p class="text-center text-sm text-gray-500 mt-6">
                        Don’t have an account yet? <a href="{{ route('register') }}"
                            class="text-purple-600 hover:underline font-medium transition duration-300">Sign up</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Add animations */
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

        .fade-in {
            animation: fadeIn 0.6s ease forwards;
        }
        
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        .animate-spin {
            animation: spin 1.5s linear infinite; /* Slowed down for a smoother effect */
        }

        /* Custom clip-path for a thicker abstract shape */
        .clip-path-abstract {
            clip-path: polygon(50% 0%, 100% 50%, 70% 100%, 30% 100%, 0% 50%); /* Thicker shape */
        }

        /* Increase the size of the spinning background */
        .spin-background {
            width: 140%; /* Increase width */
            height: 140%; /* Increase height */
            position: absolute;
            top: -20%; /* Adjust position */
            left: -20%; /* Adjust position */
        }
    </style>

    <script>
        // Add fade-in class to the container
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.querySelector('.max-w-lg');
            container.classList.add('fade-in');
        });
    </script>
</x-guest-layout>