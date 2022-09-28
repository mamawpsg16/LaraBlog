@props(['categories'])
<div class="flex justify-end mt-4">
    <form action="/posts">
        <div class="relative flex space-x-2 border border-gray-100 m-4 rounded-lg">
            
            <input type="text" name="search"
                class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none"
                placeholder="Search ..." v-model="search" />
        </div>
    </form>
</div>