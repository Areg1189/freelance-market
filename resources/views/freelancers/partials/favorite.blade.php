<section class="freelancer-jobs">
    <div class="container">
        <div class="bg-shad">
            <div class="row justify-content-center">
                <div class="col-12 ">
                    <div class="fl-job-header py-3 ">
                        <h1 class="orange fw-800 text-center m-0">Favorites</h1>
                    </div>
                </div>
                <!--Jobs-->
                @forelse($jobs as $jobFavorite)
                    @php($job = $jobFavorite->favoriteable)
                    @include('jobs.job-item')
                @empty
                    <p>And you do not work in the list of favorites</p>
                @endforelse
            </div>
        </div>
    </div>
</section>