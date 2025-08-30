@props(['title', 'description', 'question' => null, 'deleteAction' => null, 'publishAction' => null, 'editUrl' => null, 'restoreAction' => null, 'archiveAction' => null, 'anchorId' => null])
@php
	$deleteUrl = $deleteAction ?? ($question ? route('question.destroy', $question) : null);
	$publishUrl = $publishAction ?? ($question ? route('question.publish', $question) : null);
	$editHref = $editUrl ?? ($question ? route('question.edit', $question) : null);
    $hasAnyAction = $deleteUrl || $publishUrl || $editHref || $archiveAction || $restoreAction;
@endphp
<div @if($anchorId) id="{{ $anchorId }}" @endif class="group rounded-lg border border-slate-200/60 dark:border-slate-700/60 bg-gradient-to-b from-white to-slate-50 dark:from-slate-800 dark:to-slate-900 shadow-sm hover:shadow-md transition-shadow duration-200 p-4 my-4 dark:text-gray-300">
    <div x-data="{ open: false }" class="w-full">
		<div class="flex items-start justify-between gap-4">
			<button @click="open = !open" :aria-expanded="open" class="flex-1 text-left">
				<div class="flex items-center gap-2">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5 text-slate-400 transition-transform duration-200" :class="open ? 'rotate-90 text-blue-500' : ''">
						<path fill-rule="evenodd" d="M7.293 14.707a1 1 0 0 1 0-1.414L10.586 10 7.293 6.707a1 1 0 1 1 1.414-1.414l4 4a1 1 0 0 1 0 1.414l-4 4a1 1 0 0 1-1.414 0Z" clip-rule="evenodd" />
					</svg>
					<h2 class="text-base sm:text-lg font-semibold leading-snug truncate">{{ $title }}</h2>
				</div>
				<p class="mt-1 text-sm text-slate-500 dark:text-slate-400" x-show="!open">
					{{ Str::limit($description, 150) }}...
				</p>
			</button>
			@if($hasAnyAction)
				<div class="flex items-center gap-2 sm:gap-3 shrink-0">
					@if($editHref)
						<a href="{{ $editHref }}" class="inline-flex items-center gap-1.5 rounded-md border border-blue-300/60 dark:border-blue-400/40 px-2.5 py-1.5 text-xs font-medium text-blue-600 dark:text-blue-300 hover:bg-blue-50 dark:hover:bg-blue-500/10 transition-colors" title="Editar">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
								<path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712Z" />
								<path d="M11.849 6.06a2.25 2.25 0 0 0-3.182 0L2.56 12.167a4.5 4.5 0 0 0-1.147 2.003l-.69 2.757a1.125 1.125 0 0 0 1.36 1.36l2.757-.69a4.5 4.5 0 0 0 2.003-1.147l6.106-6.106a2.25 2.25 0 0 0 0-3.182Z" />
							</svg>
							<span class="hidden sm:inline">Editar</span>
						</a>
					@endif
					@if($publishUrl)
						<x-form put :action="$publishUrl">
							<button type="submit" class="inline-flex items-center gap-1.5 rounded-md border border-emerald-300/60 dark:border-emerald-400/40 px-2.5 py-1.5 text-xs font-medium text-emerald-600 dark:text-emerald-300 hover:bg-emerald-50 dark:hover:bg-emerald-500/10 transition-colors" title="Publicar">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
									<path fill-rule="evenodd" d="M12 2.25a.75.75 0 0 1 .75.75v13.69l4.22-4.22a.75.75 0 1 1 1.06 1.06l-5.5 5.5a.75.75 0 0 1-1.06 0l-5.5-5.5a.75.75 0 0 1 1.06-1.06l4.22 4.22V3a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
								</svg>
								<span class="hidden sm:inline">Publicar</span>
							</button>
						</x-form>
					@endif
					@if($archiveAction)
						<x-form patch :action="$archiveAction">
							<button type="submit" class="inline-flex items-center gap-1.5 rounded-md border border-amber-300/60 dark:border-amber-400/40 px-2.5 py-1.5 text-xs font-medium text-amber-600 dark:text-amber-300 hover:bg-amber-50 dark:hover:bg-amber-500/10 transition-colors" title="Arquivar">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
									<path d="M3 7.5A1.5 1.5 0 0 1 4.5 6h15A1.5 1.5 0 0 1 21 7.5v1.879a2.25 2.25 0 0 1-.659 1.591l-6.621 6.62a2.25 2.25 0 0 1-1.591.66H7.5A1.5 1.5 0 0 1 6 16.5V7.5Z" />
									<path d="M9 9h6v1.5H9V9Z" />
								</svg>
								<span class="hidden sm:inline">Arquivar</span>
							</button>
						</x-form>
					@endif
					@if($restoreAction)
						<x-form patch :action="$restoreAction">
							<button type="submit" class="inline-flex items-center gap-1.5 rounded-md border border-lime-300/60 dark:border-lime-400/40 px-2.5 py-1.5 text-xs font-medium text-lime-700 dark:text-lime-300 hover:bg-lime-50 dark:hover:bg-lime-500/10 transition-colors" title="Restaurar">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
									<path fill-rule="evenodd" d="M12 5.25a6.75 6.75 0 1 0 6.35 9h-2.1a4.875 4.875 0 1 1-1.328-5.238l-1.472 1.472A.75.75 0 0 0 15.75 12V6.75a.75.75 0 0 0-.75-.75H9a.75.75 0 0 0-.53 1.28l1.52 1.52A6.72 6.72 0 0 0 12 5.25Z" clip-rule="evenodd" />
								</svg>
								<span class="hidden sm:inline">Restaurar</span>
							</button>
						</x-form>
					@endif
					@if($deleteUrl)
						<x-form delete onsubmit="return confirm('Tem certeza?')" :action="$deleteUrl">
							<button type="submit" class="inline-flex items-center gap-1.5 rounded-md border border-rose-300/60 dark:border-rose-400/40 px-2.5 py-1.5 text-xs font-medium text-rose-600 dark:text-rose-300 hover:bg-rose-50 dark:hover:bg-rose-500/10 transition-colors" title="Excluir">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4">
									<path fill-rule="evenodd" d="M9 2.25A1.5 1.5 0 0 0 7.5 3.75V4.5H4.125a.75.75 0 0 0 0 1.5H5.25l.9 12.15A3 3 0 0 0 9.141 21h5.718a3 3 0 0 0 2.991-2.85l.9-12.15h1.125a.75.75 0 0 0 0-1.5H16.5V3.75A1.5 1.5 0 0 0 15 2.25H9Zm1.5 3.75V3.75h3V6H10.5ZM9.75 9a.75.75 0 0 1 .75.75v6a.75.75 0 0 1-1.5 0v-6A.75.75 0 0 1 9.75 9Zm4.5 0a.75.75 0 0 1 .75.75v6a.75.75 0 1 1-1.5 0v-6a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
								</svg>
								<span class="hidden sm:inline">Excluir</span>
							</button>
						</x-form>
					@endif
				</div>
			@endif
		</div>

		<div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-1" class="mt-3 text-justify prose prose-slate dark:prose-invert max-w-none">
			{!! nl2br(e($description)) !!}
		</div>
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

