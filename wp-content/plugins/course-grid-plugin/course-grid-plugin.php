<?php
/**
 * Plugin Name: Course Grid Plugin
 * Description: A plugin to display course information from a mock API in an admin grid with sorting and additional features.
 * Version: 1.0
 * Author: Sebastian Castro + ChatGPT
 */

if (!defined('ABSPATH')) {
    exit;
}

// Register and enqueue necessary scripts and styles
function cgp_enqueue_scripts($hook)
{
    if ($hook !== 'toplevel_page_course-grid') {
        return;
    }
    wp_enqueue_style('cgp-admin-style', plugins_url('/css/admin-style.css', __FILE__));
    wp_enqueue_script('cgp-admin-script', plugins_url('/js/admin-script.js', __FILE__), array('jquery'), '1.0', true);
}
add_action('admin_enqueue_scripts', 'cgp_enqueue_scripts');

// Add admin menu
function cgp_add_admin_menu()
{
    add_menu_page(
        'Course Grid',
        'Course Grid',
        'manage_options',
        'course-grid',
        'cgp_display_admin_page',
        'dashicons-admin-generic'
    );
}
add_action('admin_menu', 'cgp_add_admin_menu');

// Display admin page content
function cgp_display_admin_page()
{
    ?>
    <div class="wrap">
        <h1>Course Grid</h1>
        <button id="cgp-send-report" class="button button-primary">Send Report</button>
        <div id="cgp-course-grid"></div>
    </div>
    <?php
    cgp_display_courses();
}

// Fetch course data from API
function cgp_fetch_courses()
{
    $response = wp_remote_get('https://lmstest.acue.org/ACUE-microcourselist.json');
    if (is_wp_error($response)) {
        return array();
    }
    $data = wp_remote_retrieve_body($response);
    return json_decode($data, true);
}

// Display the course grid
function cgp_display_courses()
{
    $courses = cgp_fetch_courses();
    if (empty($courses)) {
        echo '<p>No courses available.</p>';
        return;
    }
    ?>
    <table id="cgp-course-table" class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Course Code</th>
                <th>Workflow State</th>
                <th>Start Date</th>
                <th>End Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($courses as $course): ?>
                <tr>
                    <td><?php echo esc_html($course['id']); ?></td>
                    <td><?php echo esc_html($course['name']); ?></td>
                    <td><?php echo esc_html($course['course_code']); ?></td>
                    <td><?php echo esc_html($course['workflow_state']); ?></td>
                    <td><?php echo esc_html($course['start_at']); ?></td>
                    <td><?php echo esc_html($course['end_at']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php
}

// Shortcode to display the course grid
function cgp_frontend_shortcode()
{
    ob_start();
    ?>
    <div id="cgp-course-grid-frontend">
        <?php
        $courses = cgp_fetch_courses();
        if (empty($courses)) {
            echo '<p>No courses available.</p>';
            return;
        }
        ?>
        <table id="cgp-course-table-sc" class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Course Code</th>
                    <th>Workflow State</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($courses as $course): ?>
                    <tr>
                        <td><?php echo esc_html($course['id']); ?></td>
                        <td><?php echo esc_html($course['name']); ?></td>
                        <td><?php echo esc_html($course['course_code']); ?></td>
                        <td><?php echo esc_html($course['workflow_state']); ?></td>
                        <td><?php echo esc_html($course['start_at']); ?></td>
                        <td><?php echo esc_html($course['end_at']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>
    <script>
        jQuery(document).ready(function ($) {
            $.ajax({
                url: 'https://lmstest.acue.org/ACUE-microcourselist.json',
                dataType: 'json',
                success: function (data) {
                    let html = '<table class="wp-list-table widefat fixed striped"><thead><tr><th>ID</th><th>Name</th><th>Course Code</th><th>Workflow State</th><th>Start Date</th><th>End Date</th></tr></thead><tbody>';
                    $.each(data, function (index, course) {
                        html += '<tr><td>' + course.id + '</td><td>' + course.name + '</td><td>' + course.course_code + '</td><td>' + course.workflow_state + '</td><td>' + course.start_date + '</td><td>' + course.end_date + '</td></tr>';
                    });
                    html += '</tbody></table>';
                    $('#cgp-course-grid-frontend').html(html);
                }
            });
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('course_grid', 'cgp_frontend_shortcode');

function cgp_enqueue_data_tables($hook)
{
    if ($hook !== 'toplevel_page_course-grid') {
        return;
    }
    wp_enqueue_script('data-tables-js', 'https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js', array('jquery'), '1.11.5', true);
    wp_enqueue_style('data-tables-css', 'https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css');
}
add_action('admin_enqueue_scripts', 'cgp_enqueue_data_tables');
?>
<style>
    thead {
        background-color: black !important;
        color: white;
    }

    td {
        border: solid 1px #000;
    }
</style>