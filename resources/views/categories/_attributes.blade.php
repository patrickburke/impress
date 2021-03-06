{!! Form::hidden('id', '@{{ category.id }}') !!}

<div class="form-group">
	<label for="name" class="col-md-3 control-label">Name</label>

	<div class="col-md-9">
		{!! Form::text('name', null, [
			'class' => 'form-control col-md-12',
			'v-model' => 'category.name'
		]) !!}
	</div>
</div>

<div class="form-group">
	<label for="slug" class="col-md-3 control-label">Slug</label>

	<div class="col-md-9">
		<div class="input-group">
			{!! Form::text('slug', null, [
				'class' => 'form-control col-md-12',
				'v-model' => 'category.slug',
				'v-attr' => 'readonly: autoSlug',
				'readonly'
			]) !!}
			<label class="input-group-addon">
				<input type="checkbox" v-model="autoSlug" checked> Auto
			</label>
		</div>
	</div>
</div>

<div class="form-group">
	<label for="color_id" class="col-md-3 control-label">Color</label>

	<div class="col-md-9">
		@foreach($colors as $color)
			<div class="radio-inline form-control-color" style="background-color: #{{ $color->hex }}" v-class="selected: category.color_id == {{ $color->id }}">
				@icon('ok')
				<label>
					{!! Form::radio('color_id', $color->id, null, [
						'v-model' => 'category.color_id'
					]) !!} {{ $color->hex }}
				</label>
			</div>
		@endforeach
		<div class="radio-inline form-control-color">
			<label>
				<input type="text" name="new-color" id="new-color">
			</label>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="pull-right">
			<button type="submit" class="btn btn-success">@icon('ok') Save</button>
		</div>
	</div>
</div>