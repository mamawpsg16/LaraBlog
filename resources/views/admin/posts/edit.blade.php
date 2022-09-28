<x-layout>
    <x-setting :header="'Edit  Post : '.$post->title">
        <form method="POST" action="{{ route('admin.posts.update',$post->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <x-form.input name="title" placeholder="Title" :value="old('title',$post->title)" required></x-form.input>
            <div class="flex justify-between items-center">
                <x-form.input name="image" placeholder="File" type="file" :value="old('image',$post->image)"></x-form.input>
                <img src="{{ isset($post->image) ? asset('storage/'.$post->image) : asset('images/illustration-1.png') }}" width="200" alt="Blog Post illustration" class="rounded-xl relative top-3 mt-2">
            </div>
            <x-form.text-area name="body" required>{{ old('body',$post->body) }}</x-form.text-area>
            <x-form.text-area name="excerpt" required>{{ old('excerpt',$post->excerpt) }}</x-form.text-area>
            <x-form.field class="mb-4">
                <x-form.label name="category"></x-form.label>
                <select name="category_id" id="category_id" class="border border-gray-400 py-2 px-1">
                    @foreach($categories = \App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}" {{ old('category_id',$post->category_id) === $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                <x-form.error name="category_id"></x-form.error>
            </x-form.field>
            <x-form.button>Update</x-form.button>
        </form>
    </x-setting>
</x-layout>