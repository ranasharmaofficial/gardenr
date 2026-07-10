<form action="{{ route('admin.attributes.update', $attribute->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Attribute Name</label>
        <input type="text" name="name" class="form-control" value="{{ $attribute->name }}" required>
    </div>
	{{--
    <!-- Optional: Loop through attribute values -->
    @foreach($attribute->attribute_values as $index => $value)
        <div class="mb-2">
            <label class="form-label">Value {{ $index + 1 }}</label>
            <input type="text" name="values[]" class="form-control" value="{{ $value->value }}">
        </div>
    @endforeach
	--}}
    <div class="text-end">
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </div>
</form>