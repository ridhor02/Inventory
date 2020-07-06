<?php

class Excel_import_model extends CI_Model{

               function select(){

                              $this->db->order_by('id', 'DESC');

                              $query = $this->db->get('import');

                              return $query;

               }

               function insert($data){

                              $this->db->insert_batch('import', $data);

               }

}