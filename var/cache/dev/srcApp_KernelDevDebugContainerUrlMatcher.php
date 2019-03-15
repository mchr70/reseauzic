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
            '/admin/rating' => [[['_route' => 'admin_rating', '_controller' => 'App\\Controller\\Admin\\AdminRatingController::index'], null, null, null, false, false, null]],
            '/admin/threads' => [[['_route' => 'admin_threads', '_controller' => 'App\\Controller\\Admin\\AdminThreadsController::showThreads'], null, null, null, false, false, null]],
            '/admin' => [[['_route' => 'admin_home', '_controller' => 'App\\Controller\\Admin\\HomepageController::index'], null, null, null, true, false, null]],
            '/' => [[['_route' => 'home', '_controller' => 'App\\Controller\\HomepageController::index'], null, null, null, false, false, null]],
            '/search' => [[['_route' => 'member_search', '_controller' => 'App\\Controller\\HomepageController::searchMember'], null, null, null, false, false, null]],
            '/member' => [[['_route' => 'app_member_index', '_controller' => 'App\\Controller\\MemberController::index'], null, null, null, true, false, null]],
            '/member/photo' => [[['_route' => 'member_photo', '_controller' => 'App\\Controller\\MemberController::showUpload'], null, null, null, false, false, null]],
            '/member/threads' => [[['_route' => 'member_threads', '_controller' => 'App\\Controller\\MemberController::showThreads'], null, null, null, false, false, null]],
            '/register' => [[['_route' => 'app_registration_register', '_controller' => 'App\\Controller\\RegistrationController::registerAction'], null, null, null, false, false, null]],
            '/login' => [[['_route' => 'login', '_controller' => 'App\\Controller\\SecurityController::login'], null, null, null, false, false, null]],
            '/forgotten_password' => [[['_route' => 'forgotten_password', '_controller' => 'App\\Controller\\SecurityController::forgottenPassword'], null, null, null, false, false, null]],
            '/superadmin/members' => [[['_route' => 'superadmin_members', '_controller' => 'App\\Controller\\Superadmin\\SuperadminMemberController::showMembers'], null, null, null, false, false, null]],
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
                            .'|delete_rating([^/]++)(*:41)'
                            .'|thread/([^/]++)(*:63)'
                        .')'
                        .'|threaddelete/([^/]++)(*:92)'
                        .'|messagedelete/([^/]++)(*:121)'
                    .')'
                    .'|/profile/([^/]++)(*:147)'
                    .'|/member/thread(?'
                        .'|/([^/]++)(*:181)'
                        .'|editor/([^/]++)(*:204)'
                        .'|delete/([^/]++)(*:227)'
                    .')'
                    .'|/reset_password/([^/]++)(*:260)'
                    .'|/superadmin/(?'
                        .'|member/([^/]++)(*:298)'
                        .'|togglemember/([^/]++)(*:327)'
                        .'|set(?'
                            .'|admin/([^/]++)(*:355)'
                            .'|user/([^/]++)(*:376)'
                        .')'
                    .')'
                    .'|/_(?'
                        .'|error/(\\d+)(?:\\.([^/]++))?(*:417)'
                        .'|wdt/([^/]++)(*:437)'
                        .'|profiler/([^/]++)(?'
                            .'|/(?'
                                .'|search/results(*:483)'
                                .'|router(*:497)'
                                .'|exception(?'
                                    .'|(*:517)'
                                    .'|\\.css(*:530)'
                                .')'
                            .')'
                            .'|(*:540)'
                        .')'
                    .')'
                .')/?$}sDu',
        ];
        $this->dynamicRoutes = [
            41 => [[['_route' => 'admin_rating_delete', '_controller' => 'App\\Controller\\Admin\\AdminRatingController::deleteRating'], ['id'], null, null, false, true, null]],
            63 => [[['_route' => 'admin_thread', '_controller' => 'App\\Controller\\Admin\\AdminThreadsController::showThread'], ['id'], null, null, false, true, null]],
            92 => [[['_route' => 'admin_thread_delete', '_controller' => 'App\\Controller\\Admin\\AdminThreadsController::deleteThread'], ['id'], null, null, false, true, null]],
            121 => [[['_route' => 'admin_message_delete', '_controller' => 'App\\Controller\\Admin\\AdminThreadsController::deleteMessage'], ['id'], null, null, false, true, null]],
            147 => [[['_route' => 'member_profile', '_controller' => 'App\\Controller\\HomepageController::showMemberProfile'], ['id'], null, null, false, true, null]],
            181 => [[['_route' => 'thread', '_controller' => 'App\\Controller\\MemberController::showThread'], ['id'], null, null, false, true, null]],
            204 => [[['_route' => 'thread_editor', '_controller' => 'App\\Controller\\MemberController::startThread'], ['recipientId'], null, null, false, true, null]],
            227 => [[['_route' => 'thread_delete', '_controller' => 'App\\Controller\\MemberController::deleteThread'], ['id'], null, null, false, true, null]],
            260 => [[['_route' => 'reset_password', '_controller' => 'App\\Controller\\SecurityController::resetPassword'], ['token'], null, null, false, true, null]],
            298 => [[['_route' => 'superadmin_member', '_controller' => 'App\\Controller\\Superadmin\\SuperadminMemberController::showMember'], ['id'], null, null, false, true, null]],
            327 => [[['_route' => 'superadmin_member_toggle', '_controller' => 'App\\Controller\\Superadmin\\SuperadminMemberController::deleteMember'], ['id'], null, null, false, true, null]],
            355 => [[['_route' => 'superadmin_setadmin', '_controller' => 'App\\Controller\\Superadmin\\SuperadminMemberController::setAdmin'], ['id'], null, null, false, true, null]],
            376 => [[['_route' => 'superadmin_setuser', '_controller' => 'App\\Controller\\Superadmin\\SuperadminMemberController::setUser'], ['id'], null, null, false, true, null]],
            417 => [[['_route' => '_twig_error_test', '_controller' => 'twig.controller.preview_error::previewErrorPageAction', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
            437 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
            483 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
            497 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
            517 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception::showAction'], ['token'], null, null, false, false, null]],
            530 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception::cssAction'], ['token'], null, null, false, false, null]],
            540 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        ];
    }
}
