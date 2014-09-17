<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php bloginfo('name'); ?><?php wp_title('|',1,'left'); ?> </title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- Le styles -->
        <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri() ?>/css/bts2/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri() ?>/css/bts2/responsive.css">
        <link href="<?php bloginfo('stylesheet_url');?>" rel="stylesheet">

        <!--[if IE]>
            <link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri() ?>/css/ie_only_styles.css" />
        <![endif]-->

		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->

		<?php wp_head(); ?>
		<!-- RSS Feed -->
		<link rel="alternate" type="application/rss+xml" title="RSS 2.0 Feed" href="<?php bloginfo('rss2_url'); ?>" />
	</head>
	<body <?php body_class(); ?>>

        <div class="full-overlay"></div>

        <div class="container">
    		<header>
                
            	<div class="row-fluid">
            		<div id="cookiePanel" class="row-fluid header cookies" style="display:none">
            			<div class="span9">
            			<p>
            				This site uses cookies. In order to continually improve this site, we remember and store information about how you use it.
            				<a href="//www.embassyenglish.com/global/cookie-statement">Find out more</a>.
            			</p>
            			</div>
            			<div id="closecookies" class="span3">
            				<input class="btn btn-small" type="button" value="Accept and close" onclick="acceptCookies('allowCookies','true','365')">
            			</div>
            		</div>
            	</div>
        


              <div class="row-fluid">

                <!-- SEARCH -->
                <div class="siteSearch" id="searchbar">
                    <fieldset>
                        <form id="searchform" class="searchform" action="//www.embassyenglish.com/global/search-results" method="get" target="_blank">
                            <input id="embheader_0_SearchTextBox" class="searchInput" type="text" name="q" class="searchInput" placeholder="Search embasyenglish.com">
                            <input id="searchsubmit" class="searchButton" type="submit" value="Search">
                        </form>
                    </fieldset>
                   
                 </div>
                 <!-- END SEARCH -->
               </div><!-- /row-fluid-->  

            
            	<div class="row-fluid">
            		<div class="span2">
                    	<a href="<?php bloginfo('url'); ?>">
                    		<img class="logo" src="<?php echo get_stylesheet_directory_uri() ?>/images/logo.png" width="134" height="81" border="0">
                    	</a>
            		</div>
                    
            		<div class="span10">
            			<div class="row-fluid">
                            <div class="span8">
                                <h1><a href="http://www.embassyenglish.com" class="back-button">« Website</a> <?php bloginfo('description'); ?> </h1>
                            </div>
            				<div class="span4">
    							<a href="#" id="searchToggle" class="search_toggle"></a>
            				</div>              
                        </div>
            			<div class="row-fluid">
            				<div class="span12">
            					
                                <div class="navbar yamm">
                                    <div class="navbar-inner">
                                        <div class="container">
                                        
                                            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target="#nav2">
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                                <div class="menu_title">Menu</div>
                                            </button>
                                            
                                            <div class="nav-collapse collapse" id="nav2">
                                                <ul class="nav">
                                                    <?php
                                                        if ( has_nav_menu( 'header-menu' ) ) {

                                                            $defaults = array(
                                                                'theme_location'  => 'header-menu',
                                                                'menu'            => '',
                                                                'container'       => false,
                                                                'container_class' => '',
                                                                'container_id'    => '',
                                                                'menu_class'      => 'menu',
                                                                'menu_id'         => '',
                                                                'echo'            => true,
                                                                'fallback_cb'     => 'wp_page_menu',
                                                                'before'          => '',
                                                                'after'           => '',
                                                                'link_before'     => '',
                                                                'link_after'      => '',
                                                                'items_wrap'      => '%3$s',
                                                                'depth'           => 0,
                                                                'walker'          => ''
                                                            );

                                                            wp_nav_menu( $defaults );

                                                        } else {
                                                            echo '<div class="topmenu notice">Please setup "Header Menu" using Wordpress Dashboard > Appearance > Menus</div>';
                                                        }

                                                    ?>


                                                    <li class="button">
                                                        <ul>        
                                                            <?php

                                                            if ( has_nav_menu( 'cta-menu' ) ) {

                                                                $defaults = array(
                                                                    'theme_location'  => 'cta-menu',
                                                                    'menu'            => '',
                                                                    'container'       => false,
                                                                    'container_class' => '',
                                                                    'container_id'    => '',
                                                                    'menu_class'      => 'menu',
                                                                    'menu_id'         => '',
                                                                    'echo'            => true,
                                                                    'fallback_cb'     => 'wp_page_menu',
                                                                    'before'          => '',
                                                                    'after'           => '',
                                                                    'link_before'     => '',
                                                                    'link_after'      => '',
                                                                    'items_wrap'      => '%3$s',
                                                                    'depth'           => 0,
                                                                    'walker'          => ''
                                                                );

                                                                wp_nav_menu( $defaults );

                                                            } else {
                                                                echo '<div class="topmenu notice">Please setup "CTA Menu" using Wordpress Dashboard > Appearance > Menus</div>';
                                                            }

                                                            ?>                
                                                            <!--<li><a href="#">Contact us</a></li>  
                                                            <li><a href="#">Book now »</a></li>-->
                                                        </ul>
                                                    </li>
                                                    
                                                    

                                                </ul>
                                            </div><!--/.nav-collapse -->
                                            
                                        </div>
                                    </div>
                                </div>

                                
            				</div>
                      </div>
            		</div>
                    
                    
               </div>      
            
            
            
        

        
           
                
            </header> <!-- header ends -->
        </div><!--/.container -->


		<div class="container">
			