<?php

namespace App\Classes;


// use App\Models\AsideVerMenu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;

class Lilas
{
    public static $attrs;
    public static $classes;
    
    public static function menu_role($permission){
        if(Auth::check()){
        $user = Auth::user()->getAllPermissions()->toArray();
        for ($i=0; $i <sizeof($user); $i++) { 
            if($user[$i]['name'] == $permission){
                return true;
            }
        }
        return false; 
        }
    }

    /**
     * get the sidebar menu
     */
    public static function sidebar_menu()
    {   
        $url = $_SERVER['REQUEST_URI'];
        for($x=0 ; $x < sizeof(config('menu')) ; $x++)
        {   
            if (!config('menu.' . $x .'.sub')  && config('menu.' . $x .'.title') !== 'divider' && Lilas::menu_role(config('menu.' . $x .'.permission')) )
            {
                print '<li class="nav-item  ';
                if ($url == config('menu.' . $x .'.url')) {print 'nav_active ' ;}
                print ' " id="menu-item-';
                print config('menu.' . $x .'.id').'">';
                print '<a class="nav-link nav_link d-flex align-items-center"  href="'. config('menu.' . $x .'.url') .'">';
                if (config('menu.' . $x .'.icon') != '' && config('menu.' . $x .'.icon') != null ) {
                    print ' <i class="fas ';
                    print config('menu.' . $x .'.icon');
                    print ' nav_icon"></i>';
                } else {
                    print '<i class="fas fa-angle-double-right nav_icon"></i>';
                }
                print '<span class="nav_name"> '. config('menu.' . $x .'.title') . '</span>';
                if ($url == config('menu.' . $x .'.notification')) {
                    print '<span class="badge rounded-pill bg-danger nav_badge" style="margin-left:auto;margin-right:12px;">' . config('menu.' . $x .'.notification' ) . '</span>' ;
                }
                print '</a></li>';
            } elseif (config('menu.' . $x .'.sub') && sizeof(config('menu.' . $x .'.sub')) > 0 && config('menu.' . $x .'.title') !== 'divider' && Lilas::menu_role(config('menu.' . $x .'.permission')) ) {
                print '<li class="nav-item">';
                print '<a class="nav-link nav_link d-flex align-items-center collapsed" data-bs-toggle="collapse" data-bs-target="#menu_item_'.config('menu.' . $x .'id').'" href="#">';
                if (config('menu.' . $x .'.icon') != '' && config('menu.' . $x .'.icon') != null ) {
                    print ' <i class="fas ';
                    print config('menu.' . $x .'.icon');
                    print ' nav_icon"></i>';
                } else {
                    print '<i class="fas fa-angle-double-right nav_icon"></i>';
                }
                print '<span class="nav_name"> '. config('menu.' . $x .'.title') . '</span>';
                print '<i class="fas fa-chevron-right nav_arrow" style="margin-left:auto;margin-right:12px;"></i></a>';
                print '<ul id="menu_item_'. config('menu.' . $x .'id') .'" class="submenu submenu1 collapse" data-bs-parent="#nav_accordion">';
                for ($y=0 ; $y < sizeof(config('menu.' . $x .'.sub')) ; $y++)
                {
                    if(!config('menu.' . $x .'.sub.' . $y . '.sub')  && config('menu.' . $x .'.sub.'. $y .'.title') !== 'divider' && Lilas::menu_role(config('menu.' . $x .'.sub.'. $y .'.permission'))){
                        print '<li class="nav-item';
                        if ($url == config('menu.' .$x . '.sub.' . $y .'.url')) {
                            print ' active_link">' ;
                        }else{
                            print '">' ;
                        }
                        print '<a class="nav-link nav_link" href="'.config('menu.' .$x . '.sub.' . $y .'.url').'">';

                        if (config('menu.' . $x . '.sub.' . $y .'.icon') != '' && config('menu.' . $x . '.sub.' . $y .'.icon') != null) {
                            print '  <i class="fas ';
                            print config('menu.' . $x . '.sub.' . $y .'.icon');
                            print ' nav_icon"></i>';
                        } else {
                            print '<i class="fas fa-angle-double-right nav_icon"></i>';
                        }
                        print '<span class="nav_name">'. config('menu.' .$x . '.sub.' . $y .'.title') .'</span></a></li>';
                    }elseif(config('menu.' . $x .'.sub.' . $y . '.sub') && sizeof(config('menu.' . $x .'.sub.' . $y . '.sub')) > 0 && config('menu.' . $x .'.sub.' . $y .'.title') !== 'divider' && Lilas::menu_role(config('menu.' . $x .'.sub.' . $y .'.permission'))){
                        print '<li class="nav-item">';
                        print '<a class="nav-link nav_link d-flex align-items-center collapsed" data-bs-toggle="collapse" data-bs-target="#sub_menu_item_';
                        print config('menu.' . $x .'.sub.' . $y .'.id').'" href="#">';
                        if (config('menu.' .$x . '.sub.' . $y .'.icon') != '' && config('menu.' .$x . '.sub.' . $y .'.icon') != null ) {
                            print ' <i class="fas ';
                            print config('menu.' .$x . '.sub.' . $y .'.icon');
                            print ' nav_icon"></i>';
                        } else {
                            print '<i class="fas fa-angle-double-right nav_icon"></i>';
                        }
                        print '<span class="nav_name">'.config('menu.' . $x .'.sub.' . $y . '.title').'</span>';
                        print '<i class="fas fa-chevron-right nav_arrow" style="margin-left:auto;margin-right:12px;"></i></a>';
                        print '<ul id="sub_menu_item_'.config('menu.' . $x .'.sub.' . $y .'.id').'" class="submenu submenu2 collapse" ';
                        print 'data-bs-parent="menu_item_'. config('menu.' . $x .'id') .'">';
                        for ($d=0 ; $d < sizeof(config('menu.' . $x .'.sub.' . $y . '.sub')) ; $d++)
                        {
                            print '<li class="nav-item';
                            if ($url == config('menu.' .$x . '.sub.' . $y .'.sub.' . $d . '.url')) {
                                print ' active_link">' ;
                            }else{
                                print '">' ;
                            }
                            print '<a class="nav-link nav_link" href="' . config('menu.' .$x . '.sub.' . $y .'.sub.' . $d . '.url') . '">';
                            if (config('menu.' .$x . '.sub.' . $y .'.sub.' . $d . '.icon') != '' && config('menu.' .$x . '.sub.' . $y .'.sub.' . $d . '.icon') != null ) {
                                print ' <i class="fas ';
                                print config('menu.' .$x . '.sub.' . $y .'.sub.' . $d . '.icon');
                                print ' nav_icon"></i>';
                            } else {
                                print '<i class="fas fa-angle-double-right nav_icon"></i>';
                            }
                            print '<span class="nav_name">' . config('menu.' .$x . '.sub.' . $y .'.sub.' . $d . '.title') . '</span></a></li>';
                        }
                        print '</ul></li>';
                    }elseif(config('menu.' . $x .'.sub.' . $y . '.sub') === 'divider'){
                        print '<li class="divider"></li>';
                    }
                }
            }elseif ( config('menu.' . $x .'.title') === 'divider') {
                print '<li class="divider"></li>';
            }
        }
    }

