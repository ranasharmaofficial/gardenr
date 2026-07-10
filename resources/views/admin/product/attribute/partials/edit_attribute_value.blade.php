<form action="{{ route('admin.update-attribute-value', $attributeValue->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="value" class="form-label">Value</label>
        <input type="text" name="value" class="form-control" value="{{ $attributeValue->value }}" required>
    </div>

    <div class="text-end">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>