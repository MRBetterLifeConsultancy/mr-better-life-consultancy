<?php
namespace App\Models;
use CodeIgniter\Model;

class HelperModel extends Model
{
    public $custom_site_url;
    public $page_data = array();
    public $session;

    public function __construct()
    {
        parent::__construct();
        $this->custom_site_url = base_url() . '';
        $this->page_data['custom_site_url'] = $this->custom_site_url;
        $this->session = session();
    }

    function array_columns($input, $column_keys = null, $index_key = null)
    {
        //array_columns($arr, 'name,profession', 'id');        
        $result = array();
        $keys = isset($column_keys) ? explode(',', $column_keys) : array();

        if ($input)
        {
            foreach ($input as $k => $v)
            {

                // Specify the return column
                if ($keys)
                {
                    $tmp = array();
                    foreach ($keys as $key)
                    {
                        $tmp[$key] = $v[$key];
                    }
                }
                else
                {
                    $tmp = $v;
                }

                // Specify the index column
                if (isset($index_key))
                {
                    $result[$v[$index_key]] = $tmp;
                }
                else
                {
                    $result[] = $tmp;
                }
            }
        }

        return $result;
    }

    function build_query_params_data($params)
    {
        $page_data = array();
        $URLarray = explode("&", $params);
        foreach ($URLarray as $key => $value)
        {
            if (isset($value) && $value != "")
            {
                $paramsArray = explode("=", $value);
                if ((isset($paramsArray[0]) && $paramsArray[0] != "") && (isset($paramsArray[1]) && $paramsArray[1] != ""))
                {
                    $page_data[$paramsArray[0]] = $paramsArray[1];
                }
            }
        }
        return $page_data;
    }

    function set_user_session_data($user_data, $type)
    {
        $session_data['email'] = $user_data["email"];
        $session_data['name'] = $user_data["first_name"] . " " . $user_data["last_name"];
        $session_data['user_type'] = $type;
        if ($type == 'admin')
        {
            $session_data['admin_id'] = $user_data["admin_id"];
            $session_data['is_admin_login'] = 1;
        }
        else if ($type == 'user')
        {
            $session_data['user_id'] = $user_data["user_id"];
            // $session_data['profile_picture'] = $user_data["profile_picture"];
            $session_data['is_user_login'] = 1;
        }
        $this->session->set($session_data);
    }

    function custom_log_message($message)
    {
        $level = 'custom';
        log_message($level, $message);
    }

    function get_yes_no_string($value)
    {
        $valuestring = get_phrase("No");
        if ($value == 1)
        {
            $valuestring = get_phrase("Yes");
        }
        return $valuestring;
    }

    function get_Y_m_d_from_date_string($value)
    {
        //date_default_timezone_set('Asia/Kolkata');
        if ($value && isset($value) && strlen($value) > 0)
        {
            return date("Y-m-d", strtotime($value));
        }
        else
        {
            return "";
        }
    }

    function get_d_m_Y_from_date_string($value)
    {
        //date_default_timezone_set('Asia/Kolkata');
        if ($value && isset($value) && strlen($value) > 0)
        {
            return date("d-m-Y", strtotime($value));
        }
        else
        {
            return "";
        }
    }

    function get_d_MM_Y_from_date_string($value)
    {
        //date_default_timezone_set('Asia/Kolkata');
        if ($value && isset($value) && strlen($value) > 0)
        {
            return date("d M Y", strtotime($value));
        }
        else
        {
            return "";
        }
    }

    function get_MM_Y_from_date_string($value)
    {
        //date_default_timezone_set('Asia/Kolkata');
        if ($value && isset($value) && strlen($value) > 0)
        {
            return date("M Y", strtotime($value));
        }
        else
        {
            return "";
        }
    }

    function get_d_MM_Y_12timefrom_date_string($value)
    {
        //date_default_timezone_set('Asia/Kolkata');
        if ($value && isset($value) && strlen($value) > 0)
        {
            return date("d M Y h:i:sa", strtotime($value));
        }
        else
        {
            return "";
        }
    }

    function get_d_MM_Y_h_ia_from_date_string($value)
    {
        //date_default_timezone_set('Asia/Kolkata');
        if ($value && isset($value) && strlen($value) > 0)
        {
            return date("d M Y h:i a", strtotime($value));
        }
        else
        {
            return "";
        }
    }

