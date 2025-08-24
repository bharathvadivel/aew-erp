<?php

use App\Models\Product;
use App\Models\ProductionType;
use App\Models\ProductSeries;
use Illuminate\Support\Facades\Auth;



/**
* titleTag
* @return string
*/

if (!function_exists('titleTag')) {
    function titleTag($page)
    {
        return "Yara | " . $page;
    }
}




/**
* dataTableRequests
* @return result
*/
if (!function_exists('dataTableRequests')) {
    function dataTableRequests($request)
    {
        ## Read value
        $draw = $request['draw'];
        $start = $request['start'];
        $rowperpage = $request['length']; // Rows display per page

        $columnName_arr = $request['columns'];
        $search_arr = $request['search'];
        $searchValue = $search_arr['value']; // Search value


        $result = array(
            'draw' => $draw,
            'start' => $start,
            'rowperpage' => $rowperpage,
            'searchValue' => $searchValue,
            'rowperpage' => $rowperpage
        );

        return $result;
    }

    /**
    * dateformats
    * @return result
    */
    if (!function_exists('basicDateFormat')) {
        function basicDateFormat($date)
        {
           $convert_date=$date!='' ? Date('d-m-Y', strtotime($date)):"";
            return $convert_date;
        }
    }


    /**
    * datetimeformats
    * @return result
    */
    if (!function_exists('railwayDateTimeFormat')) {
        function railwayDateTimeFormat($date)
        {
            return Date('d-m-Y H:i:s', strtotime($date));
        }
    }



    /**
    * active or block
    * @return result
    */
    if (!function_exists('checkStatus')) {
        function checkStatus($status)
        {
            return $status==1 ? 'Active' : 'Block';
        }
    }

    /**
    * Get User Type
    * @return usertype
    */

    if (!function_exists('checkUserType')) {
        function checkUserType($type)
        {
            switch ($type) {
                case 0:
                     $user_type='Admin';
                    break;
                case 1:
                     $user_type='Dealer';
                    break;
                case 2:
                    $user_type='Spare coordinator';
                    break;
                case 3:
                    $user_type='Engineers and Technicians';
                    break;
                default:
                    $user_type=null;
            }
            return $user_type;
        }
    }
}

