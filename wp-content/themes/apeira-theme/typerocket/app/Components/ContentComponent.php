<?php

namespace App\Components;

use TypeRocket\Template\Component;

class ContentComponent extends Component
{
    protected $title = 'Content Component';

    /**
     * Admin Fields
     */
    public function fields()
    {
        $form = $this->form();
        echo $form->wpEditor('desc')->setLabel('Content')->setSetting('options', ['teeny' => false, 'tinymce' => true, 'editor_height' => 800]);;
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
        <section class="section-<?php echo $info['component_id']; ?>" data-id="<?php echo $info['component_id']; ?>">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-8 col-md-8 col-lg-8">
                        <?php if (!empty($data['desc'])) : ?><div class="desc"><?php echo apply_filters('the_content', $data['desc']); ?></div><?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
<?php
    }
}
