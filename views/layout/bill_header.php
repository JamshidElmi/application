<?php
/**
 * Created by PhpStorm.
 * User: Eng-Elmi
 * Date: 14/12/2017
 * Time: 11:33 PM
 */
?>
<div class="col-xs-12 well well-sm no-shadow text-center">
    <div class="row">
        <div class="col-xs-2"></div>
        <div class="col-xs-8">
            <h2><?=$this->session->general_info->ci_full_name ?></h2>
            <h3><b><?= $this->session->general_info->ci_full_name_en ?></b></h3>
        </div>
        <div class="col-xs-2">
            <img src="<?=base_url('assets/img/info/'.$this->session->general_info->ci_logo) ?>" class="img-responsive" alt="LOGO">
        </div>
    </div>
</div>
