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
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $conf['lang'] ?>"
  lang="<?php echo $conf['lang'] ?>" dir="<?php echo $lang['direction'] ?>" class="no-js">
<head>
    <meta charset="UTF-8" />
    <title><?php tpl_pagetitle() ?> [<?php echo strip_tags($conf['title']) ?>]</title>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <script>(function(H){H.className=H.className.replace(/\bno-js\b/,'js')})(document.documentElement)</script>
    <?php tpl_metaheaders() ?>
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <?php echo tpl_favicon(array('favicon', 'mobile')) ?>
    <?php tpl_includeFile('meta.html') ?>
</head>

<body id="dokuwiki__top" class="sidebar-closed <?php echo tpl_classes(); ?>">
    <div id="writr__page" class="hfeed <?php echo ($showSidebar) ? 'hasSidebar' : ''; ?>">
        <?php tpl_includeFile('header.html') ?>

        <div class="sidebar-area group" id="writr__sidebar">
            <a id="writr__sidebar-toggle" href="#writr__secondary" title="<?php echo $lang['sidebar'] ?>">
                <span class="genericon genericon-close"></span>
                <span class="a11y"><?php echo $lang['sidebar'] ?></span>
            </a>

            <!-- ********** HEADER ********** -->
            <header id="writr__masthead" class="site-header" role="banner">
                <?php
                    $logoSize = array();
                    $logoImages = array();
                    if(tpl_getConf('doLogoChangesByNamespace')){
                        $logoImages[] = getNS($ID).':logo.png';
                    }
                    $logoImages[] = ':wiki:logo.png';
                    $logoImages[] = ':logo.png';
                    $logoImages[] = 'images/logo.png';
                    $logo = tpl_getMediaFile($logoImages, false, $logoSize);
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
                    <nav id="writr__site-navigation" class="main-navigation" role="navigation">
                        <h3 class="menu-toggle genericon genericon-menu" title="<?php echo tpl_getLang('menu') ?>">
                            <span class="a11y"><?php echo tpl_getLang('menu') ?></span>
                        </h3>
                        <div class="a11y skip-link">
                            <a href="#writr__content"><?php echo $lang['skip_to_content'] ?></a>
                        </div>
                        <?php tpl_include_page('topnav', 1, 1) ?>
                    </nav><!-- #writr__site-navigation -->
                <?php endif; ?>
            </header><!-- #writr__masthead -->

            <div id="writr__secondary" class="widget-area" role="complementary">
                <?php if ($conf['sidebar']): ?>
                    <div class="widget">
                        <?php tpl_includeFile('sidebarheader.html') ?>
                        <?php tpl_include_page($conf['sidebar'], 1, 1) ?>
                        <?php tpl_includeFile('sidebarfooter.html') ?>
                    </div>
                <?php endif ?>

                <div class="tools widget_links widget">
                    <?php if(!tpl_getConf('doSiteToolsRequireLogin') || (tpl_getConf('doSiteToolsRequireLogin') && $conf['useacl'])){ ?>
                        <!-- SITE TOOLS -->
                        <div class="site-tools">
                            <h3 <?php if(!tpl_getConf('showSiteToolsTitle')){ echo 'class="a11y"'; } ?>><?php echo $lang['site_tools'] ?></h3>
                            <ul>
                                <?php $items = (new \dokuwiki\Menu\SiteMenu())->getItems();
                                foreach($items as $item) {
                                    echo '<li>'
                                        .'<a href="'.$item->getLink().'" class="action '.strtolower($item->getType()).'" rel="nofollow" title="'.$item->getTitle().'">'
                                        .'<span></span> '
                                        .$item->getLabel()
                                        .'</a></li>';
                                } ?>
                            </ul>
                        </div>
                    <?php } ?>

                    <!-- PAGE TOOLS -->
                    <div class="page-tools">
                        <h3 <?php if(!tpl_getConf('showPageToolsTitle')){ echo 'class="a11y"'; } ?>><?php echo $lang['page_tools'] ?></h3>
                        <ul>
                            <?php if (!$conf['useacl'] || ($conf['useacl'] && $INFO['perm'] >= 4)): ?>
                                <?php
                                $instructions = '{{NEWPAGE';
                                if(tpl_getConf('defaultAddNewPage') !== ''){
                                    $instructions .= '>';
                                    $instructions .= tpl_getConf('defaultAddNewPage');
                                }
                                $instructions .= '}}';
                                $instructions = p_get_instructions($instructions);
                                if(count($instructions) <= 3) {
                                    $render = p_render('xhtml',$instructions,$info);
                                    echo '<li>'
                                        .'<a href="#" class="action AddNewPage" title="'.tpl_getLang('AddNewPage').'">'
                                        .'<span class="icon"></span>'
                                        .'<span class="a11y">'.tpl_getLang('AddNewPage').'</span>'
                                        .'</a>'
                                        .$render
                                        .'</li>';
                                }
                                ?>
                            <?php endif ?>
                            <?php $translation = plugin_load('helper','translation');
                            if ($translation){
                                $render = $translation->showTranslations(false);
                                echo '<li>'
                                    .'<a href="#" class="action Translation" title="'.tpl_getLang('Language').'">'
                                    .'<span class="icon"></span>'
                                    .'<span class="a11y">'.tpl_getLang('Language').'</span>'
                                    .'</a>'
                                    .$render
                                    .'</li>';
                            } ?>
                            <?php $items = (new \dokuwiki\Menu\PageMenu())->getItems();
                            foreach($items as $item) {
                                $attributes = $item->getLinkAttributes();
                                $html = '<li><a';
                                foreach($attributes as $key => $value) {
                                    $html .= ' '.$key.'="'.$value.'"';
                                }
                                $html .= '><span class="icon"></span>'
                                    .'<span class="a11y">'.$item->getLabel().'</span>'
                                    .'</a></li>';
                                echo $html;
                            } ?>
                        </ul>
                    </div>

                    <?php if ($conf['useacl']): ?>
                        <!-- USER TOOLS -->
                        <div class="user-tools">
                            <h3 <?php if(!tpl_getConf('showUserToolsTitle')){ echo 'class="a11y"'; } ?>><?php echo $lang['user_tools'] ?></h3>
                            <ul>
                                <?php $items = (new \dokuwiki\Menu\UserMenu())->getItems();
                                foreach($items as $item) {
                                    echo '<li>'
                                        .'<a href="'.$item->getLink().'" class="action '.strtolower($item->getType()).'" rel="nofollow" title="'.$item->getTitle().'">'
                                        .'<span></span> '
                                        .$item->getLabel()
                                        .'</a></li>';
                                } ?>
                            </ul>
                            <?php
                                if (!empty($_SERVER['REMOTE_USER'])) {
                                    echo '<p class="user">';
                                    tpl_userinfo();
                                    echo '</p>';
                                }
                            ?>
                        </div>
                    <?php endif ?>
                </div>

                <footer id="writr__colophon" class="site-footer" role="contentinfo">
                    <div class="site-info">
                        <?php tpl_license('button') ?>
                        <?php tpl_includeFile('footer.html') ?>
                    </div><!-- .site-info -->
                </footer><!-- #writr__colophon -->

            </div>
        </div>

        <div id="writr__content" class="site-content">
            <div id="writr__primary" class="content-area">

                <div class="writr-message-area">
                    <!-- Translation Notication -->
                    <?php if($translation) { $translation->checkage(); } ?>
                    <!-- Message Area -->
                    <?php html_msgarea() ?>
                </div>

                <!-- BREADCRUMBS -->
                <?php if($conf['breadcrumbs']){ ?>
                    <div class="breadcrumbs"><?php tpl_breadcrumbs() ?></div>
                <?php } ?>
                <?php if($conf['youarehere']){ ?>
                    <div class="breadcrumbs"><?php tpl_youarehere() ?></div>
                <?php } ?>

                <main id="writr__main" class="site-main group" role="main">

                    <?php tpl_flush() ?>
                    <?php tpl_includeFile('pageheader.html') ?>

                    <!-- wikipage start -->
                    <?php tpl_content() ?>
                    <!-- wikipage stop -->

                    <?php tpl_flush() ?>
                    <?php tpl_includeFile('pagefooter.html') ?>
                </main><!-- #writr__main -->

		<div class="page-footer">
			<?php tpl_pageinfo(); ?>
		</div>
            </div><!-- #writr__primary -->
        </div><!-- #writr__content -->
    </div><!-- #writr__page -->

    <div class="no"><?php tpl_indexerWebBug() /* provide DokuWiki housekeeping, required in all templates */ ?></div>
</body>
</html>
