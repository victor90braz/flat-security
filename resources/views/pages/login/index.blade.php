@extends('app')

@section('content')
    <div class="flex min-h-full flex-col justify-center px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <img class="mx-auto h-10 w-auto" src="https://seeklogo.com/images/R/risingwave-icon-logo-837E37238C-seeklogo.com.png" alt="Your Company">
            <h2 class="text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                Log In!
            </h2>
        </div>

        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="/login" method="POST">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">
                        Email address
                    </label>
                    <div class="mt-2">
                        <input id="email" name="email" type="email" autocomplete="email" required class="block w-full p-4 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm font-medium leading-6 text-gray-900">
                            Password
                        </label>
                    </div>
                    <div class="mt-2">
                        <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full p-4 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Sign in
                    </button>
                </div>

                <div class="sm:mx-auto sm:w-full sm:max-w-sm mt-2">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </form>

            <p class="mt-8 text-center text-sm text-gray-500">
                Not a member?
                <a href="register" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Register</a>
            </p>
        </div>
    </div>


@endsection
