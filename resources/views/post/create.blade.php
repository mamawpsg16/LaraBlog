<x-layout>
    <x-setting header="Publish New Post">
        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            <x-form.input name="title" placeholder="Title" :value="old('title')" required></x-form.input>
            <x-form.input name="image" placeholder="File" type="file" :value="old('image')" required></x-form.input>
            <x-form.text-area name="body" required>{{ old('body') }}</x-form.text-area>
            <x-form.text-area name="excerpt" required>{{ old('excerpt') }}</x-form.text-area>
            <x-form.field class="mb-4">
                <x-form.label name="category"></x-form.label>
                <select name="category_id" id="category_id" class="border border-gray-400 py-2 px-1">
                    @foreach($categories = \App\Models\Category::all() as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') === $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                <x-form.error name="category_id"></x-form.error>
            </x-form.field>
            @can('admin')
            <x-form.field class="mb-4">
                <x-form.input name="published_at" placeholder="Published At" type="checkbox" :value="old('published_at')"/>
            </x-form.field>
            @endcan
            <x-form.button>Publish</x-form.button>
        </form>
    </x-setting>
</x-layout>