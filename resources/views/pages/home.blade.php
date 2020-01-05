@extends('layouts.app')

@section('title')
Dashboard
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="body col-md-12">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="row">
            <div class="col-lg-4 pb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Translations queued</h5>
                        <p class="card-text text-center lead">
                            {{ count($products) }}
                        </p>
                        @if (count($products))
                            <a href="{{ route('product.translate') }}" class="btn btn-success float-right">Start Translating</a>
                        @endif
                        @if (Auth::user() && Auth::user()->is_admin)
                            <a href="{{ route('export') }}" class="btn btn-outline-primary float-right mr-3">Export</a>
                            <a href="{{ route('product.create') }}" class="btn btn-outline-primary float-right mr-3">Import</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-4 pb-4">
                <div class="card h-100">
                    <div class="card-body">
                        @php
                            $translations = App\ProductTranslation::where('translated_by', Auth::user()->email)->get();
                            $total = 0;
                            $avg = '';
                        @endphp
                        @foreach ($translations as $translation)
                            @php
                                $duration = $translation->duration;
                                $total += $duration;
                            @endphp
                        @endforeach

                        @if (count($translations) != 0)
                            @php
                                $avg = ($total / count($translations));
                            @endphp
                        @endif

                        <h5 class="card-title">Avg time/translation</h5>
                        <p class="card-text text-center lead">{{ is_numeric($avg) ? $avg . " sec" : "N/A" }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 pb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Translations checks queued</h5>
                        <p class="card-text text-center">{ Number of translations checks }</p>
                        <a href="{{-- {{ route('translate.control') }} --}}" class="btn btn-success float-right">Start</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="container">
                            <div class="row border-bottom">
                                <div class="col-sm-6">
                                    <h5 class="card-title">Leaderboard</h5>
                                </div>
                                <div class="col-sm-2 text-center">
                                    <p>Country</p>
                                </div>
                                <div class="col-sm-2 text-center">
                                    <p>Total</p>
                                </div>
                                <div class="col-sm-2 text-right">
                                    <p>Avg/translation</p>
                                </div>
                            </div>
                            @php
                                // $translators = $users->where('is_admin', false);
                                $translators = $users;
                                $numItems = count($translators);
                                $i = 0;
                            @endphp
                            @foreach ($translators as $translator)
                                <div class="row {{ ++$i === $numItems ? '' : 'border-bottom' }} py-2">
                                    <div class="col-sm-6">
                                        <p class="d-inline align-middle">{{ ucfirst($translator->name) }}</p>
                                    </div>
                                    <div class="col-sm-2 text-center">
                                        <p class="d-inline align-middle">{{ ucfirst($translator->country_code) }}</p>
                                    </div>

                                    @php
                                        $translations = App\ProductTranslation::where('translated_by', $translator->email)->get();
                                    @endphp

                                    <div class="col-sm-2 text-center">
                                        <p class="d-inline align-middle">{{ count($translations) }}</p>
                                    </div>

                                    @php
                                        $total = 0;
                                        $avg = 0;
                                    @endphp
                                    @foreach ($translations as $translation)
                                        @php
                                            $duration = $translation->duration;
                                            $total += $duration;
                                        @endphp
                                    @endforeach

                                    @if (count($translations) != 0)
                                        @php
                                            $avg = ($total / count($translations));
                                        @endphp
                                    @else
                                        @php
                                            $avg = '';
                                        @endphp
                                    @endif

                                    <div class="col-sm-2 text-right">
                                        <p class="d-inline align-middle">{{ is_numeric($avg) ? $avg . " sec" : "N/A" }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
