<?php

namespace Library;

class HTTPReponse extends ApplicationComponent
{
    protected $page, $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }
    public function addHeader(string $header)
    {
        header($header);
    }
    public function redirect(string $location)
    {
        header('Location: ' . $location);
    }
    public function redirect404()
    {
        $this->page = new Page($this->app);
        $this->page->setContentFile(__DIR__ . '/../Errors/404.php');
        $this->addHeader('HTTP/1.0 404 Not Found');
        $this->send();
    }
    public function send()
    {
        exit($this->page->getGeneratedPage());
    }
    public function setPage(Page $page)
    {
        $this->page = $page;
    }
    public function setCookie(string $name, string $value, int $expire, string $path, string $domain, string $secure, bool $httpOnly = true)
    {
        setcookie($name, $value, $expire, $path, $domain, $secure, $httpOnly);
    }
    public function page()
    {
        return $this->page;
    }
}
