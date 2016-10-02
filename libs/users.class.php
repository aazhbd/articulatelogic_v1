<?php

class Users
{
    var $loged = false;
    var $uemail = "";
    var $utype = "";
    var $id = "";
    var $validator = "";
    var $msg = "";

    function Users($email, $pass, $db)
    {
        $email = trim($email);
        $pass = trim($pass);
        
        $r = $db->selectData("select id, pass, ustatus, utype, validator, state from users where email = '$email'");
        
        if($r == null || $r == false) return false;
        
        foreach($r as $p)
        {
            $tid =  "" . $p['id'];
            $tpass = $p['pass'];
            $tstat = "" . $p['ustatus'];
            $utype = "" . $p['utype'];
            $tvdator =  "" . $p['validator'];
            $tperm =  "" . $p['state'];
        }
        
        if($tpass == $pass && $tstat == "1" && $tperm == "0")
        {                    
            $this->uemail = $email;                    
            $this->loged = true;
            $this->utype = $utype;
            $this->validator = $tvdator;
            $this->id = $tid;
        }
        else if($tpass == $pass && $tstat == "0")
        {
            $this->uemail = $email;
            $this->msg = "Please validate your email address by clicking on the link provided in the mail sent.";
        }
    }
    
    function isLoged()
    {
        return $this->loged;
    }
    
    function getEmail()
    {
        return $this->uemail;
    }
    
    function getId()
    {
        return $this->id;
    }
    
    function getuType()
    {
        return $this->utype;
    }
    
    function logout()
    {
        $this->uemail = "";
        $this->loged = false;
        $this->type = "";
    }
    function getValidator()
    {
        return $this->validator;
    }
}
?>