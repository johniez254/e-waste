<?php 

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Basic Vng4U2ZNaEExdWE2RDlQQjJCMmhiWXh0cTlBRXdBVjk6Mk1oM3ZZSU1NeG50SEZBRA=='
  ),
));

$response = curl_exec($curl);
    
curl_close($curl);

$mpesa_response = json_decode($response);

$access_token = $mpesa_response->access_token;

// echo $access_token;

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
    "BusinessShortCode": "174379",
    "Password": "MTc0Mzc5YmZiMjc5ZjlhYTliZGJjZjE1OGU5N2RkNzFhNDY3Y2QyZTBjODkzMDU5YjEwZjc4ZTZiNzJhZGExZWQyYzkxOTIwMjAwMjAzMDIxMjAw",
    "Timestamp": "20200203021200",
    "TransactionType": "CustomerPayBillOnline",
    "Amount": "1",
    "PartyA": "254725542046",
    "PartyB": "174379",
    "PhoneNumber": "254725542046",
    "CallBackURL": "https://db9c5a77cbfe.ngrok.io",
    "AccountReference": "F5S6F7",
    "TransactionDesc": "E-Waste"
}',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer '.$access_token,
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;

?>