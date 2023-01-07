@props([
  'breadcrumbs' => [
    'href' => '/',
    'label' => 'TOP'
  ]
])
<nav class="text-black mx-4 my-3" aria-label="Breadcrum">
  <ol class="list-none p-0 inline-flex">
    @foreach ($breadcrumbs as $breadcrumb)
        @if ($loop->last)
          <li>
            <a href="{{ $breadcrumb['href'] }}" class="text-gray-500"
              aria-current="page">
              {{ $breadcrumb['label'] }}
            </a>
          </li>
        @else
          <li class="flex items-center">
            <a href="{{ $breadcrumb['href'] }}" class="hover:underline">
              {{ $breadcrumb['label'] }}
            </a>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
              <path fill-rule="evenodd" d="M4.72 3.97a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 01-1.06-1.06L11.69 12 4.72 5.03a.75.75 0 010-1.06zm6 0a.75.75 0 011.06 0l7.5 7.5a.75.75 0 010 1.06l-7.5 7.5a.75.75 0 11-1.06-1.06L17.69 12l-6.97-6.97a.75.75 0 010-1.06z" clip-rule="evenodd" />
            </svg>            
          </li>            
        @endif
    @endforeach
  </ol>
</nav>