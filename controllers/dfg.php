<?php
/**
 * Created by PhpStorm.
 * User: Eng-Wahrez
 * Date: 07/12/2017
 * Time: 06:18 PM
 */

<?php
session_start();
if (isset($_SESSION['user_type']) && $_SESSION['user_type']=="teacher" && isset($_SESSION['user_name'])&& isset($_SESSION['password']) && isset($_GET['type']))
{
    $exam = $_GET['type'];
    if ($exam =='first')
    {
        $exam_type = "چهار نیم ماهه";
    }
    else if ($exam=='second')
    {
        $exam_type="سالانه";
    }
    ?>
    <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
    <html>
    <head>
        <?php
        if ($exam=="first")
        {
            ?>
            <script type="text/javascript">
                var numbersOnly = /^\d+$/;
                function testInputData(myfield, restrictionType)
                {
                    var myData = document.getElementById(myfield).value;
                    if(myData!==null)
                    {
                        if(restrictionType.test(myData) && myData<=40)
                        {
                            document.getElementById(myfield).style.color="green";
                            document.getElementById(myfield).style.borderColor="green";
                            document.getElementById(myfield).style.backgroundColor="white";
                        }
                        else
                        {
                            alert('دقت کنید!نمره باید مساوی یا کوچکتراز 40  باشد');
                            document.getElementById(myfield).value=null;
                            document.getElementById(myfield).style.borderColor="red";
                            document.getElementById(myfield).style.backgroundColor="lightblue";
                        }
                    }
                    else if(myData===null)
                    {
                        alert('لطفاً نمره متعلم را وارد کنید');
                    }
                    return;
                }
            </script>
        <?php
        }
        else
        {
        ?>
            <script type="text/javascript">
                var numbersOnly = /^\d+$/;
                function testInputData(myfield, restrictionType)
                {
                    var myData = document.getElementById(myfield).value;
                    if(myData!==null)
                    {
                        if(restrictionType.test(myData) && myData<=60)
                        {
                            document.getElementById(myfield).style.color="green";
                            document.getElementById(myfield).style.borderColor="green";
                            document.getElementById(myfield).style.backgroundColor="white";
                        }
                        else
                        {
                            alert('دقت کنید!نمره باید مساوی یا کوچکتراز 60  باشد');
                            document.getElementById(myfield).value=null;
                            document.getElementById(myfield).style.borderColor="red";
                            document.getElementById(myfield).style.backgroundColor="lightblue";
                        }
                    }
                    else if(myData===null)
                    {
                        alert('لطفاً نمره متعلم را وارد کنید');
                    }
                    return;
                }
            </script>
            <?php
        }
        ?>
        <link rel="stylesheet" type="text/css" href="../../lib/bootstrap/css/bootstrap.css">
        <script type="text/javascript" src="../../lib/jquery.js"></script>
        <script type="text/javascript" src="../../finance/controller/general_jq.js"></script>
        <link rel="stylesheet" type="text/css" href="../../lib/login.css">
        <link rel="stylesheet" type="text/css" href="../../headmaster/includes/index.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" type="text/css" href="../../fonts/fonts.css">
        <style type="text/css">
            #add_exam_score_table tr td,th
            {
                color:black;
                font-size:17px;
            }
            #add_exam_score_table tr th img
            {
                width:20px;
                height:auto;
                margin:auto;
            }
            #add_exam_score_table tr td input[type='checkbox']
            {
                /* All browsers except webkit*/
                transform: scale(1.9);
                /* Webkit browsers*/
                -webkit-transform: scale(1.9);
                margin-top:12px;
            }
            #add_exam_score_table tr th img#none_stu
            {
                display:none;
            }
            div#alert
            {
                border:1px solid #aaa;
                padding:0px;
                margin:3px 0px 3px 0px;
            }
            div#alert div
            {
                margin:0px;
                border-radius:0px;
                padding:1px;
            }
            div#alert img
            {
                height:20px;
                width:auto;
                float:left;
                margin:0px auto auto 5px;

            }
            div#alert img#close_icon
            {
                width:20px;
                height:auto;
                float:left;
                margin-top:-30px;
            }
            div#ins_stu div
            {
                margin:1px;
                padding:5px;
                border-radius:0px;
            }
            div#ins_stu div h5
            {
                display:inline;
                color:red;
            }
            div#ins_stu img
            {
                float:left;
                height:20px;
                width:auto;
            }
            #add_exam_score_table tr input[type='submit'],#add_exam_score_table tr input[type='reset'],#add_exam_score_table tr input[type='button']
            {
                width:32%;
                border-radius:0px;
            }
        </style>
        <script type="text/javascript">
            function close_alert()
            {
                document.getElementById("alert").style.display='none';
            }
        </script>
        <title>ثبت نمرات امتحان</title>
    </head>
    <body>
    <div class="container-fluid">
        <center>
            <?php
            include '../../includes_parts/main_header.php';
            echo $year = $_SESSION['t_edu_year'];
            $class_name = $_SESSION['sub_class_name'];
            $class_type = $_SESSION['sub_class_type'];
            $class_id = $_SESSION['sub_class_id'];
            $part_class_name = explode('-', $class_name);
            $class_part_name = $part_class_name[0];
            //class_id select
            $class_id_select = mysql_query("select base_class_id from sub_classes where sub_class_id =$class_id");
            $class_id_fetch = mysql_fetch_assoc($class_id_select);
            $base_class_id = $class_id_fetch['base_class_id'];
            //stu_id select
            $stu_id_select = mysql_query("select stu_id from student_per_year_class where sub_class_id = $class_id and status='فعال' and year=$year");

            ?>
            <div class="row-fluid">
                <div class="span12 alert alert-info" id='info'>
                    <div id="left_bar" class="span2">
                        <?php
                        include '../includes/main_leftbar.php';
                        ?>
                    </div>
                    <div id="cpanel" class="alert alert-warning">
                        <div id="headline">
                            <?php
                            include '../includes/log_out.php';
                            ?>
                        </div>
                        <br>
                        <h4>ثبت نمـــــــــــرات امتحـــــــــــــــــــان <?php echo $exam_type?>  صنف <?php echo $class_name?></h4>
                        <?php
                        //check the required number saved or no
                        $select_exam_req_score = mysql_query("select * from exam_success_score where year=$year");
                        if($select_exam_req_score && mysql_numrows($select_exam_req_score)>0)
                        {
                            if (isset($_GET['stu']) && !empty($_GET['stu']))
                            {
                                $arr = unserialize($_GET['stu']);
                                foreach ($arr as $insr_stu)
                                {
                                    $select_ins_stu = mysql_query("select name,lname from student where id=$insr_stu");
                                    $get_ins_stu= mysql_fetch_assoc($select_ins_stu);
                                    ?>
                                    <div id='ins_stu' class="<?php echo $insr_stu?>">
                                        <div class='alert alert-info'>
                                            <h5>توجه! نمره این مضمون <?php echo $get_ins_stu['name'].' '.$get_ins_stu['lname']?> قبلاً ثبت شده است</h5>
                                            <img alt="close" title='بستن' src="../../headmaster/icons/close.png" class="close_stu" id="<?php echo $insr_stu?>">
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            if ($exam=="second")
                            {
                                ?>
                                <div id='alert'>
                                    <img alt="close" title='بستن' src="../../headmaster/icons/close.png" onclick='close_alert()'>
                                    <div class='alert alert-info'>
                                        <h5>تـــوجـــــه ! قبل از ثبت نمودن نمرات، ارتباط کمپیوتر خویش را با انترنت بررسی نمائید و مطمئن شوید که ارتباط شما برقرار است </h5>
                                    </div>
                                    <div class='alert alert-danger'>
                                        <h5>تـــوجـــــه ! برای متعلمین مـــحـــــــروم اجــــــاره وارد نمــــــــودن نمــــــره را ندارید </h5>
                                    </div>
                                </div>
                                <?php
                            }
                            else
                            {
                                ?>
                                <div id='alert'>
                                    <div class='alert alert-info'>
                                        <h5>تـــوجـــــه ! قبل از ثبت نمودن نمرات، ارتباط کمپیوتر خویش را با انترنت بررسی نمائید و مطمئن شوید که ارتباط شما برقرار است </h5>
                                    </div>
                                    <img alt="close" title='بستن' src="../../headmaster/icons/close.png" id='close_icon' onclick='close_alert()'>
                                </div>
                                <?php
                            }
                            ?>
                            <hr id="line1">
                            <?php
                            if (isset($_GET['result']))
                            {
                                $url = $_GET['result'];
                                if ($url=='succed')
                                {
                                    echo("<h5 class='aler alert-success'>");
                                    echo("&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp");
                                    echo("نمرات مورد نظر موفقانه ثبت گردید");
                                    echo "</h5>";
                                }
                                elseif ($url=='error')
                                {
                                    echo "<h5 class='alert alert-danger'>";
                                    echo("&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp");
                                    echo("نمرات مورد نظر ثبت نگردید، دوباره تلاش نمائید");
                                    echo "</h5>";
                                }
                                elseif ($url=='exist')
                                {
                                    echo "<h5 class='alert alert-danger'>";
                                    echo("&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp");
                                    echo("نمره این مضمون قبلاً ثبت شده است");
                                    echo "</h5>";
                                }
                                elseif ($url=='large_amount')
                                {
                                    echo "<h5 class='alert alert-danger'>";
                                    echo("&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp");
                                    echo("دقت کنید! نمره داده شده بیشتر از مجموع نمرات امتحان می باشد");
                                    echo "</h5>";
                                }
                            }
                            ?>
                            <form method="POST" action="../controller/add_exam_score.php">
                                <table class="table table-bordered" id="add_exam_score_table" style='width:95%;'>
                                    <tr>
                                        <td><label style="margin-top:8px !important">مضمون :</label></td>
                                        <td colspan='2'>
                                            <input type="hidden" name="exam_type" id="exam_type" value="<?php echo $exam?>">
                                            <input type="hidden" name="year" value="<?php echo $year?>">
                                            <select name="sub_name" class="input" required="required">
                                                <option value="" selected>انتخاب کنید</option>
                                                <?php
                                                include '../includes/class_name_to_grade.php';
                                                $grade = subject_grade($class_part_name);
                                                $select = mysql_query("select name from subject where grade = $grade");
                                                if ($select)
                                                {
                                                    while ($row = mysql_fetch_array($select))
                                                    {
                                                        echo "<option>".$row[0]."</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>

                                        </td>
                                        <td style='text-align:right;padding-right:45px;'>
                                            استاد:
                                            <select name="teacher_id" required="required">
                                                <option value="" selected>انتخاب کنید</option>
                                                <?php
                                                $select_teacher = mysql_query("select emp.NAME,emp.LNAME,emp.ID,class.base_class_id from empolyee emp, emp_classes class where emp.POST IN ('معلم','استاد','آموزگار','TEACHER','teacher') and class.base_class_id=$base_class_id and emp.ID=class.emp_id and class.year=$year");
                                                while ($teacher = mysql_fetch_assoc($select_teacher))
                                                {
                                                    echo "<option value='$teacher[ID]'>$teacher[NAME]".' '."$teacher[LNAME]</option>";
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr id="head_row">
                                        <th>
                                            <img title="انتخاب همه" src='../icons/check.png' id='all_stu'>
                                            <img title="انتخاب همه" src='../icons/uncheck.png' id='none_stu'>
                                        </th>
                                        <th>شماره</th>
                                        <th>نام</th>
                                        <th>نام پدر</th>
                                        <th>نمبر اساس</th>
                                        <th>نمره مضمون</th>
                                    </tr>
                                    <?php
                                    $select_mah_days = mysql_query("select num_of_day from mahromy_days where base_class_id = $base_class_id and year = $year");
                                    $get_days = mysql_fetch_assoc($select_mah_days);
                                    $mah_days = $get_days['num_of_day'];
                                    if ($stu_id_select && mysql_num_rows($stu_id_select)>0)
                                    {
                                        $i=1;
                                        while ($test = mysql_fetch_assoc($stu_id_select))
                                        {
                                            $st_id = $test['stu_id'];
                                            //check not be temp
                                            if ($exam_type=='سالانه')
                                            {
                                                //check for first exam score
                                                $select_fexam_score = mysql_query("select * from exam where class_id =$class_id and exam_type='چهار نیم ماهه' and date=$year");
                                                if ($select_fexam_score and mysql_num_rows($select_fexam_score)>0)
                                                {
                                                    $select_mahrom_stu = mysql_query("select total_absent from stu_total_attendence where stu_id=$st_id and year=$year and sub_class_id =$class_id");
                                                    $get_stu_total_absent_days = mysql_fetch_assoc($select_mahrom_stu);
                                                    $stu_total_absent_days = $get_stu_total_absent_days['total_absent'];
                                                    $stu_select = mysql_query("select id,name,fname,base_id,reg_type from student where id = $st_id");
                                                    while ($stu = mysql_fetch_array($stu_select))
                                                    {
                                                        $stu_id = $stu['id'];
                                                        if (($stu['reg_type'] !='مؤقت') OR ($stu['reg_type']=='مؤقت' && !is_null($stu['base_id'])))
                                                        {
                                                            echo "<tr>";
                                                            echo "<td><input type='checkbox' value='$stu_id' name='stu_id[]'></td>";
                                                            echo "<td>".$i."</td>";
                                                            echo "<td>".$stu['name']."</td>";
                                                            echo "<td>".$stu['fname']."</td>";
                                                            if (!(is_null($stu['base_id'])))
                                                            {
                                                                echo "<td>".$stu['base_id']."</td>";
                                                            }
                                                            else
                                                            {
                                                                echo "<td>".$stu['reg_type']."</td>";
                                                            }
                                                            $score = "score".$stu_id;
                                                            $msg = "msg".$stu_id;
                                                            $stu_status = "stu_status".$stu_id;
                                                            $this_class_mah_days = "mah_days".$stu_id;
                                                            $this_stu_total_absent_days = "absent_days".$stu_id;
                                                            if ($select_mahrom_stu && $stu_total_absent_days>$mah_days)
                                                            {
                                                                echo "<td><input type='number' name='$score' id='$score' readonly value=0  min='0' max='60'"?> onchange="Javascript:testInputData('<?php echo $score ?>',numbersOnly)"><?php "</td>";
                                                                echo "<input type='hidden' value='محروم' name='$stu_status'>";
                                                            }
                                                            else
                                                            {
                                                                echo "<td><input type='number' name='$score' id='$score'  min='0' max='60'"?> onchange="Javascript:testInputData('<?php echo $score ?>',numbersOnly)"><?php "</td>";
                                                                echo "<input type='hidden' value='عادی' name='$stu_status'>";
                                                            }
                                                            echo "<input type='hidden' name='$this_class_mah_days' value='$mah_days'>";
                                                            echo "<input type='hidden' name='$this_stu_total_absent_days' value='$stu_total_absent_days'>";
                                                            echo "</tr>";
                                                            $i++;
                                                        }
                                                    }
                                                }
                                                else
                                                {
                                                    echo "<tr>";
                                                    echo "<td colspan='6'><h5 class='alert alert-danger'>لطفاً ابتدا نمرات چهارنیم ماهه متعلمین را ثبت نمایید !!</h5></td>";
                                                    echo "</tr>";
                                                    break;
                                                }
                                            }
                                            else
                                            {
                                                $stu_select = mysql_query("select id,name,fname,base_id,reg_type from student where id = $st_id");
                                                while ($stu = mysql_fetch_array($stu_select))
                                                {
                                                    if (($stu['reg_type'] !='مؤقت') OR ($stu['reg_type']=='مؤقت' && !is_null($stu['base_id'])))
                                                    {
                                                        $stu_id = $stu['id'];
                                                        echo "<tr>";
                                                        echo "<td><input type='checkbox' value='$stu_id' name='stu_id[]'></td>";
                                                        echo "<td>".$i."</td>";
                                                        echo "<td>".$stu['name']."</td>";
                                                        echo "<td>".$stu['fname']."</td>";
                                                        if ($stu['base_id']!=NULL)
                                                        {
                                                            echo "<td>".$stu['base_id']."</td>";
                                                        }
                                                        else
                                                        {
                                                            echo "<td>".$stu['reg_type']."</td>";
                                                        }
                                                        $score = "score".$stu_id;
                                                        $msg = "msg".$stu_id;
                                                        echo "<td><input type='number' name='$score' id='$score'  maxlength='2' min='0' max='40'"?> onchange="Javascript:testInputData('<?php echo $score ?>',numbersOnly)"><?php "</td>";
                                                        echo "</tr>";
                                                        $i++;
                                                    }
                                                }
                                            }
                                        }
                                    }

                                    ?>
                                    <tr>
                                        <td colspan='6'>
                                            <input type="hidden" name="class_id" value="<?php echo $class_id?>">
                                            <input type="submit" value="ثبت نمرات" name="add" class="btn btn-primary">
                                            <input type="reset" value="پاک کردن فورم"  class="btn btn-primary">
                                            <a href="index.php">
                                                <input type="button" value="برگشت"  class="btn btn-primary">
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                            <?php
                        }
                        else
                        {
                            ?>
                            <hr>
                            <div class="alert alert-danger">
                                <h5>توجه ! لطفاً برای مدیر تذکر دهید نمرات کامیابی امتحانات را ابتدا ثبت نماید.</h5>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php include '../../includes_parts/main_footer.php';?>
        </center>
    </div>
    </body>
    </html>
    <?php
}
else
{
    header("location:../../index.php?login=faild");
}
?>