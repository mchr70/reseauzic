<?php

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Psr\Log\LoggerInterface;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class srcApp_KernelDevDebugContainerUrlGenerator extends Symfony\Component\Routing\Generator\UrlGenerator
{
    private static $declaredRoutes;
    private $defaultLocale;

    public function __construct(RequestContext $context, LoggerInterface $logger = null, string $defaultLocale = null)
    {
        $this->context = $context;
        $this->logger = $logger;
        $this->defaultLocale = $defaultLocale;
        if (null === self::$declaredRoutes) {
            self::$declaredRoutes = [
        'admin_threads' => [[], ['_controller' => 'App\\Controller\\Admin\\AdminThreadsController::showThreads'], [], [['text', '/admin/threads']], [], []],
        'admin_thread' => [['id'], ['_controller' => 'App\\Controller\\Admin\\AdminThreadsController::showThread'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/admin/thread']], [], []],
        'admin_thread_delete' => [['id'], ['_controller' => 'App\\Controller\\Admin\\AdminThreadsController::deleteThread'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/adminthreaddelete']], [], []],
        'admin_message_delete' => [['id'], ['_controller' => 'App\\Controller\\Admin\\AdminThreadsController::deleteMessage'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/adminmessagedelete']], [], []],
        'admin_home' => [[], ['_controller' => 'App\\Controller\\Admin\\HomepageController::index'], [], [['text', '/admin/']], [], []],
        'app_homepage_index' => [[], ['_controller' => 'App\\Controller\\HomepageController::index'], [], [['text', '/']], [], []],
        'member_search' => [[], ['_controller' => 'App\\Controller\\HomepageController::searchMember'], [], [['text', '/search']], [], []],
        'member_profile' => [['id'], ['_controller' => 'App\\Controller\\HomepageController::showMemberProfile'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/profile']], [], []],
        'app_member_index' => [[], ['_controller' => 'App\\Controller\\MemberController::index'], [], [['text', '/member/']], [], []],
        'member_photo' => [[], ['_controller' => 'App\\Controller\\MemberController::showUpload'], [], [['text', '/member/photo']], [], []],
        'member_threads' => [[], ['_controller' => 'App\\Controller\\MemberController::showThreads'], [], [['text', '/member/threads']], [], []],
        'thread' => [['id'], ['_controller' => 'App\\Controller\\MemberController::showThread'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/member/thread']], [], []],
        'thread_editor' => [['recipientId'], ['_controller' => 'App\\Controller\\MemberController::startThread'], [], [['variable', '/', '[^/]++', 'recipientId', true], ['text', '/member/threadeditor']], [], []],
        'thread_delete' => [['id'], ['_controller' => 'App\\Controller\\MemberController::deleteThread'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/member/threaddelete']], [], []],
        'app_registration_register' => [[], ['_controller' => 'App\\Controller\\RegistrationController::registerAction'], [], [['text', '/register']], [], []],
        'login' => [[], ['_controller' => 'App\\Controller\\SecurityController::login'], [], [['text', '/login']], [], []],
        'forgotten_password' => [[], ['_controller' => 'App\\Controller\\SecurityController::forgottenPassword'], [], [['text', '/forgotten_password']], [], []],
        'reset_password' => [['token'], ['_controller' => 'App\\Controller\\SecurityController::resetPassword'], [], [['variable', '/', '[^/]++', 'token', true], ['text', '/reset_password']], [], []],
        'superadmin_members' => [[], ['_controller' => 'App\\Controller\\Superadmin\\SuperadminMemberController::showMembers'], [], [['text', '/superadmin/members']], [], []],
        'superadmin_member' => [['id'], ['_controller' => 'App\\Controller\\Superadmin\\SuperadminMemberController::showMember'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/superadmin/member']], [], []],
        'superadmin_member_toggle' => [['id'], ['_controller' => 'App\\Controller\\Superadmin\\SuperadminMemberController::deleteMember'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/superadmin/togglemember']], [], []],
        'superadmin_setadmin' => [['id'], ['_controller' => 'App\\Controller\\Superadmin\\SuperadminMemberController::setAdmin'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/superadmin/setadmin']], [], []],
        'superadmin_setuser' => [['id'], ['_controller' => 'App\\Controller\\Superadmin\\SuperadminMemberController::setUser'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/superadmin/setuser']], [], []],
        '_twig_error_test' => [['code', '_format'], ['_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'], ['code' => '\\d+'], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '\\d+', 'code', true], ['text', '/_error']], [], []],
        '_wdt' => [['token'], ['_controller' => 'web_profiler.controller.profiler::toolbarAction'], [], [['variable', '/', '[^/]++', 'token', true], ['text', '/_wdt']], [], []],
        '_profiler_home' => [[], ['_controller' => 'web_profiler.controller.profiler::homeAction'], [], [['text', '/_profiler/']], [], []],
        '_profiler_search' => [[], ['_controller' => 'web_profiler.controller.profiler::searchAction'], [], [['text', '/_profiler/search']], [], []],
        '_profiler_search_bar' => [[], ['_controller' => 'web_profiler.controller.profiler::searchBarAction'], [], [['text', '/_profiler/search_bar']], [], []],
        '_profiler_phpinfo' => [[], ['_controller' => 'web_profiler.controller.profiler::phpinfoAction'], [], [['text', '/_profiler/phpinfo']], [], []],
        '_profiler_search_results' => [['token'], ['_controller' => 'web_profiler.controller.profiler::searchResultsAction'], [], [['text', '/search/results'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
        '_profiler_open_file' => [[], ['_controller' => 'web_profiler.controller.profiler::openAction'], [], [['text', '/_profiler/open']], [], []],
        '_profiler' => [['token'], ['_controller' => 'web_profiler.controller.profiler::panelAction'], [], [['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
        '_profiler_router' => [['token'], ['_controller' => 'web_profiler.controller.router::panelAction'], [], [['text', '/router'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
        '_profiler_exception' => [['token'], ['_controller' => 'web_profiler.controller.exception::showAction'], [], [['text', '/exception'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
        '_profiler_exception_css' => [['token'], ['_controller' => 'web_profiler.controller.exception::cssAction'], [], [['text', '/exception.css'], ['variable', '/', '[^/]++', 'token', true], ['text', '/_profiler']], [], []],
        'logout' => [[], [], [], [['text', '/logout']], [], []],
    ];
        }
    }

    public function generate($name, $parameters = [], $referenceType = self::ABSOLUTE_PATH)
    {
        $locale = $parameters['_locale']
            ?? $this->context->getParameter('_locale')
            ?: $this->defaultLocale;

        if (null !== $locale && null !== $name) {
            do {
                if ((self::$declaredRoutes[$name.'.'.$locale][1]['_canonical_route'] ?? null) === $name) {
                    unset($parameters['_locale']);
                    $name .= '.'.$locale;
                    break;
                }
            } while (false !== $locale = strstr($locale, '_', true));
        }

        if (!isset(self::$declaredRoutes[$name])) {
            throw new RouteNotFoundException(sprintf('Unable to generate a URL for the named route "%s" as such route does not exist.', $name));
        }

        list($variables, $defaults, $requirements, $tokens, $hostTokens, $requiredSchemes) = self::$declaredRoutes[$name];

        return $this->doGenerate($variables, $defaults, $requirements, $tokens, $parameters, $name, $referenceType, $hostTokens, $requiredSchemes);
    }
}
