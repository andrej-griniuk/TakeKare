<?=$this->Form->create($modelName, array('class' => 'row')); ?>
    <fieldset class="col-lg-6">
        <?=$this->Form->listErrors()?>
        <?=$this->Form->hidden('id')?>
        <?=$this->Form->input('parent_id', array('label' => __('Parent'), 'empty' => true))?>
        <?=$this->Form->input('title', array('label' => __('Title')))?>
        <?=$this->Form->input('icon', array('label' => __('Icon')))?>
        <?=$this->Form->input('pos', array('label' => __('Pos')))?>
    </fieldset>
    <fieldset class="col-lg-12">
        <?=$this->Form->submit(__('Save'))?>
    </fieldset>
<?=$this->Form->end(); ?>

