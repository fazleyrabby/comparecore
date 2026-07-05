<!DOCTYPE html>
<html lang="en" class="antialiased h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – CompareCore</title>
    <style>
        @import url('https://rsms.me/inter/inter.css');
        body { font-family: 'Inter Var', -apple-system, BlinkMacSystemFont, sans-serif; }
    </style>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 dark:bg-gray-950 flex flex-col justify-center min-h-screen py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        <a href="/" class="flex items-center justify-center gap-2 text-3xl font-bold text-indigo-600 dark:text-indigo-500 mb-8 hover:opacity-90 transition-opacity">
            <i data-lucide="git-compare" class="w-8 h-8"></i>
            CompareCore
        </a>

        @if(session('error'))
        <div class="mb-4 rounded-md bg-red-50 p-4 border border-red-200 dark:bg-red-900/20 dark:border-red-800" x-data="{ show: true }" x-show="show">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i data-lucide="alert-circle" class="h-5 w-5 text-red-400"></i>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-red-800 dark:text-red-300">{{ session('error') }}</p>
                </div>
                <div class="ml-auto pl-3">
                    <div class="-mx-1.5 -my-1.5">
                        <button @click="show = false" type="button" class="inline-flex rounded-md p-1.5 text-red-500 hover:bg-red-100 dark:hover:bg-red-900/50">
                            <i data-lucide="x" class="h-4 w-4"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <div class="bg-white dark:bg-gray-900 py-8 px-4 shadow-xl shadow-gray-200/50 dark:shadow-none sm:rounded-xl sm:px-10 border border-gray-200 dark:border-gray-800">
            <div class="mb-6 text-center">
                <h2 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Welcome back</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Sign in to manage your site</p>
            </div>

            <div class="mb-6">
                <button type="button" onclick="demoLogin()" class="w-full flex items-center justify-center gap-3 p-2.5 rounded-lg border border-indigo-200 hover:border-indigo-500 bg-indigo-50 hover:bg-indigo-100 transition-colors text-left dark:border-indigo-800 dark:hover:border-indigo-500 dark:bg-indigo-900/30 dark:hover:bg-indigo-900/50 group">
                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center group-hover:bg-indigo-600 group-hover:text-white transition-colors dark:bg-indigo-900/50 dark:text-indigo-400">
                        <i data-lucide="zap" class="w-4 h-4"></i>
                    </div>
                    <div class="flex-1">
                        <div class="text-sm font-semibold text-indigo-700 dark:text-indigo-300">Quick Demo Login</div>
                        <div class="text-[11px] text-indigo-500 dark:text-indigo-400">admin@comparecore.com</div>
                    </div>
                    <i data-lucide="arrow-right" class="w-4 h-4 text-indigo-400 group-hover:text-indigo-600 dark:text-indigo-500"></i>
                </button>
            </div>

            <div class="relative mb-6">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200 dark:border-gray-700"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-2 bg-white dark:bg-gray-900 text-gray-500 dark:text-gray-400">or sign in manually</span>
                </div>
            </div>

            <form class="space-y-5" action="{{ route('login') }}" method="POST" autocomplete="off" novalidate id="loginForm">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email address</label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="appearance-none block w-full px-3 py-2.5 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:focus:ring-indigo-500 @error('email') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                            placeholder="you@example.com" value="{{ old('email') }}">
                    </div>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div x-data="{ showPassword: false }">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                    <div class="mt-1 relative rounded-md shadow-sm">
                        <input id="password" name="password" :type="showPassword ? 'text' : 'password'" autocomplete="current-password" required
                            class="appearance-none block w-full px-3 py-2.5 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:focus:ring-indigo-500 @error('password') border-red-300 focus:border-red-500 focus:ring-red-500 @enderror"
                            placeholder="Enter your password">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <button type="button" @click="showPassword = !showPassword" class="text-gray-400 hover:text-gray-500 focus:outline-none focus:text-indigo-500">
                                <i data-lucide="eye" x-show="!showPassword" class="h-4 w-4"></i>
                                <i data-lucide="eye-off" x-show="showPassword" class="h-4 w-4" style="display: none;"></i>
                            </button>
                        </div>
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded dark:bg-gray-800 dark:border-gray-700 dark:checked:bg-indigo-500">
                        <label for="remember" class="ml-2 block text-sm text-gray-900 dark:text-gray-300">Remember me</label>
                    </div>
                </div>

                <div>
                    <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors dark:focus:ring-offset-gray-900">
                        <i data-lucide="log-in" class="w-4 h-4 mr-2"></i>
                        Sign In
                    </button>
                </div>
            </form>
        </div>

        <div class="mt-6 text-center">
            <a href="/" class="inline-flex items-center gap-1.5 text-sm font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300 transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Back to home
            </a>
        </div>
    </div>

    <script>
        lucide.createIcons();
        function demoLogin() {
            document.getElementById('email').value = 'admin@comparecore.com';
            document.getElementById('password').value = 'password';
            document.getElementById('loginForm').submit();
        }
    </script>
</body>
</html>
