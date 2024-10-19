<x-app-layout>
    <div class="flex justify-center items-center p-4">
        {{-- <form method="POST" action="{{ route('plan.store') }}" class="flex flex-col space-y-4">
            @csrf
            <div class="form-group">
                <label>Plan Name</label><br>
                <input type="text" name="name" class="form-control border rounded w-full" placeholder="Enter Email">
            </div>
            <div class="form-group">
                <label>Amount</label><br>
                <input type="text" name="amount" class="form-control border rounded w-full"
                    placeholder="Enter Amount">
            </div>
            <div class="form-group">
                <label>Currency</label><br>
                <input type="text" name="currency" class="form-control border rounded w-full"
                    placeholder="Enter currency">
            </div>
            <div class="form-group">
                <label>Interval Count</label><br>
                <input type="text" name="interval_count" class="form-control border rounded w-full"
                    placeholder="Enter count">
            </div>
            <div class="form-group">
                <label>Billing Period</label><br>
                <select name="billing_period" class="form-control border rounded w-full">
                    <option disabled selected>Choose billing method</option>
                    <option value="week">Weekly</option>
                    <option value="month">Monthly</option>
                    <option value="year">Yearly</option>
                </select>
            </div><br>
            <button type="submit" class="bg-blue-500 p-2 rounded text-white">Save</button>
        </form> --}}
        <div class="p-8 rounded border border-gray-200">
            <h1 class="font-medium text-3xl">Add Plan</h1>
            <p class="text-gray-600 mt-6">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dignissimos dolorem
                vel cupiditate laudantium dicta.</p>
            <form method="POST" action="{{ route('plan.store') }}">
                @csrf
                <div class="mt-8 grid lg:grid-cols-2 gap-4">
                    <div> <label for="name" class="text-sm text-gray-700 block mb-1 font-medium">Plan Name</label> <input
                            type="text" name="name" id="name"
                            class="bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700 w-full"
                            placeholder="Enter Plan name" /> </div>
                    <div> <label for="email" class="text-sm text-gray-700 block mb-1 font-medium">Price</label> <input type="text" name="amount" id="email"
                            class="bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700 w-full"
                            placeholder="0.00" /> </div>
                    <div> <label for="job" class="text-sm text-gray-700 block mb-1 font-medium">Billing Period</label>
                            <select name="billing_period" class="bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700 w-full">
                                <option disabled selected>Choose billing method</option>
                                <option value="week">Weekly</option>
                                <option value="month">Monthly</option>
                                <option value="year">Yearly</option>
                            </select>            
                     </div>
                    <div> <label for="brithday" class="text-sm text-gray-700 block mb-1 font-medium">Period</label>
                        <input type="text" name="interval_count" id="brithday"
                            class="bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700 w-full"
                            placeholder="period" /> </div>
                </div>
                <div class="space-x-4 mt-8"> <button type="submit"
                        class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-600 active:bg-blue-700 disabled:opacity-50">Save</button>
                    <a href="/plans"
                        class="py-2 px-4 bg-white border border-gray-200 text-gray-600 rounded hover:bg-gray-100 active:bg-gray-200 disabled:opacity-50">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
