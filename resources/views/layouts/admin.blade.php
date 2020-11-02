@include('admin.section.header')
@include('admin.section.top-nav')

@include('admin.section.sidebar')
    <div class="content-wrapper">
        <!-- START PAGE CONTENT-->
        <div class="page-content fade-in-up">
           @include('admin.section.notify')
            @yield('content')

        </div>

    </div>
@include('admin.section.footer')
