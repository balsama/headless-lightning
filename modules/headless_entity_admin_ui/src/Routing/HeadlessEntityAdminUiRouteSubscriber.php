<?php

namespace Drupal\headless_entity_admin_ui\Routing;

use Drupal\Core\Routing\RouteBuildEvent;
use Drupal\Core\Routing\RoutingEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Subscriber for Headless Entity Admin UI routes.
 */
class HeadlessEntityAdminUiRouteSubscriber implements EventSubscriberInterface  {

  /**
   * Changes route names and groupings to be more logical for decoupled apps.
   *
   * @param \Drupal\Core\Routing\RouteBuildEvent $event
   *   The route build event.
   */
  public function alterRoutes(RouteBuildEvent $event) {
    $collection = $event->getRouteCollection();

    foreach ($collection->all() as $name => $route) {
      switch ($name) {
        case 'entity.user.collection':
          $route->setDefault('_title', 'Users');
          $route->setPath('/admin/access/users');
          break;
        case 'user.admin_permissions':
          $route->setPath('/admin/access/permissions');
          break;
        case 'entity.user_role.collection':
          $route->setPath('/admin/access/roles');
          break;
        case 'entity.oauth2_client.collection':
          $route->setDefault('_title', 'OAuth2 clients');
          $route->setPath('/admin/access/oauth2/clients');
          break;
        case 'entity.oauth2_token.collection':
          $route->setDefault('_title', 'OAuth2 access tokens');
          $route->setPath('/admin/access/oauth2/tokens');
          break;
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents() {
    $events[RoutingEvents::ALTER] = 'alterRoutes';
    return $events;
  }

}
