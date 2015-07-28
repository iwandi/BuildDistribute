<div calss="form-group">
	{!! Form::label('installUrl', 'Install Url:') !!}
	{!! Form::text('installUrl', NULL, ['class' => 'form-control']) !!}
</div>
<div calss="form-group">
	{!! Form::label('version', 'Version:') !!}
	{!! Form::text('version', NULL, ['class' => 'form-control']) !!}
</div>
<div calss="form-group">
	{!! Form::label('platform', 'Platform:') !!}
	{!! Form::text('platform', NULL, ['class' => 'form-control']) !!}
</div>
<div calss="form-group">
	{!! Form::label('revision', 'Revision:') !!}
	{!! Form::text('revision', NULL, ['class' => 'form-control']) !!}
</div>
<div calss="form-group">
	{!! Form::label('androidBundleVersionCode', 'Android Bundle Version Code:') !!}
	{!! Form::text('androidBundleVersionCode', NULL, ['class' => 'form-control']) !!}
</div>
<div calss="form-group">
	{!! Form::label('iPhoneBundleIdentifier', 'IPhone Bundle Identifier:') !!}
	{!! Form::text('iPhoneBundleIdentifier', NULL, ['class' => 'form-control']) !!}
</div>
<div calss="form-group">
	{!! Form::label('iPhoneBundleVersion', 'IPhone Bundle Version:') !!}
	{!! Form::text('iPhoneBundleVersion', NULL, ['class' => 'form-control']) !!}
</div>
<div calss="form-group">
	{!! Form::label('iPhoneTitle', 'IPhone Title:') !!}
	{!! Form::text('iPhoneTitle', NULL, ['class' => 'form-control']) !!}
</div>
<div calss="form-group">
	{!! Form::submit($submitText, ['class' => 'btn btn-primary form-controll']) !!}
</div>