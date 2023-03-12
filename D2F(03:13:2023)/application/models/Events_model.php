<?php

error_reporting(E_ALL ^ E_DEPRECATED);	
class Events_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * This function is used to add the event information in the database.
     * @param type $data
     */
    public function addEvent($data) {
        // The correct syntax for update in the sql
        $this->db->insert('ci_event', $data);
        return $this->db->insert_id();
    }
    
    /**
     * Function to add an attendee to a specific event
     */
    public function addEventAttendee($data) {
        // The correct syntax for update in the sql
        $this->db->insert('ci_event_attendee', $data);
        return $this->db->insert_id();
    }
    
    /**
     * Function to Delete Attendee of an Event
     */
    public function deleteEventAttendee($eventId, $memberId) {
        // Delete Statement Where Member ID = $data->MEMBER_ID
        // The correct syntax for delete in the sql
        $this->db->where('MEMBER_ID', $memberId);
        $this->db->where('EVENT_ID', $eventId);
        $this->db->delete('ci_event_attendee');

        // return how many rows are affected
        return $this->db->affected_rows();
    }
    
    /**
     * Function to update the event
     */
    public function updateEvent($eventId, $data) {
        // The correct syntax for update in the sql
        $this->db->where('EVENT_ID', $eventId);
        $this->db->update('ci_event', $data);
    }
    

    /**
     * Function to get events and also the attendee count
     */
    public function getEvents() {
            $sql = " SELECT evt.*, "
                 . " (SELECT COUNT(*) FROM ci_event_attendee ea "
                 . "  WHERE ea.EVENT_ID = evt.EVENT_ID) member_attendee_count, "
                 . " (SELECT COUNT(*) FROM ci_evt_non_member enm "
                 . " WHERE enm.EVENT_ID = evt.EVENT_ID) non_member_attendee_count"
                 . " FROM ci_event evt "
                 . " ORDER BY evt.EVENT_DTTM DESC ";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }
    
    /**
     * 
     * @param type $eventId
     * @return type
     */
    public function getEvent($eventId) {
        $sql = "SELECT * FROM ci_event WHERE EVENT_ID = '$eventId'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    // function to delete event
    public function deleteEvent($eventId) {
        // The correct syntax for delete in the sql
        $this->db->where('EVENT_ID', $eventId);
        $this->db->delete('ci_event');
    }
    
    /**
     * Function to Delete Attendee of an Event
     */
    public function deleteEventAttendees($eventId) {
        // Delete Statement Where Member ID = $data->MEMBER_ID
        // The correct syntax for delete in the sql
        $this->db->where('EVENT_ID', $eventId);
        $this->db->delete('ci_event_attendee');
    }

    /**
     * Function to get event attendees of a specific Event
     */
    public function getEventAttendees($eventId) {
        $sql = "SELECT mem.FIRST_NAME, mem.LAST_NAME, mem.NETWORK 
        FROM ci_event evt, ci_event_attendee ea, ci_member mem
        WHERE evt.EVENT_ID = ea.EVENT_ID
        AND ea.MEMBER_ID = mem.MEMBER_ID
        AND evt.EVENT_ID = '$eventId'
        ORDER BY mem.LAST_NAME ASC";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    /**
     * Function to get event non-member attendees of a specific Event
     */
    public function getEventNonMemberAttendees($eventId) {
        $sql = "SELECT nonMem.FIRST_NAME, nonMem.LAST_NAME, nonMem.NETWORK, nonMem.FIRST_TIMER_FLG 
        FROM ci_event evt, ci_evt_non_member nonMem
        WHERE evt.EVENT_ID = nonMem.EVENT_ID
        AND evt.EVENT_ID = '$eventId'
        ORDER BY nonMem.LAST_NAME ASC";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

     // function to add non members to db 
     public function addNonMember($data) {
        // The correct syntax for update in the sql
        $this->db->insert('ci_evt_non_member', $data);
        return $this->db->insert_id();
    }

    public function exportToExcel($eventId) {

        // Get event Attendees
        $sql = "SELECT mem.FIRST_NAME, mem.LAST_NAME, mem.NETWORK 
        FROM ci_event evt, ci_event_attendee ea, ci_member mem
        WHERE evt.EVENT_ID = ea.EVENT_ID
        AND ea.MEMBER_ID = mem.MEMBER_ID
        AND evt.EVENT_ID = '$eventId'
        ORDER BY mem.LAST_NAME ASC";

        $query = $this->db->query($sql);
        $date = date('M/d/Y');

        // Get Nonmember attendees
        $sql2 = "SELECT nonMem.FIRST_NAME, nonMem.LAST_NAME, nonMem.NETWORK, nonMem.FIRST_TIMER_FLG 
        FROM ci_event evt, ci_evt_non_member nonMem
        WHERE evt.EVENT_ID = nonMem.EVENT_ID
        AND evt.EVENT_ID = '$eventId'
        ORDER BY nonMem.LAST_NAME ASC";

        $query2 = $this->db->query($sql2);

        $i=0;
        $cnt = 2;
        $rowcount = $query->num_rows() + $query2->num_rows();
        if($rowcount != 0){

            include_once("xlsxwriter.class.php");
            ini_set('display_errors', 0);
            ini_set('log_errors', 1);
            error_reporting(E_ALL & ~E_NOTICE);

            $filename = "EventAttendees_" . date('M/d/Y') . ".xlsx";
            header('Content-disposition: attachment; filename="'.XLSXWriter::sanitize_filename($filename).'"');
            header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
            header('Content-Transfer-Encoding: binary');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            $arr=array();

            // print event member attendees
            foreach ($query->result_array() as $row)
            {	
            $arr[$i][0]=$row['FIRST_NAME'];//your table column fields
            $arr[$i][1]=$row['LAST_NAME'];
            $arr[$i][2]=$row['NETWORK'];
            $i=$i+1;
            }

            // print non-memberattendies
            foreach ($query2->result_array() as $row2)
            {	
            $arr[$i][0]=$row2['FIRST_NAME'];//your table column fields
            $arr[$i][1]=$row2['LAST_NAME'];
            $arr[$i][2]=$row2['NETWORK'];
            $arr[$i][3]=$row2['FIRST_TIMER_FLG'];
            $i=$i+1;
            }

            $header = array(
            'First Name'=>'string',
            'Last Name'=>'string',
            'Network'=>'string',
            'First Timer'=>'string'
            );

            $writer = new XLSXWriter();
            $writer->setAuthor('Amiel De Los Reyes and Aljon Botawan'); 
            $writer->writeSheetHeader('Sheet1', $header, $col_options = array('fill'=>'#699E96','font-style'=>'bold','color'=>'#ffffff', 'border'=>'left,right,top,bottom', 'border-style'=>'thin', 'height'=>15,'wrap_text'=>true,'valign'=>'center','halign'=>'center') );
            $border = array( 'border'=>'left,right,top,bottom');
            $border_style = array( 'border-style'=>'thin');
            foreach($arr as $row)
            $writer->writeSheetRow('Sheet1', $row, $border, $border_style);
            $writer->writeToStdOut();
            exit(0);
        }else
        {
        echo "<script>alert('No record(s) found.') </script>";  
        // Redircet to Home Page		
        echo "<script language=\"javascript\">window.location = '".	site_url('Events')."'  </script>";
        }
    }
}

?>
