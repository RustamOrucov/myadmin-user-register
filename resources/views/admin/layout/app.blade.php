
<!DOCTYPE html>
<html lang="en">
@include('admin.inc.head')

<body class="nav-md">
<div class="container body">
    <div class="main_container">
       @include('admin.inc.aside')

       @include('admin.inc.nav')

        <!-- page content -->
        <div class="right_col" role="main">
           @yield('_content')
        </div>
        <!-- /page content -->

        <!-- footer content -->
        @include('admin.inc.footer')
        <!-- /footer content -->
    </div>
</div>

@include('admin.inc.scripts')
</body>
</html>
