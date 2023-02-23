<?php

class Member_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @return type
     */
    public function GetMembers() {
        $sql = "SELECT * FROM ci_member ORDER BY LAST_NAME ASC";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }


    /**
     * 
     * @param type $memberId
     * @return type
     */
    public function GetMember($memberId) {
        $sql = "SELECT * FROM ci_member WHERE MEMBER_ID = '$memberId'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    // function to save members that were edited 
    public function saveMember($memberId, $data) {
        // The correct syntax for update in the sql
        $this->db->where('MEMBER_ID', $memberId);
        $this->db->update('ci_member', $data);
    }

    // function to add members that were edited 
    public function addMember($data) {

        // The correct syntax for update in the sql
        $this->db->insert('ci_member', $data);
    }

    // function to delete member/s 
    public function deleteMember($memberId) {
        // The correct syntax for delete in the sql
        $this->db->where('MEMBER_ID', $memberId);
        $this->db->delete('ci_member');
    }
}

?>
