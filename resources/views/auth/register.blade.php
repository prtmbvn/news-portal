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

                <h1 class="justify text-center text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Create an Account
                </h1>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input 
                            id="name" 
                            class="block mb-2 text-sm font-medium text-gray-700 w-full 
                                   bg-gray-100 border border-gray-300 rounded-lg 
                                   focus:ring-2 focus:ring-purple-600 
                                   transition duration-300 
                                   hover:border-purple-500 focus:outline-none 
                                   transform transition-transform duration-200 ease-in-out 
                                   hover:scale-105 focus:scale-105" 
                            type="text" 
                            name="name" 
                            :value="old('name')" 
                            required 
                            autofocus 
                            autocomplete="name" 
                        />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mb-2 text-sm font-medium text-gray-700 w-full 
                                   bg-gray-100 border border-gray-300 rounded-lg 
                                   focus:ring-2 focus:ring-purple-600 
                                   transition duration-300 
                                   hover:border-purple-500 focus:outline-none 
                                   transform transition-transform duration-200 ease-in-out 
                                   hover:scale-105 focus:scale-105" type="email" name="email"
                            :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="role" :value="__('Role')" />
                        <select id="role" name="role" class="block mb-2 text-sm font-medium text-gray-700 w-full 
                                   bg-gray-100 border border-gray-300 rounded-lg 
                                   focus:ring-2 focus:ring-purple-600 
                                   transition duration-300 
                                   hover:border-purple-500 focus:outline-none 
                                   transform transition-transform duration-200 ease-in-out 
                                   hover:scale-105 focus:scale-105" required>
                            <option value="" disabled selected>Pilih Role</option>
                            <option value="employee">Employer</option>
                            <option value="user">User</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-2" />
                    </div>
                    

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input id="password" class="block mb-2 text-sm font-medium text-gray-700 w-full 
                                   bg-gray-100 border border-gray-300 rounded-lg 
                                   focus:ring-2 focus:ring-purple-600 
                                   transition duration-300 
                                   hover:border-purple-500 focus:outline-none 
                                   transform transition-transform duration-200 ease-in-out 
                                   hover:scale-105 focus:scale-105" type="password" name="password" required
                            autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                        <x-text-input id="password_confirmation" class="block mb-2 text-sm font-medium text-gray-700 w-full 
                                   bg-gray-100 border border-gray-300 rounded-lg 
                                   focus:ring-2 focus:ring-purple-600 
                                   transition duration-300 
                                   hover:border-purple-500 focus:outline-none 
                                   transform transition-transform duration-200 ease-in-out 
                                   hover:scale-105 focus:scale-105" type="password"
                            name="password_confirmation" required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="terms" aria-describedby="terms" type="checkbox"
                                class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800"
                                required="">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="font-light text-gray-500 dark:text-gray-300">I accept the <a
                                    class="font-medium text-primary-600 hover:underline dark:text-primary-500"
                                    href="#">Terms and Conditions</a></label>
                        </div>
                    </div>
                    <div class="flex justify-center mt-4">
                        <button type="submit"
                            class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white font-semibold py-3 rounded-lg shadow-lg transition duration-300 transform hover:scale-105">
                            Create an Account
                        </button>
                    </div>
                    <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                        Already have an account? <a href="{{ route('login') }}"
                            class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login here</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
