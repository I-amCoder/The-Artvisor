@extends('layouts.app')
@section('content')
    {{-- <!-- Navigation-->
    <nav class="navbar navbar-light bg-light static-top">
        <div class="container py-2">
            <a class="navbar-brand " href="#!">The Artvisor</a>

        </div>
    </nav> --}}
    <!-- Masthead-->
    <header class="masthead">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <div class="text-center text-white">
                        <!-- Page heading-->
                        <h1 class="mb-5">Get prices about your favourite artsits of all time</h1>

                        <form class="form-subscribe" action="{{ route('search') }}">
                            <!-- Email address input-->
                            <div class="row">
                                <div class="col-md-8">
                                    <input class="form-control form-control-lg" name="query" id="query" type="text"
                                        placeholder="Search art prices" />
                                </div>
                                <div class="col-md-2 ">
                                    <div class="col-auto"><button class="btn btn-primary btn-lg " id="submitButton"
                                            type="submit">Search</button></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Icons Grid-->
    <section class="features-icons bg-light text-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="features-icons-item  mx-auto mb-5 mb-lg-0 mb-lg-3">
                        {{-- <div class="features-icons-icon d-flex"><i class="bi-window m-auto text-primary"></i></div> --}}
                        <h3>Artists</h3>
                        {{-- <p class="">10000</p> --}}
                        <span class="badge mt-2 badge-pill px-3 py-2 badge-success"
                            style="font-size: 24px">{{ $frontPageData['artists'] }}</span>

                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="features-icons-item  mx-auto mb-5 mb-lg-0 mb-lg-3">
                        {{-- <div class="features-icons-icon d-flex"><i class="bi-layers m-auto text-primary"></i></div> --}}
                        <h3>Artworks</h3>
                        <span class="badge mt-2 badge-pill px-3 py-2 badge-success"
                            style="font-size: 24px">{{ $frontPageData['artworks'] }}</span>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="features-icons-item  mx-auto mb-5 mb-lg-3">
                        {{-- <div class="features-icons-icon d-flex"><i class="bi-terminal m-auto text-primary"></i></div> --}}
                        <h3>Art Dealer Prices</h3>
                        <span class="badge mt-2 badge-pill px-3 py-2 badge-success"
                            style="font-size: 24px">{{ $frontPageData['art_dealer_prices'] }}</span>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="features-icons-item  mx-auto mb-0 mb-lg-3">
                        {{-- <div class="features-icons-icon d-flex"><i class="bi-terminal m-auto text-primary"></i></div> --}}
                        <h3>Auction House Prices</h3>
                        <span class="badge mt-2 badge-pill px-3 py-2 badge-success"
                            style="font-size: 24px">{{ $frontPageData['auction_houses_prices'] }}</span>`
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer-->
    <footer class="footer bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 h-100 text-center text-lg-start my-auto">
                    <ul class="list-inline mb-2">
                        <li class="list-inline-item"><a href="#!">About</a></li>
                        <li class="list-inline-item">⋅</li>
                        <li class="list-inline-item"><a href="#!">Contact</a></li>
                        <li class="list-inline-item">⋅</li>
                        <li class="list-inline-item"><a href="#!">Terms of Use</a></li>
                        <li class="list-inline-item">⋅</li>
                        <li class="list-inline-item"><a href="#!">Privacy Policy</a></li>
                    </ul>
                    <p class="text-muted small mb-4 mb-lg-0">&copy; Your Website 2022. All Rights Reserved.</p>
                </div>
                <div class="col-lg-6 h-100 text-center text-lg-end my-auto">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item me-4">
                            <a href="#!"><i class="bi-facebook fs-3"></i></a>
                        </li>
                        <li class="list-inline-item me-4">
                            <a href="#!"><i class="bi-twitter fs-3"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#!"><i class="bi-instagram fs-3"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
@endsection
