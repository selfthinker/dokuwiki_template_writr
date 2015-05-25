<?php
/**
 * DokuWiki Writr Template
 *
 * @link     http://dokuwiki.org/template:writr
 * @author   Anika Henke <anika@selfthinker.org>
 * @license  GPL 2 (http://www.gnu.org/licenses/gpl.html)
 */

if (!defined('DOKU_INC')) die();
@require_once(dirname(__FILE__).'/tpl_functions.php');
header('X-UA-Compatible: IE=edge,chrome=1');
$showSidebar = page_findnearest($conf['sidebar']);
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $conf['lang'] ?>"
  lang="<?php echo $conf['lang'] ?>" dir="<?php echo $lang['direction'] ?>" class="no-js">
<head>
    <meta charset="UTF-8" />
    <title><?php tpl_pagetitle() ?> [<?php echo strip_tags($conf['title']) ?>]</title>
    <script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
    <?php tpl_metaheaders() ?>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <?php echo tpl_favicon(array('favicon', 'mobile')) ?>
    <?php tpl_includeFile('meta.html') ?>
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css' />
</head>

<body id="dokuwiki__top" class="sidebar-closed <?php echo tpl_classes(); ?>">
    <div id="page" class="hfeed <?php echo ($showSidebar) ? 'hasSidebar' : ''; ?>">
        <?php tpl_includeFile('header.html') ?>

        <div class="sidebar-area group" id="sidebar">
            <a id="sidebar-toggle" href="#secondary" title="<?php echo $lang['sidebar'] ?>">
                <span class="genericon genericon-close"></span>
                <span class="screen-reader-text"><?php echo $lang['sidebar'] ?></span>
            </a>

            <!-- ********** HEADER ********** -->
            <header id="masthead" class="site-header" role="banner">
                <?php
                    $logoSize = array();
                    $logo = tpl_getMediaFile(array(':wiki:logo.png', ':logo.png', 'images/logo.png'), false, $logoSize);
                ?>

                <a class="site-logo"  href="<?php echo wl(); ?>" title="<?php echo $conf['title']; ?>" rel="home" accesskey="h" title="[H]">
                    <img src="<?php echo $logo; ?>" <?php echo $logoSize[3]; ?> alt="" class="no-grav header-image" />
                </a>

                <div class="site-branding">
                    <h1 class="site-title"><a href="<?php echo wl(); ?>" rel="home" accesskey="h" title="[H]"><?php echo $conf['title']; ?></a></h1>
                    <?php if ($conf['tagline']): ?>
                        <h2 class="site-description"><?php echo $conf['tagline'] ?></h2>
                    <?php endif ?>
                </div>

                <div class="search-form widget">
                    <?php tpl_searchform() ?>
                </div>

                <?php if (page_findnearest('topnav')): ?>
                    <nav id="site-navigation" class="main-navigation" role="navigation">
                        <h1 class="menu-toggle genericon genericon-menu">
                            <span class="screen-reader-text"><?php /* TODO: _e( 'Menu', 'writr' );*/ ?>Menu</span>
                        </h1>
                        <div class="screen-reader-text skip-link">
                            <a href="#content"><?php echo $lang['skip_to_content'] ?></a>
                        </div>
                        <?php tpl_include_page('topnav', 1, 1) ?>
                    </nav><!-- #site-navigation -->
                <?php endif; ?>
            </header><!-- #masthead -->

            <div id="secondary" class="widget-area" role="complementary">
                <div class="widget">
                    <?php tpl_includeFile('sidebarheader.html') ?>
                    <?php tpl_include_page($conf['sidebar'], 1, 1) ?>
                    <?php tpl_includeFile('sidebarfooter.html') ?>
                </div>

                <div class="tools widget_links widget">
                    <!-- SITE TOOLS -->
                    <div class="site-tools">
                        <h3><?php echo $lang['site_tools'] ?></h3>
                        <ul>
                            <?php _tpl_toolsevent('sitetools', array(
                                'recent'    => tpl_action('recent', 1, 'li', 1),
                                'media'     => tpl_action('media', 1, 'li', 1),
                                'index'     => tpl_action('index', 1, 'li', 1),
                            )); ?>
                        </ul>
                    </div>

                    <!-- PAGE TOOLS -->
                    <div class="page-tools">
                        <h3 class="a11y"><?php echo $lang['page_tools'] ?></h3>
                        <ul>
                            <?php _tpl_toolsevent('pagetools', array(
                                'edit'      => tpl_action('edit', 1, 'li', 1, '<span></span> <span class="a11y">', '</span>'),
                                'revisions' => tpl_action('revisions', 1, 'li', 1, '<span></span> <span class="a11y">', '</span>'),
                                'backlink'  => tpl_action('backlink', 1, 'li', 1, '<span></span> <span class="a11y">', '</span>'),
                                'subscribe' => tpl_action('subscribe', 1, 'li', 1, '<span></span> <span class="a11y">', '</span>'),
                                'revert'    => tpl_action('revert', 1, 'li', 1, '<span></span> <span class="a11y">', '</span>'),
                                'top'       => tpl_action('top', 1, 'li', 1, '<span></span> <span class="a11y">', '</span>'),
                            )); ?>
                        </ul>
                    </div>

                    <?php if ($conf['useacl']): ?>
                        <!-- USER TOOLS -->
                        <div class="user-tools">
                            <h3><?php echo $lang['user_tools'] ?></h3>
                            <ul>
                                <?php _tpl_toolsevent('usertools', array(
                                    'admin'     => tpl_action('admin', 1, 'li', 1),
                                    'profile'   => tpl_action('profile', 1, 'li', 1),
                                    'register'  => tpl_action('register', 1, 'li', 1),
                                    'login'     => tpl_action('login', 1, 'li', 1),
                                )); ?>
                            </ul>
                        </div>

                        <?php
                            if (!empty($_SERVER['REMOTE_USER'])) {
                                echo '<p class="user">';
                                tpl_userinfo();
                                echo '</p>';
                            }
                        ?>
                    <?php endif ?>
                </div>

                <footer id="colophon" class="site-footer" role="contentinfo">
                    <div class="site-info">
                        <p><?php tpl_pageinfo() ?></p>
                        <?php tpl_license('button') ?>
                        <?php tpl_includeFile('footer.html') ?>
                    </div><!-- .site-info -->
                </footer><!-- #colophon -->

            </div>
        </div>

        <div id="content" class="site-content">
            <div id="primary" class="content-area">
                <main id="main" class="site-main" role="main">

                    <!-- BREADCRUMBS -->
                    <?php if($conf['breadcrumbs']){ ?>
                        <div class="breadcrumbs"><?php tpl_breadcrumbs() ?></div>
                    <?php } ?>
                    <?php if($conf['youarehere']){ ?>
                        <div class="breadcrumbs"><?php tpl_youarehere() ?></div>
                    <?php } ?>

                    <?php tpl_flush() ?>
                    <?php tpl_includeFile('pageheader.html') ?>

                    <?php html_msgarea() ?>
                    <!-- wikipage start -->
                    <?php tpl_content() ?>
                    <!-- wikipage stop -->

                    <?php tpl_flush() ?>
                    <?php tpl_includeFile('pagefooter.html') ?>
                </main><!-- #main -->
            </div><!-- #primary -->
        </div><!-- #content -->

    </div><!-- #page -->

    <div class="no"><?php tpl_indexerWebBug() /* provide DokuWiki housekeeping, required in all templates */ ?></div>
</body>
</html>
