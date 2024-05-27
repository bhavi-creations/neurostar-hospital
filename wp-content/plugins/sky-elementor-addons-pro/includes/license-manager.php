<?php

namespace Sky_Addons_Pro;

use Sky_Addons_Pro\Base\Sky_Addons_Pro_Base;

class License_Manager {
    public $plugin_file = SKY_ADDONS_PRO__FILE__;
    public $responseObj;
    public $licenseMessage;
    public $showMessage = false;
    public $slug = "sky-elementor-addons-license";
    function __construct() {

        $licenseKey = get_option("sky_addons_pro_license_key", "");
        $liceEmail = get_option("sky_addons_pro_license_email", "");
        Sky_Addons_Pro_Base::addOnDelete(function () {
            delete_option("sky_addons_pro_license_key");
        });
        if (Sky_Addons_Pro_Base::CheckWPPlugin($licenseKey, $liceEmail, $this->licenseMessage, $this->responseObj, SKY_ADDONS_PRO__FILE__)) {
            add_action('admin_post_sky_addons_pro_deactivate_license', [$this, 'action_deactivate_license']);
            add_filter('sky_license_page', [$this, 'Activated'], 10);
        } else {
            if (!empty($licenseKey) && !empty($this->licenseMessage)) {
                $this->showMessage = true;
            }
            update_option("sky_addons_pro_license_key", "") || add_option("sky_addons_pro_license_key", "");
            add_action('admin_post_sky_addons_pro_activate_license', [$this, 'action_activate_license']);

            add_filter('sky_license_page', [$this, 'LicenseForm'], 10);
            add_action('admin_notices', [$this, 'license_not_activate_notice'], 20);
        }
    }

