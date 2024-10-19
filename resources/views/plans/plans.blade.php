<x-app-layout>
    <div class="flex justify-end items-end px-8">
        <a href="/plans/create" class="bg-blue-500 hover:bg-blue-600 text-white ml-3 px-3 py-2.5 text-sm flex items-center space-x-2 rounded">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
               <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>Add New</span>
        </a>
    </div>
    <section class="py-6 leading-7 text-gray-900 bg-white sm:py-12 md:py-16">
        <div class="box-border px-4 mx-auto border-solid sm:px-6 md:px-6 lg:px-0 max-w-7xl">
    
            <div class="flex flex-col items-center leading-7 text-center text-gray-900 border-0 border-gray-200">
                <h2 id="pricing"
                    class="box-border m-0 text-3xl font-semibold leading-tight tracking-tight text-black border-solid sm:text-4xl md:text-5xl">
                    Simple, Transparent Pricing
                </h2>
                <p class="box-border mt-2 text-xl text-gray-900 border-solid sm:text-2xl">
                </p>
            </div>
    
            @if(isset($plan))
            <div id="pricing"
                class="grid grid-cols-1 gap-4 mt-4 leading-7 text-gray-900 border-0 border-gray-200 sm:mt-6 sm:gap-6 md:mt-8  lg:grid-cols-3">
                @foreach($plan as $plans)
                <!-- Price 1 -->
                <div
                    class="{{$plans->bill_period != 'year' ? 'relative z-10 flex flex-col items-center max-w-md p-4 mx-auto my-0 border border-solid rounded-lg lg:-mr-3 sm:my-0 sm:p-6 md:my-8 md:p-8':'relative z-20 flex flex-col items-center max-w-md p-4 mx-auto my-0 bg-white border-4 border-blue-600 border-solid rounded-lg sm:p-6 md:px-8 md:py-16'}}">
                    <h3
                        class="m-0 text-2xl font-semibold leading-tight tracking-tight text-black border-0 border-gray-200 sm:text-3xl md:text-4xl">
                        {{$plans->name}}
                    </h3>
                    <div class="flex items-end mt-6 leading-7 text-gray-900 border-0 border-gray-200">
                        <p class="box-border m-0 text-6xl font-semibold leading-none border-solid">
                            ${{$plans->price}}
                        </p>
                        <p class="box-border m-0 border-solid" style="border-image: initial;">
                            / {{$plans->period.''.$plans->bill_period}}
                        </p>
                    </div>
                    <ul class="flex-1 p-0 mt-4 ml-5 leading-7 text-gray-900 border-0 border-gray-200">
                        <li class="inline-flex items-center block w-full mb-2 ml-5 font-semibold text-left border-solid">
                            <svg class="w-5 h-5 mr-2 font-semibold leading-7 text-blue-600 sm:h-5 sm:w-5 md:h-6 md:w-6"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            1 Company
                        </li>
    
                        <li class="inline-flex items-center block w-full mb-2 ml-5 font-semibold text-left border-solid">
                            <svg class="w-5 h-5 mr-2 font-semibold leading-7 text-blue-600 sm:h-5 sm:w-5 md:h-6 md:w-6"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                           User and Role management
                        </li>
    
                        <li class="inline-flex items-center block w-full mb-2 ml-5 font-semibold text-left border-solid">
                            <svg class="w-5 h-5 mr-2 font-semibold leading-7 text-blue-600 sm:h-5 sm:w-5 md:h-6 md:w-6"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            Tax Compliance
                        </li>
    
                    </ul>
                    <a href="{{route('plan.checkout',isset($plans->stripe_plan_id) ? $plans->stripe_plan_id : '')}}"
                        class="inline-flex justify-center w-full px-4 py-3 mt-8 font-sans text-sm leading-none text-center text-blue-600 no-underline bg-transparent border border-blue-600 rounded-md cursor-pointer hover:bg-blue-700 hover:border-blue-700 hover:text-white focus-within:bg-blue-700 focus-within:border-blue-700 focus-within:text-white sm:text-base md:text-lg">
                        Start Now
                    </a>
                </div>
                @endforeach
                <!-- Price 2 -->
                {{-- <div
                    class="relative z-20 flex flex-col items-center max-w-md p-4 mx-auto my-0 bg-white border-4 border-blue-600 border-solid rounded-lg sm:p-6 md:px-8 md:py-16">
                    <h3
                        class="m-0 text-2xl font-semibold leading-tight tracking-tight text-black border-0 border-gray-200 sm:text-3xl md:text-4xl">
                        Basic
                    </h3>
                    <div class="flex items-end mt-6 leading-7 text-gray-900 border-0 border-gray-200">
                        <p class="box-border m-0 text-6xl font-semibold leading-none border-solid">
                            $29
                        </p>
                        <p class="box-border m-0 border-solid" style="border-image: initial;">
                            / month
                        </p>
                    </div>
                    <ul class="flex-1 p-0 mt-4 ml-5 leading-7 text-gray-900 border-0 border-gray-200">
                        <li class="inline-flex items-center block w-full mb-2 ml-5 font-semibold text-left border-solid">
                            <svg class="w-5 h-5 mr-2 font-semibold leading-7 text-blue-600 sm:h-5 sm:w-5 md:h-6 md:w-6"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            15 Websites
                        </li>
    
                        <li class="inline-flex items-center block w-full mb-2 ml-5 font-semibold text-left border-solid">
                            <svg class="w-5 h-5 mr-2 font-semibold leading-7 text-blue-600 sm:h-5 sm:w-5 md:h-6 md:w-6"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            SSL (HTTPS)
                        </li>
    
                        <li class="inline-flex items-center block w-full mb-2 ml-5 font-semibold text-left border-solid">
                            <svg class="w-5 h-5 mr-2 font-semibold leading-7 text-blue-600 sm:h-5 sm:w-5 md:h-6 md:w-6"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            Custom Domain
                        </li>
    
                        <li class="inline-flex items-center block w-full mb-2 ml-5 font-semibold text-left border-solid">
                            <svg class="w-5 h-5 mr-2 font-semibold leading-7 text-blue-600 sm:h-5 sm:w-5 md:h-6 md:w-6"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            SiteFast Branding Removal
                        </li>
                    </ul>
    
                    <a href="{{route('plan.checkout',isset($professional->plan_id) ? $professional->plan_id : '')}}"
                        class="inline-flex justify-center w-full px-4 py-3 mt-8 font-sans text-sm leading-none text-center text-white no-underline bg-blue-600 border rounded-md cursor-pointer hover:bg-blue-700 hover:border-blue-700 hover:text-white focus-within:bg-blue-700 focus-within:border-blue-700 focus-within:text-white sm:text-base md:text-lg">
                        Start Now
                    </a>
                </div> --}}
                <!-- Price 3 -->
                {{-- <div
                    class="relative z-10 flex flex-col items-center max-w-md p-4 mx-auto my-0 border border-solid rounded-lg lg:-ml-3 sm:my-0 sm:p-6 md:my-8 md:p-8">
                    <h3
                        class="m-0 text-2xl font-semibold leading-tight tracking-tight text-black border-0 border-gray-200 sm:text-3xl md:text-4xl">
                        Plus
                    </h3>
                    <div class="flex items-end mt-6 leading-7 text-gray-900 border-0 border-gray-200">
                        <p class="box-border m-0 text-6xl font-semibold leading-none border-solid">
                            $49
                        </p>
                        <p class="box-border m-0 border-solid" style="border-image: initial;">
                            / month
                        </p>
                    </div>
    
                    <ul class="flex-1 p-0 mt-4 leading-7 text-gray-900 border-0 border-gray-200">
                        <li class="inline-flex items-center block w-full mb-2 ml-5 font-semibold text-left border-solid">
                            <svg class="w-5 h-5 mr-2 font-semibold leading-7 text-blue-600 sm:h-5 sm:w-5 md:h-6 md:w-6"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            50 Websites
                        </li>
    
                        <li class="inline-flex items-center block w-full mb-2 ml-5 font-semibold text-left border-solid">
                            <svg class="w-5 h-5 mr-2 font-semibold leading-7 text-blue-600 sm:h-5 sm:w-5 md:h-6 md:w-6"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            SSL (HTTPS)
                        </li>
    
                        <li class="inline-flex items-center block w-full mb-2 ml-5 font-semibold text-left border-solid">
                            <svg class="w-5 h-5 mr-2 font-semibold leading-7 text-blue-600 sm:h-5 sm:w-5 md:h-6 md:w-6"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            Custom Domain
                        </li>
    
    
                        <li class="inline-flex items-center block w-full mb-2 ml-5 font-semibold text-left border-solid">
                            <svg class="w-5 h-5 mr-2 font-semibold leading-7 text-blue-600 sm:h-5 sm:w-5 md:h-6 md:w-6"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            SiteFast Branding Removal
                        </li>
    
    
                        <li class="inline-flex items-center block w-full mb-2 ml-5 font-semibold text-left border-solid">
                            <svg class="w-5 h-5 mr-2 font-semibold leading-7 text-blue-600 sm:h-5 sm:w-5 md:h-6 md:w-6"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            Google Analytics
                        </li>
    
                        <li class="inline-flex items-center block w-full mb-2 ml-5 font-semibold text-left border-solid">
                            <svg class="w-5 h-5 mr-2 font-semibold leading-7 text-blue-600 sm:h-5 sm:w-5 md:h-6 md:w-6"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            Email Integration
                        </li>
    
                    </ul>
                    <a href="{{route('plan.checkout',isset($enterprise->plan_id) ? $enterprise->plan_id : '')}}"
                        class="inline-flex justify-center w-full px-4 py-3 mt-8 font-sans text-sm leading-none text-center text-blue-600 no-underline bg-transparent border border-blue-600 rounded-md cursor-pointer hover:bg-blue-700 hover:border-blue-700 hover:text-white focus-within:bg-blue-700 focus-within:border-blue-700 focus-within:text-white sm:text-base md:text-lg">
                        Start Now
                    </a>
    
                </div> --}}
            </div>
            @endif
        </div>
    </section>
</x-app-layout>
