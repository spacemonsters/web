<?php

/**
 * Created by PhpStorm.
 * User: erik
 * Date: 4/19/17
 * Time: 8:53 AM
 */
class session
{// klassi algus
    // klassi muutujad
    var $sid = false; // sessiooni id
    var $vars = array(); // sessiooni ajal tekkivad andmed
    var $http = false; // objekt veebiandmete kasutamiseks
    var $db = false; // objekt andmebaasi kasutamiseks
    // kui anonüümne lubatud ei ole - var $anonymous = false;
    var $anonymous = true; // anonüümne kasutaja on lubatud
    // sessiooni pikkus
    var $timeout = 1800; // 30 minutit
    // klassi meetodid
    // konstruktor
    function __construct(&$http, &$db){
        $this->http = &$http;
        $this->db = &$db;
        // võtame sessiooni id andmed
        $this->sid = $http->get('sid');
        $this->checkSession();
    }// konstruktor
    // sessiooni loomine
    function createSession($user = false){
        // kui kasutaja on anonüümne
        if($user == false){
            // tekitame andmed session tabeli jaoks
            $user = array(
                'user_id' => 0,
                'role_id' => 0,
                'username' => 'Anonymous'
            );
        }// kas kasutaja on anonüümne - lõpp
        // unikaalse sessiooni id loomine
        $sid = md5(uniqid(time().mt_rand(1, 1000), true));
        // päring sessiooni andmete salvestamiseks andmebaasi
        $sql = 'INSERT INTO session SET '.
            'sid='.fixDb($sid).', '.
            'user_id='.fixDb($user['user_id']).', '.
            'user_data='.fixDb(serialize($user)).', '.
            'login_ip='.fixDb(REMOTE_ADDR).', '.
            'created=NOW()';
        // sisestame päring andmebaasi
        $this->db->query($sql);
        // määrame sid ka antud klassi muutujale var $sid
        $this->sid = $sid;
        // paneme antud väärtus ka veebi - lehtede vahel kasutamiseks
        $this->http->set('sid', $sid);
    }// createSession
    // sessiooni tabeli puhastamine
    function clearSessions(){
        $sql = 'DELETE FROM session WHERE '.
            time().' - UNIX_TIMESTAMP(changed) > '.
            $this->timeout;
        $this->db->query($sql);
    }// clearSessions
    // sessiooni kontroll
    function checkSession(){
        $this->clearSessions();
        // kui sid on puudu ja anonüümne on lubatud
        // tekitame alustamiseks anonüümse sessioon
        if($this->sid === false and $this->anonymous){
            $this->createSession();
        }
        // kui aga sid on olemas
        if($this->sid !== false){
            // võtame andmed sessiooni tabelist, mis on
            // antud id-ga seotud
            $sql = 'SELECT * FROM session WHERE '.
                'sid='.fixDb($this->sid);
            // saadame päring andmebaasi ja võtame andmed
            $res = $this->db->getArray($sql);
            // kui andmebaasist andmed ei tule
            if($res == false){
                // kui anonüümne on lubatud
                // siis loome uus sessioon
                if($this->anonymous){
                    $this->createSession();
                } else {
                    // kui anonüümne sessioon ei ole lubatud
                    // tuleb maha kustutada kõik antud sessiooniga
                    // olevad andmed veebist
                    $this->sid = false;
                    $this->http->del('sid');
                }
                // lisame anonüümse kasutaja rolli ja id
                define('ROLE_ID', 0);
                define('USER_ID', 0);
            } else{
                // kui andmebaasist on võimalik sessiooni
                // kohta andmed saada
                // kõigepealt sessiooni andmed
                $vars = unserialize($res[0]['svars']);
                if(!is_array($vars)){
                    $vars = array();
                }
                $this->vars = $vars;
                // nüüd kasutaja andmed
                $user_data = unserialize($res[0]['user_data']);
                define('ROLE_ID', $user_data['role_id']);
                define('USER_ID', $user_data['user_id']);
                $this->user_data = $user_data;
            }
        } else {
            // kui $this->sid === false
            // hetkel sessiooni pole
//			// echo 'Sessiooni hetkel pole<br />';
            define('ROLE_ID', 0);
            define('USER_ID', 0);
        }
    }// checkSession
    // sessiooni uuendamine
    function flush(){
        if($this->sid !== false){
            $sql = 'UPDATE session SET changed=NOW(), '.
                'svars='.fixDb(serialize($this->vars)).
                ' WHERE sid='.fixDb($this->sid);
            $this->db->query($sql);
        }
    }
    // sessiooni andmete lisamine
    function set($name, $val){
        $this->vars[$name] = $val;
    }// set
    // sessiooni andmete võtmine
    function get($name){
        if(isset($this->vars[$name])){
            return $this->vars[$name];
        }
        return false;
    }// get
    function del($name){
        if(isset($this->vars[$name])){
            unset($this->vars[$name]);
        }
    }// del
    function delSession(){
        if($this->sid != false){
            $sql = 'DELETE FROM session '.
                'WHERE sid='.fixDb($this->sid);
            $this->db->query($sql);
            $this->sid = false;
            $this->http->del('sid');
        }
    }// delSession
}// klassi lõpp

?>