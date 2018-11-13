<?php 

class Sms
{
    private $user;
    private $host;
    private $pass;

    public function __construct($host, $user, $pass)
    {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
    }

    public function send($to, $message)
    {
        $result = array(
            'status' => 'FAILED',
            'message' => '',
        );

        if ($this->isNotLogin()){
            if (!$this->login()) {
                $result['message'] = 'Wrong user or password';
                return $result;
            }
        }

        $url = "http://".$this->host."/api/sms/send-sms";
        $data = $this->req($url, $this->getSendData($to, $message));
        $data = simplexml_load_string($data);

        if ($data && $data[0] == "OK") {
            $result['status'] = 'SUCCESS';
            $result['message'] = 'Message sent successfully.';
            return $result;
        }
        
        $result['message'] = 'An error occured';
        return $result;


    }

    private function login()
    {
        $url = "http://".$this->host."/api/user/login";
        $data = $this->req($url, $this->getUserData());
        $data = simplexml_load_string($data);
        return $data[0] == "OK";
    }

    private function logout()
    {
        $url = "http://".$this->host."/api/user/logout";
        $this->req($url, $this->getLogoutData());
    }

    private function req($url, $data, $post = true)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        
        if ($post) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);
        curl_close($ch);

        return $server_output;
    }

    private function isNotLogin()
    {
        $url = "http://".$this->host."/api/user/state-login";
        $data = $this->req($url, "", false);
        $data = simplexml_load_string($data);
        if ($data)
            return $data->State == "-1";
        else true;
    }

    private function getUserData()
    {
        return "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
                <request>
                    <Username>".$this->user."</Username>
                    <Password>".base64_encode($this->pass)."</Password>
                </request>";
    }

    private function getSendData($to, $message)
    {
        return "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
            <request>
                <Index>-1</Index>
                <Phones>
                    <Phone>$to</Phone>
                </Phones>
                <Sca></Sca>
                <Content>$message</Content>
                <Length>".strlen($message)."</Length>
                <Reserved>1</Reserved>
                <Date>2018-11-12 18:16:13</Date>
            </request>";
    }

    private function getLogoutData()
    {
        return "<?xml version=\"1.0\" encoding=\"UTF-8\"?><request><Logout>1</Logout></request>";
    }
}
