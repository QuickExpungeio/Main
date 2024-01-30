<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NotificationEmailsCron extends CI_Controller
{

    public function index()
    {

        $this->db->select('expungement_id, receiver, COUNT(*) as application_count');
        $this->db->from('cron'); 
        $this->db->group_by('receiver');
        $results = $this->db->get()->result_array();
        // echo '<pre>';print_r($results);die;
        foreach ($results as $result) {
                
                $mailContaint = $this->db->get_where('wiki', array('id' => 8))->row();
                $logo = base_url('assets/images/logo.png');
                $count = $result['application_count'];
                // echo '<pre>';print_r($count);die;
                $replaceTo = array("__LOGO__","__TITLE__","__USEREMAIL__","__CONTACTUSTEXT__");
                $replaceFrom = array($logo, "Unread Notification", "Hello", $count);
                $newContaint = str_replace($replaceTo, $replaceFrom, $mailContaint->description);
                $to = $result['receiver'];
                $subject = $mailContaint->subject;
                $message = $newContaint;
                $emailResponse = email_send($to, "", $subject, $message);
                // echo '<pre>';print_r($emailResponse);die;
                if ($emailResponse['code'] = 200) {
                    $query = "UPDATE cron SET status = '1'";
                    $this->db->query($query);
                    $this->db->where(array('status' => 1 ));
                    $this->db->delete('cron');
                    return true;
                } else {
                    return false;
                }
        }
    }
}
