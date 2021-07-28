<?php

namespace App\Classes;

use Illuminate\Support\Facades\Crypt;

class Mb
{
    /**
     * import Google Fonts
     */
    public static function GoogleFont($font,$wght)
    {
        echo '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=' .  $font . ':wght@' .  $wght . '&display=swap">';
    }

    /**
     * page loader
     * @param intger $size
     * $size if the width and height of the page loader
     * @return string svg tag
     */
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



    public static function menu_role($permission){
        if($permission){

        return true;
        }
    }
    public static function getNotifcation($id){
        return false;
    }
    /**
     * get the sidebar menu
     */
    public static function sidebar_menu()
    {
        $url = $_SERVER['REQUEST_URI'];
        $app_name = config('settings.app_name');
        for($x=0 ; $x < sizeof(config('menu')) ; $x++)
        {
            if (!config('menu.' . $x .'.sub')  && config('menu.' . $x .'.title') !== 'divider' && Mb::menu_role(config('menu.' . $x .'.permission')) )
            {
                print '<li class="nav-item  ';
                if ($url == '/' . $app_name .config('menu.' . $x .'.url')) {print 'nav_active ' ;}
                print ' " id="menu-item-';
                print config('menu.' . $x .'.id').'">';
                print '<a class="nav-link nav_link d-flex align-items-center"  href="/' . $app_name . config('menu.' . $x .'.url') .'">';
                if (config('menu.' . $x .'.icon') != '' && config('menu.' . $x .'.icon') != null ) {
                    print ' <i class="fas ';
                    print config('menu.' . $x .'.icon');
                    print ' nav_icon"></i>';
                } else {
                    print '<i class="fas fa-angle-double-right nav_icon"></i>';
                }
                print '<span class="nav_name"> '. config('menu.' . $x .'.title') . '</span>';
                if (Mb::getNotifcation(config('menu.' . $x .'.id'))) {
                    print '<span class="badge rounded-pill bg-info nav_badge" style="margin-left:auto;margin-right:12px;">' . Mb::getNotifcation(config('menu.' . $x .'.id')) . '</span>' ;
                }
                print '</a></li>';
            } elseif (config('menu.' . $x .'.sub') && sizeof(config('menu.' . $x .'.sub')) > 0 && config('menu.' . $x .'.title') !== 'divider' && Mb::menu_role(config('menu.' . $x .'.permission')) ) {
                print '<li class="nav-item">';
                print '<a class="nav-link nav_link d-flex align-items-center collapsed" data-bs-toggle="collapse" data-bs-target="#menu_item_'.config('menu.' . $x .'.id').'">';
                if (config('menu.' . $x .'.icon') != '' && config('menu.' . $x .'.icon') != null ) {
                    print ' <i class="fas ';
                    print config('menu.' . $x .'.icon');
                    print ' nav_icon"></i>';
                } else {
                    print '<i class="fas fa-angle-double-right nav_icon"></i>';
                }
                print '<span class="nav_name"> '. config('menu.' . $x .'.title') . '</span>';
                print '<i class="fas fa-chevron-right nav_arrow" style="margin-left:auto;margin-right:12px;"></i></a>';
                print '<ul id="menu_item_'. config('menu.' . $x .'.id') .'" class="submenu submenu1 collapse" data-bs-parent="#nav_accordion">';
                for ($y=0 ; $y < sizeof(config('menu.' . $x .'.sub')) ; $y++)
                {
                    if(!config('menu.' . $x .'.sub.' . $y . '.sub')  && config('menu.' . $x .'.sub.'. $y .'.title') !== 'divider' && Mb::menu_role(config('menu.' . $x .'.sub.'. $y .'.permission'))){
                        print '<li class="nav-item';
                        if ($url == '/'.$app_name . config('menu.' .$x . '.sub.' . $y .'.url')) {
                            print ' active_link">' ;
                        }else{
                            print '">' ;
                        }
                        print '<a class="nav-link nav_link" href="/'. $app_name . config('menu.' .$x . '.sub.' . $y .'.url').'">';

                        if (config('menu.' . $x . '.sub.' . $y .'.icon') != '' && config('menu.' . $x . '.sub.' . $y .'.icon') != null) {
                            print '  <i class="fas ';
                            print config('menu.' . $x . '.sub.' . $y .'.icon');
                            print ' nav_icon"></i>';
                        } else {
                            print '<i class="fas fa-angle-double-right nav_icon"></i>';
                        }
                        print '<span class="nav_name">'. config('menu.' .$x . '.sub.' . $y .'.title') .'</span>';
                        if (Mb::getNotifcation(config('menu.' . $x .'.id'))) {
                            print '<span class="badge rounded-pill bg-info nav_badge" style="margin-left:auto;margin-right:12px; ">' . Mb::getNotifcation(config('menu.' . $x .'.id')) . '</span>' ;
                        }
                        print '</a></li>';
                    }elseif(config('menu.' . $x .'.sub.' . $y . '.sub') && sizeof(config('menu.' . $x .'.sub.' . $y . '.sub')) > 0 && config('menu.' . $x .'.sub.' . $y .'.title') !== 'divider' && Mb::menu_role(config('menu.' . $x .'.sub.' . $y .'.permission'))){
                        print '<li class="nav-item">';
                        print '<a class="nav-link nav_link d-flex align-items-center collapsed" data-bs-toggle="collapse" data-bs-target="#sub_menu_item_';
                        print config('menu.' . $x .'.sub.' . $y .'.id').'">';
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
                            if ($url == '/'. $app_name . config('menu.' .$x . '.sub.' . $y .'.sub.' . $d . '.url')) {
                                print ' active_link">' ;
                            }else{
                                print '">' ;
                            }
                            print '<a class="nav-link nav_link" href="/'.$app_name . config('menu.' .$x . '.sub.' . $y .'.sub.' . $d . '.url') . '">';
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
                print '</ul></li>';
            }elseif ( config('menu.' . $x .'.title') === 'divider') {
                print '<li class="divider"></li>';
            }
        }
    }



    /**
     * convert the arabic numbers to english numbers
     * @param string $string
     * @return string
     */
    public static function ArToEnNum($string) {
        $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        $num = range(0, 9);
        return str_replace($arabic, $num, $string);
    }

    /**
     * encrypt the given string useing Crypt Class
     * @param string $string
     * @return string $encrypted
     */
    public static function encrypt($string){
        $encrypted = Crypt::encryptString($string);
        return $encrypted;
    }

    /**
     * decrypt the given string useing Crypt Class
     * @param string $string
     * @return string $decrypt
     */
    public static function decrypt($string){
        $decrypt = Crypt::decryptString($string);
        return $decrypt;
    }

}
