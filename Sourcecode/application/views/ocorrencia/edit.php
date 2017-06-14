<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="container">
	<?php if(isset($exception)): ?>
		<div class="alert alert-danger alert-dismissable">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Atenção!</strong>
			<p>
				<?= $exception ?>
			</p>
		</div>
	<?php endif; ?>
	
	<?= form_open("ocorrencia/$ocorrencia->id/editar") ?>
	<div class="row">
		<div class="col-xs-12 col-md-6">
			<div class="form-group">
				<label for="bairro">Bairro</label>
				<select class="form-control" id="bairro" name="bairro" required>
					<?php foreach($bairros as $bairro): ?>
						<option value="<?= $bairro->id ?>" <?= $ocorrencia->bairro === $bairro->id ? 'selected' : '' ?>><?= $bairro->nome ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="col-xs-12 col-md-6">
			<div class="form-group">
				<label for="tipo">Tipo</label>
				<select class="form-control" id="tipo" name="tipo" required>
					<?php foreach($tipos as $tipo): ?>
						<option value="<?= $tipo->id ?>" <?= $ocorrencia->tipo === $tipo->id ? 'selected' : '' ?>><?= $tipo->descricao ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="form-group">
				<label for="descricao">Descrição</label>
				<textarea class="form-control" id="descricao" name="descricao" required rows="8" placeholder="Descrição detalhada do ocorrido"><?= set_value('descricao', $ocorrencia->descricao); ?></textarea>
				<?= form_error('descricao'); ?>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<span class="panel-title">Localização</span>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-xs-12 col-md-6">
							<div class="form-group">
								<label for="longitude">Longitude</label>
								<input type="text" class="form-control" id="longitude" name="longitude" placeholder="Longitude" required value="<?= set_value('longitude', $ocorrencia->longitude); ?>"/>
								<?= form_error('longitude'); ?>
							</div>
						</div>
						<div class="col-xs-12 col-md-6">
							<div class="form-group">
								<label for="latitude">Latitude</label>
								<input type="text" class="form-control" id="latitude" name="latitude" placeholder="Latitude" required value="<?= set_value('latitude', $ocorrencia->latitude); ?>"/>
								<?= form_error('latitude'); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 text-right">
			<a href="<?= site_url('ocorrencia'); ?>" class="btn btn-default">Cancelar</a>
			<button type="submit" class="btn btn-primary">Atualizar</button>
		</div>
	</div>
	<?= form_close() ?>
</div>