<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Likes;
use App\Models\Views;
use Livewire\Component;
use App\Models\Comments;
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
        for ($i=0; $i < 7 ; $i++) {
            $dayStart = Carbon::now()->subDays(7)->addDays($i);
            $dayEnd   = Carbon::now()->subDays(6)->addDays($i);
            $days[$i] = $dayEnd->dayName;
            $wCount['views'][$i] = Views::where('created_at','>',$dayStart)->where('created_at','<',$dayEnd)->count();
            $wCount['comments'][$i] = Comments::where('created_at','>',$dayStart)->where('created_at','<',$dayEnd)->count();
            $wCount['likes'][$i] = Likes::where('created_at','>',$dayStart)->where('created_at','<',$dayEnd)->count();
        }
        $weekReport = LarapexChart::areaChart()
        ->addData('Comments',$wCount['comments'])
        ->addData('Likes',$wCount['likes'])
        ->addData('Views',$wCount['views'])
        ->setXAxis($days)
        ->setColors(['#BE0AFF','#ffc107','#FF0000'])
        ->setMarkers(['#BE0AFF','#ffc107','#FF0000'], 0,6);
        /////////////////////////////// end  7 days chart //////////////////////////////////////

        /////////////////////////////// day report  //////////////////////////////////////
        $todayReport =[$wCount['views'][6],$wCount['views'][6],$wCount['likes'][6],$wCount['comments'][6]];
        $visitorsStatus="down";
        $viewsStatus="down";
        $commentsStatus="down";
        $likesStatus="down";
        if($wCount['views'][6] > $wCount['views'][5]){
            $visitorsStatus="up";
            $viewsStatus="up";
        }
        if($wCount['comments'][6] > $wCount['comments'][5]){
            $commentsStatus="up";
        }
        if($wCount['likes'][6] > $wCount['likes'][5]){
            $likesStatus="up";
        }
        $Status=[$visitorsStatus,$viewsStatus,$likesStatus,$commentsStatus];
        /////////////////////////////// end day report  //////////////////////////////////////

        /////////////////////////////// report of year chart //////////////////////////////////////

        for ($i=0; $i < 12 ; $i++) {
            $monthStart = Carbon::today()->startOfYear()->addMonths($i);
            $monthEnd = Carbon::today()->startOfYear()->addMonths($i)->endOfMonth();
            $months[$i] = $monthEnd->monthName;
            $mCount['views'][$i]=Views::where('created_at','>',$monthStart)->where('created_at','<',$monthEnd)->count();
            $mCount['comments'][$i]=Comments::where('created_at','>',$monthStart)->where('created_at','<',$monthEnd)->count();
            $mCount['likes'][$i]=Likes::where('created_at','>',$monthStart)->where('created_at','<',$monthEnd)->count();
        }
        // dd($months,$mCount['comments'],$mCount['likes'],$mCount['views']);
        $yearReport = LarapexChart::barChart()
        ->addData('Comments', $mCount['comments'])
        ->addData('Likes', $mCount['likes'])
        ->addData('Views', $mCount['views'])
        ->setColors(['#BE0AFF','#ffc107','#FF0000'])
        ->setMarkers(['#BE0AFF','#ffc107','#FF0000'], 0,6)
        ->setXAxis($months);
        /////////////////////////////// end year chart //////////////////////////////////////

        /////////////////////////////// report of month chart //////////////////////////////////////
        $cerrentMonth = Carbon::today()->format('m') - 1;
        $monthReport =[$mCount['views'][$cerrentMonth],$mCount['likes'][$cerrentMonth],$mCount['comments'][$cerrentMonth]];

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
