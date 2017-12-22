<?php
/**
 * Created by PhpStorm.
 * User: Eng-Elmi
 * Date: 14/12/2017
 * Time: 11:33 PM
 */
?>
<div class="col-xs-12 well well-sm no-shadow text-center" style="margin-bottom: 5px;">
    <div class="row">
        <div class="col-xs-2" style="height: 100%"><strong style="margin-bottom: 3px "> نمبربل: <span id="bill_id"><?= $ord_cus->ord_id ?></span></strong></div>
        <div class="col-xs-8">
            <h2 style="margin-bottom: 4px"><?=$this->session->general_info->ci_full_name ?></h2>
            <h3 style="margin: 4px"><b><?= $this->session->general_info->ci_full_name_en ?></b></h3>
        </div>
        <div class="col-xs-2">
            <img src="<?=base_url('assets/img/info/'.$this->session->general_info->ci_logo) ?>" class="img-responsive" alt="LOGO">
        </div>
    </div>
</div>
