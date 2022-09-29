@extends('layouts.app')
@section('content')
    @include('layouts.navbar')
    <div class="container">
        <div class="row profile-section mx-5 mt-4 ">
            <div class="col-md-4 py-4 text-center">
                <img class="artwork-img"
                    src="{{ isset($artwork['media']) ? $artwork['media'][0]['url'] : asset('assets/img/artist.png') }}"
                    alt="   ">
            </div>
            <div class="col-md-8">
                <div class="artwork-details py-5">
                    <h3 class="py-2">
                        <img class="img-rounded-sm"
                            src="{{ isset($artist['media']) ? $artist['media'][count($artist['media']) - 1]['url'] : asset('assets/img/artist.png') }}"
                            alt="artist">
                        <span class="ml-2 text-warning ">{{ $artist['full_name'] }}</span>
                    </h3>

                    <h3>{{ $artwork['titles'][0]['value'] }}</h3>
                    <div class="row">
                        <div class="col-6 mt-4 text-capitalize">
                            <span class="text-secondary font-weight-bold">Year</span>
                            <br>
                            {{ $artwork['inception_date']['raw'] }}

                        </div>
                        <div class="col-6 mt-4 text-capitalize">

                            <span class="text-secondary font-weight-bold ">Type</span>
                            <br>
                            {{ $artwork['attribution_type'] }}
                        </div>
                        <div class="col-6 mt-4 text-capitalize">

                            <span class="text-secondary font-weight-bold">Medium</span>
                            <br>
                            {{ $artwork['medium'][0]['raw'] }}

                        </div>
                        <div class="col-6 mt-4 text-capitalize">

                            <span class="text-secondary font-weight-bold">Size</span>
                            <br>
                            {{ $artwork['size']['raw'] }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <h3>Historical Data</h3>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th></th>

                        <th>Public Price</th>
                        <th>Dealer</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        @foreach ($historical_data as $item)
                            <tr>
                                <th>
                                    <img class="img-sm-square"
                                        src="{{ isset($item['original_artwork']['media']) ? $item['original_artwork']['media'][0]['url'] : asset('assets/img/artist.png') }}"
                                        alt="img">
                                </th>
                                <td>{{ $item['latest_price']['formatted']['target'] }}</td>
                                <td>{{ isset($item['seller']['gallery']) ? $item['seller']['gallery']['name'] : '' }}
                                    <br>
                                    <small>On
                                        {{ preg_replace('(^https?://www.)', '', $item['seller']['platform']['official_website']) }}</small>
                                </td>
                                <td>
                                    @if ($item['latest_price']['status'] == 'for_sale')
                                        <a target="_blank" href="{{ $item['url'] }}"><span class="badge badge-success">For
                                                Sale</span></a>
                                    @else
                                        <span class="badge badge-danger">Not for sale</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mt-4">
            <h3>Similiar Artworks</h3>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th></th>
                        <th>ARTIST</th>
                        <th>YEAR</th>
                        <th>TITLE</th>
                        <th>PUBLIC PRICE</th>
                        <th>DEALER</th>
                        <th>STATUS</th>
                    </thead>
                    <tbody>
                        @forelse ($similiar_arts as $item)
                            <tr>
                                <td>
                                    <img src="{{ $item['media'][0]['url'] }}" alt="img" class="img-sm-square">
                                </td>
                                <td>{{ $item['artists'][0]['full_name'] }}</td>
                                <td>{{ $item['inception_date']['raw'] }}</td>
                                <td>{{ $item['titles'][0]['value'] }}</td>
                                <td>{{ isset($item['latest_price']) ? $item['latest_price']['formatted']['original'] : 'Undisclosed/not given' }}
                                </td>
                                <td>{{ isset($item['seller']['gallery']) ? $item['seller']['gallery']['name'] : $item['latest_event']['seller']['artist']['full_name'] }}
                                </td>
                                <td>
                                    @if (isset($item['latest_price']) && $item['latest_price']['status'] == 'for_sale')
                                        <a target="_blank" href="{{ $item['latest_event']['url'] }}"><span
                                                class="badge badge-success">For
                                                Sale</span></a>
                                    @else
                                        <span class="badge badge-danger">Not for sale</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                no data
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
