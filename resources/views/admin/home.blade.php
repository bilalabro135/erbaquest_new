@extends('layouts.admin.app', ['dashboard_nav' => true, 'title' => 'Dashboard'])

@section('content')
    <div class="container">

        <div class="jumbotron py-4">
            <h1>Welcome, {{ auth()->user()->name }}</h5>
            <p>Email: {{ auth()->user()->email }}</p>
        </div>
        
    </div>
@endsection