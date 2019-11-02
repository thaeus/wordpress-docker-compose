<?php
defined('ABSPATH') OR exit;

$email = get_option( 'admin_email' );
$arrHost = parse_url(home_url('', $scheme = 'http'));
$host = $arrHost['host'];

$endpoint = "https://www.trustedsite.com";
?>

<div class="wrap" id="mcafeesecure-container">

    <div id="mcafeesecure-data" data-host="<?php echo $host; ?>" data-email="<?php echo $email; ?>"></div>

    <div id="mcafeesecure-activation">
        <h1>McAfee SECURE</h1>
        <br/>
        <div id="signup-header">Your Account</div>
        <div id="signup-text">To activate the app, please create your TrustedSite account. </div>

        <form>
            <span id="email">Email
            <input id="email-input" class="mfs-input" type="text" name="email" value="<?php echo get_option('admin_email')?>"></span><br>
            <span id="domain">Domain
            <input id="domain-input" class="mfs-input" type="text" name="domain" value="<?php echo get_option('siteurl')?>"></span><br><br>
            <input type="button" value="Create Account" id="activate-now">
        </form>
    </div>

    <div id="mcafeesecure-dashboard">
        <h1>McAfee SECURE</h1>
        <div class="wrapper">
            <div id="content">

              <div class="row-wrapper">
                  <div class="row" id="summary">
                      <div class="mfs-title">
                          <span class="status-icon"></span>
                          Summary
                      </div>
                  </div>
              </div>

                <div class="row-wrapper">
                    <div class="row" id="security">
                        <div class="mfs-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>
                        <div class="link">View Details</div>

                        <div class="mfs-row">
                            <span class="status-icon"></span>
                            Security
                        </div>
                    </div>
                </div>

                <div class="row-wrapper">
                    <div class="row" id="floating-trustmark">
                        <div class="mfs-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>
                        <div class="link">View Details</div>

                        <div class="mfs-row">
                            <span class="status-icon"></span>
                            Floating trustmark
                        </div>
                    </div>
                </div>

                <div class="row-wrapper">
                    <div class="row" id="directory-listing">
                        <div class="mfs-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>
                        <div class="link">View Details</div>

                        <div class="mfs-row">
                            <span class="status-icon"></span>
                            Directory listing
                        </div>
                    </div>
                </div>

                <div class="row-wrapper">
                    <div class="row" id="search-highlighting">
                        <div class="mfs-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>
                        <div class="link">View Details</div>

                        <div class="mfs-row">
                            <span class="status-icon"></span>
                            Search highlighting
                        </div>
                    </div>
                </div>

                <div class="row-wrapper">
                    <div class="row" id="engagement-trustmark">
                        <div class="mfs-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>
                        <div class="link">View Details</div>

                        <div class="mfs-row">
                            <span class="status-icon"></span>
                            Engagement trustmark
                        </div>
                    </div>
                </div>

                <div class="row-wrapper">
                    <div class="row" id="sip">
                        <div class="mfs-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>
                        <div class="link">View Details</div>

                        <div class="mfs-row">
                            <span class="status-icon"></span>
                            Shopper Identity Protection
                        </div>
                    </div>
                </div>

                <div class="row-wrapper">
                    <div class="row" id="search-submission">
                        <div class="mfs-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>
                        <div class="link">View Details</div>

                        <div class="mfs-row">
                            <span class="status-icon"></span>
                            Sitemap + Search Submission
                        </div>
                    </div>
                </div>

                <div class="row-wrapper">
                    <div class="row" id="diagnostics">
                        <div class="mfs-arrow">
                            <i class="fa fa-angle-right"></i>
                        </div>
                        <div class="link">View Details</div>

                        <div class="mfs-row">
                            <span class="status-icon"></span>
                            Diagnostics
                        </div>
                    </div>
                </div>
                    
            </div>

            <div id="mcafeesecure-sideframe">
                <div id="mcafeesecure-upgrade">

                    <div id="mcafeesecure-pro">
                        <img id="mfs-logo" src="<?php echo plugins_url('../images/mcafee-secure-trustmark.svg',__FILE__)?>" >
                        <div>
                          <strong>Upgrade to Pro for</strong><br>
                            Unlimited visits</br>            
                            Inline engagement trustmark</br>
                            Shopper Identity Protection<br>
                            <em>and more...</em>
                            <br><br>
                        </div>
                        <form action="<?php echo $endpoint ?>/user/site/<?php echo $host ?>/upgrade" method="get" target="_blank">
                        <button class="upgrade-button" type="submit">Upgrade</button>
                    </div>

                    <div id="trustedsite-pro">
                        <div>
                        <img id="ts-logo" src="<?php echo plugins_url('../images/ts-engagement.svg',__FILE__)?>" ><br><br>
                          <strong>Upgrade to Pro for</strong><br>
                            Unlimited visits</br>            
                            Inline engagement trustmark</br>
                            Shopper Identity Protection<br>
                            <em>and more...</em>
                            <br><br>
                        </div>
                        <form action="<?php echo $endpoint ?>/user/site/<?php echo $host ?>/upgrade" method="get" target="_blank">
                        <button class="ts-upgrade-button" type="submit">Upgrade</button>
                    </div>
                    
                    <div id="mcafeesecure-engage">
                        <strong>Add the engagement trustmark</strong><br><br>
                        <img id="mfs-engage-mark" src="<?php echo plugins_url('../images/engagement.svg',__FILE__)?>" ><br><br>
                        <div class="engage-text">
                            For posts or pages, add the shortcode:<br>
                            <div class="mfs-copybox">
                                <pre>[mcafeesecure width=90]</pre>
                            </div> <br>
                            For template files, add this HTML:<br>
                            <div class="mfs-copybox">
                                <pre><?php
                                $code = "<div class='mfes-trustmark' data-type='102' data-width='90' data-ext='svg'></div>";
                                echo htmlspecialchars($code);
                                ?></pre>
                            </div> <br>
                            <a id="engage-learn-more" target="_blank" href="https://support.mcafeesecure.com/hc/en-us/articles/206073486-Adding-the-Engagement-Trustmark-to-a-Wordpress-Site">Learn more</a>
                        </div>
                    </div>

                    <div id="ts-engage">
                        <strong>Add the engagement trustmark</strong><br><br>
                        <img id="mfs-engage-mark" src="<?php echo plugins_url('../images/ts-engagement.svg',__FILE__)?>" ><br><br>
                        <div class="engage-text">
                            For posts or pages, add the shortcode:<br>
                            <div class="mfs-copybox">
                                <pre>[trustedsite width=90]</pre>
                            </div> <br>
                            For template files, add this HTML:<br>
                            <div class="mfs-copybox">
                                <pre><?php
                                $code = "<div class='trustedsite-trustmark' data-type='202' data-width='90' data-ext='svg'></div>";
                                echo htmlspecialchars($code);
                                ?></pre>
                            </div> <br>
                            <a id="engage-learn-more" target="_blank" href="https://support.mcafeesecure.com/hc/en-us/articles/206073486-Adding-the-Engagement-Trustmark-to-a-Wordpress-Site">Learn more</a>
                        </div>
                    </div>

                </div>

                <div class="ts-logo" id="ts-logo-sideframe">
                    <a href="https://www.mcafeesecure.com/trustedsite" target="_blank">
                         <img src="<?php echo plugins_url('../images/operated-by-trustedsite-colored-vertical-center.svg',__FILE__)?>" > 
                     </a>
                </div>      
            </div>
        </div>

        <div class="ts-logo" id="ts-logo-noframe">
            <a href="https://www.trustedsite.com" target="_blank">
                 <img src="<?php echo plugins_url('../images/operated-by-trustedsite-colored-vertical-center.svg',__FILE__)?>" > 
             </a>
        </div>
    </div>     
</div>
