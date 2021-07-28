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
        $all_views=Views::all();
        $all_likes=Likes::all();
        $all_comments=Comments::all();
        $today=Carbon::today()->dayName;
        $thisMonth=Carbon::today()->monthName;
        $thisYear=Carbon::today()->format('Y');
        $cerrentDate=[$today,$thisMonth,$thisYear];

        /////////////////////////////// report of 7 days chart //////////////////////////////////////
        $oneweek = Carbon::now()->subDays(7);
        $ViewsWeekData=$all_views->where('created_at','>',$oneweek)->toArray();
        $CommentsWeekData=$all_comments->where('created_at','>',$oneweek)->toArray();
        $LikesWeekData=$all_likes->where('created_at','>',$oneweek)->toArray();
        for ($i=0; $i < 7 ; $i++) {
            $weekDataArray[$i]['day'] = $oneweek->addDays()->dayName;
            foreach ($ViewsWeekData as $key) {
                if (Carbon::parse($key['created_at'])->format('Y-m-d') == Carbon::parse($oneweek)->format('Y-m-d')) {
                    $weekDataArray[$i]['views'][] = $key['id'];
                }
            }
            foreach ($CommentsWeekData as $key) {
                if (Carbon::parse($key['created_at'])->format('Y-m-d') == Carbon::parse($oneweek)->format('Y-m-d')) {
                    $weekDataArray[$i]['comments'][] = $key['id'];
                }
            }
            foreach ($LikesWeekData as $key) {
                if (Carbon::parse($key['created_at'])->format('Y-m-d') == Carbon::parse($oneweek)->format('Y-m-d')) {
                    $weekDataArray[$i]['likes'][] = $key['id'];
                }
            }
        }
        for ($i=0; $i <sizeof($weekDataArray); $i++) {
            if(isset($weekDataArray[$i]['views'])){
                $weekViewsData[$i]=count($weekDataArray[$i]['views']);
            }else{
                $weekViewsData[$i]=0;
            }
            if(isset($weekDataArray[$i]['comments'])){
                $weekCommentsData[$i]=count($weekDataArray[$i]['comments']);
            }else{
                $weekCommentsData[$i]=0;
            }
            if(isset($weekDataArray[$i]['likes'])){
                $weekLikesData[$i]=count($weekDataArray[$i]['likes']);
            }else{
                $weekLikesData[$i]=0;
            }
            $days[$i]=$weekDataArray[$i]['day'];
        }
        $weekDataArray=[];
        $views = LarapexChart::areaChart()
        ->addData('Comments',$weekCommentsData)
        ->addData('Likes',$weekLikesData)
        ->addData('Views',$weekViewsData)
        ->setXAxis($days)
        ->setColors(['#BE0AFF','#ffc107','#FF0000'])
        ->setMarkers(['#BE0AFF','#ffc107','#FF0000'], 0,6);
        /////////////////////////////// end  7 days chart //////////////////////////////////////

        /////////////////////////////// report of year chart //////////////////////////////////////
        $oneyear = Carbon::now()->startOfYear()->subMonths(1);
        $ViewsYearData=$all_views->where('created_at','>',$oneyear)->toArray();
        $CommwntsYearData=$all_comments->where('created_at','>',$oneyear)->toArray();
        $LikesYearData=$all_likes->where('created_at','>',$oneyear)->toArray();
        for ($i=0; $i < 12 ; $i++) {
            $YearDataArray[$i]['month'] = $oneyear->addMonths()->format('m');
            foreach ($ViewsYearData as $key) {
                if (Carbon::parse($key['created_at'])->format('Y-m') == Carbon::parse($oneyear)->format('Y-m')) {
                    $YearDataArray[$i]['views'][] = $key['id'];
                }
            }
            foreach ($CommwntsYearData as $key) {
                if (Carbon::parse($key['created_at'])->format('Y-m') == Carbon::parse($oneyear)->format('Y-m')) {
                    $YearDataArray[$i]['comments'][] = $key['id'];
                }
            }
            foreach ($LikesYearData as $key) {
                if (Carbon::parse($key['created_at'])->format('Y-m') == Carbon::parse($oneyear)->format('Y-m')) {
                    $YearDataArray[$i]['likes'][] = $key['id'];
                }
            }
        }
        for ($i=0; $i <12; $i++) {
            if(isset($YearDataArray[$i]['views'])){
                $yearViewsData[$i]=count($YearDataArray[$i]['views']);
            }else{
                $yearViewsData[$i]=0;
            }
            if(isset($YearDataArray[$i]['comments'])){
                $yearCommentsData[$i]=count($YearDataArray[$i]['comments']);
            }else{
                $yearCommentsData[$i]=0;
            }
            if(isset($YearDataArray[$i]['likes'])){
                $yearLikesData[$i]=count($YearDataArray[$i]['likes']);
            }else{
                $yearLikesData[$i]=0;
            }
            $months[$i]=$YearDataArray[$i]['month'];
        }
        $yearReport = LarapexChart::barChart()
        ->addData('Comments', $yearCommentsData)
        ->addData('Likes', $yearLikesData)
        ->addData('Views', $yearViewsData)
        ->setColors(['#BE0AFF','#ffc107','#FF0000'])
        ->setMarkers(['#BE0AFF','#ffc107','#FF0000'], 0,6)
        ->setXAxis($months);
        /////////////////////////////// end year chart //////////////////////////////////////

        /////////////////////////////// report of month chart //////////////////////////////////////
        $onemonth = Carbon::now()->startOfMonth()->subDays(1);
        $ViewsMonthData=$all_views->where('created_at','>',$onemonth)->toArray();
        $CommwntsMonthData=$all_comments->where('created_at','>',$onemonth)->toArray();
        $LikesMonthData=$all_likes->where('created_at','>',$onemonth)->toArray();
        $monthRadialChart=[count($ViewsMonthData),count($LikesMonthData),count($CommwntsMonthData)];
        /////////////////////////////// end year chart //////////////////////////////////////

        /////////////////////////////// day report function //////////////////////////////////////
        $todaydate = Carbon::today();
        $visitorsDayData=$all_views->where('created_at','>',$todaydate)->toArray(); /// need to be changed to visitors instede of views
        $ViewsDayData=$all_views->where('created_at','>',$todaydate)->toArray();
        $CommwntsDayData=$all_comments->where('created_at','>',$todaydate)->toArray();
        $LikesDayData=$all_likes->where('created_at','>',$todaydate)->toArray();
        $dayData=[count($visitorsDayData),count($ViewsDayData),count($LikesDayData),count($CommwntsDayData)];

        $yesterday = Carbon::today()->subday(1);
        $visitorsYesterdayData=$all_views->where('created_at','>',$yesterday)->where('created_at','<',$todaydate)->toArray(); /// need to be changed to visitors instede of views
        $ViewsYesterdayData=$all_views->where('created_at','>',$yesterday)->where('created_at','<',$todaydate)->toArray();
        $CommwntsYesterdayData=$all_comments->where('created_at','>',$yesterday)->where('created_at','<',$todaydate)->toArray();
        $LikesYesterdayData=$all_likes->where('created_at','>',$yesterday)->where('created_at','<',$todaydate)->toArray();
        $visitorsStatus="up";
        $viewsStatus="up";
        $likesStatus="up";
        $commentsStatus="up";
        if(count($visitorsYesterdayData) > count($visitorsDayData)){
            $visitorsStatus="down";
        }
        if(count($ViewsYesterdayData) > count($ViewsDayData)){
            $viewsStatus="down";
        }
        if(count($CommwntsYesterdayData) > count($CommwntsDayData)){
            $commentsStatus="down";
        }
        if(count($LikesYesterdayData) > count($LikesDayData)){
            $likesStatus="down";
        }
        $YesterdayData=[$visitorsStatus,$viewsStatus,$likesStatus,$commentsStatus];
        // dd($dayData,$YesterdayData,$ViewsYesterdayData);
        return view('backend.dashboard', [
            'cerrentDate'=>$cerrentDate,
            'views'=>$views,
            'yearReport'=>$yearReport,
            'monthRadialChart'=>$monthRadialChart,
            'todayData'=>$dayData,
            'YesterdayData'=>$YesterdayData,
        ]);
    }

}
