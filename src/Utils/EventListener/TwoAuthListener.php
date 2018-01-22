<?php

namespace Utils\EventListener;

use Monolog\Logger;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\EventListener\ResponseListener;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\Router;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class TwoAuthListener
{
    /** @var Router */
    protected $router;

    /** @var TokenStorage */
    protected $token;

    /** @var EventDispatcherInterface */
    protected $dispatcher;

    /** @var Logger */
    protected $logger;

    protected $session;

    protected $key='twoAuth';
    protected $templating;
    private $ignore_routes;

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->router       = $container->get('router');
        $this->token        = $container->get('security.token_storage');
        $this->dispatcher   = $container->get('event_dispatcher');
        $this->session       = $container->get('session');
        $this->templating  = $container->get('templating');
        $this->ignore_routes =[
            'fos_user_security_login',
            'fos_user_security_check',
            '_profiler_home',
            '_profiler',
            'fos_user_security_check',
            'fos_user_change_password',
        ];
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $num = str_pad(mt_rand(1,9999),4,'0',STR_PAD_LEFT);
        $this->session->set($this->key,$num);
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        $user = $this->token->getToken()->getUser();
        if($user->getForceChangePassword()){
            $response = new RedirectResponse( $this->router->generate ( '' ) );
            $event->setResponse($response);
        }

    }

    public function onKernelResponseHandler(FilterResponseEvent $event){
        $request = $event->getRequest();
        if(!in_array($request->attributes->get('_route'),$this->ignore_routes,false)){
            if($this->session->has($this->key) && !$request->request->has('__twoFactory')){
                $event->setResponse($this->templating->renderResponse('TwoFactor/template.html.twig',array('code' => $this->session->get($this->key))));
            }

            if($this->session->has($this->key) && $request->request->has('__twoFactory')){
                if($request->isMethod('POST')){
                    die('ok');
                }
            }
        }


        //$event->setResponse(new RedirectResponse( $this->router->generate ( '') ));
    }
}