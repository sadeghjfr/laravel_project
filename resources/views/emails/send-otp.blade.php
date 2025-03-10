@extends('emails.layouts.master')

@section('content')

    <section style="direction: rtl">
        <h2 style="direction: rtl; font-weight: bold">{{ $details['title'] }}</h2>
        <p style="direction: rtl">{{ $details['body'] }}</p>
    </section>

@endsection
