<div calss="form-group">
	{!! Form::label('name', 'Name:') !!}
	{!! Form::text('name', NULL, ['class' => 'form-control']) !!}
</div>	
<div calss="form-group">
	{!! Form::submit($submitText, ['class' => 'btn btn-primary form-controll']) !!}
</div>