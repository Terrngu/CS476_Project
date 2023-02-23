<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('member_model');
        $this->load->model('ministry_model');
    }

    /**
     * This function is the default function when accessing the Members Controller
     */
    public function index() {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                // Get Number of Members
                $data['title'] = "Members";
                $data['members'] = $this->member_model->GetMembers();
                $data['selectedId'] = $data['members'][0]->MEMBER_ID;
                $data['ministries'] = $this->ministry_model->GetMinistries();
                $data['selectedMemberId'] = $data['members'][0]->MEMBER_ID;
                $data['selectedMinistryId'] = $data['ministries'][0]->MINISTRY_ID;

             
                $data['memberMinistries'] = $this->ministry_model->getMemberMinistries($data['members'][0]->MEMBER_ID);
                $data['message'] = "";

                $this->load->view('dist/dashboard', $data);
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
     * This function is used to redirect the page to the View Member Page
     * @param type $memberId
     */
    public function View($memberId) {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                

                // Get Number of Members
                $data['title'] = "Members";
                $data['members'] = $this->member_model->GetMembers();
                $data['selectedId'] = $memberId;
                $data['selectedMember'] = $this->member_model->GetMember($memberId)[0];
            
                $data['ministries'] = $this->ministry_model->GetMinistries();
                $data['memberMinistries'] = $this->ministry_model->getMemberMinistries($memberId);
                

                $this->load->view('dist/viewMember', $data);
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
     * This function is used to redirect the page to the Edit Member Screen
     * @param type $memberId
     */
    public function Edit($memberId) {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                // Get Number of Members
                $data['title'] = "Edit Member";
                $data['members'] = $this->member_model->GetMembers();
                $data['selectedId'] = $memberId;
                $data['selectedMember'] = $this->member_model->GetMember($memberId)[0];

                $this->load->view('dist/editMember', $data);
            }
            else {
                redirect(base_url() . 'login');
            }
        }
        else {
            redirect(base_url() . 'Login');
        }
    }

    /**
     * This function is used to redirect the page to the Add Member Screen
     */
    public function Add() {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                // Get Number of Members
                $data['title'] = "Add Member";
                $data['members'] = $this->member_model->GetMembers();

                $this->load->view('dist/addMember', $data);
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
     * This function is used to save the changes made when editing the Member
     * @param type $memberId
     */
    public function save($memberId) {

        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                // To Update Members
                $lastName = $this->input->post('last_name');
                $firstName = $this->input->post('first_name');
                $contactNum = $this->input->post('contactNum');
                $email = $this->input->post('emailAdd');
                $birthDate = $this->input->post('birth_date');
                $network = $this->input->post('network');
                $address = $this->input->post('address');
                $gender = $this->input->post('gender');

                // Format Birth Date
                $birthDate = date('Y/m/d', strtotime($birthDate));

                // The correct syntax to pass parameters for the update.
                $data = array();
                $data = array(
                    'LAST_NAME' => $lastName,
                    'FIRST_NAME' => $firstName,
                    'CONTACT_NUMBER' => $contactNum,
                    'EMAIL' => $email,
                    'BIRTHDATE' => $birthDate,
                    'NETWORK' => $network,
                    'ADDRESS' => $address,
                    'GENDER' => $gender
                );

                // function call saveMember
                $this->member_model->saveMember($memberId, $data);

                redirect(base_url() . 'Members/View/' . $memberId);
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
     * This function is used to add the member information record in the database
     */
    public function addMember() {

        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                // To Update Members
                $lastName = $this->input->post('last_name');
                $firstName = $this->input->post('first_name');
                $contactNum = $this->input->post('contactNum');
                $email = $this->input->post('emailAdd');
                $birthDate = $this->input->post('birth_date');
                $network = $this->input->post('network');
                $address = $this->input->post('address');
                $gender = $this->input->post('gender');
                $shouldSendQR = $this->input->post('shouldSendQR');


                // Format Birth Date
                $birthDate = date('Y/m/d', strtotime($birthDate));

                $membersCount = sizeof($this->member_model->GetMembers()) + 1;
                $membersCountStr = sprintf('%03d', $membersCount);
                
                // Generate Member ID
                // JILREG<1st Char of FNAME><1st Char of LNAME><NUM>
                $memberId = "JILREG" . substr($firstName, 0, 1) . substr($lastName, 0, 1) . $membersCountStr;

                include("application/libraries/phpqrcode/lib/full/qrlib.php");

                $SERVERFILEPATH = FCPATH . "/uploads/";
                $text = $memberId;
                $fileName = $text . "-Qrcode.png";

                if (!file_exists($SERVERFILEPATH . $fileName)) {
                    QRcode::png($text, $SERVERFILEPATH . $fileName, QR_ECLEVEL_H);
                }

                // The correct syntax to pass parameters for the update.
                $data = array();
                $data = array(
                    'MEMBER_ID' => $memberId,
                    'LAST_NAME' => $lastName,
                    'FIRST_NAME' => $firstName,
                    'CONTACT_NUMBER' => $contactNum,
                    'EMAIL' => $email,
                    'BIRTHDATE' => $birthDate,
                    'NETWORK' => $network,
                    'ADDRESS' => $address,
                    'GENDER' => $gender
                );

                // function call saveMember
                $this->member_model->addMember($data);

                // Check if the QR Code checkbox is checked
                if ($shouldSendQR == 'on') {
                    $this->sendQRCodeEmail($SERVERFILEPATH . $fileName, $firstName . " " . $lastName, $email);
                }

                redirect(base_url() . 'Members/View/' . $memberId);
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
     * This function is used to resend the QR Code to the member
     * @param type $memberId
     */
    public function Resend($memberId) {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {
                $member = $this->member_model->GetMember($memberId)[0];
                
                include("application/libraries/phpqrcode/lib/full/qrlib.php");

                $SERVERFILEPATH = FCPATH . "/uploads/";
                $text = $memberId;
                $fileName = $text . "-Qrcode.png";

                if (!file_exists($SERVERFILEPATH . $fileName)) {
                    QRcode::png($text, $SERVERFILEPATH . $fileName, QR_ECLEVEL_H);
                }
                
                

                $this->sendQRCodeEmail($SERVERFILEPATH . $fileName, $member->FIRST_NAME . " " . $member->LAST_NAME, $member->EMAIL);
                
                //redirect(base_url() . 'Members/View/' . $memberId);
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
     * This function is used to delete the Member Information Record in the database
     * @param type $memberId
     */
    public function Delete($memberId) {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                $data['message'] = "The member information you selected has been successfully deleted.";

                // Get Number of Members
                $data['title'] = "Members";

                // function call deleteMember
                $this->member_model->deleteMember($memberId);

                // Retrieve the fresh cut of members
                $data['members'] = $this->member_model->GetMembers();
                $data['selectedId'] = $data['members'][0]->MEMBER_ID;

                // then go back to members view
                $this->load->view('dist/members', $data);
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
     * This function is used to send the QR Code to the member
     * @param type $fileName
     * @param type $name
     * @param type $email
     */
    public function sendQRCodeEmail($fileName, $name, $email) {
        require_once("PHPMailer/src/PHPMailer.php");
        require_once("PHPMailer/src/SMTP.php");


        $htmlMessage = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                        <html xmlns="http://www.w3.org/1999/xhtml">
                        <head>
                            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                            <title>JIL Regina Membership QR Code</title>
                        </head>
                        <body>
                            Hi <b>' . $name . '</b>!
                            <br />
                            <br />
                            <br />
                            Greetings! Welcome to Jesus Is Lord Church Regina. Attached in this mail is your QR Code Identification for a more efficient way to sign your attendance whenever you come to church! <br />
                            Kindly download the file and present it whenever you come by at church! God bless you and see you on our church events!<br /> <br /> <br />
                            Best Regards, <br />
                            <b>JIL Regina Support Team</b><br />
                        </body>
                        </html>';
        $altMsg = "Greetings! Welcome to Jesus Is Lord Church Regina. Attached is your QR Code Identification for a more efficient way to sign your attendance whenever you come to church.
                   Kindly download the file and present it whenever you come by at church! God bless you and see you on our church events!
                   Best Regards,
                   JIL Regina Support Team";

        $mail = new PHPMailer(); // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465; // or 587 or 465
        $mail->IsHTML(true);
        $mail->Username = "jilregina.mis@gmail.com";
        $mail->Password = "jilregina";
        $mail->SetFrom("support@jilregina.ca");
        $mail->Subject = "JIL Regina Membership QR Code";
        $mail->From = "support@jilregina.ca";
        $mail->FromName = "JIL Regina MIS Support Team";
        $mail->AddAddress($email);                // name is optional
        $mail->WordWrap = 50;
        $mail->IsHTML(true);

        $mail->AddAttachment($fileName);
        $mail->Body = $htmlMessage;
        $mail->AltBody = $altMsg;

        if (!$mail->Send()) {
            echo "There is an error in sending the QR Code to the specified Email Address. Try again later.";
        }
        else {
            echo "QR Code has been successfully sent to the specified Email Address.";
        }
    }

    /**
     * Function to add a member to a ministry
     */
    public function addToMinistry($memberId) {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                // Iterate through all selected ministries, this is the array from the form.
                $ministries = $this->input->post('ministries[]');

                $ministries = (is_array($ministries)) ? $ministries : [$ministries];

                // Call delete function to not have duplicate data in the database.
                $this->ministry_model->deleteMemberMinistry($memberId);


                if (sizeof($ministries) > 0) {
                    for ($i = 0; $i < sizeof($ministries); $i++) {
                    $data = array();
                    $data = array(
                        'MINISTRY_ID' => $ministries[$i],
                        'MEMBER_ID' => $memberId
                    );
                    $this->ministry_model->addToMinistry($data);
                    }
                }
                

                redirect(base_url() . 'Members/View/' . $memberId);
            }
            else {
                redirect(base_url() . 'Login');
            }
        }
        else {
            redirect(base_url() . 'Login');
        }
    }

}
