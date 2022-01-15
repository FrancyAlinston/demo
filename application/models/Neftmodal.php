<?php
class Neftmodal extends CI_Model {



    public function selectdata( $select="*" , $limit='' , $offset='' )
    {
 
        $this->db->select( $select );
        $this->db->limit( $limit , $offset );
        $query = $this->db->get('neftaccountclosed');
        // foreach ($query->result() as $row)
        // {
        //         echo $row->nes_id."<br>";
        // }
        return $query->result();
    }


}