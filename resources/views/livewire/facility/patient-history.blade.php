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
    <div class="p-6 flex-col text-sm w-1/4 font-medium divide-y-2 divide-gray-800">
      <div class="py-2">
        <span class="text-left">Philheath Number:</span>
        <span class="text-center">{{$record->philhealth_number}}</span>
    </div>
      <div class="py-2">
          <span class="text-left">Name:</span>
          <span class="text-center">{{$record->first_name.' '.$record->last_name}}</span>
      </div>
      <div class="py-2">
          <span class="text-left">Address:</span>
          <span class="text-center">{{$record->address}}</span>
      </div>
      <div class="py-2">
          <span class="text-left">Birthday:</span>
          <span class="text-center">{{Carbon\Carbon::parse($record->date_of_birth)->format('F, d Y')}}</span>
      </div>
      <div></div>
  </div>
  <div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
    </div>
    <div class="mt-8 flow-root">
      <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
          <table class="min-w-full divide-y divide-gray-300">
            <thead>
              <tr class="divide-x divide-gray-200">
                <th scope="col" class="py-3.5 pl-4 pr-4 text-left text-sm font-semibold text-gray-900 sm:pl-0">Facility</th>
                <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-gray-900">Date</th>
                <th scope="col" class="px-4 py-3.5 text-left text-sm font-semibold text-gray-900">Case</th>
                <th scope="col" class="py-3.5 pl-4 pr-4 text-left text-sm font-semibold text-gray-900 sm:pr-0">Diagnosis</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white">
               @forelse ($record->patient->patientHistory as $item)
               <tr class="divide-x divide-gray-200">
                <td class="whitespace-nowrap py-4 pl-4 pr-4 text-sm font-medium text-gray-900 sm:pl-0">{{$item->facility->name}}</td>
                <td class="whitespace-nowrap p-4 text-sm text-gray-500">{{Carbon\Carbon::parse($item->created_at)->format('F, d Y')}}</td>
                <td class="whitespace-nowrap p-4 text-sm text-gray-500">{{$item->caseCategory->name}}</td>
                    <td class="whitespace-normal p-4 text-sm text-gray-500">{{$item->diagnosis}}
                </td>
              </tr>
            @empty
                <tr class="divide-x divide-gray-200">
                    <td colspan="4" class="text-center whitespace-nowrap py-4 pl-4 pr-4 text-lg italic font-normal text-gray-900 sm:pl-0">
                        ---No Record Yet---
                    </td>
                </tr>
               @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="flex justify-end">
    {{ $this->addDiagnosisAction }}

    <x-filament-actions::modals />
    {{-- <a wire:navigate href="{{route('facility.patients')}}">
        <button type="button" class="flex text-sm text-gray-50 bg-green-800 hover:bg-green-600 p-2 font-semibold rounded-md border-1 border-green-600 leading-6">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
          </svg>

          <span class="px-2">Add Diagnosis</span></button>
    </a> --}}
</div>

</div>
