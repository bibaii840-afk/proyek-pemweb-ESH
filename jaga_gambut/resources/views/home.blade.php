@extends('layouts.app')

@section('content')
  @include('partials.hero')
  @include('partials.sim-peat')
  @include('partials.sim-smoke')
  @include('partials.sim-carbon')
  @include('partials.dragdrop')
  @include('partials.compare')
  @include('partials.quiz')
@endsection

@push('scripts')
  <script>window.GAMBUT = { quiz: @json(config('gambut.quiz')) };</script>
  <script src="{{ asset('js/sim-peat.js') }}"></script>
  <script src="{{ asset('js/sim-smoke.js') }}"></script>
  <script src="{{ asset('js/sim-carbon.js') }}"></script>
  <script src="{{ asset('js/dragdrop.js') }}"></script>
  <script src="{{ asset('js/compare.js') }}"></script>
  <script src="{{ asset('js/quiz.js') }}"></script>
@endpush
