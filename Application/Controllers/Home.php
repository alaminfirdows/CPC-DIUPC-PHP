<?php
/*
*   Project:    Stage4CancerCommunity
*   Version:    1.0.0
*   Author:     Al-Amin Firdows
*   Email:      alaminfirdows@gmail.com
*   Skype:      alamin.firdows
*   URI:        http://alamin.me
*/

class Home extends Controller
{
    public function index()
    {
        if (isset($_POST['send-message'])) { }


        $event_model = $this->load_model('Event_Model');
        $semester_activity_model = $this->load_model('SemesterActivity_Model');
        $data = array(
            'events' => $event_model->getAllPublishedEvents(6),
            'semester_activities' => $semester_activity_model->getAllPublishedActivities(20)
        );

        $this->view("template-part/header");
        $this->view("index", $data);
        $this->view("template-part/footer");
    }
}