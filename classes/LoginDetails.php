<?php
/**
 * Created by Chris on 9/29/2014 3:57 PM.
 */

class LoginDetails {
    private $_db,
            $_data,
            $_sessionName,
            $_cookieName,
            $isLoggedIn;

    public function __construct($user = null) {
        $this->_db = DB::getInstance();
    }

    public function create($fields = array()) {
        if(!$this->_db->insert('chat_login_details', $fields)) {
            throw new Exception('Sorry, there was a problem creating your account;');
        }
    }

    public function update($fields = array(), $id = null) {

        if(!$id && $this->isLoggedIn()) {
            $id = $this->data()->id;
        }

        if(!$this->_db->update('chat_login_details', $id, $fields)) {
            throw new Exception('There was a problem updating');
        }
    }
    public function exists() {
        return (!empty($this->_data)) ? true : false;
    }
	
    public function data(){
        return $this->_data;
    }
	
	public function insertUserLoginDetails($userId) {		
		try {
			$this->create(array(
				'userid' => $userId,
			));
            } catch(Exception $e) {
                echo $error, '<br>';
            }	
	}	
}