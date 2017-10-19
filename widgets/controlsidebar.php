<?php

/*
 * Demo widget
 */
class ControlSidebar extends Widget {

    public function display($data) {

        if (!isset($data['items'])) {
            $data['items'] = array('Home', 'About', 'Contact', 'Maro');
        }

        $this->view('layout/controlsidebar', $data);
    }

}