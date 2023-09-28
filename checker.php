
<?php
require_once( ABSPATH . 'wp-admin/includes/plugin.php' );

class Plugin_Update_Checker {
    private $plugin_file;
    private $github_username;
    private $github_repo;

    public function __construct($plugin_file, $github_username, $github_repo) {
        $this->plugin_file = $plugin_file;
        $this->github_username = $github_username;
        $this->github_repo = $github_repo;

        add_filter('pre_set_site_transient_update_plugins', array($this, 'check_for_plugin_update'));
        add_filter('plugins_api', array($this, 'plugin_api_call'), 10, 3);
    }

    public function check_for_plugin_update($transient) {
        if (empty($transient->checked)) {
            return $transient;
        }

        $plugin_data = get_plugin_data($this->plugin_file);
        $current_version = $plugin_data['Version'];

        $response = wp_remote_get("https://api.github.com/repos/{$this->github_username}/{$this->github_repo}/releases/latest");

        if (is_wp_error($response)) {
            return $transient;
        }

        $release_info = json_decode(wp_remote_retrieve_body($response));

        if ($release_info && version_compare($current_version, $release_info->tag_name, '<')) {
            $transient->response[$this->plugin_file] = (object) array(
                'slug' => dirname($this->plugin_file),
                'new_version' => $release_info->tag_name,
                'url' => $release_info->html_url,
                'package' => $release_info->zipball_url
            );
        }

        return $transient;
    }

    public function plugin_api_call($default, $action, $args) {
        if ($action === 'plugin_information' && isset($args->slug) && $args->slug === dirname($this->plugin_file)) {
            $response = wp_remote_get("https://api.github.com/repos/{$this->github_username}/{$this->github_repo}");

            if (!is_wp_error($response)) {
                $plugin_info = json_decode(wp_remote_retrieve_body($response));

                if ($plugin_info) {
                    $default = (object) array(
                        'name' => $plugin_info->name,
                        'slug' => dirname($this->plugin_file),
                        'version' => $plugin_info->tag_name,
                        'author' => $plugin_info->owner->login,
                        'requires' => '5.0',
                        'tested' => '5.8',
                        'homepage' => $plugin_info->html_url,
                        'sections' => array(
                            'description' => $plugin_info->description,
                            'changelog' => $plugin_info->body
                        )
                    );
                }
            }
        }

        return $default;
    }
}

//new Plugin_Update_Checker('your-plugin-file.php', 'your-github-username', 'your-github-repo');