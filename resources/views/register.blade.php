<head>

    <title>Register | Minia - Admin & Dashboard Template</title>
    <link rel="stylesheet" href="{{ asset('assets/css/preloader.min.css') }}" type="text/css" />

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>
    <div class="auth-page">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-xxl-3 col-lg-6 col-md-5">
                    <div class="auth-full-page-content d-flex p-sm-5 p-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100">
                                <div class="mb-4 mb-md-4 text-center">
                                    <a href="auth-register.php" class="d-block auth-logo">
                                        <img src="{{ asset('images/OCC_LOGO.png') }}" alt="" height="40">
                                        <span class="logo-txt">Library Management System</span>
                                    </a>
                                </div>
                                <div class="auth-content my-auto">
                                    <div class="text-center">
                                        <h5 class="mb-0">Register Account</h5>
                                        <p class="text-muted mt-2">Get your free OCC LMS account now.</p>
                                        @if (session('success'))
                                            <div class="alert alert-success" role="alert">
                                                <strong>{{ session('success') }}</strong>
                                            </div>
                                        @endif
                                    </div>
                                    <form class="needs-validation custom-form mt-4 pt-2" enctype="multipart/form-data"
                                        action="{{ route('register') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="role">Select Type</label>
                                                    <select class="form-control" name="role" id="role">
                                                        <option value="">Select</option>
                                                        <option value="2">Student</option>
                                                        <option value="3">Faculty</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="useremail" class="form-label">First Name</label>
                                                    <input type="text" class="form-control" id="first name"
                                                        placeholder="Enter first name" required name="fname">
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Middle Name</label>
                                                    <input type="text" class="form-control" id="middle name"
                                                        placeholder="Enter middle name" name="mname">
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label for="userpassword" class="form-label">Last Name</label>
                                                    <input type="text" class="form-control" id="lname"
                                                        placeholder="Enter password" required name="lname"
                                                        value="">
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4" id="gender_column" style="transition: 0.5s">
                                                <div class="mb-3">
                                                    <label for="userpassword" class="form-label">Gender</label>
                                                    <select name="gender" class="form-control" id="gender">
                                                        <option selected="" disabled="">Select Gender</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4" id="course_column">
                                                <div class="mb-3">
                                                    <label for="userpassword" class="form-label">Course</label>
                                                    <select name="course" class="form-control" id="course"
                                                        required="">
                                                        <option selected="" disabled="">Select Course</option>
                                                        <option value="BSIT">BSIT</option>
                                                        <option value="BSED">BSED</option>
                                                        <option value="BEED">BEED</option>
                                                        <option value="BSBA">BSBA</option>
                                                    </select>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4" id="level_column">
                                                <div class="mb-3">
                                                    <label for="userpassword" class="form-label">Year Level</label>
                                                    <select name="level" class="form-control" id="gender">
                                                        <option selected="" disabled="">Select Year Level
                                                        </option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                    </select>
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="userpassword" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email"
                                                        placeholder="Enter email" required name="email">
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="userpassword" class="form-label">Password</label>
                                                    <input type="password" class="form-control" id="userpassword"
                                                        placeholder="Enter password" required name="password">
                                                    <span class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="mb-4">
                                            <p class="mb-0">By registering you agree to the Minia <a href="#"
                                                    class="text-primary">Terms of Use</a></p>
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-primary w-100 waves-effect waves-light"
                                                name="btn_register" type="submit">Register</button>
                                        </div>
                                    </form>

                                    <!-- <div class="mt-4 pt-2 text-center">
                                    <div class="signin-other-title">
                                        <h5 class="font-size-14 mb-3 text-muted fw-medium">- Sign up using -</h5>
                                    </div>

                                    <ul class="list-inline mb-0">
                                        <li class="list-inline-item">
                                            <a href="javascript:void()" class="social-list-item bg-primary text-white border-primary">
                                                <i class="mdi mdi-facebook"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript:void()" class="social-list-item bg-info text-white border-info">
                                                <i class="mdi mdi-twitter"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="javascript:void()" class="social-list-item bg-danger text-white border-danger">
                                                <i class="mdi mdi-google"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div> -->

                                    <div class="mt-5 text-center">
                                        <p class="text-muted mb-0">Already have an account ? <a
                                                href="{{ route('login') }}" class="text-primary fw-semibold"> Login
                                            </a> </p>
                                    </div>
                                </div>
                                <div class="mt-4 mt-md-5 text-center">
                                    <p class="mb-0">©
                                        <script>
                                            document.write(new Date().getFullYear())
                                        </script> Minia . Crafted with <i
                                            class="mdi mdi-heart text-danger"></i> by Themesbrand
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end auth full page content -->
                </div>
                <!-- end col -->
                <div class="col-xxl-9 col-lg-6 col-md-7">
                    <div class="auth-bg pt-md-5 p-4 d-flex">
                        <div class="bg-overlay bg-primary"></div>
                        <ul class="bg-bubbles">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                        <!-- end bubble effect -->
                 <div class="row justify-content-center align-items-center">
                        <div class="col-xl-7">
                            <div class="p-0 p-sm-4 px-xl-0">
                                <div id="reviewcarouselIndicators" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-indicators carousel-indicators-rounded justify-content-start ms-0 mb-0">
                                        <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                        <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                        <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                        <button type="button" data-bs-target="#reviewcarouselIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                                    </div>
                                    <!-- end carouselIndicators -->
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <div class="testi-contain text-white">
                                                <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                <h4 class="mt-4 fw-medium lh-base text-white">“Hello Everyone I am Hiler Jehn Macion and I am the Project Manager of this Capstone Study!”
                                                </h4>
                                                <div class="mt-4 pt-3 pb-5">
                                                    <div class="d-flex align-items-start">
                                                        <div class="flex-shrink-0">
                                                            <img src="assets/images/users/hiler.jpg" class="avatar-md img-fluid rounded-circle" alt="...">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3 mb-4">
                                                            <h5 class="font-size-18 text-white">Hiler Jehn Macion
                                                            </h5>
                                                            <p class="mb-0 text-white-50">Projet Manager</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="carousel-item">
                                            <div class="testi-contain text-white">
                                                <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                <h4 class="mt-4 fw-medium lh-base text-white">“Hello Everyone I am RS John Cariliman and I'm the Technical Wrtiter of this Capstone Study!”</h4>
                                                <div class="mt-4 pt-3 pb-5">
                                                    <div class="d-flex align-items-start">
                                                        <div class="flex-shrink-0">
                                                            <img src="assets/images/users/rs.jpg" class="avatar-md img-fluid rounded-circle" alt="...">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3 mb-4">
                                                            <h5 class="font-size-18 text-white">RS John Cariliman
                                                            </h5>
                                                            <p class="mb-0 text-white-50">Technical Writter</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="carousel-item">
                                            <div class="testi-contain text-white">
                                                <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                <h4 class="mt-4 fw-medium lh-base text-white">“Hello Everyone I am Eljon Obsioma and I'm the System Analyst of this Capstone Study!”</h4>
                                                <div class="mt-4 pt-3 pb-5">
                                                    <div class="d-flex align-items-start">
                                                        <img src="assets/images/users/eljon.jpg" class="avatar-md img-fluid rounded-circle" alt="...">
                                                        <div class="flex-1 ms-3 mb-4">
                                                            <h5 class="font-size-18 text-white">Eljon Obsioma</h5>
                                                            <p class="mb-0 text-white-50">System Analyst
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                         <div class="carousel-item">
                                            <div class="testi-contain text-white">
                                                <i class="bx bxs-quote-alt-left text-success display-6"></i>

                                                <h4 class="mt-4 fw-medium lh-base text-white">“Hello Everyone I am Kane Desierto and I'm the Programmer of this Capstone Study!”</h4>
                                                <div class="mt-4 pt-3 pb-5">
                                                    <div class="d-flex align-items-start">
                                                        <div class="flex-shrink-0">
                                                            <img src="assets/images/users/kane2.jpg" class="avatar-md img-fluid rounded-circle" alt="...">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3 mb-4">
                                                            <h5 class="font-size-18 text-white">Desierto Kane
                                                            </h5>
                                                            <p class="mb-0 text-white-50">Programmer</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end carousel-inner -->
                                </div>
                                <!-- end review carousel -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container fluid -->
