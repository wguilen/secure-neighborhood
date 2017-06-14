<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container-fluid">
    Para cadastrar uma ocorrência, clique <?= anchor('ocorrencia/cadastrar', 'aqui') ?>.
</div>

<br/>

<div class="container-fluid">
    <?php if(!empty($ocorrencias)): ?>
        <table class="table table-bordered table-striped">
            <thead>
                <th>Bairro</th>
                <th>Tipo</th>
                <th>Descrição</th>
                <th>Longitude</th>
                <th>Latitude</th>
                <th class="text-right actions-column">Ações</th>
            </thead>
            <tbody>
                <?php foreach($ocorrencias as $ocorrencia): ?>
                    <tr>
                        <td><?= $ocorrencia->bairro ?></td>
                        <td><?= $ocorrencia->tipo ?></td>
                        <td><?= $ocorrencia->descricao ?></td>
                        <td><?= $ocorrencia->longitude ?></td>
                        <td><?= $ocorrencia->latitude ?></td>
                        <td class="text-right">
                            <a href="<?= site_url("ocorrencia/$ocorrencia->id/editar"); ?>" class="btn btn-default btn-sm">Editar</a>
                            <?= form_open("ocorrencia/$ocorrencia->id/remover", array('style' => 'display: inline;')); ?>
                                <?= form_hidden('id', $ocorrencia->id); ?>
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            <?= form_close(); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>