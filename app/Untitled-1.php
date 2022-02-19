
$xml_data ='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:loc="http://www.csapi.org/schema/parlayx/payment/amount_charging/v3_1/local" ><soapenv:Header>
    <tns:RequestSOAPHeader xmlns:tns="http://www.huawei.com.cn/schema/common/v2_1">
        <tns:spId>013329</tns:spId>
        <tns:spPassword>54654654646</tns:spPassword>
        <tns:timeStamp>202012121212</tns:timeStamp>
        <tns:serviceId>202012121212</tns:serviceId>
        <tns:OA>'.$tel.'</tns:OA>
        <tns:FA>'.$tel.'</tns:FA>
    </tns:RequestSOAPHeader> </soapenv:Header> 
    <soapenv:Body>
        <loc:chargeAmount>
            <loc:endUserIdentifier>'.$tel.'</loc:endUserIdentifier>
            <loc:charge>
                <description>charged</description>
                <currency>Birr</currency>
                <amount>100</amount>
                <code>255</code>
            </loc:charge>
            <loc:referenceCode>225</loc:referenceCode>
        </loc:chargeAmount>
    </soapenv:Body>
</soapenv:Envelope>';

$URL = "http://10.190.10.16:8310/AmountChargingService/services/AmountCharging/v3";
$ch = curl_init($URL);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "$xml_data");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($ch);
curl_close($ch);




      
      if ( (strpos($output, 'ns1:chargeAmountResponse') !== false) || (strpos($output, '22007201') !== false)  )
      {
        // Not payed
} 
else {
     //payed
}




















