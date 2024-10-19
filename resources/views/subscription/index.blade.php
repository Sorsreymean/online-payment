<x-app-layout>
    <section class="container mx-auto p-6 font-mono">
      @if(session('alert-success'))
                <div class="alert alert-success" role="alert">
                    {{session('alert-success')}}
                </div>
      @else
        <div class="alert alert-success" role="alert">
          {{session('alert-failed')}}
        </div>
      @endif
        <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
          <div class="w-full overflow-x-auto">
            @if(count($subscriptions) > 0)
            <table class="w-full">
              <thead>
                <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                  <th class="px-4 py-3">Plan Name</th>
                  <th class="px-4 py-3">Subscription Name</th>
                  <th class="px-4 py-3">Price</th>
                  <th class="px-4 py-3">Company File</th>
                  <th class="px-4 py-3">Canceled At</th>
                  <th class="px-4 py-3">Activated Date</th>
                  <th class="px-4 py-3">Expired Date</th>
                  <th class="px-4 py-3">Action</th>
                </tr>
              </thead>
              <tbody class="bg-white">
                {{-- @php
                dd($sub);
                @endphp --}}
                @foreach($subscriptions as $subscription)
                <tr class="text-gray-700">
                  <td class="px-4 py-3 border">
                    {{$subscription->plan_name}}
                  </td>
                  <td class="px-4 py-3 text-ms border">{{$subscription->subscription_name}}</td>
                  <td class="px-4 py-3 text-ms border">{{$subscription->price}} $</td>
                  <td class="px-4 py-3 text-ms border">{{$subscription->company_file}}</td>
                  <td class="px-4 py-3 text-ms border">{{$subscription->ends_at}}</td>
                  <td class="px-4 py-3 text-ms border">{{date("d-M-Y",strtotime($subscription->activated_date))}}</td>
                  <td class="px-4 py-3 text-ms border">{{date("d-M-Y",strtotime($subscription->expired_date))}}</td>
                  <td class="px-4 py-3 text-ms border">
                    @if($subscription->ends_at == null)
                      <form method="POST" action="{{ route('cancel') }}">
                        @csrf
                        <input type="hidden" name="subscriptionName" value="{{$subscription->type}}" >
                        <button type="submit" class="bg-red-500 rounded p-2 text-white ">Cancel Sub</button>
                      </form>
                    @else
                      <form method="POST" action="{{ route('resume') }}">
                        @csrf
                        <input type="hidden" name="subscriptionName" value="{{$subscription->type}}" >
                        <button type="submit" class="bg-blue-500 rounded p-2 text-white ">Resume Sub</button>
                      </form>
                    @endif
                    
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            @else
            <h4>You are not subscribed to any plan</h4>
            @endif
          </div>
        </div>
      </section>

</x-app-layout>