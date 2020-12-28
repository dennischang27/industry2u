@extends('admin.layouts.header')

@section('title')
    <title>{{ config('app.name', 'Industry2u') .  __(' Admin Portal') }}</title>
@endsection

@section('body')

    <!-- Page Wrapper -->
    <div id="wrapper">
        @include('admin.layouts.sidebar')
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content">
                    @include('admin.layouts.head')
                    <!-- Begin Page Content -->
                        <div class="container-fluid">
                            @yield('pagetitle')
                            @yield('content')
                        </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- End of Main Content -->
                <!-- Footer -->
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; Industry2u 2020</span>
                        </div>
                    </div>
                </footer>
                <!-- End of Footer -->
            </div>
            <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


@endsection
