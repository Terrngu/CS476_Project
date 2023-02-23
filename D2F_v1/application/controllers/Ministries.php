<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ministries extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('ministry_model');
        $this->load->model('member_model');
    }

    /**
     * This function is the default function when accessing the MInistries Controller
     */
    public function index() {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                // Get Number of Members
                $data['title'] = "Ministries";
                $data['ministries'] = $this->ministry_model->GetMinistries();
                $data['ministryMembers'] = $this->ministry_model->getMinistryMembers($data['ministries'][0]->MINISTRY_ID);

                $data['selectedId'] = $data['ministries'][0]->MINISTRY_ID;
                //$data['selectedMinistry'] = $this->ministry_model->GetMinistry($ministryId)[0];
                $data['message'] = "";

                $this->load->view('dist/ministry', $data);
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
     * This function is used to redirect the page to the View Ministry Page
     * @param type $ministryId
     */
    public function View($ministryId) {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                // Get Number of Members
                $data['title'] = "Ministries";
                $data['ministries'] = $this->ministry_model->GetMinistries();
                $data['selectedId'] = $ministryId;
                $data['ministryMembers'] = $this->ministry_model->getMinistryMembers($ministryId);
                $data['selectedMinistry'] = $this->ministry_model->GetMinistry($ministryId)[0];


                $data['message'] = "";
                
                $this->load->view('dist/viewMinistry', $data);
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
    public function Edit($ministryId) {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {
                // Get Number of Members
                $data['title'] = "Edit Ministry";
                $data['ministries'] = $this->ministry_model->GetMinistries();
                $data['selectedId'] = $ministryId;
                $data['selectedMinistry'] = $this->ministry_model->GetMinistry($ministryId)[0];
                // $data['selectedMinistry'] = $this->ministry_model->GetMinistry($ministryId);
                $this->load->view('dist/editMinistry', $data);
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
     * This function is used to redirect the page to the Add Ministry Screen
     */
    public function Add() {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                // Get Number of Members
                $data['title'] = "Add Ministry";
                $data['ministries'] = $this->ministry_model->GetMinistries();

                $this->load->view('dist/addMinistry', $data);
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
     * This function is used to add the ministry information record in the database
     */
    public function addMinistry() {

        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                // To Update Members
                $ministryName = $this->input->post('ministry_name');
                $ministryAbbreviation = $this->input->post('ministry_abbreviation');
                $ministryDescription = $this->input->post('ministry_description');

                $data['ministries'] = $this->ministry_model->GetMinistries();

                
                // The correct syntax to pass parameters for the update.
                $data = array();
                $data = array(
                    'DESCRIPTION' => $ministryName,
                    'ABBREVIATION' => $ministryAbbreviation,
                    'MINISTRY_DESCRIPTION' => $ministryDescription
                    
                );

                // function call saveMember
                $this->ministry_model->addMinistry($data);

                redirect(base_url() . 'Ministries');

                
                // redirect(base_url() . 'Ministries/View/' . $ministries[0]->MINISTRY_ID);
               
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
    public function save($ministryId) {

        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                // To Update Members
                $ministryName = $this->input->post('ministryName');
                $minAbbreviation = $this->input->post('minAbbreviation');
                $ministryDescription = $this->input->post('ministryDescription');
                

                // The correct syntax to pass parameters for the update.
                $data = array();
                $data = array(
                    'ABBREVIATION' => $minAbbreviation,
                    'DESCRIPTION' => $ministryName,
                    'MINISTRY_DESCRIPTION' => $ministryDescription,
                );

                // function call saveMember
                $this->ministry_model->saveMinistry($ministryId, $data);

                redirect(base_url() . 'Ministries/View/' . $ministryId);
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
     * This function is used to delete the Ministry Information Record in the database
     * @param type $ministryId
     */
    public function Delete($ministryId) {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                $data['message'] = "The ministry you selected has been successfully deleted.";

                // Get Number of Members
                $data['title'] = "Ministries";

                // function call deleteMinistry
                $this->ministry_model->deleteMinistry($ministryId);
                

                // Retrieve the fresh cut of members
                $data['ministries'] = $this->ministry_model->GetMinistries();
                $data['selectedId'] = $data['ministries'][0]->MINISTRY_ID;

                $data['ministryMembers'] = $this->ministry_model->getMinistryMembers($ministryId);
                $data['selectedMinistry'] = $this->ministry_model->GetMinistry($ministryId);

                // then go back to ministries view
                redirect(base_url() . 'Ministries');

                
                // $this->load->view('dist/ministry', $data);
                
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
     * Function to add a member to a ministry
     */
    public function addToMinistry($memberId) {
        #Redirect to Admin dashboard after authentication
        if ($this->session->userdata('userLoginAccess') == 1) {
            if ($this->session->userdata('userLoginAccess') != False) {

                // Iterate through all selected ministries
                $ministries = $this->input->post('ministries');
                
                for ($i = 0; $i < sizeof($ministries); $i++) {
                    $data = array();
                    $data = array(
                        'MINISTRY_ID' => $ministry,
                        'MEMBER_ID' => $memberId
                    );
                    $this->ministry_model->addToMinistry($data);
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
