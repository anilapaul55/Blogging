<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>BLOG</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{asset('assets/img/favicon.png')}}" rel="icon">
    <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/simple-datatables/style.cs')}}" rel="stylesheet">    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <!-- Template Main CSS File -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<style>
    .inputWithIcon input[type="text"] {
        padding-left: 40px;
    }

    .inputWithIcon input[type="password"] {
        padding-left: 40px;
    }

    .inputWithIcon {
        position: relative;
    }

    .inputWithIcon i {
        position: absolute;
        left: 20px;
        top: 14px;
        padding: 0px 8px;
        color: #1479FF;
        transition: 0.3s;
    }

    .inputWithIcon input[type="text"]:focus+i {
        color: dodgerBlue;
    }

    .inputWithIcon.inputIconBg i {
        background-color: #aaa;
        color: #fff;
        padding: 9px 4px;
        border-radius: 4px 0 0 4px;
    }
    .toggle-password {
        float: right;
        cursor: pointer;
        margin-right: 20px;
        margin-top: -30px;
    }
</style>

<body>

    <main>
        <div class="container">

            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h2 class="text-center" style="color: #2181FF;"><b>BLOG</b></h2>

                                    </div>

                                    
                                    <form class="row g-3 needs-validation" novalidate  method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="col-12 inputWithIcon">
                                            {{-- <input type="text" class="form-control login-inp" value="" placeholder="Mail ID"> --}}
                                            <input id="email" type="text" class="form-control login-inp @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Mail Id" required>
                                            <i class="bi bi-envelope"></i>
                                             
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-12 mb-4 inputWithIcon" id="show_hide_password">
                                            {{-- <input type="password" id="password" class="form-control login-inp" value="" placeholder=" Password"> --}}
                                            <input type="password" id="password" class="form-control login-inp  @error('password') is-invalid @enderror"  name="password" placeholder="Password" required >
                                            <i class="bi bi-lock"></i>
                                            <i style="color: #1479FF;margin: 1% 78%;" class="toggle-password fa fa-fw fa-eye-slash"></i>
                                                                                   
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <button class="btn login-btn w-100" type="submit">LOGIN</button>
                                        </div>

                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->


    <script src="{{asset('assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/vendor/chart.js/chart.umd.js')}}"></script>
    <script src="{{asset('assets/vendor/echarts/echarts.min.js')}}"></script>
    <script src="{{asset('assets/vendor/quill/quill.min.js')}}"></script>
    <script src="{{asset('assets/vendor/simple-datatables/simple-datatables.js')}}"></script>
    <script src="{{asset('assets/vendor/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>
    {{-- <script src="{{asset('assets/js/main.js')}}"></script> --}}
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(".toggle-password").click(function () {
            $(this).toggleClass("fa-eye fa-eye-slash");
            input = $(this).parent().find("input");
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
</body>

</html>