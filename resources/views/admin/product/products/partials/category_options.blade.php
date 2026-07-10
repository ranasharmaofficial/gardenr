<option value="{{ $category->id }}"
    @if (isset($data) && $data->parent_id == $category->id) selected @endif>
    {{ str_repeat('--', $level) }} {{ $category->name }}
</option>

@if ($category->childrenRecursive && $category->childrenRecursive->count())
    @foreach ($category->childrenRecursive as $child)
        @include('admin.product.category.partials.category_options', ['category' => $child, 'level' => $level + 1, 'data' => $data])
    @endforeach
@endif
