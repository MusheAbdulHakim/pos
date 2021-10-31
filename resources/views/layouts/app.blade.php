<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title>{{ucwords(!empty(AppSettings::get('app_name')) ? AppSettings::get('app_name'): config('app.name'))}} - {{ucwords($title ?? '')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{!empty(AppSettings::get('logo')) ? asset('storage/'.AppSettings::get('logo')): asset('assets/images/favicon.ico')}}">
    <!-- csrf token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Page Css -->
    @stack('page-css')
    <!-- Bootstrap Css -->
    @if (ucfirst(AppSettings::get('mode')) == 'Dark')
    <link href="{{asset('assets/css/bootstrap-dark.min.css')}}" id="bootstrap-style-dark" rel="stylesheet" type="text/css" />
    @else
    <link href="{{asset('assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    @endif
    <!-- Icons Css -->
    <link href="{{asset('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Toastr Css-->
    <link rel="stylesheet" href="{{asset('assets/libs/toastr/toastr.min.css')}}">
    <!-- Sweet Alert-->
    <link href="{{asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    @if (AppSettings::get('rtl') == '1')
    <link href="{{asset('assets/css/app-rtl.min.css')}}" id="app-style-rtl" rel="stylesheet" type="text/css" />
    @endif
    @if(ucfirst(AppSettings::get('mode')) == 'Dark')
    <link href="{{asset('assets/css/app-dark.min.css')}}" id="app-style-dark" rel="stylesheet" type="text/css" />
    @else
    <link href="{{asset('assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
    @endif
</head>
@if (AppSettings::get('layout') == 'detached')  
<body data-layout="detached" data-topbar="colored">
@endif
@if (AppSettings::get('layout') == 'icon')  
<body data-layout="detached" data-topbar="colored" data-keep-enlarged="true" class="vertical-collpsed">
@endif
@if (AppSettings::get('layout') == 'boxed')  
<body data-layout="detached" data-topbar="colored" data-keep-enlarged="true" class="vertical-collpsed" data-layout-size="boxed">
@endif
@if (AppSettings::get('layout') == 'compact')  
<body data-layout="detached" data-topbar="colored" data-sidebar-size="small">
@endif

    <x-preloader.spinner-chase />

    <div class="container-fluid">
        <!-- Begin page -->
        <div id="layout-wrapper">

            @include('includes.header')

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div class="h-100">

                    <div class="user-wid text-center py-4">
                        <div class="user-img">
                            <img src="{{!empty(auth()->user()->avatar) ? asset('storage/users/'.auth()->user()->avatar): asset('assets/images/users/avatar-2.jpg')}}" alt="Avatar" class="avatar-md mx-auto rounded-circle">
                        </div>

                        <div class="mt-3">
                            <a href="#" class="text-dark font-weight-medium font-size-16">{{auth()->user()->name}}</a>
                            <p class="text-body mt-1 mb-0 font-size-13">
                                @foreach (auth()->user()->roles as $role)
                                <h6 class="chip">{{$role->name}}</h6>
                                @endforeach
                            </p>
                        </div>
                    </div>

                    <!--- Sidemenu -->
                    @include('includes.sidebar')
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">

                <div class="page-content">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="page-title mb-0 font-size-18">{{$title ?? ''}}</h4>

                                <div class="page-title-right">
                                    
                                    @hasSection ('breadcrumb')
                                        @yield('breadcrumb')
                                    @else
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">{{$title ?? ''}}</li>
                                    </ol>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <!-- main page -->
                    <div class="row">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <x-alerts.danger :message="$error" />
                            @endforeach
                        @endif
                        @yield('content')
                    </div>
                    <!-- end main page -->

                </div>
                <!-- End Page-content -->

                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © Qovex.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-right d-none d-sm-block">
                                    Design & Develop by Themesbrand
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

    </div>
    <!-- end container-fluid -->

    <!-- Right Sidebar -->
    {{-- @include('includes.rightside') --}}
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- JAVASCRIPT -->
    <script src="{{asset('assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{asset('assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('assets/css/bootstrap-dark.min.css')}}"></script>
    <script src="{{asset('assets/libs/node-waves/waves.min.js')}}"></script>
    <!-- parsley plugin -->
    <script src="{{asset('assets/libs/parsleyjs/parsley.min.js')}}"></script>
    <!-- validation init -->
    <script src="{{asset('assets/js/pages/form-validation.init.js')}}"></script>
    <!-- Toastr js-->
    <script src="{{asset('assets/libs/toastr/toastr.min.js')}}"></script>
    <!-- Sweet Alerts js -->
    <script src="{{asset('assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- App js -->
    <script src="{{asset('assets/js/app.js')}}"></script>
    <script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', '') }}";
        switch (type) {
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;
            
            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;
            
            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;
            
            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
            
            case 'danger':
                toastr.error("{{ Session::get('message') }}");
                break;
            
        }
        @endif
    </script>
    <script>
        $(document).ready(function(){
            $('body').on('click','#deletebtn',function(){
                var id = $(this).data('id');
                var route = $(this).data('route');
                swal.queue([
                    {
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        type: "warning",
                        showCancelButton: !0,
                        confirmButtonText: '<i class="fas fa-trash mr-1"></i> Delete!',
                        cancelButtonText: '<i class="fas fa-times mr-1"></i> Cancel!',
                        confirmButtonClass: "btn btn-success mt-2",
                        cancelButtonClass: "btn btn-danger ml-2 mt-2",
                        buttonsStyling: !1,
                        preConfirm: function(){
                            return new Promise(function(){
                                $.ajax({
                                    url: route,
                                    type: "DELETE",
                                    data: {"id": id},
                                    success: function(){
                                        swal.insertQueueStep(
                                            Swal.fire({
                                                title: "Deleted!",
                                                text: "Resource has been deleted.",
                                                type: "success",
                                                showConfirmButton: !1,
                                                timer: 1500,
                                            })
                                        )
                                        $('#datatable').DataTable().ajax.reload();
                                    }
                                })

                            })
                        }
                    }
                ]).catch(swal.noop);
            });          
        });
    </script>
    <!-- Page Js -->
    @stack('page-js')
    

</body>

</html>