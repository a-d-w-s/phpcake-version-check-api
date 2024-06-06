<?php
declare(strict_types=1);

namespace VersionCheck\Controller;

use Cake\Core\Configure;
use Cake\Event\EventInterface;
use Cake\Routing\Router;

/**
 * VersionCheck Controller
 */
class CheckVersionController extends AppController
{
    /**
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    /**
     */
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->RequestHandler->renderAs($this, 'json');
    }

    /**
     * Check method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $data = [
            'version' => Configure::version(),
            'domain' => Router::fullBaseUrl(),
        ];

        // Set the response to be returned as JSON
        $this->set([
            'data' => $data,
            '_serialize' => ['data']
        ]);
    }
}
