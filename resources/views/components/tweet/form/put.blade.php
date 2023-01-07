@props([
  'tweet'
])
<div class="p-4">
  <form action="{{ route('tweet.update.put', ['tweetId' => $tweet->id]) }}" method="post">
    @method('PUT')
    @csrf
    @if (session('feedback.success'))
        <x-alert.success>{{ session('feedback.success') }}</x-alert.success>
    @endif
    <div class="mt-1">
      <textarea name="tweet" rows="3" 
        class="focus:ring-blue-400 focus:border-blue-400 mt-1 block 
        w-full sm:text-sm border border-gray-300 rounded-md p-2"
        placeholder="つぶやこう">
        {{ $tweet->content }}
      </textarea>
    </div>
    <p class="mt-2 text-sm text-gray-500">
      140文字までだよ      
    </p>

    @error('tweet')
        <x-alert.error>{{ $message }}</x-alert.error>
    @enderror

    <div class="flex flex-wrap justify-end">
      <x-elements.button>編集するよ</x-elements.button>
    </div>
  </form>
</div>