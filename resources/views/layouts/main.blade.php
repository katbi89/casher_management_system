<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CASHER MANAGEMENT SYSTEM</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href={{asset('/assets/css/normalize.css')}}>
    <link rel="stylesheet" href={{asset('/assets/css/bootstrap.min.css')}}>
    <link rel="stylesheet" href={{asset('/assets/css/font-awesome.min.css')}}>
    <link rel="stylesheet" href={{asset('/assets/css/themify-icons.css')}}>
    <link rel="stylesheet" href={{asset('/assets/css/flag-icon.min.css')}}>
    <link rel="stylesheet" href={{asset('/assets/css/cs-skin-elastic.css')}}>
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href={{asset('/assets/css/lib/datatable/dataTables.bootstrap.min.css')}}>
    <link rel="stylesheet" href={{asset('/assets/scss/style.css')}}>
    <link href={{asset('/assets/css/lib/vector-map/jqvmap.min.css')}} rel="stylesheet">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <link rel="stylesheet" href="/assets/css/bootstrap4.min.css"> -->
    <script src={{asset('/assets/js/jquery-3.5.1.min.js')}}></script>


    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            text-transform: capitalize;
        }
    </style>

</head>

<body>

    @include('layouts.left_panel')

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                        <h5 style="text-transform: capitalize;"><a href="/profile"><i class="fa fa-user"></i> Welcome {{Auth::user()->name}}</a></h5>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="{{url('/logout')}}">
                            <button class="btn btn-danger float-right">Logout</button>
                        </a>
                    </div>
                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->
        @yield('content')
    </div><!-- /#right-panel -->

    <!-- Right Panel -->
    <script src={{asset('/assets/js/bootstrap4.bundle.min.js')}}></script>
    <script src={{asset('/assets/js/plugins.js')}}></script>
    <script src={{asset('/assets/js/main.js')}}></script>
    <script src={{asset('/assets/js/lib/data-table/datatables.min.js')}}></script>
    <script src={{asset('/assets/js/lib/data-table/dataTables.bootstrap.min.js')}}></script>
    <script src={{asset('/assets/js/lib/data-table/dataTables.buttons.min.js')}}></script>
    <script src={{asset('/assets/js/lib/data-table/buttons.bootstrap.min.js')}}></script>
    <script src={{asset('/assets/js/lib/data-table/jszip.min.js')}}></script>
    <script src={{asset('/assets/js/lib/data-table/pdfmake.min.js')}}></script>
    <script src={{asset('/assets/js/lib/data-table/vfs_fonts.js')}}></script>
    <script src={{asset('/assets/js/lib/data-table/buttons.html5.min.js')}}></script>
    <script src={{asset('/assets/js/lib/data-table/buttons.print.min.js')}}></script>
    <script src={{asset('/assets/js/lib/data-table/buttons.colVis.min.js')}}></script>
    <script src={{asset('/assets/js/lib/data-table/datatables-init.js')}}></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#bootstrap-data-table-export').DataTable();
        });
    </script>

    @yield('script')

</body>

</html>