<?php

class Ministry_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @return type
     */
    public function GetMinistries() {
        $sql = "SELECT * FROM ci_ministry ORDER BY ABBREVIATION ASC";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    /**
     * 
     * @param type $memberId
     * @return type
     */
    public function GetMinistry($ministryId) {
        $sql = "SELECT * FROM ci_ministry WHERE MINISTRY_ID = '$ministryId'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    // function to save members that were edited 
    public function saveMinistry($ministryId, $data) {
        // The correct syntax for update in the sql
        $this->db->where('MINISTRY_ID', $ministryId);
        $this->db->update('ci_ministry', $data);
    }

    // function to add members that were edited 
    public function addToMinistry($data) {
        // The correct syntax for update in the sql
        $this->db->insert('ci_ministry_mem', $data);
    }

    /**
     * Function to Delete Ministry of a Member
     */
    public function deleteMemberMinistry($memberId) {
        // Delete Statement Where Member ID = $data->MEMBER_ID
        // The correct syntax for delete in the sql
        $this->db->where('MEMBER_ID', $memberId);
        $this->db->delete('ci_ministry_mem');
    }

    /**
     * Function to print member information on Ministries view
     */
    public function getMinistryMembers($ministryId) {
        $sql = "SELECT * FROM ci_member mem, ci_ministry_mem minMem, ci_ministry min 
        WHERE mem.member_id = minMem.member_id AND min.ministry_id = minMem.ministry_id 
        AND minMem.ministry_id = '$ministryId'
        ORDER BY mem.FIRST_NAME ASC";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;

    }

    /**
     * Function to print member information on viewMinistry view
     */
    public function getMemberMinistries($memberId) {
        $sql = "SELECT * FROM ci_member mem, ci_ministry_mem minMem, ci_ministry min 
        WHERE mem.member_id = minMem.member_id AND min.ministry_id = minMem.ministry_id AND minMem.member_id = '$memberId'
        ORDER BY mem.FIRST_NAME ASC";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;

    }

    // function to add ministry 
    public function addMinistry($data) {
        // The correct syntax for update in the sql
        $this->db->insert('ci_ministry', $data);
    }

    // function to delete ministries 
    public function deleteMinistry($ministryId) {
        // The correct syntax for delete in the sql
        $this->db->where('MINISTRY_ID', $ministryId);
        $this->db->delete('ci_ministry');
    }
}


?>
