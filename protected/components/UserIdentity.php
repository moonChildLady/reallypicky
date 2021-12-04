<?php
class UserIdentity extends CUserIdentity
{   
    public $userType = 'Front';
 
    public function authenticate()
    {
        if($this->userType=='Front') // This is front login
        {
            // check if login details exists in database
            $record=Member::model()->findByAttributes(array('email'=>$this->username)); 
            if($record===null)
            { 
                $this->errorCode=self::ERROR_USERNAME_INVALID;
            }
            else if($record->password!==$this->password)            // here I compare db password with password field
            { 
                $this->errorCode=self::ERROR_PASSWORD_INVALID;
            }
            else
            {  
                $this->setState('userId',$record->member_id);
				$this->setState('email',$record->email);
                //$this->setState('name', $record->firstName.' '.$record->lastName);
                $this->setState('name', $record->name);
				$usersession = array("email"=>$record->email,'name'=>$record->name,'id'=>$record->member_id,'displayname'=>$record->display_name);
				Yii::app()->session['memberinfo'] = $usersession;
                $this->errorCode=self::ERROR_NONE;
            }
            return !$this->errorCode;
        }

        if($this->userType=='Back')// This is admin login
        {
            // check if login details exists in database
            $record=AdminUser::model()->findByAttributes(array('username'=>$this->username));  // here I use Email as user name which comes from database
            if($record===null)
            { 
                $this->errorCode=self::ERROR_USERNAME_INVALID;
            }
            else if($record->password!==$this->password) // let we have base64_encode password in database
            { 
                $this->errorCode=self::ERROR_PASSWORD_INVALID;
            }
            else
            {  
                $this->setState('isAdmin',1);
                $this->setState('userId',$record->id);
                $this->setState('name', $record->username);
                $this->errorCode=self::ERROR_NONE;
            }
            return !$this->errorCode;
        }
    }
}