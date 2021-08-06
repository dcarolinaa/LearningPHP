<?php
namespace App\services;

class GetURL
{

    private $baseUrl;
    public function __construct(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }
    public function __invoke($method, $controller, $data = [], $relative = true)
    {
        if (true === is_object($controller)) {
            $arrControllerParts = explode('\\', get_class($controller));
            $controller = $arrControllerParts[count($arrControllerParts) - 1];
        }

        $data = array_merge(
            [
                'controller' => $controller,
                'method' => $method
            ],
            $data
        );

        $query = http_build_query($data);
        if (true === $relative) {
            return sprintf('/?%s', http_build_query($data));
        }

        return sprintf('%s?%s', $this->baseUrl, http_build_query($data));
    }
}
