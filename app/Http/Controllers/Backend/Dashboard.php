<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Likes;
use App\Models\Views;
use Livewire\Component;
use App\Models\Comments;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use ArielMejiaDev\LarapexCharts\Facades\LarapexChart;

class Dashboard extends Component
{
    public $lastPost;
    public $day;
    public $week;
    public $month;

    public function render()
{
        $today=Carbon::today()->dayName;
        $thisMonth=Carbon::today()->monthName;
        $thisYear=Carbon::today()->format('Y');
        $cerrentDate=[$today,$thisMonth,$thisYear];

        /////////////////////////////// report of 7 days chart //////////////////////////////////////
        $weekStart = Carbon::now()->subDays(7);
        $weekEnd   = Carbon::now()->endOfDay();
        $wCount['views'] = Views::where('created_at', '>', $weekStart)->where('created_at', '<=', $weekEnd)
        ->groupBy('date')
        ->get(array(
            DB::raw('Date(created_at) as date'),
            DB::raw('COUNT(*) as "count"')
        ))->toArray();
        $wCount['comments'] = Comments::where('created_at', '>', $weekStart)->where('created_at', '<=', $weekEnd)
        ->groupBy('date')
        ->get(array(
            DB::raw('Date(created_at) as date'),
            DB::raw('COUNT(*) as "count"')
        ))->toArray();
        $wCount['likes'] = Likes::where('created_at', '>', $weekStart)->where('created_at', '<=', $weekEnd)
        ->groupBy('date')
        ->get(
            array(
            DB::raw('Date(created_at) as date'),
            DB::raw('COUNT(*) as "count"')
        )
        )->toArray();

        for ($i=0; $i < 7 ; $i++) {
            $date   = Carbon::now()->subDays($i)->format('Y-m-d');
            $FwCount['views'][$i] = 0;
            $FwCount['comments'][$i] = 0;
            $FwCount['likes'][$i] = 0;
            $FwCount['date'][$i] = Carbon::parse($date)->dayName;
            foreach ( $wCount['views'] as $view){
                if ( $view['date'] == $date) {
                    $FwCount['views'][$i]=$view['count'];
                }
            }
            foreach ( $wCount['comments'] as $comment){
                if ( $comment['date'] == $date) {
                    $FwCount['comments'][$i]=$comment['count'];
                }
            }
            foreach ( $wCount['likes'] as $like){
                if ( $like['date'] == $date) {
                    $FwCount['likes'][$i]=$like['count'];
                }
            }

        }
        $weekReport = LarapexChart::areaChart()
        ->addData('Comments',array_reverse($FwCount['comments']))
        ->addData('Likes',array_reverse($FwCount['likes']))
        ->addData('Views',array_reverse($FwCount['views']))
        ->setXAxis(array_reverse($FwCount['date']))
        ->setColors(['#BE0AFF','#ffc107','#FF0000'])
        ->setMarkers(['#BE0AFF','#ffc107','#FF0000'], 0,6);
        /////////////////////////////// end  7 days chart //////////////////////////////////////

        /////////////////////////////// day report  //////////////////////////////////////
        $todayReport =[$FwCount['views'][0],$FwCount['views'][0],$FwCount['likes'][0],$FwCount['comments'][0]];
        $visitorsStatus="down";
        $viewsStatus="down";
        $commentsStatus="down";
        $likesStatus="down";
        if($FwCount['views'][0] > $FwCount['views'][1]){
            $visitorsStatus="up";
            $viewsStatus="up";
        }
        if($FwCount['comments'][0] > $FwCount['comments'][1]){
            $commentsStatus="up";
        }
        if($FwCount['likes'][0] > $FwCount['likes'][1]){
            $likesStatus="up";
        }
        $Status=[$visitorsStatus,$viewsStatus,$likesStatus,$commentsStatus];
        /////////////////////////////// end day report  //////////////////////////////////////

        /////////////////////////////// report of year chart //////////////////////////////////////
        if(! Cache::get('yearReport')){
        $yearStart = Carbon::today()->startOfYear();
        $yearEnd = Carbon::today()->endOfYear();
        $mCount['views'] = Views::where('created_at', '>', $yearStart)->where('created_at', '<', $yearEnd)
        ->groupBy('month')
        ->get(array(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as "count"')
        ))->toArray();
        $mCount['comments'] = Comments::where('created_at', '>', $yearStart)->where('created_at', '<', $yearEnd)
        ->groupBy('month')
        ->get(array(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as "count"')
        ))->toArray();
        $mCount['likes'] = Likes::where('created_at', '>', $yearStart)->where('created_at', '<', $yearEnd)
        ->groupBy('month')
        ->get(
            array(
                DB::raw('MONTH(created_at) month'),
                DB::raw('COUNT(*) as "count"')
        )
        )->toArray();
        $mCount = Cache::remember('yearReport', 60*24 , function () use ($mCount) {
            return $mCount;
        });
        }
        $mCount = Cache::get('yearReport');

        for ($i=0; $i < 12 ; $i++) {
            $date = Carbon::now()->endOfYear()->startOfMonth()->subMonths($i)->format('m');
            // $date[$i]= Carbon::now()->subMonths($i)->format('m');
            $FmCount['views'][$i] = 0;
            $FmCount['comments'][$i] = 0;
            $FmCount['likes'][$i] = 0;
            $FmCount['month'][$i] = Carbon::now()->endOfYear()->startOfMonth()->subMonths($i)->monthName;
            foreach ( $mCount['views'] as $view){
                if ( $view['month'] == $date) {
                    $FmCount['views'][$i]=$view['count'];
                }
            }
            foreach ( $mCount['comments'] as $comment){
                if ( $comment['month'] == $date) {
                    $FmCount['comments'][$i]=$comment['count'];
                }
            }
            foreach ( $mCount['likes'] as $like){
                if ( $like['month'] == $date) {
                    $FmCount['likes'][$i]=$like['count'];
                }
            }
        }
        // dd($date);

        // dd($mCount,$FmCount);


        $yearReport = LarapexChart::barChart()
        ->addData('Comments',array_reverse($FmCount['comments']))
        ->addData('Likes',array_reverse($FmCount['likes']))
        ->addData('Views',array_reverse($FmCount['views']))
        ->setXAxis(array_reverse($FmCount['month']))
        ->setColors(['#BE0AFF','#ffc107','#FF0000'])
        ->setMarkers(['#BE0AFF','#ffc107','#FF0000'], 0,6);
        /////////////////////////////// end year chart //////////////////////////////////////

        /////////////////////////////// report of month chart //////////////////////////////////////

        $cerrentMonth = Carbon::now()->format('m') -2;
        $monthReport =[$FmCount['views'][$cerrentMonth],$FmCount['likes'][$cerrentMonth],$FmCount['comments'][$cerrentMonth]];

        /////////////////////////////// end year chart //////////////////////////////////////


        return view('backend.dashboard', [
            'todayReport'=>$todayReport,
            'weekReport'=>$weekReport,
            'monthReport'=>$monthReport,
            'yearReport'=>$yearReport,
            'Status'=>$Status,
            'cerrentDate'=>$cerrentDate,
        ]);
    }

}
