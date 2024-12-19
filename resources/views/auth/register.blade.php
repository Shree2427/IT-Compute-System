@extends('layouts.app')
@section('title')
    Register
@endsection

@section('content')
<div class="flex h-screen items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center text-gray-700">Register</h2>
        <form action="{{ route('register') }}" method="POST" class="mt-6 space-y-6">
            @csrf
            <!-- Name Field -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <div class="mt-1">
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="block w-full px-4 py-2 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300 focus:border-blue-500"
                        placeholder="Enter your name"
                        required
                    />
                </div>
            </div>
            <!-- Email Field -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <div class="mt-1">
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="block w-full px-4 py-2 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300 focus:border-blue-500"
                        placeholder="Enter your email"
                        required
                    />
                </div>
            </div>
            <!-- Password Field -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <div class="mt-1">
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="block w-full px-4 py-2 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300 focus:border-blue-500"
                        placeholder="Enter your password"
                        required
                    />
                </div>
            </div>
            <!-- Confirm Password Field -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <div class="mt-1">
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        class="block w-full px-4 py-2 text-gray-700 bg-gray-100 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-blue-300 focus:border-blue-500"
                        placeholder="Confirm your password"
                        required
                    />
                </div>
            </div>
            <!-- Register Button -->
            <div>
                <button
                    type="submit"
                    class="w-full px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300"
                >
                    Register
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