    function get_h_i_from_date_string($value)
    {
        //date_default_timezone_set('Asia/Kolkata');
        if ($value && isset($value) && strlen($value) > 0)
        {
            return date("h:i", strtotime($value));
        }
        else
        {
            return "";
        }
    }

    function get_h_ia_from_date_string($value)
    {
        //date_default_timezone_set('Asia/Kolkata');
        if ($value && isset($value) && strlen($value) > 0)
        {
            return date("h:i a", strtotime($value));
        }
        else
        {
            return "";
        }
    }

    function get_m_d_Y_from_date_string($value)
    {
        //date_default_timezone_set('Asia/Kolkata');
        if ($value && isset($value) && strlen($value) > 0)
        {
            return date("m/d/Y", strtotime($value));
        }
        else
        {
            return "";
        }
    }

    function get_dbDate_from_datetime_string($value)
    {
        //date_default_timezone_set('Asia/Kolkata');
        if ($value && isset($value) && strlen($value) > 0)
        {
            return date("Y-m-d H:i:s", strtotime($value));
        }
        else
        {
            return "";
        }
    }

    function get_d_MM_Y_current_time($value)
    {
        //date_default_timezone_set('Asia/Kolkata');
        if ($value && isset($value) && strlen($value) > 0)
        {
            return date("d M Y h:i:sa", time());
        }
        else
        {
            return "";
        }
    }

    function get_m_d_Y_from_date_time($value)
    {
        //date_default_timezone_set('Asia/Kolkata');
        if ($value && isset($value) && strlen($value) > 0)
        {
            return date("m/d/Y", $value);
        }
        else
        {
            return "";
        }
    }

    function getIndianCurrency($num, $prefix = "", $postfix = "")
    {
        if($num == NULL)
        {
            $num = 0;
        }
        $explrestunits = "" ;
        if(strlen($num)>3)
        {
            $lastthree = substr($num, strlen($num)-3, strlen($num));
            $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
            $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
            $expunit = str_split($restunits, 2);
            for($i=0; $i < sizeof($expunit);  $i++)
            {
                // creates each of the 2's group and adds a comma to the end
                if($i==0)
                {
                    $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
                }
                else
                {
                    $explrestunits .= $expunit[$i].",";
                }
            }
            $thecash = $explrestunits.$lastthree;
        } 
        else 
        {
            $thecash = $num;
        }
        $thecash = $prefix.$thecash;
        return $thecash;
    }

    function getIndianCurrencyInWords(float $number)
    {
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(0 => '', 1 => 'one', 2 => 'two',
            3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
            7 => 'seven', 8 => 'eight', 9 => 'nine',
            10 => 'ten', 11 => 'eleven', 12 => 'twelve',
            13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
            16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
            19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
            40 => 'forty', 50 => 'fifty', 60 => 'sixty',
            70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
        $digits = array('', 'hundred','thousand','lakh', 'crore');
        while( $i < $digits_length ) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
            } else $str[] = null;
        }
        $Rupees = implode('', array_reverse($str));
        $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
        return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
    }

    function getStartAndEndDate($week, $year) {
        $date_string = $year . 'W' . sprintf('%02d', $week);
        $return[0] = date('Y-m-j', strtotime($date_string));
        $return[1] = date('Y-m-j', strtotime($date_string . '7'));
        return $return;
    }

    function maskedMobileNumber($num)
    {
        $masked_num = str_replace(substr($num, 0,7), 'XXX-XXX-X', $num);
        return $masked_num;
    }

    function get_date_difference_string($start_date, $end_date = null)
    {
        if ($end_date == null)
        {
            $end_date = date('Y-m-d');
        }

        $diff = abs(strtotime($end_date) - strtotime($start_date));

        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

        $diff_string = $years .($years > 1 ? " years, " : " year, "). $months .($months > 1 ? " months, " : " month, "). $days .($days > 1 ? " days" : " day");
        return $diff_string;
    }

    public function get_settings_value($col_name)
    {
        $builder = $this->db->table('settings');
        if ($col_name != null && strlen($col_name) > 0)
        {
            $builder->where('settings.name ', $col_name);
        }
        $data = $builder->get()->getRowObject();
        if(!empty($data))
        {
            return $data->value;
        }
        else
        {
            return "";
        }
    }
}