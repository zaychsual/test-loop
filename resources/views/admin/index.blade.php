@extends('layouts.app', ['title' => 'Dashboard - Admin'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container mx-auto px-6 py-8">
        <div class="mx-5">
            <div class="text-gray-500">{{ Auth::user()->name }}</div>
        </div>
    </div>
</main>
@endsection