    public static function AppSettings($setting, $value, $yes = Null, $no = Null)
    {
        if (config('settings.' . $setting) == $value) {
            echo $yes;
        } else {
            echo $no;
        };
    }
    public static function addAttr($scope, $name, $value)
    {
        self::$attrs[$scope][$name] = $value;
    }

    public static function addClass($scope, $class)
    {
        self::$classes[$scope][] = $class;
    }
    public static function printAttrs($scope)
    {
        $attrs = [];

        if (isset(self::$attrs[$scope]) && !empty(self::$attrs[$scope])) {
            foreach (self::$attrs[$scope] as $name => $value) {
                $attrs[] = $name . '="' . $value . '"';
            }
            echo ' ' . implode(' ', $attrs) . ' ';
        }
        echo '';
    }

    public static function printClasses($scope, $full = true)
    {
        if ($scope == 'body') {
            self::$classes[$scope][] = 'page-loading';
        }

        if (isset(self::$classes[$scope]) && !empty(self::$classes[$scope])) {
            $classes = implode(' ', self::$classes[$scope]);
            if ($full) {
                echo ' class="' . $classes . '" ';
            } else {
                echo ' ' . $classes . ' ';
            }
        } else {
            echo '';
        }
    }

   

    /**
     * Walk recursive array with callback
     * @param array    $array
     * @param callable $callback
     * @return array
     */
    public static function arrayWalkCallback(array &$array, callable $callback)
    {
        foreach ($array as $k => &$v) {
            if (is_array($v)) {
                $callback($k, $v, $array);
                self::arrayWalkCallback($v, $callback);
            }
        }

        return $array;
    }
    public static function setCache($name ,$value,$time=60){
        $value = Cache::remember($name,$time , function () use ($value) {
            return $value;
        });
        config()->set($name, $value);
    }
    
