<?php

namespace App\Routes {

    use App\Responses\IResponse;
    use InvalidArgumentException;

    class Router
    {
        private $response;
        private $routes = [];
        private $httpMethods = [
            'get',
            'post',
            'put',
            'patch',
            'delete'
        ];
        private $notFound;

        public function __construct(IResponse $response)
        {
            $this->response = $response;
            $this->notFound = function($url){
                echo "404 - $url was not found";
            };
        }

        public function add($method, $url, $action)
        {

            $method = strtolower($method);

            if (in_array($method, $this->httpMethods)) {
                $this->routes[$method][$url] = $action;
            } else {
                throw new InvalidArgumentException("Unsuppported HTTP Method: $method. Use get, post, put, patch or delete");
            }
        }

        public function setNotFound($action)
        {
            $this->notFound = $action;
        }

        public function dispatch(){

            foreach ($this->routes as $method => $routes) {

                foreach ($routes as $url => $action) {

                    if ($method == strtolower($_SERVER['REQUEST_METHOD'])) {

                        //TODO: get any wildcards

                        if ($url == $_SERVER['REQUEST_URI']) {

                            if (is_callable($action)) {
                                return $action();
                            }

                            $actionArr = explode('@', $action);
                            $controllerClass = 'App\\Controllers\\' . $actionArr[0];
                            $method = $actionArr[1];

                            try {
                                $reflectedClass = new \ReflectionClass($controllerClass);
                            } catch (\ReflectionException $e) {
                                throw new InvalidArgumentException("Controller $actionArr[0] does not exist");
                            }

                            if (!$reflectedClass->IsInstantiable()) {
                                throw new InvalidArgumentException("Controller $actionArr[0] does not exist");
                            }

                            if (!$reflectedClass->hasMethod($method)) {
                                throw new InvalidArgumentException("Method $method does not exist on controller $actionArr[1]");
                            }

                            $controller = new $controllerClass($this->response);

                            echo $controller->$method();
                            return null;
                        }
                    }
                }
            }

            call_user_func_array($this->notFound,[$_SERVER['REQUEST_URI']]);
            return null;
        }
    }
}