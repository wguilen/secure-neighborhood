<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container">
	<?= form_open('bairro/cadastrar') ?>
		<div class="row">
			<div class="col-xs-12">
				<div class="form-group">
					<label for="nome">Nome</label>
					<input type="text" class="form-control" id="nome" name="nome" placeholder="Nome do bairro" required value="<?= set_value('nome'); ?>"/>
					<?= form_error('nome'); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<div class="form-group">
					<label for="coordenadas">Coordenadas</label>
					<textarea class="form-control" id="coordenadas" name="coordenadas" placeholder="Coordenadas que formem a área do bairro" rows="3" required><?= set_value('coordenadas') ?></textarea>
					<?= form_error('coordenadas'); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 text-right">
				<a href="<?= site_url('bairro'); ?>" class="btn btn-default">Cancelar</a>
				<button type="submit" class="btn btn-primary">Cadastrar</button>
			</div>
		</div>
	<?= form_close() ?>
</div>