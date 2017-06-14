<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container-fluid">
    <?php if(!empty($ocorrencias)): ?>
        <table class="table table-bordered table-striped">
            <thead>
                <th>Bairro</th>
                <th class="text-right">Quantidade de ocorrências</th>
            </thead>
            <tbody>
                <?php foreach($ocorrencias as $ocorrencia): ?>
                    <tr>
                        <td><?= $ocorrencia->bairro ?></td>
                        <td class="text-right"><?= $ocorrencia->numero_ocorrencias ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>