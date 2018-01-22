<?php
/**
 * Created by PhpStorm.
 * User: ronald
 * Date: 2/25/17
 * Time: 12:30 PM
 */

namespace UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class SmsSenderController extends Controller
{

//    /**
//     * @Rest\View(statusCode=Response::HTTP_CREATED, serializerGroups={"sms"})
//     * @Rest\Post("/sms")
//     */
//    public function sendSMSAction(Request $request) {
//
//        $smsRequest = new SmsRequest();
//        $form = $this->createForm(SmsRequestType::class, $smsRequest);
//
//        $form->submit($request->request->all());
//
//        if (!$form->isValid()) {
//            return $form;
//        }
//
//        // Here we can send the sms
//        $restClient = $this->get('circle.restclient');
//
//        //$restClient->post('http://www.someUrl.com', 'somePayload');
//
//        $url =  $this->getRealSmsURL($smsRequest);
//        /** @var Response $response */
//        $response = $restClient->get($url);
//
//        $responseContent = $response->getContent();
//        // {"data":[{"status":"OK","error":"0","smslog_id":"66","queue":"5c25b4923da1bae0fbef6da91937f55a","to":"00221766752645"}],"error_string":null,"timestamp":1488382863}
//
//        $responseContent = json_encode($responseContent, true);
//
//        if($responseContent["data"][0]["status"] == "OK"){
//            return View::create("Le mot de passe a bien été envoyé",200);
//        }
//
//
//        return View::create("Erreur lors de l'envoi du SMS",400);
//
//    }
//
//    private  function getRealSmsURL(SmsRequest $smsRequest){
//
//        $search = array(':telephone', ':message');
//        $replace = array($smsRequest->getSendTo(), $smsRequest->getMessage());
//
//        $url = $this->getParameter('sms_server_url');
//
//        $url = str_replace($search, $replace, $url);
//
//        return $url;
//    }
}