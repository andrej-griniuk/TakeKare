<?= $this->Flash->render('auth') ?>
<?= $this->Flash->render() ?>
<?= $this->Form->create() ?>
<fieldset>
    <?= $this->Form->input('email') ?>
    <?= $this->Form->input('password') ?>
</fieldset>
<?= $this->Form->button(__('Login')); ?>
<?= $this->Form->end() ?>
