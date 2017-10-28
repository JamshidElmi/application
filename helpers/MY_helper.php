<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php


if ( ! function_exists('option'))
{
    /**
     * Select Province
     *
     * @param   array   array of goten data from database
     * @return  mixed   just options of a select input control
     */
    function option($items)
    {
        $item = explode(',', $items);
        for ($i=0; $i < count($item) ; $i++)
        {
            echo "<option>". $item[$i] ."</option>";
        }
    }

}




if(!function_exists("setting_option"))
{
    /**
     * Select Province
     *
     * @param   string  setting name
     * @return  mixed   Array of valus on fixed column of row
     */
    function setting_option($set_name)
    {
        $ci = & get_instance();
        $ci->db->select('setting_value');
        $ci->db->where('setting_name' , $set_name);
        $ci->db->limit(1);
        $setting = $ci->db->get('setting')->result();
        // print_r(current($setting[0]));
        $item = explode(',', current($setting[0]));
        for ($i=0; $i < count($item) ; $i++)
        {
            echo "<option>". $item[$i] ."</option>";
        }
    }
}

if(!function_exists("alert"))
{
    function alert($txt, $type = 'success')
    {
        switch ($type) {
            case 'danger':
                $icon = 'ban';
                $title = 'پیغام خطا !';
                break;
            case 'info':
                $icon = 'info-circle';
                $title = 'پیغام توجه !';
                break;
            case 'warning':
                $icon = 'warning';
                $title = 'پیغام هشدار !';
                break;
            default:
                $icon = 'check';
                $title = 'پیغام موفقیت !';
                break;
        }
        echo    '<div class="alert alert-'.$type.' alert-dismissible">
                    <button type="button" class="close pull-left" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-'.$icon.'"></i> '.$title.'</h4>
                    '.$txt.'
                </div>';
    }

}


if(!function_exists("options"))
{
    /**
     * Select [options]
     *
     * @param   string  setting name
     * @return  mixed   Array of valus on fixed column of row
     */
    function options($item)
    {
        $ci = & get_instance();
        $field = $item.'_name';
        $ci->db->select($field);
        $items = $ci->db->get($item.'s')->result();
        foreach($items as $row)
        {
            echo "<option>". $row->$field ."</option>";
        }
    }
}


if(!function_exists("permission"))
{
    function permission($number)
    {
        switch ($number) {
            case 1:
                $pos_name = 'مدیر کل';
                break;
            case 2:
                $pos_name = 'مدیر مسئول';
                break;
            case 3:
                $pos_name = 'گارسن';
                break;
        }
        echo $pos_name;
    }

}

if(!function_exists("sys_type"))
{
    function sys_type($number)
    {
        switch ($number) {
            case 0:
                $pos_name = 'آشپزخانه';
                break;
            case 1:
                $pos_name = 'رستورانت';
                break;
        }
        echo $pos_name;
    }

}



if(!function_exists("substr_fa"))
{
    function substr_fa($data,$count)
    {
        $data = strip_tags($data);
        if(strlen($data) > $count)
        {
            return substr($data, 0, ($spos = strpos($data, ' ', $lcount = count($data) > $count ? $lcount : $count)) ? $spos : $lcount )."...";
        }
        elseif(strlen($data) > ($count/2))
        {
            $count = $count/2;
            return substr($data, 0, ($spos = strpos($data, ' ', $lcount = count($data) > $count ? $lcount : $count)) ? $spos : $lcount )."...";
        }
        else
        {
            return $data."...";
        }
    }
}
 ?>
