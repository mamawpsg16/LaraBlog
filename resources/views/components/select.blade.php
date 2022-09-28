<select v-model="selected_category" name="category">
    {{-- <option selected disabled value="category">Select a category</option> --}}
    @foreach($categories as $category)
    <option value="{{ $category->slug }}">
        {{ $category->name}}
    </option>
    @endforeach
</select>