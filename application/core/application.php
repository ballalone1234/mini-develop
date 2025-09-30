<?php

declare(strict_types=1);

class Application
{
    /** @var string|null The controller */
    private ?string $url_controller = null;

    /** @var string|null The method (of the above controller), often also named "action" */
    private ?string $url_action = null;

    /** @var array URL parameters */
    private array $url_params = [];

    /**
     * "Start" the application:
     * Analyze the URL elements and calls the according controller/method or the fallback
     */
    public function __construct()
    {
        $this->splitUrl();

        if (!$this->url_controller) {
            require APP . 'controller/home.php';
            $page = new Home();
            $page->index();
        } elseif (file_exists(APP . 'controller/' . $this->url_controller . '.php')) {
            require APP . 'controller/' . $this->url_controller . '.php';
            $this->url_controller = new $this->url_controller();

            if (method_exists($this->url_controller, $this->url_action)) {
                if (!empty($this->url_params)) {
                    call_user_func_array([$this->url_controller, $this->url_action], $this->url_params);
                } else {
                    $this->url_controller->{$this->url_action}();
                }
            } else {
                if (strlen($this->url_action) === 0) {
                    $this->url_controller->index();
                } else {
                    header('location: ' . URL . 'problem');
                }
            }
        } else {
            header('location: ' . URL . 'problem');
        }
    }

    /**
     * Get and split the URL
     */
    private function splitUrl(): void
    {
        if (isset($_GET['url'])) {
            $url = trim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            $this->url_controller = $url[0] ?? null;
            $this->url_action = $url[1] ?? null;

            unset($url[0], $url[1]);

            $this->url_params = array_values($url);
        }
    }
}
