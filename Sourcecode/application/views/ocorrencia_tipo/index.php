<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container-fluid">
    Para cadastrar um tipo de ocorrência, clique <?= anchor('ocorrencia/tipo/cadastrar', 'aqui') ?>.
</div>

<br/>

<div class="container-fluid">
    <?php if(!empty($tipos)): ?>
        <table class="table table-bordered table-striped">
            <thead>
                <th>Descrição</th>
                <th class="text-right actions-column">Ações</th>
            </thead>
            <tbody>
                <?php foreach($tipos as $tipo): ?>
                    <tr>
                        <td><?= $tipo->descricao ?></td>
                        <td class="text-right">
                            <a href="<?= site_url("ocorrencia/tipo/$tipo->id/editar"); ?>" class="btn btn-default btn-sm">Editar</a>
                            <?= form_open("ocorrencia/tipo/$tipo->id/remover", array('style' => 'display: inline;')); ?>
                                <?= form_hidden('id', $tipo->id); ?>
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            <?= form_close(); ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>