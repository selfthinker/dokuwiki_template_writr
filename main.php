<?php
/**
 * DokuWiki Starter Template
 *
 * @link     http://dokuwiki.org/template:starter
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
</head>

<body id="dokuwiki__top">
    <div id="dokuwiki__site" class="<?php echo tpl_classes(); ?> <?php echo ($showSidebar) ? 'hasSidebar' : ''; ?>">
        <?php html_msgarea() ?>
        <?php tpl_includeFile('header.html') ?>

        <!-- ********** HEADER ********** -->
        <div id="dokuwiki__header"><div class="group">

            <h1><?php tpl_link(wl(),$conf['title'],'accesskey="h" title="[H]"') ?></h1>
            <?php if ($conf['tagline']): ?>
                <p class="claim"><?php echo $conf['tagline'] ?></p>
            <?php endif ?>

            <p class="a11y skip">
                <a href="#dokuwiki__content"><?php echo $lang['skip_to_content'] ?></a>
            </p>

            <!-- BREADCRUMBS -->
            <?php if($conf['breadcrumbs']){ ?>
                <div class="breadcrumbs"><?php tpl_breadcrumbs() ?></div>
            <?php } ?>
            <?php if($conf['youarehere']){ ?>
                <div class="breadcrumbs"><?php tpl_youarehere() ?></div>
            <?php } ?>

            <hr />
        </div></div><!-- /header -->


        <div class="wrapper group">

            <!-- ********** ASIDE ********** -->
            <?php if ($showSidebar): ?>
                <div id="dokuwiki__aside"><div class="aside include group">
                    <?php tpl_includeFile('sidebarheader.html') ?>
                    <?php tpl_include_page($conf['sidebar'], 1, 1) ?>
                    <?php tpl_includeFile('sidebarfooter.html') ?>
                    <hr class="a11y" />
                </div></div><!-- /aside -->
            <?php endif; ?>

            <!-- ********** CONTENT ********** -->
            <div id="dokuwiki__content"><div class="group">
                <?php tpl_flush() ?>
                <?php tpl_includeFile('pageheader.html') ?>

                <div class="page group">
                    <!-- wikipage start -->
                    <?php tpl_content() ?>
                    <!-- wikipage stop -->
                </div>

                <?php tpl_flush() ?>
                <?php tpl_includeFile('pagefooter.html') ?>
            </div></div><!-- /content -->

        </div><!-- /wrapper -->

        <!-- ********** FOOTER ********** -->
        <div id="dokuwiki__footer">

                <hr />
                <div class="doc"><?php tpl_pageinfo() ?></div>
            <div class="tools">
                <!-- SITE TOOLS -->
                <div id="dokuwiki__sitetools">
                    <h3><?php echo $lang['site_tools'] ?></h3>
                    <?php tpl_searchform() ?>
                    <ul>
                        <?php _tpl_toolsevent('sitetools', array(
                            'recent'    => tpl_action('recent', 1, 'li', 1),
                            'media'     => tpl_action('media', 1, 'li', 1),
                            'index'     => tpl_action('index', 1, 'li', 1),
                        )); ?>
                    </ul>
                </div>

                <!-- PAGE TOOLS -->
                <div id="dokuwiki__pagetools">
                    <h3><?php echo $lang['page_tools'] ?></h3>
                    <ul>
                        <?php _tpl_toolsevent('pagetools', array(
                            'edit'      => tpl_action('edit', 1, 'li', 1),
                            'revisions' => tpl_action('revisions', 1, 'li', 1),
                            'backlink'  => tpl_action('backlink', 1, 'li', 1),
                            'subscribe' => tpl_action('subscribe', 1, 'li', 1),
                            'revert'    => tpl_action('revert', 1, 'li', 1),
                            'top'       => tpl_action('top', 1, 'li', 1),
                        )); ?>
                    </ul>
                </div>

                <!-- USER TOOLS -->
                <?php if ($conf['useacl']): ?>
                    <div id="dokuwiki__usertools">
                        <h3><?php echo $lang['user_tools'] ?></h3>
                        <ul>
                            <?php
                                if (!empty($_SERVER['REMOTE_USER'])) {
                                    echo '<li class="user">';
                                    tpl_userinfo();
                                    echo '</li>';
                                }
                            ?>
                            <?php _tpl_toolsevent('usertools', array(
                                'admin'     => tpl_action('admin', 1, 'li', 1),
                                'profile'   => tpl_action('profile', 1, 'li', 1),
                                'register'  => tpl_action('register', 1, 'li', 1),
                                'login'     => tpl_action('login', 1, 'li', 1),
                            )); ?>
                        </ul>
                    </div>
                <?php endif ?>
            </div>

            <?php tpl_license('button') ?>
        </div><!-- /footer -->

        <?php tpl_includeFile('footer.html') ?>
    </div><!-- /site -->

    <div class="no"><?php tpl_indexerWebBug() /* provide DokuWiki housekeeping, required in all templates */ ?></div>
</body>
</html>
