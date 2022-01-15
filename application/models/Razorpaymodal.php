<?php

class Razorpaymodal extends CI_Model
{
    public function selectdata($select="*", $date)
    {
        $this->db->select($select);
        $this->db->where('settled_date =', $date);
        $query = $this->db->get('razorpay');
        return $query->result();
    }

    /**
     * Not in use, maybe can be used for future purpose for date range search
     */
    public function getRazorPayDateRange($from, $to)
    {
        $sql =  "SELECT * FROM `razorpay`
        WHERE `settled_date` 
        BETWEEN STR_TO_DATE( '$from', '%d %b %Y' ) AND STR_TO_DATE( '$to', '%d %b %Y' ) 
        ORDER BY `settled_date` DESC";
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function find($id, $select="*")
    {
        $this->db->select($select);
        $this->db->where('id =', $id);
        $query = $this->db->get('razorpay');
        if ($this->db->count_all_results()>0) {
            return $query->result();
        }
        return false;
    }

    public function searchMembers($oldId, $column, $select="*")
    {
        $this->db->select($select);
        $this->db->like($column, $oldId);
        $this->db->order_by($column);
        $this->db->limit(10);
        $query = $this->db->get('member');
        if ($this->db->count_all_results()>0) {
            return $query->result();
        }
        return false;
    }
}
