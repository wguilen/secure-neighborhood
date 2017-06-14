<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container-fluid">
    Para cadastrar um bairro, clique <?= anchor('bairro/cadastrar', 'aqui') ?>.
</div>

<br/>

<div class="container-fluid">
    <?php if(!empty($bairros)): ?>
        <table class="table table-bordered table-striped">
            <thead>
                <th>Nome</th>
                <th class="hidden-xs">Coordenadas</th>
                <th class="text-right actions-column">Ações</th>
            </thead>
            <tbody>
                <?php foreach($bairros as $bairro): ?>
                    <tr>
                        <td><?= $bairro->nome ?></td>
                        <td class="hidden-xs"><?= $bairro->coordenadas ?></td>
                        <td class="text-right">
                            <a href="<?= site_url("bairro/$bairro->id/editar"); ?>" class="btn btn-default btn-sm">Editar</a>
                            <?= form_open("bairro/$bairro->id/remover", array('style' => 'display: inline;')); ?>
                                <?= form_hidden('id', $bairro->id); ?>
                                <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                            <?= form_close(); ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>