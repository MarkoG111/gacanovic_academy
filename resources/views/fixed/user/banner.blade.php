<div class="wrapper bgded overlay gradient" style="background-image:url('{{ asset('img/background.png') }}');">
    <div id="pageintro" class="hoc clear">
        <article class="pageintro-wrap">
            <p>Learn On Your Own !</p>

            <footer>
                <form class="example" action="{{ route('courses') }}" method="GET">
                    <input type="text" placeholder="Search For Courses" aria-label="true" name="search"
                        class="form-control" value="">
                    <button type="submit" class="buttonS"><i class="fa fa-search"></i></button>
                </form>
            </footer>
        </article>
    </div>
</div>
