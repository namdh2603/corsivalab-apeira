<?php
add_action('wp_ajax_nopriv_check_reward_status', 'check_reward_status_callback');
add_action('wp_ajax_check_reward_status', 'check_reward_status_callback');
function check_reward_status_callback()
{
    if (!is_user_logged_in()) {
        return false;
    }
    $user_id = get_current_user_id();
	
    $type = sanitize_text_field($_POST['type']);
	
	$user_reward = get_user_meta($user_id, 'user_reward_list', true);
	if($type == 'account'){
		$status = check_reward_account($user_id);
		$user_reward[] = 'account';
		update_user_meta($user_id, 'user_reward_list', $user_reward);
	} else if($type == 'order'){
		$status = check_reward_orders($user_id);
		$user_reward[] = 'order';
		update_user_meta($user_id, 'user_reward_list', $user_reward);
	} else {
		$status = false;
	}
	
	
    $result = $status;
//     $result = ob_get_clean();
    wp_send_json_success($result);
    wp_die();
}

function check_reward_account($user_id)
{
    if (is_user_logged_in()) {
        $result = true;
    } else {
        $result = false;
        // 		$user_money = get_user_meta($user_id, 'money', true);
    }
    return $result;
}
function check_reward_orders($user_id)
{
    $result = false;
        $args = array(
            'customer_id' => $user_id,
//             'status' => array('wc-processing', 'wc-on-hold'),
            'return' => 'ids',
            //     'customer' => $user_email,
            //     'limit' => 1,
        );
        $orders = wc_get_orders($args);
        if ($orders) {
            $result = true;
        }
    
    return $result;
}