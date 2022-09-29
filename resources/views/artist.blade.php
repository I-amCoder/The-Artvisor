@extends('layouts.app')
@section('content')
    @php

    @endphp

    @include('layouts.navbar')
    <div class="row profile-section mx-5 mt-4">
        <div class="col-md-5 py-4 ">
            <div class="row">
                <div class="col-6 text-right">
                    <img class="artist-img" src="{{ $image }}" alt="   ">
                </div>
                <div class="col-6">
                    <div class="ml-2">
                        <div class="h4 text-secondary">Artist</div>
                        <div class="h2">{{ $artist['name'] }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 ">
            <strong>Artist Details</strong>
            <div class="ml-2 mt-2 py-4 artist-details">
                @if ($artist['type'] == 'emerging')
                    <p>{{ $artist['name'] }} is an emerging contemporary artist.</p>
                @endif
                <p>ARTWORKS SOLD IN MAJOR AUCTION HOUSES
                    {{ $artist['total_auction_houses'] > 0 ? $artist['total_auction_houses'] : 'No' }}</p>
                {{-- <p>News Presence </p> --}}
                <p>Total artworks: {{ $artist['total_artworks'] }}</p>
            </div>
        </div>
    </div>
    <hr>
    <div class="container">
        <div class="row my-3">
            <div class="filters">
                <ul class="nav nav-tabs">
                    <p class="nav-item">
                        Filters <span class="badge badge-primary">{{ $filters['total']['value'] }}</span>
                    </p>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="false">Year</a>
                        <div class="dropdown-menu">
                            @foreach ($filters['aggregations']['inception_date.date'] as $key => $value)
                                <a class="dropdown-item {{ $value <= 0 ? 'disabled' : '' }}"
                                    @php $array = request()->all();
                                        array_unshift($array, request()->segment(2));
                                        unset($array['artworks_cursor']);
                                        $array['year'] = $key; @endphp
                                    href="{{ route('artist', $array) }}">{{ $key }}
                                    <span class="badge badge-secondary">{{ $value }}</span></a>
                            @endforeach
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="false">Medium</a>
                        <div class="dropdown-menu">
                            @foreach ($filters['aggregations']['medium.ids'] as $key => $value)
                                <a class="dropdown-item {{ $value <= 0 ? 'disabled' : '' }}"
                                    @php $array = request()->all();
                                    array_unshift($array, request()->segment(2));
                                    unset($array['artworks_cursor']);
                                    $array['medium'] = $key; @endphp
                                    href="{{ route('artist', $array) }}">{{ $key }}
                                    <span class="badge badge-secondary">{{ $value }}</span></a>
                            @endforeach
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="false">Type</a>
                        <div class="dropdown-menu">
                            @foreach ($filters['aggregations']['attribution_type'] as $key => $value)
                                <a class="dropdown-item {{ $value <= 0 ? 'disabled' : '' }}"
                                    @php $array = request()->all();
                                    array_unshift($array, request()->segment(2));
                                    unset($array['artworks_cursor']);
                                    $array['type'] = $key; @endphp
                                    href="{{ route('artist', $array) }}">{{ $key }}
                                    <span class="badge badge-secondary">{{ $value }}</span></a>
                            @endforeach
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="false">Price</a>
                        <div class="dropdown-menu">
                            @foreach ($filters['aggregations']['relevant_event.latest_price.value_usd'] as $key => $value)
                                <a class="dropdown-item {{ $value <= 0 ? 'disabled' : '' }}"
                                    @php $array = request()->all();
                                    array_unshift($array, request()->segment(2));
                                    unset($array['artworks_cursor']);
                                    $array['price'] = $key; @endphp
                                    href="{{ route('artist', $array) }}">{{ $key }}
                                    <span class="badge badge-secondary">{{ $value }}</span></a>
                            @endforeach
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                            aria-haspopup="true" aria-expanded="false">Status</a>
                        <div class="dropdown-menu">
                            @foreach ($filters['aggregations']['sale_status'] as $key => $value)
                                <a class="dropdown-item {{ $value <= 0 ? 'disabled' : '' }}"
                                    @php $array = request()->all();
                                    array_unshift($array, request()->segment(2));
                                    unset($array['artworks_cursor']);
                                    $array['status'] = $key; @endphp
                                    href="{{ route('artist', $array) }}">{{ $key }}
                                    <span class="badge badge-secondary">{{ $value }}</span></a>
                            @endforeach
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th></th>
                        <th>YEAR</th>
                        <th>TITLE</th>
                        {{-- <th>SIZE</th> --}}
                        <th>LAST PUBLIC PRICE</th>
                        <th>DATE</th>
                        <th>DEALER</th>
                        <th>STATUS</th>
                    </thead>
                    <tbody>
                        @forelse ($artworks as $item)
                            <tr>
                                <th>
                                    <img class="img-sm-square"
                                        src="{{ isset($item['media']) ? $item['media'][0]['url'] : asset('assets/img/artist.png') }}"
                                        alt="url">
                                </th>
                                <th>{{ $item['inception_date']['raw'] }}</th>
                                <th>{{ $item['titles'][0]['value'] }}</th>
                                <th>{{ isset($item['latest_price']) ? $item['latest_price']['formatted']['target'] : 'Undisclosed' }}
                                </th>
                                <th>
                                    {{-- {{ dd(Str::between($item['latest_price']['date']['raw'], '-', '-')) }} --}}
                                    <?php $date = $item['latest_event']['last_update_date']; ?>
                                    {{ $months[intval(Str::between($date, '-', '-')) - 1] . ' - ' . explode('-', $date, 2)[0] }}
                                </th>
                                <th>{{ $item['latest_event']['seller']['artist']['full_name'] }}</th>
                                <th>
                                    <a target="_blank" href="{{ $item['latest_event']['url'] }}">
                                        {{-- @if (isset($item['latest_price']) && $item['latest_price']['is_for_sale']) --}}
                                        @if ($item['latest_event']['latest_price']['status'] == 'for_sale')
                                            <span class="badge badge-success">FOR SALE</span>
                                        @else
                                            <span class="badge badge-danger">NOT FOR SALE</span>
                                        @endif
                                    </a>
                                </th>
                                {{-- <th></th> --}}
                            </tr>

                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row my-3 justify-content-center">
        <div class="col-6">

            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item {{ is_null($pagination['previous']) ? 'disabled' : '' }}">
                        <a class="page-link"
                            href="{{ route('artist', [Request::segment(2), 'query' => request('query'), 'artworks_cursor' => $pagination['previous']]) }}"
                            tabindex="-1">Previous</a>
                    </li>
                    @forelse ($pagination['previous_pages'] as $page)
                        <li class="page-item ">
                            <a class="page-link "
                                href="{{ route('artist', [Request::segment(2), 'query' => request('query'), 'artworks_cursor' => $page['cursor']]) }}">{{ $page['page'] }}</a>
                        </li>
                    @empty
                    @endforelse
                    <li class="page-item active">
                        <a href="javascript::void(0)" class="page-link">{{ $pagination['current'] }}</a>
                    </li>
                    @forelse ($pagination['next_pages'] as $page)
                        <li class="page-item ">
                            <a class="page-link"
                                href="{{ route('artist', [Request::segment(2), 'query' => request('query'), 'artworks_cursor' => $page['cursor']]) }}">{{ $page['page'] }}</a>
                        </li>
                    @empty
                    @endforelse
                    <li class="page-item {{ is_null($pagination['next']) ?? 'disabled' }}">
                        <a class="page-link"
                            href="{{ route('artist', [Request::segment(2), 'query' => request('query'), 'artworks_cursor' => $pagination['next']]) }}">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
