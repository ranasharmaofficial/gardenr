<option value="{{ $category->id }}"
    @if (!empty($data['category_id']) && $data['category_id'] == $category->id) selected @endif>
    {{ str_repeat('--', $level) }} {{ $category->name }}
</option>

@if ($category->childrenRecursive && $category->childrenRecursive->count())
    @foreach ($category->childrenRecursive as $child)
        @include('admin.vivah_mitra.category.partials.edit_category_options', ['category' => $child, 'level' => $level + 1, 'data' => $data])
    @endforeach
@endif
