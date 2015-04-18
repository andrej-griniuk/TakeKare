<?=$this->Form->create($modelName, array('class' => 'row')); ?>
<fieldset class="col-lg-6">
    <?=$this->Form->listErrors()?>
    <?=$this->Form->hidden('id')?>
    <?=$this->Form->input('branch_id', array('label' => __('Branch')))?>
    <?=$this->Form->input('email', array('label' => __('Email')))?>
    <?=$this->Form->input('name', array('label' => __('Name')))?>
    <?=$this->Form->input('password', array('label' => __('Password'), 'value' => ''))?>
    <?=$this->Form->input('is_active', array('label' => __('Is Active'), 'type' => 'checkbox'))?>
    <?=$this->Form->input('is_manager', array('label' => __('Is Manager'), 'type' => 'checkbox'))?>
    <?=$this->Form->input('is_owner', array('label' => __('Is Owner'), 'type' => 'checkbox'))?>
</fieldset>
<fieldset class="col-lg-12">
    <?=$this->Form->submit(__('Save'))?>
</fieldset>
<?=$this->Form->end(); ?>

