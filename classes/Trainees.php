<?php
/**
 * Created by Chris on 9/29/2014 3:57 PM.
 */

class Trainees {
    private $_db,
            $_data;

    public function __construct($user = null) {
        $this->_db = DB::getInstance();
    }

    public function create($fields = array()) {
        if(!$this->_db->insert('trainees', $fields)) {
            throw new Exception('Sorry, there was a problem creating your account;');
        }
    }

    public function update($fields = array(), $id = null) {

        if(!$id && $this->isLoggedIn()) {
            $id = $this->data()->id;
        }

        if(!$this->_db->update('trainees', $id, $fields)) {
            throw new Exception('There was a problem updating');
        }
    }
	
	public function check_if_exists($studentID = null, $fname = null, $mname = null, $lname = null) {
            $user = $this->find($fname);
            
            if ($user){
                if ($this->data()->studentID === $studentID && $this->data()->mname === $mname && $this->data()->lname === $lname){
                    return true;
                }
            }

        return false;
    }
	
	public function find($user = null) {
        if($user) {
            $field = (is_numeric($user)) ? 'id' : 'fname';
            $data = $this->_db->get('trainees', array($field, '=', $user));

            if($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }
	
    public function exists() {
        return (!empty($this->_data)) ? true : false;
    }

    public function data(){
        return $this->_data;
    }

}