    /**
     * Get SVG content
     * @param string $filepath
     * @param string $class
     *
     * @return string|string[]|null
     */
    public static function getSVG($filepath, $class = '')
    {
        if (!is_string($filepath) || !file_exists($filepath)) {
            return '';
        }

        $svg_content = file_get_contents($filepath);

        $dom = new \DOMDocument();
        $dom->loadXML($svg_content);

        // remove unwanted comments
        $xpath = new \DOMXPath($dom);
        foreach ($xpath->query('//comment()') as $comment) {
            $comment->parentNode->removeChild($comment);
        }

        // remove unwanted tags
        $title = $dom->getElementsByTagName('title');
        if ($title['length']) {
            $dom->documentElement->removeChild($title[0]);
        }
        $desc = $dom->getElementsByTagName('desc');
        if ($desc['length']) {
            $dom->documentElement->removeChild($desc[0]);
        }
        $defs = $dom->getElementsByTagName('defs');
        if ($defs['length']) {
            $dom->documentElement->removeChild($defs[0]);
        }

        // remove unwanted id attribute in g tag
        $g = $dom->getElementsByTagName('g');
        foreach ($g as $el) {
            $el->removeAttribute('id');
        }
        $mask = $dom->getElementsByTagName('mask');
        foreach ($mask as $el) {
            $el->removeAttribute('id');
        }
        $rect = $dom->getElementsByTagName('rect');
        foreach ($rect as $el) {
            $el->removeAttribute('id');
        }
        $path = $dom->getElementsByTagName('path');
        foreach ($path as $el) {
            $el->removeAttribute('id');
        }
        $circle = $dom->getElementsByTagName('circle');
        foreach ($circle as $el) {
            $el->removeAttribute('id');
        }
        $use = $dom->getElementsByTagName('use');
        foreach ($use as $el) {
            $el->removeAttribute('id');
        }
        $polygon = $dom->getElementsByTagName('polygon');
        foreach ($polygon as $el) {
            $el->removeAttribute('id');
        }
        $ellipse = $dom->getElementsByTagName('ellipse');
        foreach ($ellipse as $el) {
            $el->removeAttribute('id');
        }

        $string = $dom->saveXML($dom->documentElement);

        // remove empty lines
        $string = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $string);

        $cls = array('svg-icon');
        if (!empty($class)) {
            $cls = array_merge($cls, explode(' ', $class));
        }