    public function license_not_activate_notice() {
        $class = 'notice notice-error';
        $message = wp_kses_post(__('<strong>License Error! Sky Addons Pro for Elementor not activated.</strong> Please activate it to enable premium features. Otherwise, it\'s will not work properly. <a href="' . admin_url('admin.php?page=sky-elementor-addons-license') . '">Activate now.</a> If you don\'t have a license, please purchase it <a target="_blank" href="https://skyaddons.com/">from here.</a>', 'sky-elementor-addons-pro'));

        printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), $message);
    }

    public function action_activate_license() {
        check_admin_referer('sa-el-license');
        $licenseKey = !empty($_POST['sky_license_key']) ? $_POST['sky_license_key'] : "";
        $licenseEmail = !empty($_POST['sky_license_email']) ? $_POST['sky_license_email'] : "";
        update_option("sky_addons_pro_license_key", $licenseKey) || add_option("sky_addons_pro_license_key", $licenseKey);
        update_option("sky_addons_pro_license_email", $licenseEmail) || add_option("sky_addons_pro_license_email", $licenseEmail);
        update_option('_site_transient_update_plugins', '');
        wp_safe_redirect(admin_url('admin.php?page=' . $this->slug));
    }
    public function action_deactivate_license() {
        check_admin_referer('sa-el-license');
        $message = "";
        if (Sky_Addons_Pro_Base::RemoveLicenseKey(SKY_ADDONS_PRO__FILE__, $message)) {
            update_option("sky_addons_pro_license_key", "") || add_option("sky_addons_pro_license_key", "");
            update_option('_site_transient_update_plugins', '');
        }
        wp_safe_redirect(admin_url('admin.php?page=' . $this->slug));
    }

    public function check_days_in_expiry($date2) {
        $date1 = Date('Y-m-d');

        $date1_ts = strtotime($date1);
        $date2_ts = strtotime($date2);
        $diff = $date2_ts - $date1_ts;
        return sprintf("%02d", round($diff / 86400, 2)) . ' ' . esc_html__('Days remaining', 'sky-elementor-addons-pro');
    }
    public function Activated() {
        $date_licensor = preg_replace('/\s+/', '_', strtolower($this->responseObj->expire_date));

        if ($date_licensor == 'no_expiry' || $date_licensor == '00:00:00') {
            $expiry_days =  esc_html__('Lifetime', 'sky-elementor-addons-pro');
        } else {
            $expiry_days = $this->check_days_in_expiry($this->responseObj->expire_date);
            if ($expiry_days <= 30) {
                $this->sky_addons_pro_license_expire_soon($expiry_days);
            }
        }

?>
        <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
            <input type="hidden" name="action" value="sky_addons_pro_deactivate_license" />
            <div class="sa-el-license-container">
                <h3 class="sa-el-license-title sa-d-flex sa-align-items-center">
                    <img class="sky-license-page-logo sa-me-3" src="<?php echo esc_url(SKY_ADDONS_ASSETS_URL . 'images/sky-logo-gradient-icon-256x256.png'); ?>" alt="Sky Addons Logo"><?php esc_html_e("Sky Addons Pro License Info", 'sky-elementor-addons-pro'); ?>
                </h3>
                <hr>
                <ul class="sa-el-license-info">
                    <li>
                        <div>
                            <span class="sa-el-license-info-title"><?php esc_html_e("Status", 'sky-elementor-addons-pro'); ?></span>

                            <?php if ($this->responseObj->is_valid) : ?>
                                <span class="sa-el-license-valid"><?php esc_html_e("Valid", 'sky-elementor-addons-pro'); ?></span>
                            <?php else : ?>
                                <span class="sa-el-license-valid"><?php esc_html_e("Invalid", 'sky-elementor-addons-pro'); ?></span>
                            <?php endif; ?>
                        </div>
                    </li>

                    <li>
                        <div>
                            <span class="sa-el-license-info-title"><?php esc_html_e("License Type", 'sky-elementor-addons-pro'); ?></span>
                            <?php echo $this->responseObj->license_title; ?>
                        </div>
                    </li>

                    <li>
                        <div>
                            <span class="sa-el-license-info-title"><?php esc_html_e("License Expired on", 'sky-elementor-addons-pro'); ?></span>
                            <span class="sa-d-inline-block">
                                <span class="sa-mr-2">
                                    <?php
                                    if ('Unlimited' == $this->responseObj->support_end) {
                                        echo $this->responseObj->support_end;
                                    } else {
                                        echo date('d M, Y', strtotime($this->responseObj->expire_date));
                                    }
                                    if (!empty($this->responseObj->expire_renew_link)) {
                                    ?>
                                        <a target="_blank" class="sa-el-blue-btn" href="<?php echo $this->responseObj->expire_renew_link; ?>">Renew</a>
                                    <?php
                                    }
                                    ?>
                                </span>
                                <span class="sa-fw-bolder sa-text-danger">
                                    ( <?php
                                        if ($expiry_days) {
                                            echo esc_html($expiry_days);
                                        }
                                        ?> )
                                </span>
                            </span>

                        </div>
                    </li>

                    <li>
                        <div>
                            <span class="sa-el-license-info-title"><?php esc_html_e("Support Expired on", 'sky-elementor-addons-pro'); ?></span>
                            <?php
                            if ('Unlimited' == $this->responseObj->support_end) {
                                echo $this->responseObj->support_end;
                            } else {
                                echo date('d M, Y', strtotime($this->responseObj->support_end));
                            }
                            if (!empty($this->responseObj->support_renew_link)) {
                            ?>
                                <a target="_blank" class="sa-el-blue-btn" href="<?php echo $this->responseObj->support_renew_link; ?>">Renew</a>
                            <?php
                            }
                            ?>
                        </div>
                    </li>
                    <li>
                        <div>
                            <span class="sa-el-license-info-title"><?php esc_html_e("Your License Key", 'sky-elementor-addons-pro'); ?></span>
                            <span class="sa-el-license-key"><?php echo esc_attr(substr($this->responseObj->license_key, 0, 9) . "XXXXXXXX-XXXXXXXX" . substr($this->responseObj->license_key, -9)); ?></span>
                        </div>
                    </li>
                </ul>
                <div class="sa-el-license-active-btn">
                    <?php wp_nonce_field('sa-el-license'); ?>
                    <?php submit_button('Deactivate'); ?>
                </div>
            </div>
        </form>
    <?php
    }

    public function LicenseForm() {
    ?>
        <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
            <input type="hidden" name="action" value="sky_addons_pro_activate_license" />
            <div class="sa-el-license-container">
                <h3 class="sa-el-license-title sa-d-flex sa-align-items-center">
                    <img class="sky-license-page-logo sa-me-3" src="<?php echo esc_url(SKY_ADDONS_ASSETS_URL . 'images/sky-logo-gradient-icon-256x256.png'); ?>" alt="Sky Addons Logo"><?php esc_html_e("Sky Addons Pro Licensing", 'sky-elementor-addons-pro'); ?>
                </h3>
                <hr>
                <?php
                if (!empty($this->showMessage) && !empty($this->licenseMessage)) {
                ?>
                    <div class="notice notice-error is-dismissible">
                        <p><?php echo esc_html_e($this->licenseMessage, 'sky-elementor-addons-pro'); ?></p>
                    </div>
                <?php
                }
                ?>
                <p><?php esc_html_e("Enter your license key here, to activate the product, and get full feature updates and premium support.", 'sky-elementor-addons-pro'); ?></p>
                <ol>
                    <li><?php esc_html_e("License Key is very important for you. Otherwise, you will not able to use premium features.", 'sky-elementor-addons-pro');
                        ?></li>
                    <li><?php esc_html_e("Please collect your license key from FastSpring / Codecanyon account.", 'sky-elementor-addons-pro');
                        ?></li>
                    <li><?php esc_html_e("Envato Purchase code would be the License key for Envato users.", 'sky-elementor-addons-pro');
                        ?></li>
                    <li><?php echo wp_kses_post(__("If you don't have license key, please collect it from here - <a target='_blank' href='https://skyaddons.com/'>https://skyaddons.com/</a>", 'sky-elementor-addons-pro'));
                        ?></li>
                    <li><?php echo wp_kses_post(__("FastSpring users account link - <a target='_blank' href='https://techfyd.onfastspring.com/account/'>https://techfyd.onfastspring.com/account/</a>", 'sky-elementor-addons-pro'));
                        ?></li>
                    <li><?php echo wp_kses_post(__("Open Support Ticket - <a target='_blank' href='https://techfyd.com/support/'>https://techfyd.com/support/</a>", 'sky-elementor-addons-pro'));
                        ?></li>
                </ol>
                <div class="sa-el-license-field">
                    <label for="sky_license_key"><?php esc_html_e("License code", 'sky-elementor-addons-pro'); ?></label>
                    <input type="text" class="regular-text code" name="sky_license_key" size="50" placeholder="xxxxxxxx-xxxxxxxx-xxxxxxxx-xxxxxxxx" required="required">
                </div>
                <div class="sa-el-license-field">
                    <label for="sky_license_key"><?php esc_html_e("Email Address", 'sky-elementor-addons-pro'); ?></label>
                    <?php
                    $purchaseEmail   = get_option("sky_addons_pro_license_email", get_bloginfo('admin_email'));
                    ?>
                    <input type="text" class="regular-text code" name="sky_license_email" size="50" value="<?php echo $purchaseEmail; ?>" placeholder="" required="required">
                    <div><small><?php esc_html_e("We will send update news of this product by this email address, don't worry, we hate spam", 'sky-elementor-addons-pro'); ?></small></div>
                </div>
                <div class="sa-el-license-active-btn">
                    <?php wp_nonce_field('sa-el-license'); ?>
                    <?php submit_button('Activate'); ?>
                </div>
            </div>
        </form>
<?php
    }
    public function sky_addons_pro_license_expire_soon($expiry_days) {
        if (!current_user_can('update_plugins')) {
            return;
        }

        $message      = wp_kses_post('<p>' . __('Sky Addons Pro for Elementor is going to expire in <b class="sa-text-danger sa-fw-bolder">' . $expiry_days . '</b> day/days. Please renew your license as soon as possible.', 'sky-elementor-addons-pro') . '</p>');

        printf('<div class="error"><p>%s</p></div>', $message);
    }
}


function sky_addons_pro_license_manager() {
    return new License_Manager();
}

// kick-off the License_Manager class
sky_addons_pro_license_manager();
