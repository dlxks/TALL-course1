<div>
    <div class="flex flex-col bg-whitie w-full h-screen bg-gray-100"
        x-data="{ showSubscribe: false,  showSuccess: false }">
        <nav
            class="flex py-2 px-4 justify-between items-center container mx-auto text-gray-700 border-b border-b-gray-200">
            <a href="/">
                <x-application-logo class="w-16 h-16 fill-current" />
            </a>

            <div class="flex justify-end">
                @auth
                <a href="{{route('dashboard')}}">Dashboard</a>
                @else
                <a href="{{route('login')}}">Login</a>
                @endauth
            </div>
        </nav>

        <div class="flex container mx-auto h-full items-center">
            <div class="flex flex-col w-1/3 items-start">
                <h1 class="text-5xl text-gray-800 leading-tight font-bold mb-4">This is a Simple Landing page to
                    subscribe
                </h1>
                <p class="text-xl text-gray-600 mb-10">We are just checking the TALL stack. Would you mind subscribing?
                </p>
                <x-primary-button x-on:click="showSubscribe = true"
                    class="px-6 py-4 flex tracking-wide items-center justify-center border-2 border-gray-700 hover:text-gray-700 hover:bg-transparent hover:border-2 hover:border-gray-700">
                    Subscribe
                </x-primary-button>
            </div>
        </div>

        <x-amodal class="bg-pink-500" trigger="showSubscribe">
            <p class="text-white text-5xl font-extrabold text-center">Let's do it!</p>
            <form action="" class="flex flex-col items-center" wire:submit.prevent="subscribe">
                <x-text-input class="px-5 py-3 w-80 border border-blue-400" type="email" name="email"
                    placeholder="Email address" wire:model="email"></x-text-input>
                <span class="text-gray-100 text-xs">
                    {{-- Validation --}}
                    {{
                    $errors->has('email')
                    ? $errors->first('email')
                    : 'We will send a confirmation email.'
                    }}
                </span>
                <x-primary-button type="submit"
                    class="px-5 py-3 mt-5 w-80 justify-center !text-gray-900 bg-white border border-white hover:!text-white hover:bg-transparent">
                    Get in
                </x-primary-button>
            </form>
        </x-amodal>

        <x-amodal class="bg-emerald-500" trigger="showSuccess">
            <p class="animate-pulse text-white text-5xl font-extrabold text-center">
                <span class="text-5xl">&check;</span> You have subscribed!
            </p>
        </x-amodal>
    </div>
</div>