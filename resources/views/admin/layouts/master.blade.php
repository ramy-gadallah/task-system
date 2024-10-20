<!DOCTYPE html>
<html lang="en">
@include('admin.layouts.head')

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.layouts.sidebar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('admin.layouts.header')

            <div class="main-panel">
                @yield('content')
            
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
              <!-- footer-->
            
    
    <!-- container-scroller -->
    @include('admin.layouts.js')

    @yield('js')
</body>
</html>
