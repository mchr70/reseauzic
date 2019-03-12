<?php

use Symfony\Component\Routing\Matcher\Dumper\PhpMatcherTrait;
use Symfony\Component\Routing\RequestContext;

/**
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class srcApp_KernelDevDebugContainerUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    use PhpMatcherTrait;

    public function __construct(RequestContext $context)
    {
        $this->context = $context;
        $this->staticRoutes = [
            '/admin/members' => [[['_route' => 'admin_members', '_controller' => 'App\\Controller\\Admin\\AdminMemberController::showMembers'], null, null, null, false, false, null]],
            '/admin/threads' => [[['_route' => 'admin_threads', '_controller' => 'App\\Controller\\Admin\\AdminThreadsController::showThreads'], null, null, null, false, false, null]],
            '/admin' => [[['_route' => 'app_admin_homepage_index', '_controller' => 'App\\Controller\\Admin\\HomepageController::index'], null, null, null, true, false, null]],
            '/' => [[['_route' => 'app_homepage_index', '_controller' => 'App\\Controller\\HomepageController::index'], null, null, null, false, false, null]],
            '/search' => [[['_route' => 'member_search', '_controller' => 'App\\Controller\\HomepageController::searchMember'], null, null, null, false, false, null]],
            '/member' => [[['_route' => 'app_member_index', '_controller' => 'App\\Controller\\MemberController::index'], null, null, null, true, false, null]],
            '/member/photo' => [[['_route' => 'member_photo', '_controller' => 'App\\Controller\\MemberController::showUpload'], null, null, null, false, false, null]],
            '/member/threads' => [[['_route' => 'member_threads', '_controller' => 'App\\Controller\\MemberController::showThreads'], null, null, null, false, false, null]],
            '/register' => [[['_route' => 'app_registration_register', '_controller' => 'App\\Controller\\RegistrationController::registerAction'], null, null, null, false, false, null]],
            '/login' => [[['_route' => 'login', '_controller' => 'App\\Controller\\SecurityController::login'], null, null, null, false, false, null]],
            '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
            '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
            '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
            '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
            '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
            '/logout' => [[['_route' => 'logout'], null, null, null, false, false, null]],
        ];
        $this->regexpList = [
            0 => '{^(?'
                    .'|/admin(?'
                        .'|/(?'
                            .'|member/([^/]++)(*:35)'
                            .'|deletemember/([^/]++)(*:63)'
                            .'|thread/([^/]++)(*:85)'
                        .')'
                        .'|threaddelete/([^/]++)(*:114)'
                        .'|messagedelete/([^/]++)(*:144)'
                    .')'
                    .'|/profile/([^/]++)(*:170)'
                    .'|/member/thread(?'
                        .'|/([^/]++)(*:204)'
                        .'|editor/([^/]++)(*:227)'
                        .'|delete/([^/]++)(*:250)'
                    .')'
                    .'|/_(?'
                        .'|error/(\\d+)(?:\\.([^/]++))?(*:290)'
                        .'|wdt/([^/]++)(*:310)'
                        .'|profiler/([^/]++)(?'
                            .'|/(?'
                                .'|search/results(*:356)'
                                .'|router(*:370)'
                                .'|exception(?'
                                    .'|(*:390)'
                                    .'|\\.css(*:403)'
                                .')'
                            .')'
                            .'|(*:413)'
                        .')'
                    .')'
                .')/?$}sDu',
        ];
        $this->dynamicRoutes = [
            35 => [[['_route' => 'admin_member', '_controller' => 'App\\Controller\\Admin\\AdminMemberController::showMember'], ['id'], null, null, false, true, null]],
            63 => [[['_route' => 'admin_member_delete', '_controller' => 'App\\Controller\\Admin\\AdminMemberController::deleteMember'], ['id'], null, null, false, true, null]],
            85 => [[['_route' => 'admin_thread', '_controller' => 'App\\Controller\\Admin\\AdminThreadsController::showThread'], ['id'], null, null, false, true, null]],
            114 => [[['_route' => 'admin_thread_delete', '_controller' => 'App\\Controller\\Admin\\AdminThreadsController::deleteThread'], ['id'], null, null, false, true, null]],
            144 => [[['_route' => 'admin_message_delete', '_controller' => 'App\\Controller\\Admin\\AdminThreadsController::deleteMessage'], ['id'], null, null, false, true, null]],
            170 => [[['_route' => 'member_profile', '_controller' => 'App\\Controller\\HomepageController::showMemberProfile'], ['id'], null, null, false, true, null]],
            204 => [[['_route' => 'thread', '_controller' => 'App\\Controller\\MemberController::showThread'], ['id'], null, null, false, true, null]],
            227 => [[['_route' => 'thread_editor', '_controller' => 'App\\Controller\\MemberController::startThread'], ['recipientId'], null, null, false, true, null]],
            250 => [[['_route' => 'thread_delete', '_controller' => 'App\\Controller\\MemberController::deleteThread'], ['id'], null, null, false, true, null]],
            290 => [[['_route' => '_twig_error_test', '_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
            310 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
            356 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
            370 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
            390 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception::showAction'], ['token'], null, null, false, false, null]],
            403 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception::cssAction'], ['token'], null, null, false, false, null]],
            413 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        ];
    }
}
