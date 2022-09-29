<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand text-white">The Artvisor</a>
        <form class="form-inline" action="{{ route('search') }}">
            <input class="form-control mr-sm-2" type="search" name="query" id="query" type="text"
                placeholder="Search art prices" aria-label="Search">
            <button class="btn btn-outline-light my-2  my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>
