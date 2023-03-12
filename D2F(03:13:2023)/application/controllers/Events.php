<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('events_model');
        $this->load->model('member_model');
        
    }

    public function index() {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                // Get Number of Members
                $data['title'] = "Events";
                $data['events'] = $this->events_model->getEvents();
                $data['message'] = "";

                $this->load->view('dist/events', $data);
            } else {
                 redirect(base_url() . 'Login');
             }
         }
         else {
             $data = array();
             redirect(base_url() . 'Login');
         }
    }


    /**
     * This function is used to delete the Event Information Record in the database
     * @param type $eventId
     */
    public function Delete($eventId) {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                $data['message'] = "The event information you selected has been successfully deleted.";
                $memberId = $this->input->post('QRCode');

                // Get Number of Members
                $data['title'] = "Events";

                // function call deleteMember              
                $this->events_model->deleteEvent($eventId);
                $this->events_model->deleteEventAttendees($eventId);
                


                // Retrieve the fresh cut of events
                $data['events'] = $this->events_model->getEvents();
                $data['selectedId'] = $data['events'][0]->EVENT_ID;
                $data['eventAttendees'] = $this->events_model->getEventAttendees($data['events'][0]->EVENT_ID);
                $data['nonMemberAttendees'] = $this->events_model->getEventNonMemberAttendees($data['events'][0]->EVENT_ID);

                // then go back to events view
                $this->load->view('dist/events', $data);
            }
            else {
                redirect(base_url() . 'Login');
            }
        }
        else {
            $data = array();
            redirect(base_url() . 'Login');
        }
    }
    
     /**
     * This function is used to redirect the page to the View Events Page
     * @param type $eventId
     */
    public function View($eventId) {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                

                // Get Number of Members
                $data['title'] = "Events";
                $data['events'] = $this->events_model->getEvents();
                $data['selectedId'] = $eventId;
                $data['selectedEvent'] = $this->events_model->getEvent($eventId)[0];
                $data['message'] = "";
                $data['eventAttendees'] = $this->events_model->getEventAttendees($eventId);
                $data['nonMemberAttendees'] = $this->events_model->getEventNonMemberAttendees($eventId);
        
                $this->load->view('dist/viewEvent', $data);
            }
            else {
                redirect(base_url() . 'Login');
            }
        }
        else {
            redirect(base_url() . 'Login');
        }
    }
    
    public function addEventAttendee() {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {
                // Retrieve the Form values
                $eventId = $this->input->post('event_id');
                $memberId = $this->input->post('QRCode');
                
                // Retrieve name of the Member that has been added
                $member = $this->member_model->GetMember($memberId);

                // Validate if a member has been retrieved
                if (sizeof($member) > 0) {
                    // Insert to database
                    $data = array(
                        'EVENT_ID' => $eventId,
                        'MEMBER_ID' => $memberId
                    );

                    // JSON - build parameters
                    $newAttendee = new stdClass();
                    $newAttendee->LAST_NAME = $member[0]->LAST_NAME;
                    $newAttendee->FIRST_NAME = $member[0]->FIRST_NAME;
                    $newAttendee->NETWORK = $member[0]->NETWORK;

                    // Delete Attendee first before adding to avoid duplication
                    $isRecordDeleted = $this->events_model->deleteEventAttendee($eventId, $memberId);

                    // Check if record is already in the table
                    if($isRecordDeleted > 0) {
                        $newAttendee->SUCCESS_FLG = 'false';
                    } else {
                        $newAttendee->SUCCESS_FLG = 'true';
                    } 

                    // Function call addEventAttendee
                    $this->events_model->addEventAttendee($data);

                    echo json_encode($newAttendee);
                }
                else {
                    echo "Invalid QR Code. No member found.";
                }
            }
            else {
                redirect(base_url() . 'Login');
            }
        }
        else {
            $data = array();
            redirect(base_url() . 'Login');
        }
    }
    
    public function saveEvent() {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {
                // Retrieve the Form values
                $eventId = $this->input->post('event_id');
                $description = $this->input->post('description');
                $eventDttm = $this->input->post('event_dttm');
                $evtStatusFlg = $this->input->post('status');
                $longDesc = $this->input->post('long_desc');
                
                // Validate if the Event ID is either blank or null
                if ($eventId == '' || $eventId == ' ') {
                    // Insert to database if the Event ID is blank
                    $data = array(
                        'DESCRIPTION' => $description,
                        'EVENT_DTTM' => $eventDttm . ':00.00000',
                        'EVT_STATUS_FLG' => $evtStatusFlg,
                        'LONG_DESC' => $longDesc
                    );

                    // function call saveMember
                    $insertedId = $this->events_model->addEvent($data);
                    
                    echo $insertedId;
                }
                else {
                    // Update the existing record in the database
                    $data = array(
                        'DESCRIPTION' => $description,
                        'EVENT_DTTM' => $eventDttm . ':00.00000',
                        'EVT_STATUS_FLG' => $evtStatusFlg,
                        'LONG_DESC' => $longDesc
                    );

                    // function call saveMember
                    $this->events_model->updateEvent($eventId, $data);
                    
                    echo $eventId;
                }
            }
            else {
                redirect(base_url() . 'Login');
            }
        }
        else {
            $data = array();
            redirect(base_url() . 'Login');
        }
    }

    /**
     * This function is used to add the non- member information record in the database
     */
    public function addEventNonMember() {

        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                // To Update Members
                $eventId = $this->input->post('event_id');
                $lastName = $this->input->post('lastName');
                $firstName = $this->input->post('firstName');
                $contactNum = $this->input->post('contactNum');
                $network = $this->input->post('network');
                $address = $this->input->post('address');
                $gender = $this->input->post('gender');
                $firstTimerFlag = $this->input->post('firstTimerFlag');
                $data['message'] = "Successfully added the non-member.";

            
                // The correct syntax to pass parameters for the update.
                $data = array();
                $data = array(
                    'EVENT_ID' => $eventId,
                    'FIRST_NAME' => $firstName,
                    'LAST_NAME' => $lastName,
                    'CONTACT_NUMBER' => $contactNum,
                    'NETWORK' => $network,
                    'ADDRESS' => $address,
                    'GENDER' => $gender,
                    'FIRST_TIMER_FLG' => $firstTimerFlag
                );

                // function call saveMember
                $this->events_model->addNonMember($data);
            }
            else {
                redirect(base_url() . 'Login');
            }
        }
        else {
            redirect(base_url() . 'Login');
        }
    }


    

    /**
     * Export to PDF 
     */
    public function exportPDF($eventId){
        
        $data['eventAttendees'] = $this->events_model->getEventAttendees($eventId);
        $data['selectedEvent'] = $this->events_model->getEvent($eventId)[0];

        date_default_timezone_set('Asia/Manila'); //Server Time	

        // INCLUDE THE phpToPDF.php FILE
        require(APPPATH.'views/dist/phpToPDF.php'); 

        // PUT YOUR HTML IN A VARIABLE
        $my_html = "<html>
        <head>
        <link href=\"http://phptopdf.com/bootstrap.css\" rel=\"stylesheet\">
        <link href=\"http://getbootstrap.com/examples/dashboard/dashboard.css\" rel=\"stylesheet\">
        </head>
        <body>";

        // $my_html.= '<img src="http://192.168.64.2/MIS/assets/img/meta-jilr-logo.png"> <br /> <br />';

        $my_html.= '<p><b>Event Title: </b>' . $data['selectedEvent']->DESCRIPTION . '<br />';
        $my_html.= '<b>Event Description: </b>' . $data['selectedEvent']->LONG_DESC . '<br />';
        $my_html.= '<b>Event Status: </b>' . $data['selectedEvent']->EVT_STATUS_FLG . '<br />';
        $my_html.= '<b>Event Status: </b>' . $data['selectedEvent']->EVENT_DTTM . '<br /> <br />';

        $my_html.= "<table class=\"table table-striped\">
                        <thead>
                        <tr>
                            <th>Row</th>
                            <th>Name</th>
                            <th>Network</th>
                        </tr>
                        </thead>
                        <tbody>";
                    $rowCount = 1;                        
                    foreach($data['eventAttendees'] as $data['eventAttendee']){
                        $my_html .= '<tr><th scope="row">'. $rowCount . '</th>';
                        $my_html .= '<td>'. $data['eventAttendee']->LAST_NAME . ", " . $data['eventAttendee']->FIRST_NAME . '</td><td>'. $data['eventAttendee']->NETWORK .'</td><td>';                        
                        $my_html .='</td></tr>';
                        $rowCount++;
                        }
                        $my_html .="</tbody>
                    </table>
                </body>
                </html>";

            // echo $my_html;
            // // SET YOUR PDF OPTIONS -- FOR ALL AVAILABLE OPTIONS, VISIT HERE:  http://phptopdf.com/documentation/
            $pdf_options = array(
              "source_type" => 'html',
              "source" => $my_html,
              "action" => 'download',
              "save_directory" => '',
              "file_name" => 'EventAttendees_'.date('M/d/Y').'.pdf');


            // // CALL THE phpToPDF FUNCTION WITH THE OPTIONS SET ABOVE
            phptopdf($pdf_options);
    }

    public function exportExcel($eventId) {
        $this->load->helper(array('form', 'url'));
		$this->load->library("pagination");

        $this->events_model->exportToExcel($eventId);

    }
}
