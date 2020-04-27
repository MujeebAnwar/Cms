@include('includes.public.header')

<!-- Navigation -->
@include('includes.public.nav')

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
       @yield('content')
        <!-- Blog Sidebar Widgets Column -->


        @include('includes.public.widget')
    </div>
    <!-- /.row -->

    <hr>
@yield('pagination')
    <!-- Footer -->

    @include('includes.public.footer')