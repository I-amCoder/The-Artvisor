@extends('layouts.app')
@section('content')
    @include('layouts.navbar')
    <style>
        .loader {
            margin: auto;
            margin-top: 6rem;
            border: 20px solid #EAF0F6;
            border-radius: 50%;
            border-top: 20px solid #FF7A59;
            width: 200px;
            height: 200px;
            animation: spinner 4s linear infinite;
        }

        @keyframes spinner {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <div class="container " id="result-container">
        <div class="row" id="result-counter">
            <div id="loading" class="mt-5">
                <div class="h1 text-center">Loading...</div>
                <div class="loader"></div>
            </div>
        </div>
    </div>
    {{-- <div class="container">
        <div class="row" >

            <div class="d-flex flex-inline overflow-hidden justify-content-start">
                <a href="{{ url()->current() . '?query=' . $currentData['query'] . '&type=all' }}"
                    class="mr-4 p-2 result-sort {{ $currentData['type'] == 'all' ? 'text-danger' : '' }}">All
                    <span class="badge badge-success">{{ $typeData['all'] }}</span></a>

                @forelse ($typeData as $key => $value)
                    <div class="mr-4 p-2 result-sort">{{ $value }} <span
                            class="badge badge-success">{{ $namespaces[$key] }}</span>
                    </div>
                @empty
                @endforelse
            </div>
        </div>
        <div class="row"></div>
        @foreach ($items as $item)
            <div class="row">

                <a href="{{ $type == 'artist' || $type == 'artwork' ? route($item['type'], [$item['slug'], 'query' => request('query')]) : 'javascript::void(0)' }}"
                    class="nav-link">
                    <div class="artist-container">
                        <div class="row">
                            <div class="col-2 text-right">
                                <img class="search-img"
                                    src="{{ isset($item['media']) ? $item['media'][0]['url'] : asset('assets/img/artist.png') }}"
                                    alt="">
                            </div>
                            <div class="col-auto ml-3">
                                @if ($type == 'artist')
                                    <p class="h4">{{ $item['full_name'] }}</p>
                                    <p>{{ $type }}</p>
                                @else
                                    <p class="h4">{{ $item['artists'][0]['full_name'] }}</p>
                                    <p class="h5">{{ $item['titles'][0]['value'] }}</p>
                                    <p>{{ $type }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach

    </div>
    <div class="row justify-content-center">
        <div class="col">
            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item {{ is_null($pagination['previous']) ? 'disabled' : '' }}">
                        <a class="page-link"
                            href="{{ route('search', ['query' => request('query'), 'cursor' => $pagination['previous']]) }}"
                            tabindex="-1">Previous</a>
                    </li>
                    @forelse ($pagination['previous_pages'] as $page)
                        <li class="page-item ">
                            <a class="page-link "
                                href="{{ route('search', ['query' => request('query'), 'cursor' => $page['cursor']]) }}">{{ $page['page'] }}</a>
                        </li>
                    @empty
                    @endforelse
                    <li class="page-item active">
                        <a href="javascript::void(0)" class="page-link">{{ $pagination['current'] }}</a>
                    </li>
                    @forelse ($pagination['next_pages'] as $page)
                        <li class="page-item ">
                            <a class="page-link"
                                href="{{ route('search', ['query' => request('query'), 'cursor' => $page['cursor']]) }}">{{ $page['page'] }}</a>
                        </li>
                    @empty
                    @endforelse
                    <li class="page-item {{ is_null($pagination['next']) ?? 'disabled' }}">
                        <a class="page-link"
                            href="{{ route('search', ['query' => request('query'), 'cursor' => $pagination['next']]) }}">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div> --}}
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            fetchData();
            console.log("{{ route('searchApi', $query) }}");
        })


        function fetchData() {
            fetch("{{ route('searchApi', $query) }}")
                .then((response) => response.json())
                .then((result) => {
                    $("#loading").hide();
                    appendResult(result[3])

                })

        }



        function appendResult(items) {
            items.map((item) => {
                console.table(item);
                let type = item.type;
                $("#result-container").append(`
                <div class="row">
                    <div class="artist-container">
                        <div class="row">
                            <div class="col-2 text-right">
                                <img class="search-img"
                                    src="${typeof item.media !== 'undefined' ? item.media[0].url : '/assets/img/artist.png'}"
                                    alt="">
                            </div>
                            <div class="col-auto ml-3">
                                ${type==='artist'?
                                    `<p class="h4">${item.full_name}</p>
                                                                                                                                                                                                                                <p>${type}</p>`
                                :
                                `<p class="h4">${ item.artists[0].full_name }</p>
                                                                                                                                                                                                <p class="h5">${ item.titles[0].value }</p>
                                                                                                                                                                                                <p>${type}</p>`
                            }
                            </div>
                        </div>
                    </div>
                </div>
                `)
            })
        }
    </script>
@endpush
