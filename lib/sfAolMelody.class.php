<?php
class sfAolMelody extends sfOAuth1
{
  protected function initialize($config)
  {
    $this->request_token_url = 'https://api.screenname.aol.com/auth/oauth_request_token';
    $this->request_auth_url = 'https://api.screenname.aol.com/auth/oauth_authorize';
    $this->access_token_url = 'https://api.screenname.aol.com/auth/oauth_access_token';
  }

  public function getContacts($uid)
  {
    $url = 'http://social.yahooapis.com/v1/user/'.$uid.'/contacts';
    $this->params = array('format' => 'json');
    $request = OAuthRequest::from_consumer_and_token($this->getConsumer(), $this->getToken(), 'GET', $url, $this->params);
    $request->sign_request(new OAuthSignatureMethod_HMAC_SHA1(), $this->getConsumer(), $this->getToken());

    $url = $request->to_url();

    return $this->call($url, null, 'GET');
  }
}