@extends('layouts.home')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                Réinitialiser votre mot de passe
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Veuillez entrer votre nouveau mot de passe.
            </p>
        </div>
        
        @if (session('status'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                {{ session('status') }}
            </div>
        @endif
        
        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                {{ session('error') }}
            </div>
        @endif
        
        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form class="mt-8 space-y-6" action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            
            <div class="rounded-md shadow-sm -space-y-px">
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Adresse e-mail</label>
                    <input id="email" name="email" type="email" value="{{ request('email') }}" required 
                           class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 
                                  placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 
                                  focus:border-blue-500 focus:z-10 sm:text-sm"
                           placeholder="Adresse e-mail">
                </div>
                
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Nouveau mot de passe</label>
                    <input id="password" name="password" type="password" required 
                           class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 
                                  placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 
                                  focus:border-blue-500 focus:z-10 sm:text-sm"
                           placeholder="Nouveau mot de passe">
                </div>
                
                <div>
                    <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirmer le mot de passe</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required 
                           class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 
                                  placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-blue-500 
                                  focus:border-blue-500 focus:z-10 sm:text-sm"
                           placeholder="Confirmer le mot de passe">
                </div>
            </div>
            
            <div>
                <button type="submit" 
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent 
                               text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 
                               focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Réinitialiser le mot de passe
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
