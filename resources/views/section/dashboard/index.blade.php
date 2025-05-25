@extends('layouts.main')

@section('content')
<div class="main p-4 ms-3 mt-3">
    <x-header-sections/>
    <hr class="text-black">

    @if (auth()->user()->role == 'karyawan')
        @include('section.dashboard.karyawan')
    @endif
    </div>
</div>
@endsection
