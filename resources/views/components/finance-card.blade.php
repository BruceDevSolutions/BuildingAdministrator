@props([
    'title',
    'money' => null,
    'value' => null,
    'iconType' => 'money'
])
<div class="relative flex flex-col min-w-0 mb-6 break-words text-white bg-slate-800 shadow-soft-xl rounded-2xl bg-clip-border">
    <div class="flex-auto p-4">
      <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-2/3 max-w-full px-3">
          <div>
            <p class="mb-0 font-sans font-semibold leading-normal text-sm">{{ $title }}</p>
            <h5 class="mb-0 font-bold">
                @if($money)
                    {{ number_format($money, 2) }} Bs.
                @endif
                @if($value)
                    {{ $value }}
                @endif
              {{-- <span class="leading-normal text-sm font-weight-bolder text-lime-500">+55%</span> --}}
            </h5>
          </div>
        </div>
        <div class="w-4/12 max-w-full px-3 ml-auto text-right flex-0">
          <div class="inline-flex justify-center items-center text-gray-100 w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500 shadow-soft-2xl">
                @switch($iconType)
                    @case('money')
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                            </svg>
                        @break

                    @case('house')
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                        @break
                    @default
                @endswitch
          </div>
        </div>
      </div>
    </div>
</div>