        echo '<span class="' . implode(' ', $cls) . '"><!--begin::Svg Icon | path:' . $filepath . '-->' . $string . '<!--end::Svg Icon--></span>';;
    }

    /**
     * Check if $path provided is SVG
     */
    public static function isSVG($path)
    {
        if (is_string($path)) {
            return substr(strrchr($path, '.'), 1) === 'svg';
        }

        return false;
    }

    /**
     * loop for values of array that comes from object
     */
    public static function getValue($array)
    {
        $v =[];
        for ($i = 0; $i < sizeof($array); $i++) {
            foreach ($array[$i] as $key => $value) {
                $v[$i] = $value;
            }
        }
        return $v;
    }
    /**
     * loop for keys of array that comes from object
     */
    public static function getKey($array)
    {   
        for ($i = 0; $i < sizeof($array); $i++) {
            foreach ($array[$i] as $key => $value) {
                $k[$i] = $key;
            }
        }
        return $k;
    }
    public static function opjectToArray($array)
    {
        $v = json_decode(json_encode($array), true);
        return $v;

    }
    public static function NumberToWords($number) {

        $hyphen      = '-';
        $conjunction = ' and ';
        $separator   = ', ';
        $negative    = 'negative ';
        $decimal     = ' point ';
        $dictionary  = array(
            0                   => 'zero',
            1                   => 'one',
            2                   => 'two',
            3                   => 'three',
            4                   => 'four',
            5                   => 'five',
            6                   => 'six',
            7                   => 'seven',
            8                   => 'eight',
            9                   => 'nine',
            10                  => 'ten',
            11                  => 'eleven',
            12                  => 'twelve',
            13                  => 'thirteen',
            14                  => 'fourteen',
            15                  => 'fifteen',
            16                  => 'sixteen',
            17                  => 'seventeen',
            18                  => 'eighteen',
            19                  => 'nineteen',
            20                  => 'twenty',
            30                  => 'thirty',
            40                  => 'fourty',
            50                  => 'fifty',
            60                  => 'sixty',
            70                  => 'seventy',
            80                  => 'eighty',
            90                  => 'ninety',
            100                 => 'hundred',
            1000                => 'thousand',
            1000000             => 'million',
            1000000000          => 'billion',
            1000000000000       => 'trillion',
            1000000000000000    => 'quadrillion',
            1000000000000000000 => 'quintillion'
        );

        if (!is_numeric($number)) {
            return false;
        }

        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
            // overflow
            trigger_error(
                'NumberToWords only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
                E_USER_WARNING
            );
            return false;
        }

        if ($number < 0) {
            return $negative . self::NumberToWords(abs($number));
        }

        $string = $fraction = null;

        if (strpos($number, '.') !== false) {
            list($number, $fraction) = explode('.', $number);
        }

        switch (true) {
            case $number < 21:
                $string = $dictionary[$number];
                break;
            case $number < 100:
                $tens   = ((int) ($number / 10)) * 10;
                $units  = $number % 10;
                $string = $dictionary[$tens];
                if ($units) {
                    $string .= $hyphen . $dictionary[$units];
                }
                break;
            case $number < 1000:
                $hundreds  = $number / 100;
                $remainder = $number % 100;
                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
                if ($remainder) {
                    $string .= $conjunction . self::NumberToWords($remainder);
                }
                break;
            default:
                $baseUnit = pow(1000, floor(log($number, 1000)));
                $numBaseUnits = (int) ($number / $baseUnit);
                $remainder = $number % $baseUnit;
                $string = self::NumberToWords($numBaseUnits) . ' ' . $dictionary[$baseUnit];
                if ($remainder) {
                    $string .= $remainder < 100 ? $conjunction : $separator;
                    $string .= self::NumberToWords($remainder);
                }
                break;
        }

        if (null !== $fraction && is_numeric($fraction)) {
            $string .= $decimal;
            $words = array();
            foreach (str_split((string) $fraction) as $number) {
                $words[] = $dictionary[$number];
            }
            $string .= implode(' ', $words);
        }

        return ucfirst ($string);
    }
    public static function ArToEnNum($string) {
        $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        $num = range(0, 9);
        return str_replace($arabic, $num, $string);
    }
    public static function getData($table,$cond, $order='ASC'){
        $quiry = DB::select('select * from `'.$table.'` where ' .$cond . ' ORDER BY id '. $order);
        $quiry = self::opjectToArray($quiry);
        return $quiry;
    }
    public static function getOneDataAsc($table,$cond,$cell,$order='ASC'){
        $quiry =DB::select('select `'.$cell.'` from `'.$table.'` where ' . $cond . ' ORDER BY id '.$order);
        $quiry = self::opjectToArray($quiry);
        $quiry = self::getvalue($quiry);
        return $quiry;
    }
    public static function getOneData($table,$cond,$cell){
        $quiry =DB::select('select `'.$cell.'` from `'.$table.'` where ' . $cond );
        $quiry = self::opjectToArray($quiry);
        $quiry = self::getvalue($quiry);
        return $quiry;
    }

    public static function progressColor(int $width = 0){
        
        if ($width == 0) {
            print 'style="width: '.$width.'%; background-color: #aaaaac"';
        }elseif($width <= 20){
            print 'style="width: '.$width.'%; background-color: #F64E60"';
        }elseif($width <= 40){
            print 'style="width: '.$width.'%; background-color: #FFA800"';
        }elseif($width <= 60){
            print 'style="width: '.$width.'%; background-color: #6f42c1"';
        }elseif($width <= 80){
            print 'style="width: '.$width.'%; background-color: #3699FF"';
        }elseif($width <= 99){
            print 'style="width: '.$width.'%; background-color: #1BC5BD"';
        }elseif($width == 100){
            print 'style="width: '.$width.'%; background-color: #1bc55c"';
        }else{
            true;
        }

    }

    public static function pageLoader($size = 30){
        echo  '<svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                    width="'. $size .'px" height="'. $size .'px" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve">
                    <path opacity="0.2" fill="#000" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946
                    s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634
                    c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z"/>
                    <path fill="#000" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0
                    C22.32,8.481,24.301,9.057,26.013,10.047z">
                    <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 20 20" to="360 20 20" dur="0.5s" repeatCount="indefinite"/>
                    </path>
                </svg>';
    }
    public static function encrypt($string){
        $encrypted = Crypt::encryptString($string);
        print_r($encrypted);
    }
    public static function decrypt($string){
        $decrypt= Crypt::decryptString($string);
        print_r($decrypt);
    }
}
