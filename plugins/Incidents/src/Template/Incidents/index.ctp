<ul class="nav nav-pills row">
    <li><?= $this->Html->link(__('New Incident'), ['action' => 'save']) ?></li>
</ul>

<?= $this->element('incidents_filter') ?>

<div class="incidents index large-10 medium-9 columns">
    <?= $this->element('incidents_table') ?>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
