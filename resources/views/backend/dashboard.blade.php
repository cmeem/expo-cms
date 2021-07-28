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
                    <span class="h2 m-0 text-gray-900 fw-bold">{{ $todayData[0] }}</span>
                    <span class="h5 m-0 text-gray-600 fw-bold">Visitors</span>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <img src='{{ asset('img/svgs/'. $YesterdayData[0] .'-arrow.svg') }}' width='50px' height='50px' class="text-red-500">
                </div>
            </div>

        </div>
        <div class="col-12 col-lg-4 col-3xl-2 card card-body p-2">
            <div class="d-flex justify-content-between align-items-center p-2 px-4">
                <div class="bg-purple-100 rounded-circle p-1 d-flex justify-content-center align-items-center" style='width:80px; height:80px'>
                    <i class="fas fa-users fa-lg text-purple-500 fs-1"></i>
                </div>
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <span class="h2 m-0 text-gray-900 fw-bold">{{ $todayData[1] }}</span>
                    <span class="h5 m-0 text-gray-600 fw-bold">Blog Views</span>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <img src='{{ asset('img/svgs/'. $YesterdayData[1] .'-arrow.svg') }}' width='50px' height='50px' class="text-red-500">
                </div>
            </div>

        </div>
        <div class="col-12 col-lg-4 col-3xl-2 card card-body p-2">
            <div class="d-flex justify-content-between align-items-center p-2 px-4">
                <div class="bg-yellow-100 rounded-circle p-1 d-flex justify-content-center align-items-center" style='width:80px; height:80px'>
                    <i class="fas fa-thumbs-up fa-lg text-yellow-500 fs-1"></i>
                </div>
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <span class="h2 m-0 text-gray-900 fw-bold">{{ $todayData[2] }}</span>
                    <span class="h5 m-0 text-gray-600 fw-bold">Likes</span>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <img src='{{ asset('img/svgs/'. $YesterdayData[2] .'-arrow.svg') }}' width='50px' height='50px' class="text-red-500">
                </div>
            </div>

        </div>
        <div class="col-12 col-lg-4 col-3xl-2 card card-body p-2">
            <div class="d-flex justify-content-between align-items-center p-2 px-4">
                <div class="bg-green-100 rounded-circle p-1 d-flex justify-content-center align-items-center" style='width:80px; height:80px'>
                    <i class="fas fa-comment fa-lg text-green-500 fs-1"></i>
                </div>
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <span class="h2 m-0 text-gray-900 fw-bold">{{ $todayData[3] }}</span>
                    <span class="h5 m-0 text-gray-600 fw-bold">Comments</span>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <img src='{{ asset('img/svgs/'. $YesterdayData[3] .'-arrow.svg') }}' width='50px' height='50px' class="text-red-500">
                </div>
            </div>

        </div>
    </div>
    <div class="row gap-3 mx-1">
        <div class="col-12 col-lg-8 col-3xl-4 card card-body p-2" >
            <span class="h6 fw-bold text-gray-700" style="font-size:14px">Report of last 7 Days</span>
            {{ $views->container() }}
        </div>
        <div class="col-12 col-lg-4 col-3xl-2 card card-body p-2" >
            <span class="h6 fw-bold text-gray-700" style="font-size:14px">Goals of {{ $cerrentDate[1] }}</span>
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
    {{ $views->script() }}
    {{ $yearReport->script() }}
    <script>
        // monthly report start
        var options = {
            series: [{{ $monthRadialChart[0] }}, {{ $monthRadialChart[1] }}, {{ $monthRadialChart[2] }}],
          chart: {
          height: 500,
          type: 'radialBar',
        },
        plotOptions: {
          radialBar: {
            dataLabels: {
              name: {
                fontSize: '26px',
              },
              value: {
                fontSize: '22px',
                formatter: function(val) {
                  return parseInt(val);
                },
              },
              total: {
                show: true,
                label: 'Total Point of {{ $cerrentDate[1] }}',
                formatter: function (w) {
                  return {{ $monthRadialChart[0] + $monthRadialChart[1]  +$monthRadialChart[2] }}
                }
              }
            }
          }
        },
        labels: ['Views', 'Likes', 'Comments'],
        };
        var chart = new ApexCharts(document.querySelector("#month_report"), options);
        chart.render();
        // monthly report ends

        //
    </script>
@endsection
</div>
