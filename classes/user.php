<?php

class user {
    private $_db,
            $_data,
            $_session_name, 
            $_cookie_name,
            $_is_logged_in;
    
    public function __construct($user = null){
        $this->_db = db::getInstance();
        $this->_session_name = config::get('session/session_name');
        $this->_cookie_name = config::get('remember/cookie_name');
        
        if (!$user){
            if (session::exists($this->_session_name)){
                $user = session::get($this->_session_name);
                
                if ($this->find($user)){
                    $this->_is_logged_in = true;
                } else {
                    //process logout
                }
            }
        } else {
            $this->find($user);
        }
    }
    
    public function create($fields = array()){
        if (!$this->_db->insert('users', $fields)){
            throw new Exception('Something went wrong, please contact an admin.');
        }
    }
    
    public function update($fields = array(), $id = null){
        if (!$id && $this->isLoggedIn()){
            $id = $this->_data->id;
        }
    
        if (!$this->_db->update('users', $id, $fields)){
            throw new Exception('There was a problem updating your information.');
        }
    }
    
    public function find($user = null){
        if ($user){
            $field = (is_numeric($user)) ? 'id' : 'username';
            $data = $this->_db->get('users', array($field, '=', $user));
            
            if ($data->count()){
                $this->_data = $data->firstResult();
                return true;
            }
        }
        
        return false;
    }
    
    public function login($username = null, $password = null, $remember = false){        
        if (!$username && !$password && $this->exists()){
            session::put($this->_session_name, $this->_data->id);
        } else {
            $user = $this->find($username);
        
            if ($user){
                if ($this->_data->password === hash::make($password, $this->_data->salt)){
                    session::put($this->_session_name, $this->_data->id);
                    
                    if ($remember){
                        $hash = hash::unique();
                        $hash_check = $this->_db->get('users_session', array('user_id', '=', $this->_data->id));
                        
                        if (!$hash_check->count()){
                            $this->_db->insert('users_session', array(
                                'user_id' => $this->_data->id,
                                'hash' => $hash
                            ));
                        } else {
                            $hash = $hash_check->firstResult()->hash;
                        }
                        
                        cookie::put($this->_cookie_name, $hash, config::get('remember/cookie_expiry'));
                    }
                    
                    return true;
                }
            }
        }
        
        return false;
    }
    
    public function hasPermission($key){
        $group = $this->_db->get('groups', array('id', '=', $this->_data->group));
        
        if ($group->count()){
            $permissions = json_decode($group->firstResult()->permissions, true);
            
            return $permissions[$key];
        }
        
        return false;
    }
    
    public function exists(){
        return !empty($this->_data);
    }
    
    public function logout(){
        $this->_db->delete('users_session', array('user_id', '=', $this->_data->id));
        session::delete($this->_session_name);
        cookie::delete($this->_cookie_name);
    }
    
	public function username(){
		return $this->_data->username;
	}

    public function name(){
		return $this->_data->name;
	}

    public function data(){
        return $this->_data;
    }
    
    public function isLoggedIn(){
        return $this->_is_logged_in;
    }
}

?>
