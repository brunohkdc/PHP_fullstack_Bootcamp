<div>
   @foreach ($locales as $code => $label)
        @if ($code !== $currentLocale)
            <button
                wire:click="switchLocale('{{ $code }}')"
                class="text-sm font-medium text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors duration-150 cursor-pointer"
            >
                {{ $label }}
            </button>
        @else
            <span class="text-sm font-semibold text-gray-900 dark:text-white underline underline-offset-2">
                {{ $label }}
            </span>
        @endif
 
        @if (!$loop->last)
            <span class="text-gray-300 dark:text-gray-600 select-none">|</span>
        @endif
    @endforeach
</div>