</div>


<!-- JAVASCRIPT -->
<!-- JAVASCRIPT -->
<script src="{{ asset("assets/libs/jquery/jquery.min.js") }}"></script>
<script src="{{ asset("assets/libs/bootstrap/js/bootstrap.bundle.min.js") }}"></script>
<script src="{{ asset("assets/libs/metismenu/metisMenu.min.js") }}"></script>
<script src="{{ asset("assets/libs/simplebar/simplebar.min.js") }}"></script>
<script src="{{ asset("assets/libs/node-waves/waves.min.js") }}"></script>
<script src="{{ asset("assets/libs/feather-icons/feather.min.js") }}"></script>
<!-- pace js -->
<script src="{{ asset("assets/libs/pace-js/pace.min.js") }}"></script>
<!-- password addon init -->
<script src="{{ asset("assets/js/pages/pass-addon.init.js") }}"></script>

    <script>
        $('body').on('change', '#role', function() {
            var role = $('#role').val();
            if (role == "") {
                return false
            } else {
                if (role == 3) {
                    $("#course_column").hide();
                    $("#level_column").hide();
                    $("#gender_column").removeClass("col-md-4");
                    $("#gender_column").addClass("col-md-12");
                } else {
                    $("#course_column").show();
                    $("#level_column").show();
                    $("#gender_column").removeClass("col-md-12");
                    $("#gender_column").addClass("col-md-4");

                }
            }
        })

        $(function() {

            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000,
            });



        })
    </script>
</body>

</html>
