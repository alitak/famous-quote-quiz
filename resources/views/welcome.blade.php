@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
                    @guest
                        <h2>Please <a href="{{ route('login') }}">login</a> to play the Famous Quote Quiz!</h2>
                    @endguest
                    @auth
                        <quiz></quiz>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection
