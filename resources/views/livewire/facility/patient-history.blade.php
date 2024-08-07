<div class="signika-negative-100">
    <div class="flex justify-end">
        <a wire:navigate href="{{route('facility.patients')}}">
            <button type="button" class="flex text-sm text-gray-50 bg-gray-800 hover:bg-gray-600 p-2 font-semibold rounded-md border-2 border-gray-600 leading-6">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
              </svg>
              <span class="px-2">Return</span></button>
        </a>
    </div>

    <h1 class="text-4xl font-medium">Patient History</h1>
    <div class="mt-5 overflow-hidden bg-white shadow sm:rounded-lg">
        <div class="px-4 py-6 sm:px-6">
          <h3 class="text-base font-semibold leading-7 text-gray-900">Patient Information</h3>
          <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Personal details.</p>
        </div>
        <div class="border-t border-gray-100">
          <dl class="divide-y divide-gray-100">
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-900">Full name</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$record->first_name.' '.$record->last_name}}</dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-900">Address</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{$record->address}}</dd>
            </div>
            <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
              <dt class="text-sm font-medium text-gray-900">Birthday</dt>
              <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{Carbon\Carbon::parse($record->date_of_birth)->format('F, d Y')}}</dd>
            </div>
          </dl>
        </div>
      </div>
      {{-- diagnosis --}}

      <div class="mt-5 overflow-hidden bg-white shadow sm:rounded-lg">
        <div class="px-4 py-6 sm:px-6">
          <h3 class="text-base font-semibold leading-7 text-gray-900">Diagnosis History</h3>
          <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-500"></p>
        </div>
        <div class="border-t border-gray-100">
            <dl class="grid grid-cols-1 sm:grid-cols-2 px-5">
                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                  <dt class="text-sm font-medium leading-6 text-gray-900">Facility</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">St. Elizabeth</dd>
                </div>
                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-1 sm:px-0">
                  <dt class="text-sm font-medium leading-6 text-gray-900">Date of Diagnosis</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">August 09, 2024</dd>
                </div>
                <div class="border-t border-gray-100 px-4 py-6 sm:col-span-2 sm:px-0">
                  <dt class="text-sm font-medium leading-6 text-gray-900">Diagnosis</dt>
                  <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">Fugiat ipsum ipsum deserunt culpa aute sint do nostrud anim incididunt cillum culpa consequat. Excepteur qui ipsum aliquip consequat sint. Sit id mollit nulla mollit nostrud in ea officia proident. Irure nostrud pariatur mollit ad adipisicing reprehenderit deserunt qui eu.</dd>
                </div>
              </dl>
        </div>
      </div>

</div>
