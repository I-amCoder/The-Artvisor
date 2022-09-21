@extends('layouts.app')
@section('content')
    @include('layouts.navbar')
    <div class="container">
        <div class="row">

            <div class="d-flex flex-inline overflow-hidden justify-content-start">
                <a href="{{ url()->current() . '?query=' . $currentData['query'] . '&type=all' }}"
                    class="mr-4 p-2 result-sort {{ $currentData['type'] == 'all' ? 'text-danger' : '' }}">All
                    <span class="badge badge-success">{{ $typeData['all'] }}</span></a>

                {{-- @forelse ($types as $type)
                    <div class="mr-4 p-2 result-sort">{{ $type }} <span
                            class="badge badge-success">{{ $type }}</span>


                    @empty
                @endforelse --}}
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
                <?php $type = $item['type']; ?>
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
                                    {{-- <h1>{{ $item[$loop->index]['full_name'] }}</h1> --}}
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
    </div>
@endsection
