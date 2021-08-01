<div class="row gap-3 mx-1">
@section('nav_buttons')

@endsection
    <div class="row gap-3 mx-1">
        <div class="col-12 col-lg-4 col-3xl-2 card card-body p-2 00px">
            <div class="d-flex justify-content-between align-items-center p-2 px-4">
                <div class="bg-red-100 rounded-circle p-1 d-flex justify-content-center align-items-center" style='width:80px; height:80px'>
                    <i class="fas fa-chart-bar fa-lg text-red-500 fs-1"></i>
                </div>
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <span class="h2 m-0 text-gray-900 fw-bold">{{ $todayReport[0] }}</span>
                    <span class="h5 m-0 text-gray-600 fw-bold">Visitors</span>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <img src='{{ asset('img/svgs/'. $Status[0] .'-arrow.svg') }}' width='50px' height='50px' class="text-red-500">
                </div>
            </div>

        </div>
        <div class="col-12 col-lg-4 col-3xl-2 card card-body p-2">
            <div class="d-flex justify-content-between align-items-center p-2 px-4">
                <div class="bg-purple-100 rounded-circle p-1 d-flex justify-content-center align-items-center" style='width:80px; height:80px'>
                    <i class="fas fa-users fa-lg text-purple-500 fs-1"></i>
                </div>
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <span class="h2 m-0 text-gray-900 fw-bold">{{ $todayReport[1] }}</span>
                    <span class="h5 m-0 text-gray-600 fw-bold">Blog Views</span>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <img src='{{ asset('img/svgs/'. $Status[1] .'-arrow.svg') }}' width='50px' height='50px' class="text-red-500">
                </div>
            </div>

        </div>
        <div class="col-12 col-lg-4 col-3xl-2 card card-body p-2">
            <div class="d-flex justify-content-between align-items-center p-2 px-4">
                <div class="bg-yellow-100 rounded-circle p-1 d-flex justify-content-center align-items-center" style='width:80px; height:80px'>
                    <i class="fas fa-thumbs-up fa-lg text-yellow-500 fs-1"></i>
                </div>
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <span class="h2 m-0 text-gray-900 fw-bold">{{ $todayReport[2] }}</span>
                    <span class="h5 m-0 text-gray-600 fw-bold">Likes</span>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <img src='{{ asset('img/svgs/'. $Status[2] .'-arrow.svg') }}' width='50px' height='50px' class="text-red-500">
                </div>
            </div>

        </div>
        <div class="col-12 col-lg-4 col-3xl-2 card card-body p-2">
            <div class="d-flex justify-content-between align-items-center p-2 px-4">
                <div class="bg-green-100 rounded-circle p-1 d-flex justify-content-center align-items-center" style='width:80px; height:80px'>
                    <i class="fas fa-comment fa-lg text-green-500 fs-1"></i>
                </div>
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <span class="h2 m-0 text-gray-900 fw-bold">{{ $todayReport[3] }}</span>
                    <span class="h5 m-0 text-gray-600 fw-bold">Comments</span>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <img src='{{ asset('img/svgs/'. $Status[3] .'-arrow.svg') }}' width='50px' height='50px' class="text-red-500">
                </div>
            </div>

        </div>
    </div>
    <div class="row gap-3 mx-1">
        <div class="col-12 col-lg-8 col-3xl-4 card card-body p-2" >
            <span class="h6 fw-bold text-gray-700" style="font-size:14px">Report of last 7 Days</span>
            {{ $weekReport->container() }}
        </div>
        <div class="col-12 col-lg-4 col-3xl-2 card card-body p-2" >
            <span class="h6 fw-bold text-gray-700" style="font-size:14px">Totals of {{ $cerrentDate[1] }}</span>
            <div id="month_report" class=""></div>
        </div>
    </div>
    <div class="row gap-3 mx-1">
        <div class="col-12 col-lg-8 col-3xl-4 card card-body p-2" >
            <span class="h6 fw-bold text-gray-700" style="font-size:14px">Report of {{ $cerrentDate[2] }}</span>
            {{ $yearReport->container() }}
        </div>
    </div>
    <div class="row gap-3 mx-1">
        <div class="col-12 col-lg-4 col-3xl-2 card card-body p-2" ></div>
        <div class="col-12 col-lg-4 col-3xl-2 card card-body p-2" ></div>
        <div class="col-12 col-lg-4 col-3xl-2 card card-body p-2" ></div>
    </div>
@section('page_style')

@endsection
@section('page_script')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    {{ $weekReport->script() }}
    {{ $yearReport->script() }}
    <script>
        var options = {
          series: [{{ $monthReport[0] }}, {{ $monthReport[1] }}, {{ $monthReport[2] }}],
          chart: {
          height: 500,
          type: 'donut',
        },
        dataLabels: {
          enabled: false
        },
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              show: false
            }
          }
        }],
        legend: {
          position: 'right',
          offsetY: 0,
          height: 230,
        },
        labels: ['Views', 'Likes', 'Comments'],
        colors:['#FF0000','#ffc107','#BE0AFF']
        };

        var chart = new ApexCharts(document.querySelector("#month_report"), options);
        chart.render();

    </script>
@endsection
</div>
