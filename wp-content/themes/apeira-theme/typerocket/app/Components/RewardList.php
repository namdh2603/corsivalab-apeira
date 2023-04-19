<?php
namespace App\Components;
use TypeRocket\Template\Component;
class RewardList extends Component
{
    protected $title = 'Reward List';
    /**
     * Admin Fields
     */
    public function fields()
    {
        $form = $this->form();
        echo $form->text('sub_title')->setLabel('Sub Title');
        echo $form->text('title')->setLabel('Title');
        echo $form->wpEditor('desc')->setLabel('Description');
        echo $form->repeater('List')->setFields([
            $form->row()
                ->withColumn(
                    $form->image('img')->setLabel('Icon'),
                )
                ->withColumn(
                    $form->text('Title'),
                    $form->input('point')->setTypeNumber()->setLabel('Points'),
                    // $form->text('btn_txt')->setLabel('Text Button'),
                    // $form->text('btn_link')->setLabel('Link Button')->setDefault('#'),
                ),
        ]);
    }
    /**
     * Render
     *
     * @var array $data component fields
     * @var array $info name, data_id, model, first_data, last_data, component_id, hash
     */
    public function render(array $data, array $info)
    {
?>
        <section class="section-<?php echo $info['component_id']; ?> section-padding" data-id="<?php echo $info['component_id']; ?>">
            <div class="container">
                <div class="head-section">
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-8 col-md-8 col-lg-8 text-center">
                            <?php if (!empty($data['sub_title'])) : ?><div class="sub-title"><?php echo $data['sub_title']; ?></div><?php endif; ?>
                            <?php if (!empty($data['title'])) : ?><div class="title"><?php echo $data['title']; ?></div><?php endif; ?>
                            <?php if (!empty($data['desc'])) : ?><div class="desc"><?php echo apply_filters('the_content', $data['desc']); ?></div><?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="reward-list">
                    <div class="row justify-content-center">
                        <?php $action_list =  get_theme_mod(sanitize_underscores('Action Reward List'));
                        if (!empty($action_list)) {
							
                            if (is_user_logged_in()) {
                                $user = wp_get_current_user();
                                $user_id = $user->ID;
								
								$user_reward = get_user_meta($user_id, 'user_reward_list', true);
								if(empty($user_reward)){
									update_user_meta($user_id, 'user_reward_list', array());
								}
                            }
                        ?>
                            <?php foreach ($action_list as $item) { ?>
                                <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 reward-item" data-type="<?php echo $item['slug']; ?>">
                                    <div class="reward-inner">
                                        <img src="<?php echo get_attachment($item['icon'])['src']; ?>" class="w-100" alt="img" />
                                        <?php if (!empty($item['title'])) : ?>
                                            <div class='icons-title'><?php echo $item['title']; ?></div>
                                        <?php endif; ?>
                                        <?php if (!empty($item['point'])) : ?>
                                            <div class='icons-point'><?php echo $item['point']; ?> points</div>
                                        <?php endif; ?>
                                        <?php if (is_user_logged_in()) {
																   if (in_array($item['slug'], $user_reward) == true) { ?>
                                                <div class="btn-wrap btn-center">
                                                    <div class="btn-main btn-main-v2 disabled">COMPLETED</div>
                                                </div>
                                            <?php } else { ?>
                                                <div class="btn-wrap btn-center">
                                                    <div class="btn-main btn-outline-v3 enabled">COMPLETE</div>
                                                </div>
                                        <?php }
																  } else { ?>
										<div class="btn-wrap btn-center">
                                                    <a class="btn-main btn-outline-v3 disabled" href="#corsivalab-shortcode-form">COMPLETE</a>
                                                </div>
										
						<?php } ?>
                                    </div>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
<?php
    }
}