<?php

namespace App\Components;

use TypeRocket\Template\Component;

class ContentWithImage extends Component
{
    protected $title = 'Content With Image';
    /**
     * Admin Fields
     */
    public function fields()
    {
        $form = $this->form();
        echo $form->toggle('reverse')->setLabel('Image & Text reverse');
        echo $form->image('img')->setLabel('Image');
        echo $form->wpEditor('desc')->setLabel('Content')->setSetting('options', ['teeny' => false, 'tinymce' => true, 'editor_height' => 600]);
    }
    /**
     * Render
     *
     * @var array $data component fields
     * @var array $info name, item_id, model, first_item, last_item, component_id, hash
     */
    public function render(array $data, array $info)
    {
?>
        <section class="section-<?php echo $info['component_id']; ?> section-content" data-id="<?php echo $info['component_id']; ?>">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-8 col-md-8 col-lg-8">
                        <div class="desc">
                            <div class="row <?php echo (!empty($data['reverse'])?'flex-row-reverse':''); ?>">
                                <div class="col-12 col-sm-5 col-md-5 col-lg-5">
                                    <img src="<?php echo get_attachment($data['img'])['src']; ?>" class="" alt="img" />
                                </div>
                                <div class="col-12 col-sm-7 col-md-7 col-lg-7 align-self-center">
                                    <?php if (!empty($data['desc'])) : ?><div class="desc"><?php echo apply_filters('the_content', $data['desc']); ?></div><?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php
    }
}
