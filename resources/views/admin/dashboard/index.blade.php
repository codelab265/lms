@extends('layout')
@section('title', 'Dashboard')
@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Minia</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
            <div class="col-xl-4 col-md-6">
                <!-- card -->
                <div class="card card-h-100">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <span class="text-muted mb-3 lh-1 d-block">Number of Books</span>
                                <h2 class="mb-3">
                                    <span class="counter-value" data-target="{{ $number_of_books }}">
                                        {{ $number_of_books }}
                                    </span>
                                </h2>
                            </div>

                            <!-- <div class="col-6">
                                <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                            </div> -->
                        </div>

                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xl-4 col-md-6">
                <!-- card -->
                <div class="card card-h-100">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <span class="text-muted mb-3 lh-1 d-block">Most Borrowed Book</span>
                                <h4 class="mb-3">
                                    @if ($most_borrowed_book!=null)
                                    <span  data-target="{{ $most_borrowed_book->book->title }}">{{ $most_borrowed_book->book->title }}</span>
                                    @else
                                        None
                                    @endif
                                </h4>
                            </div>

                        </div>

                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col-->

            <div class="col-xl-4 col-md-6">
                <!-- card -->
                <div class="card card-h-100">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Number of students</span>
                                <h4 class="mb-3">
                                    <span class="counter-value" data-target="{{ $number_of_students }}">{{ $number_of_students }}</span>
                                </h4>
                            </div>

                        </div>

                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->
            <div class="col-xl-4 col-md-6">
                <!-- card -->
                <div class="card card-h-100">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <span class="text-muted mb-3 lh-1 d-block text-truncate">Number of Faculties</span>
                                <h4 class="mb-3">
                                    <span class="counter-value" data-target="{{ $number_of_faculty }}">{{ $number_of_faculty }}</span>
                                </h4>
                            </div>

                        </div>

                    </div><!-- end card body -->
                </div><!-- end card -->
            </div><!-- end col -->

            <!-- end col -->
        </div><!-- end row-->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <canvas id="chartjs_bar"></canvas>
                    </div>
                </div>
            </div>
        </div>
@endsection
@push('script')
<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script type="text/javascript">
      var ctx = document.getElementById("chartjs_bar").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels:<?php echo json_encode($course) ?>,
                        datasets: [{
                            backgroundColor: [
                               "#5969ff",
                                "#ff407b",
                                "#25d5f2",
                                "#ffc750",
                                "#2ec551",
                                "#7040fa",
                                "#ff004e"
                            ],
                            data:<?php echo json_encode($total) ?>,
                        }]
                    },
                    options: {
                        legend: {
                        display: false,
                        position: 'bottom',

                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 14,
                        }
                    },


                }
                });
    </script>

@endpush
